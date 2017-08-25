<?php

namespace App\Http\Controllers;

use Auth;
use App\Visitor;
use App\Website;
use App\Category;
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

    public function getRipeData(Request $request)
    {
    	$ip = '62.154.197.162';
        $res = $this->client->request('GET', 'http://rest.db.ripe.net/search.json?query-string=' . $ip, [
		    //'auth' => ['user', 'pass']
		]);

		dd(json_decode($res->getBody()));
     }

     public function getVisitors()
     {
        $categories = Category::get();
        $websites = Auth::user()->website;
        $visitors = [];
        foreach ($websites as $key => $value) {
            array_push($visitors, Visitor::where('website_id', $value->id)->get());
        }

        // dd($visitors);


     	return view('visitor.visitor', compact('visitors', 'categories', 'websites'));
     }

     public function fetchByWebsite(Request $request)
     {
        $categories = Category::get();
        $websites = Auth::user()->website;
        $website = Website::where('id', $request->websiteId)->get();
        // $visitors = Visitor::where('website_id', $website->id)->get();
        $visitors = [];
        foreach ($website as $key => $value) {
            array_push($visitors, Visitor::where('website_id', $value->id)->get());
        }

        return view('visitor.visitor', compact('visitors', 'categories', 'websites'));
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
