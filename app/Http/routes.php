<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/* Login */
get('dashboard', ['as' => 'Auth::dashboard', 'uses' => 'HomeController@dashboard']);
get('login',     ['as' => 'Auth::login',     'uses' => 'Auth\AuthController@getLogin']);
get('logout',    ['as' => 'Auth::logout',    'uses' => 'Auth\AuthController@getLogout']);
post('login',    ['as' => 'Auth::postLogin', 'uses' => 'Auth\AuthController@postLogin']);

get('/', function() {
	$route = \Auth::check() ? 'Auth::dashboard' : 'Auth::login';

	return redirect()->to( route($route) );
});

/* Admin routes */
Route::group(['prefix' => 'admin', 'as' => 'Admin::', 'middleware' => ['auth', 'auth.admin']], function() {
	get('users',     ['as' => 'users',     'uses' => 'AdminController@users']);
	get('donors',    ['as' => 'donors',    'uses' => 'UserController@donors']);
	get('orphans',   ['as' => 'orphans',   'uses' => 'UserController@orphans']);
	get('dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);

	get('/', function() { 
		return redirect()->to( route('Admin::dashboard') ); 
	});
});


/* Donor Routes */
Route::group(['prefix' => 'donor', 'as' => 'Donor::', 'middleware' => ['auth', 'auth.donor']], function() {
	get('orphans',   ['as' => 'orphans',   'uses' => 'DonorController@orphans']);
	get('dashboard', ['as' => 'dashboard', 'uses' => 'DonorController@dashboard']);

	get('/', function() { 
		return redirect()->to( route('Donor::dashboard') ); 
	});
});

get('api/v1/orphans', 'Api\v1\OrphanController@index');