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

// Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Admin')->prefix('home')->name('admin.')->middleware(['admin','auth'])->group(function(){
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('/manager', 'ManagerController');
    Route::get('manager/active/{id}', 'ManagerController@isActive')->name('manager.active');

});
Route::namespace('Manager')->prefix('manager')->name('manager.')->middleware(['manager','auth'])->group(function(){
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('/slider', 'SliderController');
    Route::get('slider/active/{id}', 'SliderController@isActive')->name('slider.active');

    Route::resource('/category', 'CategoryController');
    Route::get('category/active/{id}', 'CategoryController@isActive')->name('category.active');

});
