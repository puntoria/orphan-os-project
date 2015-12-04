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

Route::group(['prefix' => 'admin', 'as' => 'Admin::'], function() {
	get('users',     ['as' => 'users',     'uses' => 'UserController@users']);
	get('donors',    ['as' => 'donors',    'uses' => 'UserController@donors']);
	get('orphans',   ['as' => 'orphans',   'uses' => 'UserController@orphans']);
	get('dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);

	get('/', function() { 
		return redirect()->to( route('Admin::dashboard') ); 
	});
});

Route::group(['prefix' => 'donor', 'as' => 'Donor::'], function() {
	get('orphans',   ['as' => 'orphans',   'uses' => 'DonorController@orphans']);
	get('dashboard', ['as' => 'dashboard', 'uses' => 'DonorController@dashboard']);

	get('/', function() { 
		return redirect()->to( route('Donor::dashboard') ); 
	});
});
