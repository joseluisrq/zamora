<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use App\Empresa;
use App\Movimiento;
use App\Persona;
use App\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuentaAhorroController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
             ->select(
            	'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.saldoefectivo',
                'cuentaahorros.fechaapertura',
                'cuentaahorros.tasa',

                'personas.dni as sociodni',
                'personas.nombre as socionombre',
                'personas.apellidos as socioapellido',

                'cuentaahorros.estado'
            )
            ->where('cuentaahorros.estado', '=', 1)
            ->orderBy('cuentaahorros.id', 'desc')->paginate(15);
        }
        else{

        	$tabla = 'cuentaahorros';

        	if($criterio == 'dni')
        		$tabla = 'personas';

            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
            ->select(
            	'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.saldoefectivo',
                'cuentaahorros.fechaapertura',
                'cuentaahorros.tasa',

                'personas.dni as sociodni',
                'personas.nombre as socionombre',
                'personas.apellidos as socioapellido',

                'cuentaahorros.estado'
            )
            ->where('cuentaahorros.estado', '=', 1)
            ->where($tabla.'.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cuentaahorros.id', 'desc')->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $cuentas->total(),
                'current_page' => $cuentas->currentPage(),
                'per_page'     => $cuentas->perPage(),
                'last_page'    => $cuentas->lastPage(),
                'from'         => $cuentas->firstItem(),
                'to'           => $cuentas->lastItem(),
            ],
            'cuentas' => $cuentas
        ];
	}

	public function selectSocio(Request $request)
    {
    	if (!$request->ajax()) return redirect('/');

    	$filtro = $request->filtro;
        $socios = Persona::join('socios','personas.id','=','socios.id')
        ->select(
            'personas.id',
            'personas.dni',
            'personas.nombre',
            'personas.apellidos'
        )
        ->where('socios.estado', '=', '1') //socio activo
        ->where('personas.dni', 'like', '%'. $filtro . '%')
        ->get();

        $tasa = Empresa::select('tasa_ahorros')
        ->orderBy('empresa.id', 'desc')
        ->take(1)
        ->get()[0]->tasa_ahorros;

        $iduser = 14;//\Auth::user()->id;
        $usuario = User::select(
            'users.id',
            'users.usuario'
        )
        ->where('users.id', '=', $iduser) //usuario activo
        ->take(1)
        ->get()[0];

        return [
        	'tasa' => $tasa,
        	'socios' => $socios,
        	'usuario' => $usuario
        ];
    }

	public function store(Request $request)
	{
		if (!$request->ajax()) return redirect('/');
 
        try{
			DB::beginTransaction();

			$numerocuenta = $request->numerocuenta;

			//Esto es en caso se cree más de una cuenta por socio
			$cantidad_cuentas = CuentaAhorro::select('numerocuenta')
			->where('cuentaahorros.numerocuenta', 'like', $numerocuenta.'%')
			->get()
			->count();

			if($cantidad_cuentas > 0)
				$numerocuenta .= '_'.($cantidad_cuentas + 1);

			$cuentaahorro = new CuentaAhorro();
			$cuentaahorro->idsocio = $request->idsocio;
	        $cuentaahorro->idusuario = $request->idusuario;
	        $cuentaahorro->numerocuenta = $numerocuenta;
	        $cuentaahorro->saldoefectivo = $request->monto_inicial;
	        $cuentaahorro->fechaapertura = Carbon::now('America/Lima');
	        $cuentaahorro->ultimomovimiento = 0;//Al momento de la creación
	        $cuentaahorro->descripcion = $request->descripcion;
	        $cuentaahorro->tasa = $request->tasa;
	        $cuentaahorro->estado = '1';
            $cuentaahorro->save();

            $movimiento = new Movimiento();
            $movimiento->idusuario = $cuentaahorro->idusuario;
	        $movimiento->idahorro = $cuentaahorro->id;
	        $movimiento->fecharegistro = Carbon::now('America/Lima');
	        $movimiento->monto = $cuentaahorro->saldoefectivo;//Porque se trata del aporte inicial
	        $movimiento->descripcion = 'CREACIÓN DE CUENTA DE AHORROS';
	        $movimiento->tipomovimiento = '1';//Se trata del aporte inicial
	        $movimiento->estado = '1';
	        $movimiento->save();

	        $cuentaahorro->ultimomovimiento = $movimiento->id;
	        $cuentaahorro->save();

			DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
	}

	public function detalleCuentaAhorro(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

		$id = $request->id;

		$infocuenta = CuentaAhorro::join('users', 'users.id', '=', 'cuentaahorros.idusuario')
        ->select(
        	'cuentaahorros.id',
            'cuentaahorros.numerocuenta',
            'cuentaahorros.saldoefectivo',
            'cuentaahorros.fechaapertura',
            'cuentaahorros.tasa',

            'users.usuario'
        )
        ->where('cuentaahorros.id', '=', $id)
        ->take(1)
        ->get()[0];

        $infosocio = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
        ->select(
        	'personas.dni',
            'personas.nombre',
            'personas.apellidos',
            'personas.fechanacimiento',
            'personas.direccion',
            'personas.telefono',
            'personas.email'
        )
        ->where('cuentaahorros.id', '=', $id)
        ->take(1)
        ->get()[0];

        $movimientos = Movimiento::join('cuentaahorros', 'cuentaahorros.id', '=', 'movimientos.idahorro')
        ->join('users', 'users.id', '=', 'cuentaahorros.idusuario')
        ->select(
        	'movimientos.id',
            'movimientos.fecharegistro',
            'movimientos.monto',
            'movimientos.tipomovimiento',
            'movimientos.estado',

            'users.usuario'
        )
        ->where('cuentaahorros.id', '=', $id)
        ->orderBy('movimientos.id', 'desc')
        ->get();

		return [
			'infocuenta' => $infocuenta,
			'infosocio' => $infosocio,
			'movimientos' => $movimientos
		];
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
