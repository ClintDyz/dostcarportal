<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*------------------------ Private Routes ------------------------*/

Route::group(['middlewareGroups' => ['web']], function () {
    //Route::auth();

    // Authentication Routes...
    Route::get('login-first', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    Route::get('/', 'PortalController@portal');

    Route::get('accounts', 'AccountController@viewAccounts');
    Route::post('accounts/add', 'AccountController@addAccount');
    Route::post('accounts/get/{id}', 'AccountController@getAccount');
    Route::post('accounts/edit/{id}', 'AccountController@editAccount');
    Route::post('accounts/delete/{id}', 'AccountController@deleteAccount');

    //Records
    Route::get('records/show-create/{type}', 'RecordsController@showCreateForm');
    Route::get('records/show-edit/{type}', 'RecordsController@showEditForm');
    Route::post('records/store/{type}', 'RecordsController@store');
    Route::post('records/update/{type}', 'RecordsController@update');
    Route::post('records/delete/{id}', 'RecordsController@delete');
    Route::post('records/delete-attachment/{id}', 'RecordsController@deleteAttachment');

    //Infosys
    Route::get('infosys/show-infosys', 'InfosysController@showInfosys');
    Route::get('infosys/show-create', 'InfosysController@showCreateForm');
    Route::get('infosys/show-edit/{id}', 'InfosysController@showEditForm');
    Route::post('infosys/store', 'InfosysController@store');
    Route::post('infosys/update/{id}', 'InfosysController@update');
    Route::post('infosys/delete/{id}', 'InfosysController@delete');
});

/*------------------------- Public Routes -------------------------*/

//Records
Route::get('records/show-record/{type}', 'RecordsController@showRecord');
Route::get('records/show-view/{type}', 'RecordsController@showView');
Route::get('records/show-search', 'RecordsController@showSearchRecord');