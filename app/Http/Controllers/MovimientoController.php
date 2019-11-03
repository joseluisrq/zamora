<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use App\DepositoFijo;
use App\Empresa;
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

        $cuentas = [];

        if($request->tipocuenta == 1)//Se trata de cuentas de AHORROS
        {
            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
            ->join('socios', 'socios.id', '=', 'cuentaahorros.idsocio')
            ->select(
                'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.tipocuenta',

                'personas.nombre',
                'personas.apellidos',

                DB::raw('CONCAT(personas.dni, " - ", cuentaahorros.numerocuenta) AS identificador')
            )
            ->where([
                ['cuentaahorros.estado', '=', '1'],
                ['cuentaahorros.tipocuenta', '=', '1'],//SOLO SE MUESTRAN LAS CUENTAS DE AHORROS
                ['personas.dni', 'like', '%'. $dni . '%'],
                ['socios.estado', '=', '1']
            ]) //socio activo
            ->get();
        }
        else
        {
            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
            ->join('socios', 'socios.id', '=', 'cuentaahorros.idsocio')
            ->join('depositos_fijo', 'depositos_fijo.idcuenta', '=', 'cuentaahorros.id')
            ->select(
                'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.tipocuenta',

                'depositos_fijo.tasa',
                'depositos_fijo.monto',
                'depositos_fijo.fecha_inicio',
                'depositos_fijo.fecha_fin',

                'personas.nombre',
                'personas.apellidos',

                DB::raw('CONCAT(personas.dni, " - ", cuentaahorros.numerocuenta) AS identificador')
            )
            ->where([
                ['cuentaahorros.estado', '=', '1'],
                ['cuentaahorros.tipocuenta', '=', '2'],// SOLO SE MUESTRAN LAS CUENTAS DE PLAZO FIJO
                ['personas.dni', 'like', '%'. $dni . '%'],
                ['socios.estado', '=', '1']
            ])
            ->whereNull('depositos_fijo.fecha_cobro')
            ->get();
        }

        return [ 'cuentas' => $cuentas ];
	}

	public function storeAhorros(Request $request)// MOVIMIENTOS PARA CUENTAS DE AHORRO
	{
		if (!$request->ajax()) return redirect('/');

        $request->validate([
            'cuenta' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required'
        ], 
        [
            'cuenta.required' => 'Seleccione un número de cuenta',
            'monto.required' => 'Ingrese un monto',
            'descripcion.required' => 'Ingrese una descripción',
            'tipo.required' => 'Seleccione un tipo de movimiento'
        ]);

        try{
            DB::beginTransaction();

            $idcuenta = $request->cuenta;
            $tipo = $request->tipo;// 0:Retiro, 1:Aporte
            $monto = $request->monto;

            $cuentaahorros = CuentaAhorro::findOrFail($idcuenta);

            $plazo_establecido = 0;//Estas variables permiten validar y también calcular el interés a plazo fijo
            $dias_transcurridos = 0;

            $saldoefectivo = $cuentaahorros->saldoefectivo;

			if($tipo == 0)
			{//Si se trata de retiro, se debe verificar que tenga el dinero suficientes

				if($saldoefectivo < $monto)
					return ["excep" => true, "monto" => $saldoefectivo ]; //Significa que quiere retirar más de lo que dispone
				else
					$cuentaahorros->saldoefectivo = $saldoefectivo - $monto;
			}
			else //Si se trata de aporte solo se incremeta el saldo
			{
				$cuentaahorros->saldoefectivo = $saldoefectivo + $monto;	
			}

            $interes_ganado = $this->calcularInteresCuentaAhorros($cuentaahorros, $saldoefectivo, $plazo_establecido, $dias_transcurridos);

            $movimiento = new Movimiento();
            $movimiento->idusuario = \Auth::user()->id;
            $movimiento->idahorro = $idcuenta;
            $movimiento->fecharegistro = Carbon::now('America/Lima');
            $movimiento->monto = $monto;
            $movimiento->descripcion = $request->descripcion;
            $movimiento->tipomovimiento = $tipo;
            $movimiento->interes_ganado = $interes_ganado;
            $movimiento->interes_ganado_total = $cuentaahorros->interes_ganado + $interes_ganado;
            $movimiento->estado = '1';
            $movimiento->save();

            $cuentaahorros->ultimomovimiento = $movimiento->id;//Se actualiza el último movimiento de la cuenta
            $cuentaahorros->interes_ganado += $interes_ganado;
            $cuentaahorros->save();

            DB::commit();

            return ["excep" => false , "id" => $movimiento->id];
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}

    public function storeFijo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $request->validate(['cuenta' => 'required'], ['cuenta.required' => 'Seleccione un número de cuenta']);

        try{
            DB::beginTransaction();

            $idcuenta = $request->cuenta;

            $fechas = DepositoFijo::select('depositos_fijo.fecha_inicio', 'depositos_fijo.fecha_fin')
            ->where('depositos_fijo.idcuenta', '=', $idcuenta)
            ->orderBy('depositos_fijo.id', 'desc')
            ->take(1)
            ->get()[0];

            $fecha_inicio = Carbon::parse($fechas->fecha_inicio);
            $fecha_fin = Carbon::parse($fechas->fecha_fin);

            $fecha_actual = Carbon::now('America/Lima');

            $plazo_establecido = $fecha_fin->diffInDays($fecha_inicio);
            $dias_transcurridos = $fecha_actual->diffInDays($fecha_inicio);

            $datos_plazo = $this->plazoCumplido($plazo_establecido, $dias_transcurridos, $fecha_inicio);

            $plazo_cumplido = $datos_plazo['plazo_cumplido'];
            $fecha_fin = $datos_plazo['fecha_fin'];
            $minimo_dias = $datos_plazo['minimo_dias'];

            if(!$plazo_cumplido)
            {
                return [
                    "plazocumplido" => $plazo_cumplido,
                    "fecha_inicio" => $fecha_inicio->format('d-m-Y'),
                    "fecha_fin" => $fecha_fin->format('d-m-Y'),
                    "plazo_establecido" => $plazo_establecido,
                    "minimo_dias" => $minimo_dias
                ];
            }

            $cuentaahorros = CuentaAhorro::findOrFail($idcuenta);
            $saldoefectivo = $cuentaahorros->saldoefectivo;

            $id_deposito_cobro = DepositoFijo::where([
                ['depositos_fijo.idcuenta', '=', $cuentaahorros->id]
            ])
            ->whereNull('depositos_fijo.fecha_cobro')
            ->orderBy('depositos_fijo.id', 'desc')
            ->get()[0]->id;

            $interes_ganado = $this->calcularInteresCuentaAhorros($cuentaahorros, $saldoefectivo, $plazo_establecido, $dias_transcurridos);

            $cuentaahorros->interes_ganado += $interes_ganado;
            $interes_total = $cuentaahorros->interes_ganado;

            // SE ASUME QUE SE CANCELA LA CUENTA AL FINAL DEL PLAZO
            $deposito_cobro = DepositoFijo::findOrFail($id_deposito_cobro);
            $deposito_cobro->fecha_cobro = Carbon::now('America/Lima');
            $deposito_cobro->monto_cobrado = $deposito_cobro->monto;
            $deposito_cobro->interes_cobrado = $interes_ganado;

            $descripcion = $deposito_cobro->descripcion;
            $deposito_cobro->descripcion .= '/CANCELACIÓN DE CUENTA';
            
            $cuentaahorros->saldoefectivo = 0;
            $cuentaahorros->estado = 0;

            $movimiento = new Movimiento();
            $movimiento->idusuario = \Auth::user()->id;
            $movimiento->idahorro = $idcuenta;
            $movimiento->fecharegistro = Carbon::now('America/Lima');
            $movimiento->monto = $deposito_cobro->monto;
            $movimiento->descripcion = 'COBRO DE MONTO E INTERÉS Y CANCELACIÓN DE CUENTA';
            $movimiento->tipomovimiento = '0';//Es un retiro
            $movimiento->interes_ganado = $interes_ganado;
            $movimiento->interes_ganado_total = $interes_total;
            $movimiento->estado = '1';

            if($request->renovar)
            {
                $campo_tasa = 'tasa_ahorroplazo_'.$plazo_establecido;

                $deposito_fijo = new DepositoFijo();
                $deposito_fijo->idcuenta = $cuentaahorros->id;
                $deposito_fijo->tasa = Empresa::get()[0]->$campo_tasa;
                $deposito_fijo->monto = $deposito_cobro->monto;
                $deposito_fijo->fecha_inicio = Carbon::now('America/Lima');
                $deposito_fijo->fecha_fin = Carbon::now('America/Lima')->addDays($plazo_establecido);
                $deposito_fijo->monto_cobrado = 0;
                $deposito_fijo->interes_cobrado = 0;
                $deposito_fijo->descripcion = 'RENOVACIÓN DE CUENTA';
                $deposito_fijo->save();

                $deposito_cobro->monto_cobrado = 0;
                $deposito_cobro->descripcion = $descripcion;

                $cuentaahorros->saldoefectivo = $deposito_fijo->monto;
                $cuentaahorros->estado = 1;

                $movimiento->monto = 0;
                $movimiento->descripcion = 'COBRO DE INTERÉS Y RENOVACIÓN DE CUENTA';
                $movimiento->tipomovimiento = '1';//Es un aporte/ renovación
            }

            $deposito_cobro->save();

            $movimiento->save();

            $cuentaahorros->ultimomovimiento = $movimiento->id;//Se actualiza el último movimiento de la cuenta
            $cuentaahorros->save();

            DB::commit();

            return [ "plazocumplido" => true, "id" => $movimiento->id];
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
    }

    private function plazoCumplido($plazo_establecido, $dias_transcurridos, Carbon $fecha_inicio)
    {
        $minimo_dias = 15;

        switch ($plazo_establecido) {
            case 30://Por defecto el mínimo es 15 días                
                break;
            case 90:
                $minimo_dias = 31;
                break;
            case 180:
                $minimo_dias = 91;
                break;
            case 360:
                $minimo_dias = 181;            
                break;
            case 361:
                $minimo_dias = 361;
                break;
            
            default:
                break;
        }

        $plazo_cumplido = ($dias_transcurridos >= $minimo_dias);
        $fecha_fin = Carbon::parse($fecha_inicio);
        $fecha_fin->addDays($minimo_dias);

        return [
            "plazo_cumplido" => $plazo_cumplido,
            "fecha_fin" => $fecha_fin,
            "minimo_dias" => $minimo_dias
        ];
    }

    private function calcularInteresCuentaAhorros(CuentaAhorro $cuenta, $saldoefectivo, $plazo_establecido, $dias_transcurridos)
    {
        $tea = ($cuenta->tasa)/100;//TASA EFECTIVA ANUAL
        $tem = pow((1 + $tea), (1/12)) - 1;//TASA EFECTIVA MENSUAL
        $tna = $tem * 12;//TASA NOMINAL ANUAL
        $tnd = $tna / 360;//TASA NOMINAL DIARIA

        $interes_ganado = 0;

        if($cuenta->tipocuenta == 1)
        {
            $ult_movimiento = Movimiento::findOrFail($cuenta->ultimomovimiento);

            $fecha_actual = Carbon::now('America/Lima');
            $fecha_ult_movimiento = Carbon::parse($ult_movimiento->fecharegistro);

            $dias_transcurridos = $fecha_actual->diffInDays($fecha_ult_movimiento);

            $interes_ganado = $tnd * $saldoefectivo * $dias_transcurridos;
        }
        else
        {//Se calcula el interés para las cuentas de plazo fijo

            $deposito_fijo = DepositoFijo::select('depositos_fijo.monto', 'depositos_fijo.tasa')
            ->where('depositos_fijo.idcuenta', '=', $cuenta->id)
            ->orderBy('depositos_fijo.id', 'desc')
            ->take(1)
            ->get()[0];

            $tea = ($deposito_fijo->tasa)/100;//TASA EFECTIVA ANUAL
            $monto_deposito = $deposito_fijo->monto;

            $nro_dias = ($dias_transcurridos < $plazo_establecido)? $dias_transcurridos : $plazo_establecido;
            //El número de días depende, en el caso de que retire su dinero antes del plazo final, o si lo retira después del plazo

            $interes_ganado = $monto_deposito * (pow((1 + $tea), ($nro_dias/360)) - 1);//Con capitalización diaria
        }

        return number_format($interes_ganado, 2, '.', ' ');
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

            'movimientos.idahorro',
            'movimientos.monto',
            'movimientos.descripcion',
            'movimientos.tipomovimiento',
            'movimientos.fecharegistro',
            'movimientos.interes_ganado',
            'movimientos.interes_ganado_total',

            'users.usuario'
        )
        ->where('movimientos.id', '=', $id)
        ->orderBy('movimientos.id', 'desc')
        ->take(1)
        ->get()[0];

        $tipocuenta = CuentaAhorro::findOrFail($movimiento->idahorro)->tipocuenta;

        //FECHA DE INICIO DE PLAZO FIJO
        $fecha_inicio = '';
        $fecha_fin = '';

        $min_dias = 15;
        $max_dias = 30;

        if($tipocuenta == 2){
            $deposito = DepositoFijo::where('depositos_fijo.idcuenta', '=', $movimiento->idahorro)
                ->orderBy('depositos_fijo.id', 'desc')->get()[0];

            $fecha_inicio = Carbon::parse($deposito->fecha_inicio);
            $fecha_fin = Carbon::parse($deposito->fecha_fin);

            $plazo_dias = $fecha_fin->diffInDays($fecha_inicio);

            $fecha_inicio = $fecha_inicio->format('d-m-Y');
            $fecha_fin = $fecha_fin->format('d-m-Y');

            switch ($plazo_dias) {
                case 30://Por defecto el mínimo es 15 y el máximo 30 días
                    break;
                case 90:
                    $min_dias = 31;
                    $max_dias = 90;
                    break;
                case 180:
                    $min_dias = 91;
                    $max_dias = 180;
                    break;
                case 360:
                    $min_dias = 181;
                    $max_dias = 360;
                    break;
                case 361:
                    $min_dias = 361;
                    $max_dias = 361;
                    break;
                default:
                    break;
            }

        }


        $pdf= \PDF::loadView('pdf.detallemovimiento',[
            "mov" => $movimiento,
            "tipocuenta" => $tipocuenta,
            "fecha_inicio" => $fecha_inicio,
            "fecha_fin" => $fecha_fin,
            "min_dias" => $min_dias,
            "max_dias" => $max_dias
        ]);

        return $pdf->download('Movimiento-0'.$id.'.pdf');
    }
}
