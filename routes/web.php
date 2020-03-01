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
    if(auth()->check()) {
        return redirect(route('home'));
    }
    return view('welcome');
})->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('jobs', 'JobController')->middleware('auth');

Route::get('search/jobs', 'JobController@search')->name('jobs.search')->middleware('auth');
Route::post('jobs/{job}/bid', 'JobController@storeBid')->name('jobs.store-bid')->middleware('auth');

Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => 'auth'], function() {
    Route::get('', 'SettingController@edit')->name('edit');
    Route::post('', 'SettingController@update')->name('update');
    Route::post('password/edit', 'SettingController@updatePassword')->name('update-password');
});