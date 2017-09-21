<?php

namespace App\Http\Controllers;

use Auth;
use App\Website;
use \GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
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

	public function websiteForm()
	{
		return view('website.register');
	}

    public function registerWebsite(WebsiteRequest $request)
    {
        $res = $this->client->request('GET', 'http://ip-api.com/json/' . str_replace("http://", "", $request->domain), [
            //'auth' => ['user', 'pass']
        ]);
        $decodedBody = json_decode($res->getBody());

    	$website = Website::create([
    		'domain' => $request['domain'],
    		'status'=> 1,
            'ip_address' => $decodedBody->query,
    		'user_id' => Auth::user()->id,
    	]);

    	if (is_null($website) || empty($website)) {
    		return redirect()->route('dashboard-index')->with('message-website', "Something went wrong, we were unable to register your website. Try again");;
    	}

    	return redirect()->route('dashboard-index')->with('message-website', "website succesfully registered");
    }
}
