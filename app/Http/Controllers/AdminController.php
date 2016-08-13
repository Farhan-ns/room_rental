<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
   	/*
    |--------------------------------------------------------------------------
    | This method is use to show admin profile
    |--------------------------------------------------------------------------
    */
    public function showAdminProfile()
    {
    	return view('pages.admin.show_admin_profile');
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to verify the admin user
    |--------------------------------------------------------------------------
    */
    public function verifyAdmin()
    {
    	if(Auth::user()->privelege == 'Admin') {
    		return redirect()->route('admin_home');
    	}
    	
    	Auth::logout();

    	return redirect()->route('signin')->with('errormessage', 'Your Are Not Allowed to use the URL!');
    }
   
}
