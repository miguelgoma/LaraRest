<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');
Route::group(['middleware'=>'auth:api'], function(){
    Route::apiResource('users', 'UserController');
});

// Route::get('users', 'UserController@index');
// Route::get('users/{id}', 'UserController@show');
// Route::post('users', 'UserController@store');
// Route::put('users/{id}', 'UserController@update');
// Route::delete('users/{id}', 'UserController@destroy');
