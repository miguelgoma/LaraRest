<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('user','UserController@user');
    Route::put('users/info','UserController@updateInfo');
    Route::put('users/password','UserController@updatePassword');
    
    Route::apiResource('users', 'UserController');
    Route::apiResource('roles', 'RoleController');
    Route::apiResource('products', 'ProductController');
});

// Route::get('users', 'UserController@index');
// Route::get('users/{id}', 'UserController@show');
// Route::post('users', 'UserController@store');
// Route::put('users/{id}', 'UserController@update');
// Route::delete('users/{id}', 'UserController@destroy');
