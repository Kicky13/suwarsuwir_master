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