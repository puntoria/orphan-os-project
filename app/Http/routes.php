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

/*get('migrate', [
	// 'middleware' => ['auth', 'auth.superadmin'], 
	'uses' => 'HomeController@migrateOldDatabase']);*/

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

Route::group(['prefix' => 'me', 'as' => 'Profile::', 'middleware' => 'auth'], function() {
	get('/', ['as' => 'me', 'uses' => 'UserController@profile']);
});

Route::group(['prefix' => 'api/v1', 'as' => 'Api::', 'middleware' => 'auth'], function() {

	/**********************************************************************
    	ORPHAN API ROUTES
	**********************************************************************/
	get('orphans/get/{filter?}', 'Api\v1\OrphanController@index');
	get('orphans/csv', ['as' => 'OrphanCSV', 'uses' => 'Api\v1\OrphanController@csv']);
	get('orphans/pdf',  'Api\v1\OrphanController@massPdf');
	get('orphans/stats',  'Api\v1\OrphanController@stats');
	post('orphans/photo',  'Api\v1\OrphanController@photo');
	post('orphans/create', 'Api\v1\OrphanController@create');
	post('orphans/update', 'Api\v1\OrphanController@massUpdate');
	post('orphans/delete', 'Api\v1\OrphanController@massDelete');
	post('orphans/document',  'Api\v1\OrphanController@document');

	Route::group(['prefix' => 'orphans/{id}', 'as' => 'Orphans::'], function() {
		get('/', 'Api\v1\OrphanController@show');
		get('pdf', ['as' => 'PDF', 'uses' => 'Api\v1\OrphanController@pdf']);
		get('finances/{year}', ['as' => 'Report', 'uses' => 'Api\v1\OrphanController@finances']);

		post('update', 'Api\v1\OrphanController@update');
		post('delete', 'Api\v1\OrphanController@delete');
		post('finances/{year}/delete', 'Api\v1\OrphanController@deleteFinances');
	});

	Route::group(['prefix' => 'photo/{name}', 'as' => 'Photos::'], function() {
		post('delete', 'Api\v1\OrphanController@removePhoto');
	});

	Route::group(['prefix' => 'document/{name}', 'as' => 'Documents::'], function() {
		post('delete', 'Api\v1\OrphanController@removeDocument');
	});


	/**********************************************************************
    	DONOR API ROUTES
	**********************************************************************/
	get('donors/get/{filter?}', 'Api\v1\DonorController@index');
	get('donors/stats', 'Api\v1\DonorController@stats');
	get('donors/csv', ['as' => 'DonorCSV', 'uses' => 'Api\v1\DonorController@csv']);
	post('donors/create', 'Api\v1\DonorController@create');
	post('donors/delete', 'Api\v1\DonorController@massDelete');

	Route::group(['prefix' => 'donors/{id}', 'as' => 'Donors::'], function() {
		get('/', 'Api\v1\DonorController@show');
		get('orphans/get/{filter?}', 'Api\v1\DonorOrphansController@index');
		get('orphans/withoutDonation', 'Api\v1\DonorOrphansController@withoutDonation');
		get('orphans/stats', 'Api\v1\DonorOrphansController@stats');
		get('orphans/csv', ['as' => 'DonorOrphansCSV', 'uses' => 'Api\v1\DonorOrphansController@csv']);
		post('update', 'Api\v1\DonorController@update');
		post('delete', 'Api\v1\DonorController@delete');
	});

	/**********************************************************************
    	USER API ROUTES
	**********************************************************************/
	get('users/get/{filter?}', 'Api\v1\UserController@index');
	get('users/stats', 'Api\v1\UserController@stats');
	post('users/create', 'Api\v1\UserController@create');
	post('users/delete', 'Api\v1\UserController@massDelete');

	Route::group(['prefix' => 'users/{id}', 'as' => 'Users::'], function() {
		get('/', 'Api\v1\UserController@show');
		post('update', 'Api\v1\UserController@update');
		post('delete', 'Api\v1\UserController@delete');
		post('update/me', 'Api\v1\UserController@updateProfile');
	});

	post('email', 'Api\v1\EmailController@send');

	get('dashboard', 'Api\v1\DashboardController@index');
});
