<?php

namespace App\Http\Controllers;
use App\Simulador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimuladorController extends Controller
{
    //
    public function listaSilumaciones(){
        $simulaciones = Simulador::
        select(
            'simulaciones.id',           
            'simulaciones.montodesembolsado',
            'simulaciones.fechadesembolso',
            'simulaciones.fechaprimeracuota',                   
            'simulaciones.numerocuotas',
           
            'simulaciones.tasa',
            'simulaciones.estado',
            'simulaciones.periodo',

            'simulaciones.dni',
            'simulaciones.nombresapellidos',

            )
        ->where('simulaciones.estado', '=', '1')
        ->get();
       

        return[
            "simulaciones"=>$simulaciones
        ];
    }   
   
       //guardar un simulacion
       public function guardarSimulacion(Request $request)
       {
           if (!$request->ajax()) return redirect('/');
    
           try{
               DB::beginTransaction();       
               $simulacion = new Simulador();            

               
               $simulacion->montodesembolsado = $request->montodesembolsado;
               $simulacion->fechadesembolso = $request->fechadesembolso;
               $simulacion->fechaprimeracuota = $request->fechaprimeracuota;  
             
               $simulacion->numerocuotas = $request->numerocuotas;//cantidad de cuiota
               $simulacion->tasa = $request->tasa;
               $simulacion->estado = '1'; //simulacion activo /2 simulacion inactivo //3 simulacion pagado completado
               $simulacion->periodo = $request->periodo; //1mensual/2bimensual/3trimestral/6semmestral/12anual
             
               $simulacion->dni = $request->dni;
               $simulacion->nombresapellidos = $request->nombresapellidos;
               $simulacion->save();
               DB::commit();
               return ['idcredito' =>  $simulacion->id];
           } catch (Exception $e){
               DB::rollBack();
           }
       }
   
}
