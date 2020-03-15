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
Route::get('jobs/search', 'JobController@search')->name('jobs.search')->middleware(['auth']);
Route::get('jobs/bid', 'JobController@bidsIndex')->name('jobs.bid-index')->middleware('auth');
Route::post('jobs/{job}/create-bid', 'JobController@storeBid')->name('jobs.store-bid')->middleware('auth');
Route::resource('jobs', 'JobController')->except(['edit', 'update', 'destroy', 'show'])->middleware('auth');
Route::get('jobs/{job}/{title?}', 'JobController@show')->name('jobs.show')->middleware('auth');


// setting
Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => 'auth'], function() {
    Route::get('', 'SettingController@edit')->name('edit');
    Route::post('', 'SettingController@update')->name('update');
    Route::post('password', 'SettingController@updatePassword')->name('update-password');
    Route::post('update-upwork-profile-link', 'SettingController@updateUpworkLink')->name('update-upwork-profile');
});