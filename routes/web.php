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
    return redirect('/detail');
    // return view('welcome');
});
Route::get('/detail', 'TrekController@index')->name('detail.index');
Route::get('/mountain/new', 'TrekController@create')->name('detail.new');
Route::post('/mountain/new', 'TrekController@store')->name('detail.store');
Route::get('/mountain/{id}', 'TrekController@show')->name('detail.detail');
Route::get('/mountain/edit/{id}', 'TrekController@edit')->name('detail.edit');
Route::post('/mountain/update/{id}', 'TrekController@update')->name('detail.update');
