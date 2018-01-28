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
    return redirect('/login');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index');
Route::get('/user/create', 'UserController@createView');
Route::post('/user/create', 'UserController@create');
Route::get('/user/update/{id}', 'UserController@updateView');
Route::post('/user/update/{id}', 'UserController@update');

Route::get('/produk', 'ProdukController@index');
Route::get('/produk/create', 'ProdukController@createView');
Route::post('/produk/create', 'ProdukController@create');
Route::get('/produk/update/{id}', 'ProdukController@updateView');
Route::post('/produk/update/{id}', 'ProdukController@update');

Route::get('/permintaan', 'PermintaanController@index');
Route::get('/permintaan/create', 'PermintaanController@createView');
Route::post('/permintaan/create', 'PermintaanController@create');
Route::get('/permintaan/item/{id}', 'PermintaanController@detail');
Route::get('/permintaan/item/create/{id}', 'PermintaanController@createItem');
Route::get('/permintaan/item/delete/{permintaan}/{produk}', 'PermintaanController@deleteItem');
Route::get('/permintaan/validasi/{id}/{value}', 'PermintaanController@validasi');

Route::get('/produksi', 'ProduksiController@index');
Route::get('/produksi/create', 'ProduksiController@createView');
Route::post('/produksi/create', 'ProduksiController@create');