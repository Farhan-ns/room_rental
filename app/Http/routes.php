<?php

/*
|--------------------------------------------------------------------------
| Application Routes:: Room and Appartment Rental
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

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
	return view('pages.about',$data);
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
	return view('pages.signup',$data);
})->name('signup');

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
	return view('pages.signin',$data);
})->name('signin');


/*
|--------------------------------------------------------------------------
| Route Group: prefix => user
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user'], function () {
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

});
