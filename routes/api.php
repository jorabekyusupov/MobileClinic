<?php

use App\Http\Controllers\Api\PassportController;
use App\Http\Controllers\api\ResultController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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

Route::post('register', 'Api\PassportController@register')->name('register');
Route::post('login', 'Api\PassportController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('result', 'Api\ResultController@update')->name('ResultCreate');
    Route::post('show', 'Api\ResultController@show')->name('ResultShow');
// Route::apiResources('/result','Api\ResultController')->except('index');

});

