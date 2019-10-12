<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use App\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
	public function selectCuenta(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

    	$filtro = $request->filtro;

        $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
        ->select(
            'cuentaahorros.id',
            'cuentaahorros.numerocuenta',

            'personas.nombre',
            'personas.apellidos'
        )
        ->where('cuentaahorros.estado', '=', '1') //socio activo
        ->where('cuentaahorros.numerocuenta', 'like', '%'. $filtro . '%')
        ->get();

        return [ 'cuentas' => $cuentas ];
	}

	public function store(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $idcuenta = $request->idahorro;
            $tipo = $request->tipo;
            $monto = $request->monto;

            $cuentaahorros = CuentaAhorro::findOrFail($idcuenta);
            $saldoefectivo = $cuentaahorros->saldoefectivo;

			if($tipo == 0)
			{//Si se trata de retiro, se deb verificar que tenga el dinero suficientes
				if($saldoefectivo < $monto)
					return [ "excep" => true ]; //Significa que quiere retirar más de lo que dispone
				else
					$cuentaahorros->saldoefectivo = $saldoefectivo - $monto;
			}
			else //Si se trata de aporte solo se incremeta el saldo
			{
				$cuentaahorros->saldoefectivo = $saldoefectivo + $monto;	
			}

            $movimiento = new Movimiento();
            $movimiento->idusuario = 14;//\Auth::user()->id;
            $movimiento->idahorro = $idcuenta;
            $movimiento->fecharegistro = Carbon::now('America/Lima');;
            $movimiento->monto = $monto;
            $movimiento->descripcion = $request->descripcion;
            $movimiento->tipomovimiento = $tipo;
            $movimiento->estado = '1';
            $movimiento->save();

            $cuentaahorros->ultimomovimiento = $movimiento->id;//Se actualiza el último movimiento de la cuenta
            $cuentaahorros->save();

            DB::commit();

            return [ "excep" => false ];
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}
}
