<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentaAhorroController extends Controller
{
	public function index(Request $request)
	{

	}

	public function store(Request $request)
	{
		if (!$request->ajax()) return redirect('/');
 
        try{
			DB::beginTransaction();

			$cuentaahorro = new CuentaAhorro();

            $cuentaahorro->idsocio = $request->idsocio;
            $cuentaahorro->idusuario = $request->idsocio;
            $cuentaahorro->numerocuenta = $request->numerocuenta;
            $cuentaahorro->saldoefectivo = $request->monto;
            $cuentaahorro->descripcion = $request->descripcion; //cantidad de cuiotas
            $cuentaahorro->tasa = $request->tasa;
            $cuentaahorro->estado = '1';
          
            $cuentaahorro->save();

			DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
	}
}
