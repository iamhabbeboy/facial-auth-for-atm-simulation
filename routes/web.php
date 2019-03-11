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

Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@store');
Route::get('/signout', 'AccountManagerController@signout');
Route::post('/get-balance', 'AccountManagerController@balance');
Route::post('/fund-acct', 'AccountManagerController@fundAmount');
Route::post('/transfer-fund', 'AccountManagerController@fundTransfer');
Route::post('/fetch-acctdetails', 'AccountManagerController@fetchAccountDetails');
Route::get('/open-account', 'AccountManagerController@index')->name('account_open');
Route::post('/register', 'AccountManagerController@store')->name('register_account');
Route::post('/profile-update', 'AccountManagerController@profileUpdate')->name('account_open');
Route::get('/fund', 'AccountManagerController@fundAccount')->name('fund')->middleware('authorization');
Route::get('/profile', 'AccountManagerController@profile')->name('profile')->middleware('authorization');
Route::get('/transfer', 'AccountManagerController@transfer')->name('transfer')->middleware('authorization');
Route::get('/withdrawal', 'AccountManagerController@withdrawal')->name('withdrawal')->middleware('authorization');
Route::get('/home', 'AccountManagerController@dashboard')->name('account_dashboard')->middleware('authorization');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
