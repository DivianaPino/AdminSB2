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


Route::get('/admin', 'FrontendController@index')->name('index');
Route::get('/admin/table', 'ProductoController@index')->name('producto.table');
Route::post('/admin/table/store', 'ProductoController@store')->name('producto.store');
Route::get('/admin/table/{id}/edit', 'ProductoController@edit')->name('producto.edit'); 
Route::post('/admin/table/{id}/update', 'ProductoController@update')->name('producto.update'); 
Route::delete('/admin/table/{id}/delete', 'ProductoController@destroy')->name('producto.delete'); 




