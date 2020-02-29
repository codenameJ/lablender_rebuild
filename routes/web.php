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
Route::get('/logout', 'Auth\LoginController@logout'); // logout

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/lab', 'LabController@index')->name('lab');
Route::resource('/admin/lab','LabController');
Route::resource('/admin/lab','LabController');
Route::resource('/ta/lab','LabController');
Route::resource('/lab','LabController');
// Route::get('/lab/{id}', 'LabController@show');
Route::get('admin/lab/{id}', 'LabController@show');

Route::any('/admin/lab/{any?}', 'LabController@index')->where('any','.*')->middleware('auth');
Route::any('/{any?}', 'HomeController@index')->where('any','.*')->middleware('auth');