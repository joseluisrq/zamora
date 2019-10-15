<?php

namespace App\Http\Controllers;
use App\Simulador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimuladorController extends Controller
{
    //
    public function listaSilumaciones(Request $request){
       
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){ 
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
        ->orderBy('simulaciones.id', 'desc')->paginate(10);

        }else{
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
            ->where('simulaciones.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('simulaciones.id', 'desc')->paginate(10);
    
        }
       
        return [
            'pagination' => [
                'total'        => $simulaciones->total(),
                'current_page' => $simulaciones->currentPage(),
                'per_page'     => $simulaciones->perPage(),
                'last_page'    => $simulaciones->lastPage(),
                'from'         => $simulaciones->firstItem(),
                'to'           => $simulaciones->lastItem(),
            ],
            'simulaciones' => $simulaciones
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
    public function pdfDetallecredito(Request $request, $id)
    {
      $credito = Simulador::
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
        'simulaciones.nombresapellidos' )
        ->where('simulaciones.id','=',$id)->take(1)->get();

         

        $numerocredito=Simulador::select('id')
          ->where('id',$id)->get();

        
          $pdf= \PDF::loadView('pdf.proforma',[
              'credito'=>$credito]
             );
          return $pdf->download('Proforma-'.$numerocredito[0]->id.'.pdf');
      
  }
   
}
