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
    return view('index');
});

Route::get('/bienvenido', function () {
    return view('bienvenido');
});

Route::view('/empresas', 'empresas');



Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 


Route::post('/', 'UserController@login')->name('user.login');