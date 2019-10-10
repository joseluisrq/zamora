<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;

class CuotaController extends Controller
{
    //
    public function index(){
        $cuotas = Cuota::
            select(
                'cuotas.id')->get();
               
                return['cuotas'=>$cuotas];
    }
    //todas las cuotas sin pagar
    //falta paginacion
    public function cuotassinpagar(){
                $cuotas = Cuota::join('creditos','cuotas.idcredito','=','creditos.id')
                ->join('personas as socio','creditos.idsocio','=','socio.id')
                               
                ->select(
                    'cuotas.id', 
                    'cuotas.numerodecuota',                
                    'cuotas.fechapago',                  
                    'cuotas.fechacancelo',
                    'cuotas.monto',
                    'cuotas.saldopendiente',
                    'cuotas.mora',
                    'cuotas.descripcion',
                    'cuotas.estado',

                    'creditos.numeroprestamo',
                    
                    'socio.id as idsocio',
                    'socio.dni as dni',
                    'socio.nombre as nombre',
                    'socio.apellidos as apellidos',      
                    )->where('cuotas.estado','=','0')
                    ->orderby('fechapago','asc')
                    ->get();
            return
            ['cuotas'=>$cuotas
            ];
    }


    //detalle de la cuota a pagar
    public function detalleCuota(Request $request)
    {
      //  if (!$request->ajax()) return redirect('/');

           $id=$request->id;
            $cuotas = Cuota::join('creditos', 'creditos.id', '=', 'cuotas.idcredito')
            ->join('personas', 'personas.id', '=', 'creditos.idsocio')
            ->select(
                'creditos.id as idcredito',
                'creditos.numeroprestamo',
                'creditos.tipocambio',
               
                'creditos.tasa',
                'creditos.numerocuotas',
                'creditos.montodesembolsado',
                'creditos.periodo',

                'cuotas.id as id cuota',
                'cuotas.numerodecuota',
                'cuotas.fechacancelo',
                'cuotas.fechapago',
                'cuotas.monto',
                'cuotas.mora',
                'cuotas.saldopendiente',

                'personas.id as idpersona',
                'personas.nombre',
                'personas.apellidos',         
                'personas.dni'
            )
            ->where('personas.id', '=',$id)
            ->where('creditos.estado', '=', '1')//Buscar los créditos activos
            ->where('cuotas.estado', '=', '0')//Buscar las cuotas que faltan pagar
            ->orderby('fechapago', 'ASC')//Buscar las cuotas que faltan pagar
            ->limit(1)//Solo se obtiene la cuota que debe pagar
            ->get();
     
        return [
            'cuotas' => $cuotas,
           
        ];
    }
}
