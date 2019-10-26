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

Route::group([
    'prefix'     => 'auth',
    'namespace'  => 'V1\Authentication',
    'limit'      => 50,
    'expires'    => 1
], function () {
    Route::post('register', 'AuthenticationController@register');
    Route::post('login', 'AuthenticationController@login');
});

Route::group([
    'prefix'     => 'auth',
    'namespace'  => 'V1\Authentication',
    'middleware' => 'auth:api',
    'limit'      => 50,
    'expires'    => 1
], function () {
    Route::get('logout', 'AuthenticationController@logout');
});

Route::group([
    'prefix'     => 'accounts',
    'namespace'  => 'V1\Accounts',
    'middleware' => 'auth:api'
], function () {
    Route::get('/', 'AccountsController@getAccounts');
    Route::post('/', 'AccountsController@createAccount');
    Route::put('/{id}', 'AccountsController@editAccount');
    Route::delete('/{id}', 'AccountsController@removeAccount');
});
