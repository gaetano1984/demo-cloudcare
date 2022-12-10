<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('auth', ['App\Http\Controllers\AuthController', 'getToken'])->name('user_login');
Route::post('auth', ['App\Http\Controllers\AuthController', 'getToken']);
Route::group(['prefix' => 'beer', 'middleware' => 'apiauth'], function(){
    Route::get('search', function(){
        return Response::json(['beer' => []], 200);
    });
});
