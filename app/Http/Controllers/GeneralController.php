<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function adminLogin()
    {
    	Auth::logout();
    	
    	return redirect()->route('adminlogin');
    }
}
