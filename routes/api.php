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


Route::namespace('API')->name('api.')->group(function(){


    Route::prefix('auth')->group(function(){
        Route::post('register','AuthenticationController@register')->name('register');
        Route::post('login','AuthenticationController@login')->name('login');

        Route::middleware('auth:api')->group(function(){
            Route::post('logout','AuthenticationController@logout')->name('logout');
            Route::get('me','AuthenticationController@me')->name('me');
        });
    });

}
);