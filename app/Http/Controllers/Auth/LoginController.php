<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function signIn(Request $request){
        return view('adminpanel.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password), $remember_me)) {

            $user = Auth::user();

            // if($user->hasRole('admin')){
            //     return redirect()->intended(route('dashboard'));
            // }

            // Check if the user has verified their email
            // if (!$user->hasVerifiedEmail()) {

            //     // Generate a unique token and store it in session or cookie
            //     $token = session('verification_token') ? session('verification_token') : Str::random(64);
                
            //     session(['verification_token' => $token, 'email' => $user->email]);

            //     // Send verification email with the token
            //     Notification::route('mail', $user->email)->notify(new VerifyEmailNotification($token));
                
            //     Auth::logout();
            //     return back()->with('error', 'Verification mail has been sent, please verify your email address before logging in.');
            // }

            return redirect()->intended(route('dashboard'));
        }

        return back()->with('error', "These credentials doesn't match with our records");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        
        return redirect()->to(url('/'));
    }
}
