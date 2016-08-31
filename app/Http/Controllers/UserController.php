<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Illuminate\Support\Facades\Auth;

use Image;

use DB;


class UserController extends Controller
{
    public function showUserProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('pages.client.showuserprofile', $user);
    }


    /*
    |--------------------------------------------------------------------------
    | This method is use to show members of app
    |--------------------------------------------------------------------------
    */
    public function showMembers()
    {
        $members = DB::table('users')->where('privelege', 'User')->orderBy('created_at','asc')->paginate(9);

        return view('pages.admin.members', ['members' => $members]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method is used to update the profile picture of user
    |--------------------------------------------------------------------------
    */
    public function profileImage(Request $request)
    {
        if($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time() . '.' . $profile->getClientOriginalExtension();
            Image::make($profile)->resize(300, 300)->save(public_path('/uploads/profiles/' . $filename));

            $user = Auth::user();
            $user->profile = $filename;
            $user->save();
        }

        return redirect()->route('profile-edit');
    }

    /*
    |--------------------------------------------------------------------------
    |This methos is to change password of client
    |--------------------------------------------------------------------------
    */
    public function passwordUpdate(Request $request)
    {
        //validation required
        $user_id = $request['user_id'];
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $new_password2 = $request['new_password2'];

        $user = User::find($user_id);

        $password_compare = password_verify($old_password, $user->password);
        
        if($password_compare == True) {

            if($new_password == $new_password2) {
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect()->route('changepass')->with('message','Password Change Successfully');
            }

            return redirect()->route('changepass')->with('error_msg','Password not match.');
        }

        return redirect()->route('changepass')->with('error_msg', 'Wrong Password.');
       
    }

    /*
    |--------------------------------------------------------------------------
    |This methos is use to update profile of the client
    |--------------------------------------------------------------------------
    */
    public function updateUserProfile(Request $request)
    {
        //needs validation
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $email = $request['email'];
        $mobile = $request['mobile'];
        $birthday = $request['bday'];
        $gender = $request['gender'];
        $user_id = $request['user_id'];

        // the current filename/profile name of the user
        $filename = Auth::user()->profile;

        if($request->hasFile('profileimg')) {
            $profile = $request->file('profileimg');
            $filename = time() . '.' . $profile->getClientOriginalExtension();
            Image::make($profile)->resize(300, 300)->save(public_path('/uploads/profiles/' . $filename));

        }
        // else {
        //     $filename = Auth::user()->profile;
        // }

        $update = User::find($user_id);

        $update->firstname = $firstname;
        $update->lastname = $lastname;
        $update->email = $email;
        $update->mobile = $mobile;
        $update->birthday = $birthday;
        $update->gender = $gender;
        $update->profile = $filename;

        $update->save();

        return redirect()->route('profile')->with('message', 'Profile Successfully Updated!');
    }

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
                return redirect()->route('admin_home');
            }
            else {
        		return redirect()->route('home_user');
            }
    	}
    	return redirect()->route('signin')->with('error_msg','Incorrect Email or Password!')->withInput();
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
