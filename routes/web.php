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


	Route::get('/de',function(){
		return view('User.detail');
	})->name('post');


	Route::resource('post','PostController')->middleware('login');

	Route::resource('user','UserController');
	Route::get('/registerUser','UserController@registerUser')->name('registerUser');
	Route::post('/registerUser','UserController@checkRegisterUser')->name('checkRegisterUser');
	Route::get('/login','UserController@showFormLogin')->name('formLogin');
	Route::post('/login','UserController@login')->name('login');
	Route::get('/logout','UserController@logout')->name('logout');
	Route::get('/','HomeController@index')->name('home');
	Route::get('/detail/{id}','HomeController@show')->name('detail');
