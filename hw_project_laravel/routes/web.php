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

Auth::routes();

Route::get('/home', 'TransactionsController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/paymentmethods', 'BalanceController@paymentmethods')->name('paymentmethods');
Route::post('/balances/store', 'BalanceController@store')->name('balances.store');
Route::delete('/balances/{id}', 'BalanceController@destroy')->name('balances.destroy');
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::post('/transactions', 'TransactionsController@store')->name('transactions.store');
Route::get('/transactions/export', 'TransactionsController@export')->name('transactions.export');
Route::get('/transactions/statistics', 'TransactionsController@statistics')->name('transactions.statistics');
Route::get('/transactions/gstatistics', 'TransactionsController@generalStatistics')->name('transactions.gstatistics');
Route::get('transactions/sstatistics', 'TransactionsController@specificStatistics')->name('transactions.sstatistics');

