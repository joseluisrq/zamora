<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use App\Movimiento;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
	public function selectCuenta(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

    	$dni = $request->filtro;

        $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
        ->join('socios', 'socios.id', '=', 'cuentaahorros.idsocio')
        ->select(
            'cuentaahorros.id',
            'cuentaahorros.numerocuenta',

            'personas.nombre',
            'personas.apellidos',

            DB::raw('CONCAT(personas.dni, " - ", cuentaahorros.numerocuenta) AS identificador')
        )
        ->where([
            ['cuentaahorros.estado', '=', '1'],
            ['cuentaahorros.tipocuenta', '=', '1'],//SOLO SE REGISTRAN MOVIMIENTOS PARA CUENTAS DE AHORROS...
            ['personas.dni', 'like', '%'. $dni . '%'],
            ['socios.estado', '=', '1']
        ]) //socio activo
        ->get();

        return [ 'cuentas' => $cuentas ];
	}

	public function store(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        $request->validate([
            'cuenta' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required'
        ]);

        try{
            DB::beginTransaction();

            $idcuenta = $request->cuenta;
            $tipo = $request->tipo;// 0:Retiro, 1:Aporte
            $monto = $request->monto;

            $cuentaahorros = CuentaAhorro::findOrFail($idcuenta);
            $saldoefectivo = $cuentaahorros->saldoefectivo;

			if($tipo == 0)
			{//Si se trata de retiro, se deb verificar que tenga el dinero suficientes
                // if($cuentaahorros->tipocuenta == 2) //VALIDAR LOS RETIROS PARA LA CUENTA DE PLAZO FIJO

				if($saldoefectivo < $monto)
					return [ "excep" => true, "monto" => $saldoefectivo ]; //Significa que quiere retirar más de lo que dispone
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

            return [ "excep" => false , "id" => $movimiento->id];
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}

    public function imprimirBoucherMovimiento(Request $request)
    {
        $id = $request->id;

        $movimiento = Movimiento::join('cuentaahorros', 'cuentaahorros.id', '=', 'movimientos.idahorro')
        ->join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
        ->join('users', 'users.id', '=', 'movimientos.idusuario')
        ->select(
            'cuentaahorros.numerocuenta',

            'personas.nombre',
            'personas.apellidos',
            'personas.dni',

            'movimientos.monto',
            'movimientos.descripcion',
            'movimientos.tipomovimiento',
            'movimientos.fecharegistro',

            'users.usuario'
        )
        ->where('movimientos.id', '=', $id)
        ->orderBy('movimientos.id', 'desc')
        ->take(1)
        ->get()[0];

        $pdf= \PDF::loadView('pdf.detallemovimiento',['mov'=>$movimiento]);
        return $pdf->download('Movimiento-0'.$id.'.pdf');
    }
}
