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


Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/get-today-guests', 'HomeController@getTodayGuests');
    Route::get('ajax-add-new-guest', 'HomeController@addNewGuest');
    Route::get('guest-checkout', 'HomeController@checkout');
    Route::get('change-discount-status', 'HomeController@updateGuestDiscount');
});

