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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/api/v1/{sub}', 'ApiController@v1');
Route::post('/api/v1/{sub}', 'ApiController@v1');
Route::get('/tambah_arti', 'HomeController@tambah_arti');


// admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/database', 'HomeController@database');
    Route::get('/database/hapus/{slug}/{id}', 'HomeController@database_del');
    Route::get('/database/terima/{slug}/{id}', 'HomeController@database_acc');
    Route::get('/bahasa', 'HomeController@bahasa');
    Route::get('/bahasa/tambah', 'HomeController@bahasa_add');
    Route::post('/bahasa/tambah', 'HomeController@bahasa_add');
    Route::get('/bahasa/hapus/{slug}', 'HomeController@bahasa_del');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/terjemahan_saya', 'HomeController@terjemahan_saya');
});
