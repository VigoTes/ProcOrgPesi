<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/bienvenido', function () {
    return view('bienvenido');
});

Route::get('/foda', function () {
    return view('tablas.foda.index');
});

Route::get('/matriz', function () {
    return view('tablas.matriz.index');
});



Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 
Route::resource('empresa', 'EmpresaController');  // es resource pq trabajamos con varias rutas 


Route::post('/', 'UserController@login')->name('user.login');