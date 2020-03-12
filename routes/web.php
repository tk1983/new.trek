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
Route::delete('/mountain/{id}', 'TrekController@destroy')->name('detail.destroy');

Route::get('/users/{user_id}', 'UsersController@show')->name('users.show');
Route::post('/users/{user_id}', 'UsersController@store')->name('users.store');

Route::get('/mountain/{id}/likes', 'LikesController@store');
Route::get('/likes/{like_id}', 'LikesController@destroy');

Route::post('/mountain/{comment_id}/comments','CommentsController@store');
Route::post('/mountain/{comment_id}/comments2','CommentsController@store2');
Route::get('/comments/{comment_id}', 'CommentsController@destroy');
Route::get('/comments2/{comment_id}', 'CommentsController@destroy2');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/sato', function () {
     return view('sato');
});
Route::get('/call', function () {
    return view('call');
});