<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /*
	|--------------------------------------------------------------------------
	| This method is use the user to create account in the application
	|--------------------------------------------------------------------------
	*/
    public function userSignup(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email|unique:users',
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'bday' => 'required|date',
    		'gender' => 'required',
    		'mobile' => 'required',
    		'password' => 'required|confirmed|min:6|max:64',
    		'password_confirmation' => 'required|min:6|max:64'
    		]);

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

    	return redirect()->route('signup')->with('message', 'Successfully Signedup!');

    }

    /*
	|--------------------------------------------------------------------------
	| This method is use to Signin a registered/authentiated user
	|--------------------------------------------------------------------------
	*/
    public function userSignin(Request $request)
    {
    	$remember = $request['remember'];

    	if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $remember)) {

            if(Auth::user()->privelege == 'Admin') {
                Auth::logout();
                return redirect()->route('signin')->with('errormessage', 'Privelege Error!');
            }
    		return redirect()->route('home_user');
    	}

    	return redirect()->route('signin')->with('errormessage','Incorrect Email or Password!')->withInput();
    }

    /*
	|--------------------------------------------------------------------------
	| This method is use to logout any signedin user
	|--------------------------------------------------------------------------
	*/
    public function getLogout(Request $request)
    {
    	Auth::logout();

    	return redirect()->route('home');
    }


}
