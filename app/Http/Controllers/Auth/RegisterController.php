<?php

namespace App\Http\Controllers\Auth;

use App\User;
use PHPMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->middleware('guest');
        $this->mailer = $mailer;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $confirmationCode = str_random(30);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role_id' => 2,
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmationCode,
        ]);
    }

    public function confirm($confirmation_code)
    {
        $user = User::where('confirmation_code', $confirmation_code)->first();

        if ($user) {
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();

            return redirect()->route('postLogin')->with('message-confirm', "You have successfully verified your account. You can login");
        }

        return redirect()->route('postLogin')->with('message-confirm', "Oops! Something went wrong, please re-register");
    }

    /**
     * Send mail to patient
     *
     * @param  Request  $request
     * @return dashboard
     */
    protected function sendConfirmationEmail($data)
    {
        $confirmationCode = $data['confirmation_code'];

        $this->mailer->isSMTP();
        $this->mailer->Host = env('Host');
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = env('Username');
        $this->mailer->Password = env('Password');
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Port = 465;

        $this->mailer->addAddress($data['email']);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = 'Verify your email address';
        $this->mailer->Body    = view('confirmEmail', compact('confirmationCode'));

        if(!$this->mailer->send()) {

            return redirect()->route('postLogin')->with('message-email', "Oops, something went wrong: " . $this->mailer->ErrorInfo);
        } else {
            return redirect()->route('postLogin')->with('message-email', "Thanks for signing up! A confirmation email has been sent to your email. Please click the link sent to your email to confirm your account.");
        }
    }
}
