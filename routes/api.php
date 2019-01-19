<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


// V1 Routes
Route::group(['prefix' => 'v1'], function () {
	
	// Auth routes
	Route::post('/register', 'API\UserController@register');
    Route::post('/login', 'API\UserController@login');

	// The below is a web route. It has to go
	// Route::post('/recover', 'API\UsersController@recover');

	// Route that shouldn't refresh token
	Route::group(['middleware' => ['jwt.auth']], function() {
		Route::get('/logout', 'API\UserController@logout');
		Route::get('user', 'Api\UserController@getAuthUser');
	});

	// Routes that require authentication and refreshes token
	Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function () {
		// User routes
		Route::group(['prefix' => 'users', 'middleware' => 'check.users'], function () {
			Route::get('/{id}', [
				'as' => 'users.show',
				'uses' => 'API\UserController@show'
			]);
			Route::put('/{id}', 'API\UserController@update');
		});
		// Ping route to refresh token
		Route::get('/ping', 'API\UserController@ping');
	});

    // Public routes        
    Route::get('open', 'Api\DataController@open');
	
});

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('closed', 'Api\DataController@closed');
});

// Route::resource('/users', 'UserApiController');

























































// Route::group([

//     'middleware' => 'api',
//     'namespace' => 'App\Http\Controllers',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });