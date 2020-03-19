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

// jobs
Route::group(['middleware' => 'auth'], function() {
    Route::get('jobs/search', 'JobController@search')->name('jobs.search');
    Route::get('jobs/bid', 'JobController@bidsIndex')->name('jobs.bid-index');
    Route::post('jobs/{job}/create-bid', 'JobController@storeBid')->name('jobs.store-bid');
    Route::resource('jobs', 'JobController')->except(['edit', 'update', 'destroy', 'show']);
    Route::get('jobs/{job}/{title?}', 'JobController@show')->name('jobs.show');


    // setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function() {
        Route::get('', 'SettingController@edit')->name('edit');
        Route::post('', 'SettingController@update')->name('update');
        Route::post('password', 'SettingController@updatePassword')->name('update-password');
        Route::post('update-upwork-profile-link', 'SettingController@updateUpworkLink')->name('update-upwork-profile');
    });

    // notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function() {
        Route::get('', 'NotificationController@index')->name('index');
        Route::get('mark-all-notifications-as-read', 'NotificationController@markAllAsRead')->name('mark-all-as-read');
    });
});