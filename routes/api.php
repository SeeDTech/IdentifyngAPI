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
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


Route::get('open', 'Api\DataController@open');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => ['jwt.auth']], function() {
    
    Route::post('login', 'Api\UserController@authenticate');
    Route::get('user', 'Api\UserController@getAuthenticatedUser');
    Route::get('closed', 'Api\DataController@closed');
});





















// Route::resource('/users', 'UserApiController');
// Route::resource('/thirdparties', 'ThirdPartyController');  
// Route::post('register', 'AuthController@register');
// Route::post('login', 'AuthController@login');
// Route::post('recover', 'AuthController@recover');
// Route::group(['middleware' => ['jwt.auth']], function() {
//     Route::get('logout', 'AuthController@logout');
// });

// Route::group(['middleware' => ['jwt.auth']], function() {
//     Route::get('logout', 'AuthController@logout');
//     Route::get('test', function(){
//         return response()->json(['foo'=>'bar']);
//     });
// });
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/login', function (Request $request) {
    
//     if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
//         // Authentication passed...
//         $user = auth()->user();
//         $user->generateToken();
//         $user->save();
//         return $user;
//     }
    
//     return response()->json([
//         'error' => 'Unauthenticated user',
//         'code' => 401,
//     ], 401);
// });

// Route::middleware('auth:api')->post('/logout', function (Request $request) {
    
//     if (auth()->user()) {
//         $user = auth()->user();
//         $user->user_token = null; // clear user_token
//         $user->save();

//         return response()->json([
//             'message' => 'Thank you for using our Mobile Platform',
//         ]);
//     }
    
//     return response()->json([
//         'error' => 'Unable to logout user',
//         'code' => 401,
//     ], 401);
// });
