<?php

use App\Http\Middleware\RouteAccessMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::namespace('Admin\Auth')->prefix('admin')->name('admin.')->group(function(){
    Route::get('login', 'LoginController@showLoginForm')
    ->name('login');

    Route::post('login','LoginController@login');
    Route::post('logout','LoginController@logout')->name('logout');

    Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');

    Route::post('password/reset','ResetPasswordController@reset')->name('password.update');

});

Route::middleware('auth:admin', RouteAccessMiddleware::ALIAS)->group(function () {
    Route::namespace('Admin')->group(function(){
        
        Route::get('admins/me', 'AdminController@me')
            ->name('admins.me');
        Route::resource('admins', 'AdminController')->except('show');
        Route::resource('roles', 'RoleController');

        Route::resource('supplier','SupplyController');

    });
    Route::resource('customers', 'CustomerController');

    Route::prefix('products')->name('products.')->group(function () {

        Route::resource('attributes', 'ProductAttributeController')
            ->except(['show']);
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', 'CategoryController@index')
            ->name('index');
        Route::get('create', 'CategoryController@create')
            ->name('create');
        Route::post('/', 'CategoryController@store')
            ->name('store');
        Route::get('{category}/edit', 'CategoryController@edit')
            ->name('edit');
        Route::put('{category}', 'CategoryController@update')
            ->name('update');
        Route::delete('{category}', 'CategoryController@destroy')
            ->name('destroy');
    });
    
});
