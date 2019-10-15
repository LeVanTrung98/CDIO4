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
		return view('layout.admin');
	})->name('post');

	// admin
	Route::group(['middleware'=>['login'],'prefix'=>'admin'],function(){
		route::resource('home','AdminController');
		Route::resource('infringe','InfringeController');
		Route::post('updatePost','AdminController@updatePost')->name('adminUpdatePost');
	});


	Route::resource('post','PostController')->middleware('login');
	Route::get('usersPost/{id}','PostController@formUpdate')->name('formUpdate');
	Route::post('userPost','PostController@userUpdatePost')->name('userUpdatePost');
	Route::post('/search','HomeController@search')->name('search');
	Route::get('/search/{id}','HomeController@searchDistrict')->name('searchDistrict');
	Route::resource('user','UserController');
	Route::get('users','UserController@showUser')->middleware('login')->name('userShow');
	Route::get('users/{id}','UserController@showDetail')->middleware('login')->name('detailUser');
	Route::post('users','UserController@noAccept')->middleware('login');
	Route::post('users/accept','UserController@accept')->middleware('login');
	Route::post('users/Come','UserController@Come')->middleware('login');
	Route::get('/registerUser','UserController@registerUser')->name('registerUser');
	Route::post('/registerUser','UserController@checkRegisterUser')->name('checkRegisterUser');
	Route::get('/login','UserController@showFormLogin')->name('formLogin');
	Route::post('/login','UserController@login')->name('login');
	Route::get('/logout','UserController@logout')->name('logout');
	Route::get('/','HomeController@index')->name('home');
	Route::get('/detail/{id}','HomeController@show')->name('detail');
