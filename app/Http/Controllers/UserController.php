<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class UserController extends Controller
{
    
    public function userSignup(Request $request)
    {
    	$email = $request['email'];
    	$firstname = $request['firstname'];
    	$lastname = $request['lastname'];
    	$bday = $request['bday'];
    	$gender = $request['gender'];
    	$mobile = $request['mobile'];
    	$password = $request['password'];
    	$password2 = $request['password2'];

    	$user = new User();

    	$user->email = $email;
    	$user->firstname = $firstname;
    	$user->lastname = $lastname;
    	$user->gender = $gender;
    	$user->birthday = $bday;
    	$user->mobile = $mobile;
    	$user->password = bcrypt($password);

    	$user->save();

    	return redirect()->route('signup');

    }
}
