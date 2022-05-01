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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blogs', 'BlogController@index')->name('blogs');
Route::group(['middleware' => 'auth'], function () {
Route::get('/blog/create', 'BlogController@create')->name('blog.create');
Route::post('/blog/store', 'BlogController@store')->name('blog.store');
Route::post('/blog/update', 'BlogController@update')->name('blog.update');
Route::get('/blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
Route::get('/blog/delete/{id}', 'BlogController@delete')->name('blog.delete');
});
Route::group(['middleware' => 'BlogAccess'], function () {  
    Route::post('/blog/update', 'BlogController@update')->name('blog.update');
    Route::get('/blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
    Route::get('/blog/delete/{id}', 'BlogController@delete')->name('blog.delete');
});