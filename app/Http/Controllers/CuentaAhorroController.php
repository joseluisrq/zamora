<?php

namespace App\Http\Controllers;

use App\CuentaAhorro;
use App\DepositoFijo;
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
                'cuentaahorros.interes_ganado',

                'personas.dni as sociodni',
                'personas.nombre as socionombre',
                'personas.apellidos as socioapellido',

                'cuentaahorros.tipocuenta',
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
                'cuentaahorros.interes_ganado',

                'personas.dni as sociodni',
                'personas.nombre as socionombre',
                'personas.apellidos as socioapellido',

                'cuentaahorros.tipocuenta'
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

    public function cuentasSocio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $idsocio = $request->id;
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
             ->select(
                'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.saldoefectivo',
                'cuentaahorros.fechaapertura',
                'cuentaahorros.tasa',
                'cuentaahorros.interes_ganado',

                'cuentaahorros.tipocuenta',
                'cuentaahorros.estado'
            )
            ->where([
                ['cuentaahorros.idsocio', '=', $idsocio]
            ])
            ->orderBy('cuentaahorros.id', 'desc')->paginate(15);
        }
        else
        {
            $cuentas = CuentaAhorro::join('personas', 'personas.id', '=', 'cuentaahorros.idsocio')
             ->select(
                'cuentaahorros.id',
                'cuentaahorros.numerocuenta',
                'cuentaahorros.saldoefectivo',
                'cuentaahorros.fechaapertura',
                'cuentaahorros.tasa',
                'cuentaahorros.interes_ganado',

                'cuentaahorros.tipocuenta',
                'cuentaahorros.estado'
            )
            ->where([
                ['cuentaahorros.estado', '=', 1],
                ['cuentaahorros.idsocio', '=', $idsocio],
                ['cuentaahorros.'.$criterio, 'like', '%'.$buscar.'%']
            ])
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

        $iduser = \Auth::user()->id;
        $usuario = User::select(
            'users.id',
            'users.usuario'
        )
        ->where('users.id', '=', $iduser) //usuario activo
        ->take(1)
        ->get()[0];

        return [
        	'socios' => $socios,
        	'usuario' => $usuario
        ];
    }

	public function store(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        $monto_min = $request->monto_min;

        $request->validate([
            'idsocio' => 'required',
            'monto_inicial' => 'required|numeric|min:'.$monto_min,
            // 'descripcion' => 'required'
        ],
        [
            'idsocio.required' => 'seleccione un DNI de socio',
            'monto_inicial.required' => 'ingrese un monto',
            'monto_inicial.min' => 'el monto mínimo de apertura es de S/.'.$monto_min
        ]);
 
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

            $descripcion = $request->tipocuenta==1?'Nueva Cuenta de Ahorros':'Nueva Cuenta a Plazo Fijo';

			$cuentaahorro = new CuentaAhorro();
			$cuentaahorro->idsocio = $request->idsocio;
	        $cuentaahorro->idusuario = \Auth::user()->id;
	        $cuentaahorro->numerocuenta = $numerocuenta;
	        $cuentaahorro->saldoefectivo = $request->monto_inicial;
	        $cuentaahorro->fechaapertura = Carbon::now('America/Lima');
	        $cuentaahorro->ultimomovimiento = 0;//Al momento de la creación
	        $cuentaahorro->descripcion = $descripcion;
            $cuentaahorro->tipocuenta = $request->tipocuenta;
	        $cuentaahorro->tasa = $request->tasa;
            $cuentaahorro->interes_ganado = 0;
	        $cuentaahorro->estado = '1';
            $cuentaahorro->save();

            $movimiento = new Movimiento();
            $movimiento->idusuario = $cuentaahorro->idusuario;
	        $movimiento->idahorro = $cuentaahorro->id;
	        $movimiento->fecharegistro = Carbon::now('America/Lima');
	        $movimiento->monto = $cuentaahorro->saldoefectivo;//Porque se trata del aporte inicial
	        $movimiento->descripcion = 'CREACIÓN DE CUENTA';
	        $movimiento->tipomovimiento = '1';//Se trata del aporte inicial
            $movimiento->interes_ganado = 0;
            $movimiento->interes_ganado_total = 0;
	        $movimiento->estado = '1';
	        $movimiento->save();

	        $cuentaahorro->ultimomovimiento = $movimiento->id;
	        $cuentaahorro->save();

            $deposito = '';

            if(isset($request->tiempo_fijo))
            {
                $deposito = new DepositoFijo();
                $deposito->idcuenta = $cuentaahorro->id;
                $deposito->fecha_inicio = Carbon::now('America/Lima');
                $deposito->fecha_fin = Carbon::now('America/Lima')->addDays($request->tiempo_fijo);
                $deposito->tasa = $request->tasa;
                $deposito->monto = $request->monto_inicial;
                $deposito->monto_cobrado = 0;
                $deposito->interes_cobrado = 0;
                $deposito->descripcion = 'CREACIÓN DE CUENTA';
                $deposito->save();
            }

			DB::commit();

            return ["idcuenta" => $cuentaahorro->id, "deposito" => $deposito];
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
            'cuentaahorros.tipocuenta',

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
        ->join('users', 'users.id', '=', 'movimientos.idusuario')
        ->select(
        	'movimientos.id',
            'movimientos.fecharegistro',
            'movimientos.monto',
            'movimientos.tipomovimiento',
            'movimientos.interes_ganado',

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

    public function obtenerInteresesGanados(Request $request)
    {
        $idsocio = $request->id;

        $intereses = CuentaAhorro::select(DB::raw('sum(interes_ganado) as interes_total'))
        ->where('idsocio', '=', $idsocio)
        ->get()[0]->interes_total;

        return [
            "interes_total" => $intereses
        ];
    }

    public function imprimirDetalleCuenta(Request $request)
    {
        $id = $request->id;

        $cuenta = CuentaAhorro::join('personas as socio', 'socio.id', '=', 'cuentaahorros.idsocio')
        ->join('users', 'users.id', '=', 'cuentaahorros.idusuario')
        ->select(
            'cuentaahorros.id',
            'cuentaahorros.numerocuenta',
            'cuentaahorros.saldoefectivo',
            'cuentaahorros.fechaapertura',
            'cuentaahorros.descripcion',
            'cuentaahorros.tasa',
            'cuentaahorros.tipocuenta',

            'socio.nombre',
            'socio.apellidos',
            'socio.dni',
            'socio.fechanacimiento',
            'socio.departamento',
            'socio.ciudad',
            'socio.direccion',
            'socio.telefono',
            'socio.email',

            'users.usuario'
        )
        ->where('cuentaahorros.id', '=', $id)
        ->orderBy('cuentaahorros.id', 'desc')
        ->take(1)
        ->get()[0];

        $cuenta->fechaapertura = Carbon::parse($cuenta->fechaapertura)->format('d-m-Y H:i:s');
        $cuenta->fechanacimiento = Carbon::parse($cuenta->fechanacimiento)->format('d-m-Y');

        $datos_plazo_fijo = [];
        $min_dias = 15;
        $max_dias = 30;
        if($cuenta->tipocuenta == 2){
            $datos_plazo_fijo = DepositoFijo::select(
                        'depositos_fijo.monto',
                        'depositos_fijo.tasa',
                        'depositos_fijo.fecha_inicio',
                        'depositos_fijo.fecha_fin'
                    )
            ->where('depositos_fijo.idcuenta', '=', $cuenta->id)
            ->orderBy('depositos_fijo.id', 'desc')
            ->take(1)
            ->get()[0];

            $datos_plazo_fijo->fecha_inicio = Carbon::parse($datos_plazo_fijo->fecha_inicio);
            $datos_plazo_fijo->fecha_fin = Carbon::parse($datos_plazo_fijo->fecha_fin);

            $plazo_dias = $datos_plazo_fijo->fecha_fin->diffInDays($datos_plazo_fijo->fecha_inicio);

            $datos_plazo_fijo->fecha_inicio = $datos_plazo_fijo->fecha_inicio->format('d-m-Y');
            $datos_plazo_fijo->fecha_fin = $datos_plazo_fijo->fecha_fin->format('d-m-Y');

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

        $pdf= \PDF::loadView('pdf.detallecuentaahorros',[
            "cuenta" => $cuenta,
            "datos_plazo_fijo" => $datos_plazo_fijo,
            "min_dias" => $min_dias,
            "max_dias" => $max_dias
        ]);

        return $pdf->download('CuentaAhorro_'.$cuenta->numerocuenta.'.pdf');
    }
}
