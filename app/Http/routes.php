<?php

/*
|--------------------------------------------------------------------------
| Application Routes:: Room and Appartment Rental
|--------------------------------------------------------------------------
|
| Note: Client is an authenticated user of the application
|
*/
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Route to Home Page of the application
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
	$data = array(
		'homeactive' => 'active',
		'aboutactive' => '',
		'signinactive' => '',
		'signupactive' => ''
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}

    return view('pages.home', $data);
})->name('home');

/*
|--------------------------------------------------------------------------
| Route to About Page of the application
|--------------------------------------------------------------------------
*/
Route::get('about', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => 'active',
		'signinactive' => '',
		'signupactive' => ''
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.about2',$data);
})->name('about');

/*
|--------------------------------------------------------------------------
| Route to Signin Page of the application
|--------------------------------------------------------------------------
*/
Route::get('member_signup', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => '',
		'signinactive' => '',
		'signupactive' => 'active'
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.signup',$data);
})->name('signup');

/*
|--------------------------------------------------------------------------
| Singup Route using the UserController@userSignup method
|--------------------------------------------------------------------------
*/
Route::post('user_signup', [
		'uses' => 'UserController@userSignup'
	]);

/*
|--------------------------------------------------------------------------
| Signin Route using the UserController@userSignin method
|--------------------------------------------------------------------------
*/
Route::post('user_signin', [
		'uses' => 'UserController@userSignin'
	]);


/*
|--------------------------------------------------------------------------
| Route to Signin Page of the application
|--------------------------------------------------------------------------
*/
Route::get('member_signin', function () {
	$data = array(
		'homeactive' => '',
		'aboutactive' => '',
		'signinactive' => 'active',
		'signupactive' => ''
		);

	if(Auth::check()) {
		return redirect()->route('home_user');
	}
	
	return view('pages.signin',$data);
})->name('signin');


/*
|--------------------------------------------------------------------------
| Route Group: prefix => user
| This Route Group is protected route: 'middleware' => 'auth'
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
	/*
	|--------------------------------------------------------------------------
	| Route to Client Home Page, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('/', function () {
		return view('pages.client.home');
	})->name('home_user');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Search Result, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('search', function () {
		return view('pages.client.search');
	})->name('search');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Posts, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('posts', ['uses' => 'PostController@index'], function () {
		return view('pages.client.posts');
	})->name('myposts');

	/*
	|--------------------------------------------------------------------------
	| This route is use to see or view specific post of user/client viewing it
	|--------------------------------------------------------------------------
	*/
	Route::get('post/{id}',[
		'uses' => 'PostController@postView',
		'as' => 'post'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route use to add post by the client
	|--------------------------------------------------------------------------
	*/
	Route::post('postaddpost', [
		'uses' => 'PostController@postAddPost',
		'as' => 'postaddpost'
		]);

	/*
	|--------------------------------------------------------------------------
	| Route to Client Add Posts view, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('addpost', function () {
		return view('pages.client.addpost');
	})->name('addpost');

	/*
	|--------------------------------------------------------------------------
	| Route to Client About, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('about', function () {
		return view('pages.client.about');
	})->name('client_about');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Browse Posts, Needed to be authenticated
	|--------------------------------------------------------------------------
	*/
	Route::get('browse', ['uses' => 'PostController@browsePosts'], function () {
		return view('pages.client.browse');
	})->name('browse');

	/*
	|--------------------------------------------------------------------------
	| Route to Client Profile
	|--------------------------------------------------------------------------
	*/
	Route::get('profile', function () {
		return view('pages.client.profile');
	})->name('profile');

	/*
	|--------------------------------------------------------------------------
	| Logout route
	|--------------------------------------------------------------------------
	*/
	Route::get('logout', [
		'uses' => 'UserController@getLogout',
		'as' => 'logout'
		]);

});


/*
|--------------------------------------------------------------------------
| Route to admin login using URI
|--------------------------------------------------------------------------
*/
Route::get('admin', 'GeneralController@adminLogin');
Route::get('administrator', 'GeneralController@adminLogin');

Route::get('admin-login', function () {
	Auth::logout();
	return view('pages.adminlogin');
})->name('adminlogin');

/*
|--------------------------------------------------------------------------
| Route Group: prefix => admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

	Route::get('home', function () {
		return view('pages.admin.home');
	})->name('admin_home');

});




/*
|--------------------------------------------------------------------------
| Route to Show Errors
|--------------------------------------------------------------------------
*/
Route::get('exception-error', function () {
	return view('pages.exceptionerror');
})->name('showerrors');