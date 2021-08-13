<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('login');
    }

    public function register(Request $request)
    {
        return view('register');
    }
    public function authenticate(Request $request)
    {
        if(filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    		$credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
		} else {
    		$credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);
            $credentials = [
                'id_no' => $request->email,
                'password' => $request->password
            ];
		}

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('view-results');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    
    public function logout(){
        \Auth::logout();

        return redirect('/');
    }
}
