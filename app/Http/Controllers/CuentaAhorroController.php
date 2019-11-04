<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\Caja;
use App\CuentaAhorro;
use App\DepositoFijo;
use App\DetalleCaja;
use App\Empresa;
use App\Movimiento;
use App\Persona;
use App\Socio;
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
                'cuentaahorros.interes_disponible',

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
                'cuentaahorros.interes_disponible',

                'personas.dni as sociodni',
                'personas.nombre as socionombre',
                'personas.apellidos as socioapellido',

                'cuentaahorros.tipocuenta'
            )
            ->where('cuentaahorros.estado', '=', 1)
            ->where($tabla.'.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cuentaahorros.id', 'desc')->paginate(15);
        }

        //PARA MOSTRAR EL INTERÉS DISPONIBLE
        for($i = 0; $i < sizeof($cuentas); $i++)
        {
            $cuentas[$i]->interes_disponible += $this->interesDesdeUltMovimiento($cuentas[$i]->id);
            $cuentas[$i]->interes_disponible = number_format($cuentas[$i]->interes_disponible, 2, '.', '');
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
                'cuentaahorros.interes_disponible',

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
                'cuentaahorros.interes_disponible',

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

        for($i = 0; $i < sizeof($cuentas); $i++)
        {
            $cuentas[$i]->interes_disponible += $this->interesDesdeUltMovimiento($cuentas[$i]->id);
            $cuentas[$i]->interes_disponible = number_format($cuentas[$i]->interes_disponible, 2, '.', '');
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
            $cuentaahorro->interes_disponible = 0;
	        $cuentaahorro->estado = '1';
            $cuentaahorro->save();

            $movimiento = new Movimiento();
            $movimiento->idusuario = $cuentaahorro->idusuario;
	        $movimiento->idahorro = $cuentaahorro->id;
	        $movimiento->fecharegistro = Carbon::now('America/Lima');
	        $movimiento->monto = $request->monto_inicial;//Porque se trata del aporte inicial
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

            $idcaja = Caja::where([
                ['idusuario', '=', \Auth::user()->id],
                ['estado', '=', 1]
            ])
            ->orderBy('id', 'desc')
            ->get()[0]->id;

            $detallecaja = new DetalleCaja();
            $detallecaja->idcaja = $idcaja;
            $detallecaja->idmovimiento = $movimiento->id;
            $detallecaja->tipo = 2;//SE TRATA DE MOVIMIENTOS
            $detallecaja->estado = 1;//ENTRA DINERO A LA CAJA
            $detallecaja->fecha = Carbon::now('America/Lima');
            $detallecaja->monto = $request->monto_inicial;
            $detallecaja->save();

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
            'cuentaahorros.interes_ganado',
            'cuentaahorros.interes_disponible',

            'users.usuario'
        )
        ->where('cuentaahorros.id', '=', $id)
        ->take(1)
        ->get()[0];

        $infocuenta->interes_disponible += $this->interesDesdeUltMovimiento($id);
        $infocuenta->interes_disponible =  number_format($infocuenta->interes_disponible, 2, '.', '');

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
        if (!$request->ajax()) return redirect('/');

        $idsocio = $request->id;

        $cuentas = CuentaAhorro::where([
            ['idsocio', '=', $idsocio],
            ['estado', '=', '1']// SOLO CONSIDERAR LAS CUENTAS ACTIVAS
        ])
        ->get();

        $interes_cuentas = 0;

        for($i = 0; $i < sizeof($cuentas); $i++)
        {//SOLO ESTÁ DISPONIBLE LOS INTERESES DE LAS CUENTAS DE AHORROS, PORQUE LOS DE PLAZO FIJO SE COBRAN AL FINAL DEL PERÍODO
            if($cuentas[$i]->tipocuenta == 1)
                $interes_cuentas += $cuentas[$i]->interes_disponible + $this->interesDesdeUltMovimiento($cuentas[$i]->id);
        }

        $interes_aportes = Socio::select('interes_aportaciones')
        ->where('id', '=', $idsocio)
        ->get()[0]->interes_aportaciones;

        $interes_aportes += $this->interesDesdeUltAporte($idsocio);

        return [
            "interes_cuentas" => number_format($interes_cuentas, 2, '.', ''),
            "interes_aportes" => $interes_aportes
        ];
    }

    private function interesDesdeUltMovimiento($idcuenta)
    {
        $cuenta = CuentaAhorro::findOrFail($idcuenta);

        $tea = ($cuenta->tasa)/100;//TASA EFECTIVA ANUAL
        $tem = pow((1 + $tea), (1/12)) - 1;//TASA EFECTIVA MENSUAL
        $tna = $tem * 12;//TASA NOMINAL ANUAL
        $tnd = $tna / 360;//TASA NOMINAL DIARIA


        $ult_movimiento = Movimiento::findOrFail($cuenta->ultimomovimiento);

        $fecha_actual = Carbon::now('America/Lima');
        $fecha_ult_movimiento = Carbon::parse($ult_movimiento->fecharegistro);

        $dias_transcurridos = $fecha_actual->diffInDays($fecha_ult_movimiento);

        $interes_ganado = $tnd * $cuenta->saldoefectivo * $dias_transcurridos;

        return $interes_ganado;
    }

    private function interesDesdeUltAporte($idsocio)
    {
        $socio = Socio::findOrFail($idsocio);

        
        $ultimo_aporte = Aporte::where([
            ['idsocio', '=', $idsocio],
            ['tipooperacion', '=', '1'],
            ['estado', '=', '1']
        ])
        ->orderBy('id', 'desc')
        ->get();

        $ult_cobro = Aporte::where([
            ['idsocio', '=', $idsocio],
            ['tipooperacion', '=', '0'],
            ['estado', '=', '1']
        ])
        ->orderBy('id', 'desc')
        ->get();

        if(sizeof($ultimo_aporte) > 0)
        {
            $aporte = $ultimo_aporte[0];

            $tea = ($aporte->tasa)/100;//TASA EFECTIVA ANUAL
            $tem = pow((1 + $tea), (1/12)) - 1;//TASA EFECTIVA MENSUAL
            $tna = $tem * 12;//TASA NOMINAL ANUAL
            $tnd = $tna / 360;//TASA NOMINAL DIARIA

            $fecha_actual = Carbon::now('America/Lima');
            $fecha_ult_aporte = Carbon::parse($aporte->fecharegistro);

            if(sizeof($ult_cobro) > 0)
                $fecha_ult_aporte = Carbon::parse($ult_cobro[0]->fecharegistro);

            $dias_transcurridos = $fecha_actual->diffInDays($fecha_ult_aporte);

            $interes_ganado = $tnd * $aporte->monto * $dias_transcurridos;

            return number_format($interes_ganado, 2, '.', '');
        }

        return 0;
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

    public function reportes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $ahorros_activos = CuentaAhorro::where([
            ['tipocuenta', '=', '1'],
            ['estado', '=', '1']
        ])->get()->count();

        $ahorros_inactivos = CuentaAhorro::where([
            ['tipocuenta', '=', '1'],
            ['estado', '=', '0']
        ])->get()->count();

        $plazofijo_activos = CuentaAhorro::where([
            ['tipocuenta', '=', '2'],
            ['estado', '=', '1']
        ])->get()->count();

        $plazofijo_inactivos = CuentaAhorro::where([
            ['tipocuenta', '=', '2'],
            ['estado', '=', '0']
        ])->get()->count();

        $montos_ahorros = CuentaAhorro::select(DB::raw('sum(saldoefectivo) as total'))
        ->where([
            ['tipocuenta', '=', '1'],
            ['estado', '=', '1']
        ])->get()[0]->total;

        $montos_plazofijo = CuentaAhorro::select(DB::raw('sum(saldoefectivo) as total'))
        ->where([
            ['tipocuenta', '=', '2'],
            ['estado', '=', '1']
        ])->get()[0]->total;

        $interes_ahorros = CuentaAhorro::select('id', 'interes_ganado')
        ->where([
            ['tipocuenta', '=', '1'],
            ['estado', '=', '1']
        ])->get();

        $interes_ganado_ahorros = 0;
        for($i = 0; $i < sizeof($interes_ahorros); $i++)
        {
            $interes_ganado_ahorros += $interes_ahorros[$i]->interes_ganado + $this->interesDesdeUltMovimiento($interes_ahorros[$i]->id);
        }

        $interes_plazofijo= CuentaAhorro::select('id', 'interes_ganado')
        ->where([
            ['tipocuenta', '=', '2'],
            ['estado', '=', '1']
        ])->get();

        $interes_ganado_plazofijo = 0;
        for($i = 0; $i < sizeof($interes_plazofijo); $i++)
        {
            $interes_ganado_plazofijo += $interes_plazofijo[$i]->interes_ganado + $this->interesDesdeUltMovimiento($interes_plazofijo[$i]->id);
        }

        return [
            "ahorros_activos" => $ahorros_activos,
            "ahorros_inactivos" => $ahorros_inactivos,
            "plazofijo_activos" => $plazofijo_activos,
            "plazofijo_inactivos" => $plazofijo_inactivos,
            "montos_ahorros" => number_format($montos_ahorros, 2, '.', ' '),
            "interes_ganado_ahorros" => number_format($interes_ganado_ahorros, 2, '.', ' '),
            "montos_plazofijo" => number_format($montos_plazofijo, 2, '.', ' '),
            "interes_ganado_plazofijo" => number_format($interes_ganado_plazofijo, 2, '.', ' ')
        ];
    }
}
