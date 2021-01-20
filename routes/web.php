<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/bienvenido', function () {
    return view('bienvenido');
});






/* ******************     RUTAS DE RESOURCEPARA CONTROLADORES  ************** */

Route::resource('usuarios', 'UsuarioController');  // es resource pq trabajamos con varias rutas 
Route::resource('user', 'UserController');  // es resource pq trabajamos con varias rutas 
Route::resource('categoria', 'CategoriaController');  // es resource pq trabajamos con varias rutas 
Route::resource('empresa', 'EmpresaController');  // es resource pq trabajamos con varias rutas
Route::resource('objetivo', 'ObjetivoController');  // es resource pq trabajamos con varias rutas
Route::resource('elemento', 'ElementoController');  // es resource pq trabajamos con varias rutas
Route::resource('estrategia', 'EstrategiaController');  // es resource pq trabajamos con varias rutas
Route::resource('proceso', 'ProcesoController');  // es resource pq trabajamos con varias rutas
Route::resource('subproceso', 'SubprocesoController');  // es resource pq trabajamos con varias rutas
Route::resource('area', 'AreaController');  // es resource pq trabajamos con varias rutas
Route::resource('puesto', 'PuestoController');  // es resource pq trabajamos con varias rutas
Route::resource('celdamatriz', 'CeldaMatrizController');  // es resource pq trabajamos con varias rutas
Route::resource('matriz', 'MatrizController');  // es resource pq trabajamos con varias rutas

/* ************************** RUTAS ADICIONALES  ********************* */


Route::get ('empresa/{id}/listar','EmpresaController@listar')->name('empresa.listar');
Route::get ('matriz/{id}/listar','MatrizController@listar')->name('matriz.listar');
Route::get ('matriz/{id}/crear','MatrizController@crear')->name('matriz.crear');

//                    idEmpresa

Route::get ('proceso/{id}/listar','ProcesoController@listar')->name('proceso.listar');
Route::get ('proceso/{id}/crear','ProcesoController@crear')->name('proceso.crear');

Route::get ('area/{id}/listar','AreaController@listar')->name('area.listar');
Route::get ('area/{id}/crear','AreaController@crear')->name('area.crear');



Route::get ('empresa/{id}/foda','EmpresaController@foda')->name('empresa.foda');
Route::get ('empresa/{id}/matriz','EmpresaController@matriz')->name('empresa.matriz');
Route::get ('empresa/{id}/matrizProcOrg','EmpresaController@matrizProcOrg')->name('empresa.matrizProcOrg');

Route::get ('empresa/{id}/estrategiasFO','EmpresaController@estrategiasFO')->name('empresa.estrategiasFO');
Route::get ('empresa/{id}/estrategiasFA','EmpresaController@estrategiasFA')->name('empresa.estrategiasFA');
Route::get ('empresa/{id}/estrategiasDO','EmpresaController@estrategiasDO')->name('empresa.estrategiasDO');
Route::get ('empresa/{id}/estrategiasDA','EmpresaController@estrategiasDA')->name('empresa.estrategiasDA');

Route::get ('empresa/{id}/descargarPDF','EmpresaController@ExportarPDF')->name('empresa.ExportarPDF');
Route::get ('empresa/{id}/imprimir','EmpresaController@imprimir')->name('empresa.imprimir');


// ************************* RUTAS DE CONFIRMACION  
Route::get ('empresa/{id}/confirmar','EmpresaController@confirmar')->name('empresa.confirmar');
Route::get ('usuarios/{id}/confirmar','UsuarioController@confirmar')->name('usuarios.confirmar');
Route::get ('objetivo/{id}/confirmar','ObjetivoController@confirmar')->name('objetivo.confirmar');
Route::get ('elemento/{id}/confirmar','ElementoController@confirmar')->name('elemento.confirmar');
Route::get ('estrategia/{id}/confirmar','EstrategiaController@confirmar')->name('estrategia.confirmar');
Route::get ('proceso/{id}/confirmar','ProcesoController@confirmar')->name('proceso.confirmar');
Route::get ('subproceso/{id}/confirmar','SubprocesoController@confirmar')->name('subproceso.confirmar');
Route::get ('area/{id}/confirmar','AreaController@confirmar')->name('area.confirmar');
Route::get ('puesto/{id}/confirmar','PuestoController@confirmar')->name('puesto.confirmar');
Route::get ('matriz/{id}/confirmar','MatrizController@confirmar')->name('matriz.confirmar');


// RUTA DE CANCELACION PERSONALIZADA (TE RETORNA A LA VISTA DE ESTRATEGIA EN LA QUE ESTABAS FA FO DO DA)
Route::get ('estrategia/{id}/cancelar','EstrategiaController@cancelar')->name('estrategia.cancelar');

Route::post ('usuarios/{id}/updateEmpresas','UsuarioController@updateEmpresas')->name('usuarios.updateEmpresas');


// RUTA PARA EL LOGIN 
Route::post('/', 'UserController@login')->name('user.login');
//Route::post('/', 'UserController@login')->name('login');


Route::get('/', function () {
    return view('login');
});

/* 
Route::get('/salir', function() {
    Auth::logout();
    //Session::flush();
    return Redirect::to('/');
})->middleware('auth'); */



Route::get('cancelar', function () {
    return redirect()->route('empresa.index')->with('datos','Accion cancelada');
})->name('cancelar');


