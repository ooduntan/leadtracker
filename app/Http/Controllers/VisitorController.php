<?php

namespace App\Http\Controllers;

use Auth;
use App\Note;
use App\Visitor;
use App\Website;
use App\Company;
use App\Category;
use App\Activity;
use Carbon\Carbon;
use \GuzzleHttp\Client;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Http Client
     *
     * @var \GuzzleHttp\Client $client
     */
    protected $client;

    /**
     * Constructor, initializes admin report with http client
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * get ripe data from the route base on ip passed
     *
     * @param Request $request
     */
    public function getRipeData(Request $request)
    {
    	// $request->ip = '62.154.197.162';
        $res = $this->client->request('GET', 'http://rest.db.ripe.net/search.json?query-string=' . $request->ip, [
		    //'auth' => ['user', 'pass']
		]);

		$decodedBody = json_decode($res->getBody());
        $data = $decodedBody->objects->object[0]->attributes->attribute;

        $this->storeData($data);
     }

    /**
     * Get data from getRipeData method and save
     *
     * @param $data
     */
    public function storeData($data)
    {
        // dd($data);
        $visitor = Visitor::create([
            'website_id' => 1,
            'ip_address' => $data[0]->value,
            'country' => $data[3]->value,
            'company' => $data[1]->value,
            'description' => $data[2]->value,
            'links' => json_encode([$data[4]->link->href, $data[5]->link->href, $data[7]->link->href]),
            'source' => $data[10]->value,
            'first_seen' => $data[8]->value,
            'last_seen' => $data[9]->value,
        ]);

        $company = Company::create([
            'visitor_id' => $visitor->id,
            // 'contact_name' => "",
            // 'contact_email' => "",
            'company_name' => $visitor->company,
            // 'company_billing_email' => "",
            // 'street' => "",
            'country' => $visitor->country,
            // 'postal_code' => "",
            // 'website' => "",
            // 'city' => "",
            // 'vat_id' => "",
        ]);

        if ($visitor && $company) {
            return redirect()->route('dashboard-index')->with('message-success', 'You succesfully saved ripe data into the database');
        }

        return redirect()->route('dashboard-index')->with('message-failure', 'Something went wrong');
    }

     public function getNewVisitors()
     {
        $categories = Category::get();
        $websites = Auth::user()->websites;
        $visitors = [];
        $value = [];
        $this->addAllToWebsites($websites);

        foreach ($websites as $key => $value) {
            array_push($visitors, Visitor::where([['website_id', $value->id], ['category_id', null]])->get());
        }

        return view('visitor.visitor', compact('visitors', 'categories', 'websites', 'value'));
     }

     public function getVisitors()
     {
        $categories = Category::get();
        $websites = Auth::user()->websites;
        $visitors = [];
        $value = [];
        $this->addAllToWebsites($websites);

        foreach ($websites as $key => $value) {
            array_push($visitors, Visitor::where('website_id', $value->id)->get());
        }

     	return view('visitor.visitor', compact('visitors', 'categories', 'websites', 'value'));
     }

     public function fetchByWebsite(Request $request)
     {
        $categories = Category::get();
        $websites = Auth::user()->website;
        $visitors = [];
        $value = [];
        $this->addAllToWebsites($websites);
        if ($request->websiteId == 0) {
            return redirect()->route('visitors');
        }
        $website = Website::where('id', $request->websiteId)->get();
        array_push($value, $website);

        foreach ($website as $key => $value) {
            array_push($visitors, Visitor::where('website_id', $value->id)->get());
        }

        return view('visitor.visitor', compact('visitors', 'categories', 'websites', 'value'));
     }

     private function addAllToWebsites($websites)
     {
        $obj1 = new \stdClass();
        $obj2 = new \stdClass();
        $obj1->website = $obj2;
        $obj2->id = 0;
        $obj2->domain = 'All';
        $websites->push($obj2);
     }

     public function getActions(Request $request)
     {
        $categories = Category::all();
        $category = Category::where('id', $request->category)->first();
        $visitors = Visitor::where('category_id', $request->category)->get();

        return view('visitor.visitor-actions', compact('visitors', 'category', 'categories'));
     }

    public function getLeadVisitor()
    {
        $categories = Category::all();
        $category = Category::where('id', 3)->first();
        $visitors = Visitor::where('category_id', 3)->get();

        return view('visitor.visitor-actions', compact('visitors', 'category', 'categories'));
    }

    public function getCustomerVisitor()
    {
        $categories = Category::all();
        $category = Category::where('id', 1)->first();
        $visitors = Visitor::where('category_id', 1)->get();

        return view('visitor.visitor-actions', compact('visitors', 'category', 'categories'));
    }

    public function getCompetitorVisitor()
    {
        $categories = Category::all();
        $category = Category::where('id', 2)->first();
        $visitors = Visitor::where('category_id', 2)->get();

        return view('visitor.visitor-actions', compact('visitors', 'category', 'categories'));
    }

    public function getVisitorDetails(Request $request)
    {
        $visitor = Visitor::where('id', $request->id)->first();
        $company = Company::where('visitor_id', $request->id)->first();
        $categories = Category::get();
        $notes = Note::get();

        return view('visitor.visitor-details', compact('visitor', 'categories', 'company', 'notes'));
    }

    public function updateVisitorDetails(Request $request)
    {
        if ($_POST['form-a'] !== null) {
            $company = Company::where('visitor_id', $request->id)->update([
                'contact_name' => $request->contact,
                'contact_email' => $request->email,
                'category_id' => $request->categoryId,
                'contact_phone' => $request->phone,
            ]);

            $visitor = Visitor::where('id', $request->id)->update([
                'status' => 1,
                'category_id' => $request->categoryId,
            ]);

            if ($company && $visitor) {
                return redirect('/visitor/' . $request->id . '/details')->with('message-success', 'You succesfully updated the contact');
            }

            return redirect()->route('dashboard-index')->with('message-failure', 'Something went wrong when updating the contact');
        }

        return redirect()->route('dashboard-index')->with('message-failure', 'Wrong form');
    }

    public function classify(Request $request)
    {
        $visitor = Visitor::where('id', $request->visitorId)->update([
            'status' => 1,
            'category_id' => $request->categoryId,
        ]);

        if ($visitor == 1) {
            return redirect()->route('visitors')->with('message-success', 'You succesfully clasify the visitor');
        } else {
            return redirect()->route('visitors')->with('message-failure', 'Oops, something went wrong');
        }
    }
}
