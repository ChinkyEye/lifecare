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

Auth::routes(['reset' => false,
            'register' => false
            ]);

Route::prefix('api/user')->group(function () {

Route::get('slide', 'Api\SliderController@index'); //slider 

});





// Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Admin')->prefix('home')->name('admin.')->middleware(['admin','auth'])->group(function(){
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('/manager', 'ManagerController');
    Route::get('manager/active/{id}', 'ManagerController@isActive')->name('manager.active');
    Route::resource('/slider', 'SliderController');
    Route::get('slider/active/{id}', 'SliderController@isActive')->name('slider.active');

});
Route::namespace('Manager')->prefix('manager')->name('manager.')->middleware(['manager','auth'])->group(function(){
    Route::get('', 'HomeController@index')->name('home');
    Route::resource('/slider', 'SliderController');
    Route::get('slider/active/{id}', 'SliderController@isActive')->name('slider.active');

    Route::resource('/category', 'CategoryController');
    Route::get('category/active/{id}', 'CategoryController@isActive')->name('category.active');
    
    Route::resource('/specialist', 'SpecialistController');
    Route::get('specialist/active/{id}', 'SpecialistController@isActive')->name('specialist.active');

    Route::resource('/address', 'AddressController');
    Route::get('address/active/{id}', 'AddressController@isActive')->name('address.active');

    Route::resource('/day', 'DayController');
    Route::get('day/active/{id}', 'DayController@isActive')->name('day.active');

    Route::resource('/hospital','HospitalController');
    Route::get('hospital/active/{id}', 'HospitalController@isActive')->name('hospital.active');

    Route::resource('/doctor','DoctorController');
    Route::get('doctor/active/{id}', 'DoctorController@isActive')->name('doctor.active');

<<<<<<< HEAD
    Route::resource('/prescription', 'PrescriptionController');
    Route::get('prescription/show/{id}', 'PrescriptionController@detail');
    Route::get('prescription/active/{id}', 'PrescriptionController@isActive')->name('prescription.active');
=======
    Route::resource('/doctorhasday','DoctorHasDayController');
    Route::get('/doctor/doctorhasday/{id}','DoctorHasDayController@index')->name('doctorhasday.index');
    Route::get('/doctor/doctorhasday/create/{id}','DoctorHasDayController@create')->name('doctorhasday.create');

    Route::resource('/doctorhasdaytime','DoctorHasDayTimeController');
    Route::get('/doctor/doctorhasdaytime/{id}','DoctorHasDayTimeController@index')->name('doctorhasdaytime.index');


>>>>>>> origin/master

});
