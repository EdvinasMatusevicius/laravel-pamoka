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
    // Route::prefix('auth')->group( function () {

    //     Route::post('register','AuthController@register')->name('register');
    //     Route::post('login', 'AuthController@login')->name('login');
    //     Route::post('logout', 'AuthController@logout')->name('logout');
    //     Route::post('refresh', 'AuthController@refresh')->name('refresh');
    //     Route::get('me', 'AuthController@me')->name('me');
    
    // });

    Route::prefix('auth')->group(function(){
        Route::post('register','AuthenticationController@register')->name('register');
        Route::post('login','AuthenticationController@login')->name('login');

        Route::middleware('auth:api')->group(function(){
            Route::post('logout','AuthenticationController@logout')->name('logout');
            Route::get('me','AuthenticationController@me')->name('me');
        });
    });

    Route::apiResource('categories','CategoryController')->only(['index','show']);
    Route::apiResource('products','ProductController')->only('index','show');
}
);