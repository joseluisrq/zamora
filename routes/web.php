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


Route::group(['middleware' => ['guest']], function () {   
    Route::get('/','Auth\LoginController@mostrarFormularioLogin'); 
    Route::post('/login','Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {   
    
    //reportes
    Route::get('/reportes', 'ReportesController');//listar creditos
    //cerrar sesion
    Route::post('/cerrarsesion','Auth\LoginController@cerrarSesion')->name('cerrarsesion'); 
     
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');





    
    //ADMINSITRADOR
    Route::group(['middleware' => ['Administrador']], function () { 

        Route::get('/credito', 'CreditoController@index');//listar creditos
        Route::get('/credito/detallecredito','CreditoController@detallecredito');//detalle credito
        Route::post('/credito/registrar', 'CreditoController@store');//registrar un nuevo credito
        Route::get('/credito/ultimocredito', 'CreditoController@ultimocredito');//listar creditos
        Route::put('/credito/desembolsar', 'CreditoController@desembolsar');
        Route::put('/credito/aprobar', 'CreditoController@aprobar');
        Route::put('/credito/desaprobar', 'CreditoController@desaprobar');
        // PERSONAS
        Route::get('/listapersonas', 'PersonaController@index');
        //Route::get('/listarusuarios', 'PersonaController@listarusuarios');
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
        Route::put('/cuota/pagarCuota', 'CuotaController@pagarCuota');
        Route::put('/cuota/pagarCuotaDeposito', 'CuotaController@pagarCuotaDeposito');
        Route::get('/cuota/selectsocio', 'CuotaController@selectSocio');
        Route::get('/cuota/detallecuotapdf/{id}', 'CuotaController@pdfDetalleCuota')->name('detallecuota_pdf');
        //listar cuotas a pagaR

        // APORTES
        Route::get('/aporte/listar', 'AporteController@index');
        Route::get('/aporte/selectsocio', 'AporteController@selectSocio');
        Route::get('/aporte/pdfDetalleAporte', 'AporteController@pdfDetalleAporte')->name('detalleaporte_pdf');
        Route::post('/aporte/registrar', 'AporteController@store');

        // CUENTA AHORROS
        Route::get('/ahorro/listar', 'CuentaAhorroController@index');
        Route::get('/ahorro/detalle/', 'CuentaAhorroController@detalleCuentaAhorro');
        Route::get('/ahorro/selectsocio', 'CuentaAhorroController@selectSocio');
        Route::post('/cuentaahorros/crear', 'CuentaAhorroController@store');
        Route::get('/ahorro/movimiento/imprimirboucher', 'MovimientoController@imprimirBoucherMovimiento');
        Route::get('/ahorro/cuenta/imprimirdetalle', 'CuentaAhorroController@imprimirDetalleCuenta');
        //MOVIMIENTOS
        Route::get('/movimiento/selectCuenta', 'MovimientoController@selectCuenta');
        Route::post('/movimiento/registrar', 'MovimientoController@store');


        //simulaciones
        Route::get('/simulacion/listaSilumaciones', 'SimuladorController@listaSilumaciones');//listar creditos
        Route::post('/simulacion/guardarSimulacion', 'SimuladorController@guardarSimulacion');
        Route::get('/simulacion/pdfDetallecredito/{id}', 'SimuladorController@pdfDetallecredito')->name('proforma_pdf');

        // OPCIONES DE CONFIGURACION
        Route::get('/config/valores', 'EmpresaController@index');
        Route::put('/config/actualizar', 'EmpresaController@update');

        //pdf
        Route::get('/credito/pdfDetallecredito/{id}', 'CreditoController@pdfDetallecredito')->name('detallecredito_pdf');


        //notifiacion
        Route::get('/notificacion', 'CuotaController@notificacion');//listar creditos
       
        //EMPRESA
        Route::get('/empresa/tasaCuenta', 'EmpresaController@tasaCrearCuenta');

        Route::post('/movimiento/registrarAhorros', 'MovimientoController@storeAhorros');


            Route::post('/movimiento/registrarFijos', 'MovimientoController@storeFijo');
            Route::get('/ahorro/cuentassocio', 'CuentaAhorroController@cuentasSocio');
            Route::get('/ahorro/intereses', 'CuentaAhorroController@obtenerInteresesGanados');
            Route::get('/empresa/tasaAportes', 'EmpresaController@tasaAportes');
            Route::get('/infosocio', 'PersonaController@infosocio');

        //CAJA
        Route::post('/caja/abrirCaja', 'CajaController@abrirCaja');//abrir caja
        Route::get('/caja/seleccionarCaja', 'CajaController@seleccionarCaja');//cajalista
        Route::get('/caja/CajasAperturadas', 'CajaController@CajasAperturadas');//cajalista
        Route::get('/caja/MovimientosCaja', 'CajaController@MovimientosCaja');//cajalista
        Route::put('/caja/CerrarCaja', 'CajaController@CerrarCaja');//cajalista
        Route::put('/caja/ActualizarMontoIncial', 'CajaController@ActualizarMontoIncial');//cajalista

        Route::get('/caja/HistorialCajas', 'CajaController@HistorialCajas');//cajalista
      

        Route::get('/persona/selectUsuarios', 'PersonaController@selectUsuarios');
	    Route::post('/persona/registrar/usercomosocio', 'PersonaController@storeUserComoSocio');

	    Route::get('/movimiento/selectCuentaInteres', 'MovimientoController@selectCuentaInteres');
	    Route::post('/movimiento/registrarRetiroInteres', 'MovimientoController@cobrarInteres');

	    Route::post('/aporte/cobrarInteresAportes', 'AporteController@cobrarInteresAportes');
        

        Route::get('/ahorro/reporte', 'CuentaAhorroController@reportes');
        Route::get('/caja/pdfDetalleCaja/{id}', 'CajaController@pdfDetalleCaja')->name('detallecaja_pdf');

        Route::get('/cajas/pdfReportecajas', 'CajaController@pdfReportecajas')->name('reportecajas_pdf');
        Route::get('/persona/pdfreportesociosactivos/{id}', 'PersonaController@pdfreportesociosactivos')->name('reportesociosactivos_pdf');
       // Route::get('/persona/pdfreportesociosinactivos', 'PersonaController@pdfreportesociosinactivos')->name('pdfreportesociosinactivos_pdf');

    });  






     //ANALISTA
     Route::group(['middleware' => ['Analista']], function () { 
        Route::get('/credito', 'CreditoController@index');//listar creditos
        Route::get('/credito/detallecredito','CreditoController@detallecredito');//detalle credito
        Route::post('/credito/registrar', 'CreditoController@store');//registrar un nuevo credito
        Route::get('/credito/ultimocredito', 'CreditoController@ultimocredito');//listar creditos
        Route::put('/credito/desembolsar', 'CreditoController@desembolsar');
        // PERSONAS
        Route::get('/listapersonas', 'PersonaController@index');
        //Route::get('/listarusuarios', 'PersonaController@listarusuarios');
        Route::get('/detallepersona', 'PersonaController@detalle');
        Route::post('/registrarpersona', 'PersonaController@store');

          //simulaciones
          Route::get('/simulacion/listaSilumaciones', 'SimuladorController@listaSilumaciones');//listar creditos
          Route::post('/simulacion/guardarSimulacion', 'SimuladorController@guardarSimulacion');
          Route::get('/simulacion/pdfDetallecredito/{id}', 'SimuladorController@pdfDetallecredito')->name('proforma_pdf');
  
      
           //notifiacion
           Route::get('/notificacion', 'CuotaController@notificacion');//listar creditos
           Route::get('/caja/pdfDetalleCaja/{id}', 'CajaController@pdfDetalleCaja')->name('detallecaja_pdf');

           Route::get('/cajas/pdfReportecajas', 'CajaController@pdfReportecajas')->name('reportecajas_pdf');
    });







     //CAJAERO
     Route::group(['middleware' => ['Cajero']], function () { 
          //cuotas
        Route::get('/cuota', 'CuotaController@index');//listar creditos
        Route::get('/cuota/cuotassinpagar', 'CuotaController@cuotassinpagar');
        Route::get('/cuota/detallepagar', 'CuotaController@detalleCuota');
        Route::put('/cuota/pagarCuota', 'CuotaController@pagarCuota');
        Route::get('/cuota/selectsocio', 'CuotaController@selectSocio');
        Route::get('/cuota/detallecuotapdf/{id}', 'CuotaController@pdfDetalleCuota')->name('detallecuota_pdf');
        Route::put('/cuota/pagarCuotaDeposito', 'CuotaController@pagarCuotaDeposito');
        Route::get('/aporte/listar', 'AporteController@index');
        Route::get('/aporte/selectsocio', 'AporteController@selectSocio');
        Route::get('/aporte/pdfDetalleAporte', 'AporteController@pdfDetalleAporte')->name('detalleaporte_pdf');
        Route::post('/aporte/registrar', 'AporteController@store');

           //notifiacion
           Route::get('/notificacion', 'CuotaController@notificacion');//listar creditos

           Route::get('/cajas/pdfReportecajas', 'CajaController@pdfReportecajas')->name('reportecajas_pdf');


           // CUENTA AHORROS
        Route::get('/ahorro/listar', 'CuentaAhorroController@index');
        Route::get('/ahorro/detalle/', 'CuentaAhorroController@detalleCuentaAhorro');
        Route::get('/ahorro/selectsocio', 'CuentaAhorroController@selectSocio');
        Route::post('/cuentaahorros/crear', 'CuentaAhorroController@store');
        Route::get('/ahorro/movimiento/imprimirboucher', 'MovimientoController@imprimirBoucherMovimiento');
        Route::get('/ahorro/cuenta/imprimirdetalle', 'CuentaAhorroController@imprimirDetalleCuenta');
        //MOVIMIENTOS
        Route::get('/movimiento/selectCuenta', 'MovimientoController@selectCuenta');
        Route::post('/movimiento/registrar', 'MovimientoController@store');

        Route::get('/caja/pdfDetalleCaja/{id}', 'CajaController@pdfDetalleCaja')->name('detallecaja_pdf');


    });





});


