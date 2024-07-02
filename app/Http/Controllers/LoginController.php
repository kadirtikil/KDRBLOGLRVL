<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse {
        $creds = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // checks if user matches any in the database. hashing of pw not necessary, laravel does that on its own (compares both hashed values).
        if(Auth::attempt($creds)){
            $request->session()->regenerate();

            // intended redirects the user to the page they tried to acess, before they were intercepted by the authentication
            return redirect()->intended('dashboard');
        }

        // return an error if no  matches can be found
        return back()->withErrors([
            'email' => 'The provided credentials dont match any of our records.',
        ])->onlyInput('email');

    }


    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/');
    }

}
