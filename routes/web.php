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


Route::get('/', function () {
    return view('contenido/contenido');
});
