<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\Empresa;
use App\Persona;
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

        $request->validate([
            'idsocio' => 'required',
            'dni' => 'required|size:8',
            'monto' => 'required',
            'descripcion' => 'required'
        ],
        [
            'idsocio.required' => 'Problema con el ID de socio',
            'dni.required' => 'Seleccione un DNI de socio',
            'dni.size' => 'El DNI debe tener 8 números',
            'monto.required' => 'Ingrese un monto',
            'descripcion.required' => 'Ingrese una descripción'  
        ]);
 
        try{
			DB::beginTransaction();

            $tasa = Empresa::select('tasa_aportes')
            ->orderBy('empresa.id', 'desc')
            ->take(1)
            ->get()[0]->tasa_aportes;

			$aporte = new Aporte();
            $aporte->idsocio = $request->idsocio;
            $aporte->idusuario = \Auth::user()->id;
           
            $aporte->monto = $request->monto;
            $aporte->fecharegistro = Carbon::now('America/Lima');
          
            $aporte->descripcion = $request->descripcion; //cantidad de cuiotas
            $aporte->tasa = $tasa;
            $aporte->estado = '1';
          
            $aporte->save();

			DB::commit();

            return ["idaporte" => $aporte->id];
        } catch (Exception $e){
            DB::rollBack();
        }
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
		        'aportaciones.tasa',

                'personas.nombre',
                'personas.apellidos',
	            'personas.dni',
	            'personas.direccion',

                DB::raw('(select usuario from users where users.id = aportaciones.idusuario) as usuario')
	    	)
	    	->where('aportaciones.id', '=', $id)
	    	->orderBy('aportaciones.id', 'desc')
	    	->take(1)
	    	->get();

		$pdf= \PDF::loadView('pdf.detalleaporte',['aporte'=>$aporte]);
		return $pdf->download('Aporte-'.$id.'.pdf');
    }
}
