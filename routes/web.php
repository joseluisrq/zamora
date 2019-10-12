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
Route::get('/credito/ultimocredito', 'CreditoController@ultimocredito');//listar creditos

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
Route::get('/cuota/cuotassinpagar', 'CuotaController@cuotassinpagar');
Route::get('/cuota/detallepagar', 'CuotaController@detalleCuota');
Route::put('/cuota/pagar', 'CuotaController@update');

//listar cuotas a pagaR


// APORTES
Route::get('/aporte/listar', 'AporteController@index');
Route::get('/aporte/selectsocio', 'AporteController@selectSocio');
Route::get('/aporte/pdfDetalleAporte', 'AporteController@pdfDetalleAporte')->name('detalleaporte_pdf');
Route::post('/aporte/registrar', 'AporteController@store');

// CUENTA AHORROS
Route::post('/cuentaahorros/crear', 'CuentaAhorroController@store');


//simulaciones
Route::get('/simulacion/listaSilumaciones', 'SimuladorController@listaSilumaciones');//listar creditos
Route::post('/simulacion/guardarSimulacion', 'SimuladorController@guardarSimulacion');


//pdf
Route::get('/credito/pdfDetallecredito/{id}', 'CreditoController@pdfDetallecredito')->name('detallecredito_pdf');

Route::get('/', function () {
    return view('contenido/contenido');
});
