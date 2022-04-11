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


Route::get('/','MemoController@index')->middleware('auth');
Route::get('/new','MemoController@new');
Route::get('/edit','MemoController@edit');
Route::post('/edit','MemoController@edit');
Route::post('/add','MemoController@create');
Route::post('/remove','MemoController@remove');
Route::post('/update','MemoController@update');
Route::post('/search','MemoController@search');
Route::post('/tag_update','MemoController@tag_update');

Auth::routes();//ログインの時にいる。

