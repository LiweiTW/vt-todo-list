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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Token API

Route::get("token/{token}", "TokenController@verifyToken");
Route::post("token/", "TokenController@getToken");

//Todo API
Route::middleware('token')->get('todo/', "TodoController@getTodos");
Route::middleware('token')->get('todo/{id}', "TodoController@getTodo");
Route::middleware('token')->post('todo/{id}', "TodoController@updateTodo");
Route::middleware('token')->post('todo/', "TodoController@createTodo");

