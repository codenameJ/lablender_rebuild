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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mark-all-read/{user}', function (User $user) {
    $user->unreadNotifications->markAsRead();
    return response(['message'=>'done']);
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout'); // logout

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/lab', 'LabController@index')->name('lab');
Route::resource('/admin/lab', 'LabController');
Route::resource('/admin/lab', 'LabController');
Route::resource('/ta/lab', 'LabController');
Route::resource('/lab', 'LabController');
// Route::get('/lab/{id}', 'LabController@show');
Route::get('admin/lab/{id}', 'LabController@show');


Route::any('/student/lab/{any?}', 'LabController@index')->where('any', '.*')->middleware('auth');
Route::any('/ta/lab/{any?}', 'LabController@index')->where('any', '.*')->middleware('auth');
Route::any('/professor/lab/{any?}', 'LabController@index')->where('any', '.*')->middleware('auth');
Route::any('/admin/lab/{any?}', 'LabController@index')->where('any', '.*')->middleware('auth');
Route::any('/{any?}', 'HomeController@index')->where('any', '.*')->middleware('auth');
