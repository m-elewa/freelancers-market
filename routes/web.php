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

// home page for both guest user and auth user
Route::get('/', 'HomeController@index')->name('home');

// auth
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function() {
    // jobs
    Route::resource('jobs', 'JobController')->only(['index', 'create', 'store']);
    Route::group(['prefix' => 'jobs', 'as' => 'jobs.'], function() {
        Route::get('search', 'JobController@search')->name('search');
        Route::get('bid', 'JobController@bidsIndex')->name('bid-index');
        Route::post('{job}/create-bid', 'JobController@storeBid')->name('store-bid');
        Route::get('{job}/{title?}', 'JobController@show')->name('show');
    });

    // setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
        Route::get('', 'SettingController@edit')->name('edit');
        Route::post('', 'SettingController@update')->name('update');
        Route::post('password', 'SettingController@updatePassword')->name('update-password');
        Route::post('update-profile-link', 'SettingController@updateProfileLink')->name('update-profile-link');
    });

    // notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function() {
        Route::get('', 'NotificationController@index')->name('index');
        Route::get('mark-all-notifications-as-read', 'NotificationController@markAllAsRead')->name('mark-all-as-read');
    });
});