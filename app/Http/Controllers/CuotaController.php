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
}
