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
Route::get('users', 'UsersController@index')->middleware('role:admin|pengajar')->name('users.index');
Route::post('users/assignrole', 'UsersController@assignrole')->middleware('role:admin|pengajar')->name('users.assignrole');
Route::get('/home', 'HomeController@index')->name('home');
