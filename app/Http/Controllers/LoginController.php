<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getSignIn(){
        return view('user.signIn');
    }

    public function postSignIn(Request $request){
        $this->validate($request, [
        'email' => 'email|required',
        'password' => 'required|min:4',
        'g-recaptcha-response' => 'required|captcha',
        ], [
        'g-recaptcha-response.required' => 'Please complete the reCAPTCHA to verify that you are not a robot.',
        'g-recaptcha-response.captcha' => 'The reCAPTCHA response was incorrect. Please try again.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Please enter your password.',
        'password.min' => 'Your password must be at least 4 characters long.',
        ]);
            if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            if (auth()->user()->role === 'admin') {
             return redirect()->route('admin.profile');
            }
            else if (auth()->user()->role === 'employee'){
             return redirect()->route('employee.profile');
            }
            else if (auth()->user()->role === 'supplier'){
             return redirect()->route('supplier.profile');
            }
            else return redirect()->route('customer.profile');
        }
        else return redirect()->route('user.login')->with('error','Email-Address And Password Are Wrong.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->guest('login');
    }
}
