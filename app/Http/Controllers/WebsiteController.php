<?php

namespace App\Http\Controllers;

use Auth;
use App\Website;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
{
	public function websiteForm()
	{
		return view('website.register');
	}

    public function registerWebsite(WebsiteRequest $request)
    {
    	$website = Website::create([
    		'domain' => $request['domain'],
    		'status'=> 1,
    		'user_id' => Auth::user()->id
    	]);

    	if (is_null($website) || empty($website)) {
    		return redirect()->route('dashboard-index')->with('message-website', "Something went wrong, we were unable to register your website. Try again");;
    	}

    	return redirect()->route('dashboard-index')->with('message-website', "website succesfully registered");
    }
}
