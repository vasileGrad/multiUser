<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct()
	{
		// we always doing people that are not logged in as admin is who we're redirecting OR who we want to be have access to this
		$this->middleware('guest:admin', ['except' => ['logout']]);
        //  not to use this middleware for the logout
	}


    public function showLoginForm() 
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	// 1. Validate the form data

    	// 2. Attempt to log the user in

    	// 3. If successful, then redirect to their intended location

    	// 4. If unsuccessful, then redirect back to the login with the form data


    	// 1.
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	// 2.
    	// returns true if it was successful or false if it was not successful
    	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		// 3.
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	// 4.
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
