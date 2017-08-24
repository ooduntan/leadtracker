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
        $website = Auth::user()->website;
        $visitors = [];
        foreach ($website as $key => $value) {
            array_push($visitors, Visitor::findAllById($value->id));
        }

     	return view('visitor.visitor', compact('visitors', 'categories'));
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
