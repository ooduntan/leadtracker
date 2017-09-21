<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return User
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {

            return redirect()->route('login')->with('message-failed', "Your email is not in our record, please register this email");
        }

        if ($user->confirmed === 0) {
            return redirect()->route('login')->with('message-confirm', "You haven't confirm your email yet, please do confirm your email in the link sent to your email");
        }
        $authStatus = Auth::attempt($request->only(['email', 'password']), $request->has('remember'));

        if (!$authStatus) {

            return redirect()->route('login')->with('message-failed', "Your record does not match our credentials, please try again with the correct records");
        }

        return redirect()->intended('/');
    }
}
