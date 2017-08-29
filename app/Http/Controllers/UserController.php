<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
    	$websites = Auth::user()->website;

    	return view('settings', compact('websites'));
    }
}
