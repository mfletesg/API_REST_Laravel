<?php

use Illuminate\Http\Request;
use App\User;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token, x_csrftoken');
Route::get('/user', function(){
  $items = User::all()->toJson();
  return response($items)->header('Content-Type', 'application/json');
});
