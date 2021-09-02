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

    //Record Types
    Route::get('record-types/show-view/{id}', 'RecordTypeController@showRecordType');
    Route::get('record-types/show-edit/{id}', 'RecordTypeController@showEditForm');
    Route::post('record-types/store', 'RecordTypeController@store')
         ->name('store-record-type');
    Route::post('record-types/update/{id}', 'RecordTypeController@update')
         ->name('update-record-type');
    Route::post('record-types/update-order', 'RecordTypeController@updateOrder')
         ->name('update-record-type-order');
    Route::post('record-types/delete/{id}', 'RecordTypeController@delete')
         ->name('delete-record-type');

    //Records
    Route::get('records/show-create/{type}', 'RecordController@showCreateForm');
    Route::get('records/show-edit/{type}', 'RecordController@showEditForm');
    Route::post('records/store/{type}', 'RecordController@store');
    Route::post('records/update/{type}', 'RecordController@update');
    Route::post('records/delete/{id}', 'RecordController@delete');
    Route::post('records/delete-attachment/{id}', 'RecordController@deleteAttachment');

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
Route::get('records/show-record/{type}', 'RecordController@showRecord');
Route::get('records/show-view/{type}', 'RecordController@showView');
Route::get('records/show-search', 'RecordController@showSearchRecord');