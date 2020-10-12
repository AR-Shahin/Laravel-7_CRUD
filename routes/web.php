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
Auth::routes(['verify' => true]);
Route::get('displayAllstudent','StudentController@displayStudents')->name('displayStudent')->middleware('verified');;
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');;
Route::get('/all-students', 'StudentController@index')->name('student')->middleware('verified');;
Route::post('/add-student', 'StudentController@store')->name('store')->middleware('verified');;
Route::get('/studentEdit/{id}', 'StudentController@edit')->middleware('verified');;
Route::get('/studentView/{id}', 'StudentController@view')->middleware('verified');;
Route::post('/update-student/{id}', 'StudentController@update')->middleware('verified');;
Route::get('/studentDelete/{id}', 'StudentController@delete')->middleware('verified');;
//user route

Route::get('/update-user-profile', 'HomeController@update')->name('updateProfile')->middleware('verified');;
Route::post('/updateUserProfile', 'HomeController@updateProfile')->name('updateUserProfile')->middleware('verified');;
Route::get('/Password_Change', 'HomeController@changePass_UI')->name('changePass_UI')->middleware('verified');;
Route::post('/Password Change', 'HomeController@changePass')->name('changePass')->middleware('verified');;