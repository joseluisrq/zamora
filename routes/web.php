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
//CREDITOS
Route::get('/credito', 'CreditoController@index');//listar creditos
Route::get('/credito/detallecredito','CreditoController@detallecredito');//detalle credito
Route::post('/credito/registrar', 'CreditoController@store');//registrar un nuevo credito
// PERSONAS
Route::get('/listapersonas', 'PersonaController@index');
Route::get('/detallepersona', 'PersonaController@detalle');
Route::post('/registrarpersona', 'PersonaController@store');
Route::put('/actualizarpersona', 'PersonaController@update');
Route::delete('/eliminarpersona', 'PersonaController@delete');

// ROLES
Route::get('/listaroles', 'RolController@index');


Route::get('/socios/selectCliente', 'CreditoController@selectCliente');


//cuotas
Route::get('/cuota', 'CuotaController@index');//listar creditos



Route::get('/', function () {
    return view('contenido/contenido');
});
