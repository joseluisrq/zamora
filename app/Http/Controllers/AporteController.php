<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\Caja;
use App\DetalleCaja;
use App\Empresa;
use App\Persona;
use App\Socio;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AporteController extends Controller
{
	public function index(Request $request)
    {
    	if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
        	$aportes = Aporte::join('personas', 'personas.id', '=', 'aportaciones.idsocio')
	    	->select(
                'aportaciones.id',
	    		'aportaciones.idsocio',
		        'aportaciones.idusuario',
		        'aportaciones.monto',
		        'aportaciones.fecharegistro',
		        'aportaciones.descripcion',
		        'aportaciones.tasa',
		        'aportaciones.estado',

		        'personas.dni',
                'personas.nombre',
                'personas.apellidos',

                DB::raw('(select usuario from users where users.id = aportaciones.idusuario) as usuario')
	    	)
	    	->orderBy('aportaciones.id', 'desc')
	    	->paginate(15);
        }
        else{
        	$tabla = ($criterio == 'fecharegistro') ? 'aportaciones': 'personas';

        	$aportes = Aporte::join('personas', 'personas.id', '=', 'aportaciones.idsocio')
	    	->select(
                'aportaciones.id',
	    		'aportaciones.idsocio',
		        'aportaciones.idusuario',
		        'aportaciones.monto',
		        'aportaciones.fecharegistro',
		        'aportaciones.descripcion',
		        'aportaciones.tasa',
		        'aportaciones.estado',

		        'personas.dni',
                'personas.nombre',
                'personas.apellidos',

                DB::raw('(select usuario from users where users.id = aportaciones.idusuario) as usuario')
	    	)
	    	->where($tabla.'.'.$criterio, 'like', '%'. $buscar . '%')
	    	->orderBy('aportaciones.id', 'desc')
	    	->paginate(15);
        }

        return [
            'pagination' => [
                'total'        => $aportes->total(),
                'current_page' => $aportes->currentPage(),
                'per_page'     => $aportes->perPage(),
                'last_page'    => $aportes->lastPage(),
                'from'         => $aportes->firstItem(),
                'to'           => $aportes->lastItem(),
            ],
            'aportes' => $aportes
        ];
    }

    public function selectSocio(Request $request)
    {
    	$filtro = $request->filtro;
        $socios = Persona::join('socios','personas.id','=','socios.id')
        ->select(
            'personas.id',
            'personas.dni',
            'personas.nombre',
            'personas.apellidos'
        )
        ->where('socios.estado', '=', '1') //cliente activo
        ->where('personas.dni', 'like', '%'. $filtro . '%')
        ->get();

        return ['socios' => $socios];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $min_aporte = Empresa::get()[0]->monto_min_aporte;

        $request->validate([
            'idsocio' => 'required',
            'dni' => 'required|size:8',
            'monto' => 'required|numeric|min:'.$min_aporte,
            'descripcion' => 'required'
        ],
        [
            'idsocio.required' => 'Problema con el ID de socio',
            'dni.required' => 'Seleccione un DNI de socio',
            'dni.size' => 'El DNI debe tener 8 números',
            'monto.required' => 'Ingrese un monto',
            'monto.min' => 'El monto mínimo de aporte es S/ '.$min_aporte,
            'descripcion.required' => 'Ingrese una descripción'  
        ]);
 
        try{
			DB::beginTransaction();

            $tasa = Empresa::select('tasa_aportes')
            ->get()[0]->tasa_aportes;

            $idsocio = $request->idsocio;

            $socio = Socio::findOrFail($idsocio);
            $socio->interes_aportaciones += $this->interesDesdeUltAporte($idsocio);
            $socio->save();

			$aporte = new Aporte();
            $aporte->idsocio = $idsocio;
            $aporte->idusuario = \Auth::user()->id;
            $aporte->monto = $request->monto;
            $aporte->fecharegistro = Carbon::now('America/Lima');
            $aporte->descripcion = $request->descripcion; //cantidad de cuotas
            $aporte->tasa = $tasa;
            $aporte->tipooperacion = 1;
            $aporte->estado = '1';
            $aporte->save();

            $idcaja = Caja::where([
                ['idusuario', '=', \Auth::user()->id],
                ['estado', '=', 1]
            ])
            ->orderBy('id', 'desc')
            ->get()[0]->id;

            $detallecaja = new DetalleCaja();
            $detallecaja->idcaja = $idcaja;
            $detallecaja->idmovimiento = $aporte->id;
            $detallecaja->tipo = 1;//SE TRATA DE MOVIMIENTOS
            $detallecaja->estado = 1;//ENTRA DINERO A LA CAJA, SE RELIZA UN APORTE
            $detallecaja->fecha = Carbon::now('America/Lima');
            $detallecaja->monto = $request->monto;
            $detallecaja->save();

			DB::commit();

            return ["idaporte" => $aporte->id];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function cobrarInteresAportes(Request $request)// MOVIMIENTOS PARA COBRO DE APORTES
    {
        if (!$request->ajax()) return redirect('/');

        $idsocio = $request->idsocio;

        $socio = Socio::findOrFail($idsocio);

        $interes_ganado = $this->interesDesdeUltAporte($idsocio);
        $interes_disponible = $socio->interes_aportaciones + $interes_ganado;

        // MONTO MÍNIMO DE RETIRO DE INTERÉS DE APORTES
        $min_interes = Empresa::get()[0]->monto_min_interes_aporte;
        $min_interes = number_format($min_interes, 2,'.','');

        $max_interes = $interes_disponible;
        $max_interes = number_format($max_interes, 2,'.','');

        $request->validate([
            'monto_retiro' => 'required|numeric|min:'.$min_interes.'|max:'.$max_interes
        ], 
        [
            'monto_retiro.required' => 'Ingrese un monto',
            'monto_retiro.min' => 'El monto mínimo de retiro es S/ '.$min_interes,
            'monto_retiro.max' => 'Usted dispone de S/ '.$max_interes
        ]);

        try{
            DB::beginTransaction();

            $monto = $request->monto_retiro;

            $aporte = new Aporte();
            $aporte->idsocio = $idsocio;
            $aporte->idusuario = \Auth::user()->id;
            $aporte->monto = $monto;
            $aporte->fecharegistro = Carbon::now('America/Lima');
            $aporte->descripcion = 'COBRO INTERÉS';
            $aporte->tasa = 0;
            $aporte->tipooperacion = 0;
            $aporte->estado = 1;
            $aporte->save();

            $socio->interes_aportaciones = number_format(($interes_disponible - $monto), 2, '.', '');
            $socio->save();

            $idcaja = Caja::where([
                ['idusuario', '=', \Auth::user()->id],
                ['estado', '=', 1]
            ])
            ->orderBy('id', 'desc')
            ->get()[0]->id;

            $detallecaja = new DetalleCaja();
            $detallecaja->idcaja = $idcaja;
            $detallecaja->idmovimiento = $aporte->id;
            $detallecaja->tipo = 1;//SE TRATA DE APORTES
            $detallecaja->estado = 0;//SALE DINERO DE LA CAJA, SE COBRA INTERESES
            $detallecaja->fecha = Carbon::now('America/Lima');
            $detallecaja->monto = $monto;
            $detallecaja->save();

            DB::commit();

            return ["id" => $aporte->id];
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
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

    // DESCARGAR BOUCHER PDF
	public function pdfDetalleAporte(Request $request)//, $id
	{
        $id = $request->id;

		$aporte = Aporte::join('personas', 'personas.id', '=', 'aportaciones.idsocio')
	    	->select(
		        'aportaciones.monto',
		        'aportaciones.fecharegistro',
		        'aportaciones.descripcion',
		        'aportaciones.tipooperacion',
                'aportaciones.tasa',

                'personas.nombre',
                'personas.apellidos',
	            'personas.dni',
	            'personas.direccion',

                DB::raw('(select usuario from users where users.id = aportaciones.idusuario) as usuario')
	    	)
	    	->where('aportaciones.id', '=', $id)
	    	->orderBy('aportaciones.id', 'desc')
	    	->get()[0];

		$pdf= \PDF::loadView('pdf.detalleaporte',['aporte'=>$aporte]);
		return $pdf->download('Aporte-'.$id.'.pdf');
    }
}
