<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function verifyAdmin()
    {
    	if(Auth::user()->privelege == 'Admin') {
    		return redirect()->route('admin_home');
    	}
    	
    	Auth::logout();

    	return redirect()->route('signin')->with('errormessage', 'Your Are Not Allowed to use the URL!');
    }
   
}
