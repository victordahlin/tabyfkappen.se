<?php

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
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function ()    {
        return redirect('/categories');
    });

    Route::get('settings', 'SettingsController@index');
    Route::post('settings/store', 'SettingsController@store');
    Route::post('settings/update', 'SettingsController@update');

    Route::get('statistics','StatisticsController@index');

    Route::resource('companies','CompaniesController');
    Route::resource('categories','CategoriesController');
    Route::resource('offers','OffersController');
    Route::resource('users', 'UsersController');
    Route::resource('information', 'InformationController');
    Route::resource('activation-codes', 'ActivationCodesController');

    Route::get('images/{filename}', function ($filename)
    {
        return Image::make(storage_path() . '/app/' . $filename)->response();
    });
});

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => 'api/v1/'], function()
{
    Route::post('create', 'Auth\AuthenticateController@authenticate');
    Route::post('login', 'Auth\AuthenticateController@login');
    Route::post('logout', 'Auth\AuthenticateController@logout');

    Route::get('offer', 'RestController@useOffer');
    Route::get('getCategories', 'RestController@getCategories');
    Route::get('getCompanies', 'RestController@getCompanies');
    Route::get('getInfo', 'RestController@getInfo');
    Route::get('getCompanies', 'RestController@getCompanies');
    Route::get('getOffers', 'RestController@getOffers');
    Route::get('check', 'RestController@isTokenValid');
    
    Route::get('dev', 'RestController@getOffersDev');

    Route::post('reset', 'Auth\PasswordController@postEmailRestAPI');

    Route::get('image/{filename}', function ($filename)
    {
        return Image::make(storage_path() . '/app/' . $filename)->response();
    });
});