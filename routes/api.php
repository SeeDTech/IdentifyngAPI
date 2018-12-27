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


// Route::resource('/users', 'UserApiController');
// Route::resource('/thirdparties', 'ThirdPartyController');  

Route::resource('subscriptions', 'SubscriptionController');
Route::middleware('api')->get('/hello_world', function () {
    return json_encode(['message' => 'hello world']);
});
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
