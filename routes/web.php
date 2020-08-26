<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('bank.index');
});

Route::get('bank', 'BankController@index')->name('bank.index');
Route::get('bank/create', 'BankController@create')->name('bank.create');
Route::post('bank/create', 'BankController@store')->name('bank.store');
Route::get('bank/{id}/edit', 'BankController@edit')->name('bank.edit');
Route::put('bank/{id}/edit', 'BankController@update')->name('bank.update');
Route::delete('bank/{id}/destroy', 'BankController@destroy')->name('bank.destroy');
