<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/bienvenido', function () {
    return view('bienvenido');
});



Route::get('/matriz', function () {
    return view('tablas.matriz.index');
});


Route::get('/estrategiasFO', function () {
    return view('tablas.estrategias.FO');
});

Route::get('/estrategiasFA', function () {
    return view('tablas.estrategias.FA');
});

Route::get('/estrategiasDO', function () {
    return view('tablas.estrategias.DO');
});

Route::get('/estrategiasDA', function () {
    return view('tablas.estrategias.DA');
});





Route::resource('usuarios', 'UsuarioController');  // es resource pq trabajamos con varias rutas 


Route::resource('user', 'UserController');  // es resource pq trabajamos con varias rutas 


Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 
Route::resource('empresa', 'EmpresaController');  // es resource pq trabajamos con varias rutas

Route::resource('objetivo', 'ObjetivoController');  // es resource pq trabajamos con varias rutas
Route::resource('elemento', 'ElementoController');  // es resource pq trabajamos con varias rutas
Route::resource('estrategia', 'EstrategiaController');  // es resource pq trabajamos con varias rutas



Route::get ('empresa/{id}/foda','EmpresaController@foda')->name('empresa.foda');

Route::get ('empresa/{id}/estrategiasFO','EmpresaController@estrategiasFO')->name('empresa.estrategiasFO');


Route::get ('empresa/{id}/confirmar','EmpresaController@confirmar')->name('empresa.confirmar');

Route::get ('usuarios/{id}/confirmar','UsuarioController@confirmar')->name('usuarios.confirmar');
Route::get ('objetivo/{id}/confirmar','ObjetivoController@confirmar')->name('objetivo.confirmar');
Route::get ('elemento/{id}/confirmar','ElementoController@confirmar')->name('elemento.confirmar');
Route::get ('estrategia/{id}/confirmar','EstrategiaController@confirmar')->name('estrategia.confirmar');



Route::post('/', 'UserController@login')->name('user.login');




Route::get('cancelar', function () {
    return redirect()->route('empresa.index')->with('datos','Accion cancelada');
})->name('cancelar');
