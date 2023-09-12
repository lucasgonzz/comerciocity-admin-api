<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {

    // CommonLaravel 
    // ----------------------------------------------------------------------------------------------------
    // Generals
    Route::post('search/{model_name}', 'CommonLaravel\SearchController@search');
    Route::post('search-from-modal/{model_name}', 'CommonLaravel\SearchController@searchFromModal');
    Route::post('search/save-if-not-exist/{model_name}/{propertye}/{query}', 'CommonLaravel\SearchController@saveIfNotExist');
    Route::get('previus-day/{model_name}/{index}', 'CommonLaravel\PreviusDayController@previusDays');
    Route::get('previus-next/{model_name}/{index}', 'CommonLaravel\PreviusNextController@previusNext');
    Route::get('previus-next-index/{model_name}/{id}', 'CommonLaravel\PreviusNextController@getIndexPreviusNext');
    Route::put('update/{model_name}', 'CommonLaravel\UpdateController@update');
    Route::put('delete/{model_name}', 'CommonLaravel\DeleteController@delete');
    
    // User
    Route::get('user', 'CommonLaravel\AuthController@user');
    Route::put('user/{id}', 'UserController@update');
    Route::put('user-password', 'CommonLaravel\UserController@updatePassword');

    // Employee
    Route::resource('employee', 'CommonLaravel\EmployeeController');

    // Permissions
    Route::get('permission', 'CommonLaravel\PermissionController@index');

    // Images
    Route::post('save-pre-image', 'CommonLaravel\ImageController@savePreImage');
    Route::post('set-image/{prop}', 'CommonLaravel\ImageController@setImage');
    Route::delete('delete-image-prop/{model_name}/{id}/{prop_name}', 'CommonLaravel\ImageController@deleteImageProp');
    Route::delete('delete-image-model/{model_name}/{model_id}/{image_id}', 'CommonLaravel\ImageController@deleteImageModel');

    // ----------------------------------------------------------------------------------------------------

    Route::resource('commerce', 'CommerceController');
    Route::post('commerce/register-payment/{id}', 'CommerceController@registerPayment');
});
