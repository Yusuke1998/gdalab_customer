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
Route::post('auth/login', 'App\Http\Controllers\Auth\UserController@login')
    ->middleware('web', 'checkjsonisvalid');
Route::group(['middleware' => ['auth:token', 'api.token', 'LogResponse', 'checkjsonisvalid']], function () {
    Route::post('auth/logout', 'App\Http\Controllers\Auth\UserController@logout');
    Route::resource('customers', 'App\Http\Controllers\CustomerController')->only([
        'index', 'destroy'
    ]);
    Route::post('customers', 'App\Http\Controllers\CustomerController@store')
        ->middleware('VerifyCustomerField');
});

