<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $reset_request = $request->except('_token');
        //validate entries
        $validateReset = \Validator::make($reset_request, [
            'email' => 'bail|required|max:100|min:3',
            'password' => 'bail|required|confirmed'
        ]);

        if ($validateReset->fails()) {
            return back()->withErrors($validateReset)
                        ->withInput();
        }

        if(filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    		$user = User::where('email', $request->email);
		} else {
    		$user = User::where('id_no', $request->email);
		}

        if($user == null) {
            return back()->withErrors(['email' => 'This specified email is not recognised'])
                        ->withInput();
        }

        $user->update([
            'password' => \Hash::make($reset_request['password'])
        ]);

        return redirect('/login')->with('message', 'Password has been reset successfully!');
    }
}
