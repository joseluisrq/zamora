<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;
use App\Credito;
use App\Persona;
use App\Socio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function cuotassinpagar(Request $request){

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){ 

                $cuotas = Cuota::join('creditos','cuotas.idcredito','=','creditos.id')
                ->join('personas as socio','creditos.idsocio','=','socio.id')
                               
                ->select(
                    'cuotas.id', 
                    'cuotas.numerodecuota',                
                    'cuotas.fechapago',                  
                    'cuotas.fechacancelo',
                    'cuotas.monto',
                    'cuotas.interes',
                    'cuotas.amortizacion',
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
                    ->where('creditos.estado', '=', '1')
                    ->where('creditos.estadodesembolso','=','2')
                    ->orderby('fechapago','asc')->paginate(10);
                    

        }
        
        else{ 

            $cuotas = Cuota::join('creditos','cuotas.idcredito','=','creditos.id')
            ->join('personas as socio','creditos.idsocio','=','socio.id')
                           
            ->select(
                'cuotas.id', 
                'cuotas.numerodecuota',                
                'cuotas.fechapago',                  
                'cuotas.fechacancelo',
                'cuotas.monto',
                'cuotas.interes',
                'cuotas.amortizacion',
                'cuotas.saldopendiente',
                'cuotas.mora',
                'cuotas.descripcion',
                'cuotas.estado',

                'creditos.numeroprestamo',
                
                'socio.id as idsocio',
                'socio.dni as dni',
                'socio.nombre as nombre',
                'socio.apellidos as apellidos',      
                )
                ->where('creditos.estado', '=', '1')
                ->where('cuotas.estado','=','0')
                ->where('creditos.estadodesembolso','=','2')
                ->where('socio.'.$criterio, 'like', '%'. $buscar . '%')
                ->orderby('fechapago','asc')->paginate(10);
              

    }
    return [
        'pagination' => [
            'total'        => $cuotas->total(),
            'current_page' => $cuotas->currentPage(),
            'per_page'     => $cuotas->perPage(),
            'last_page'    => $cuotas->lastPage(),
            'from'         => $cuotas->firstItem(),
            'to'           => $cuotas->lastItem(),
        ],
        'cuotas'=>$cuotas
            ];
    }


        public function notificacion(Request $request){       
          

        $mytime= Carbon::now('America/Lima');
        $mytime = $mytime->format('Y-m-d');

            $cuotas = Cuota::join('creditos','cuotas.idcredito','=','creditos.id')
            ->join('personas as socio','creditos.idsocio','=','socio.id')
                        
            ->select(
                'cuotas.id', 
                'cuotas.numerodecuota',                
                'cuotas.fechapago', 
                'cuotas.estado',

                'creditos.numeroprestamo',
                
                'socio.id as idsocio',
                'socio.dni as dni',
                'socio.nombre as nombre',
                'socio.apellidos as apellidos',      
                )->where('cuotas.estado','=','0')
                ->where('creditos.estado', '=', '1')
                ->where('creditos.estadodesembolso','=','2')
                ->where('fechapago','<',$mytime)->get();


                $creditosporaprobar = Credito::join('personas as socio','creditos.idsocio','=','socio.id')                            
                ->select(
                       
                    'creditos.numeroprestamo',
                    
                    'socio.id as idsocio',
                    'socio.dni as dni',
                    'socio.nombre as nombre',
                    'socio.apellidos as apellidos')    
               
                    ->where('creditos.estado', '=', '1')
                    ->where('creditos.estadodesembolso','=','0') ->get();


                $creditospordesembolsar = Credito::join('personas as socio','creditos.idsocio','=','socio.id')                            
                ->select(
                        
                    'creditos.numeroprestamo',
                    
                    'socio.id as idsocio',
                    'socio.dni as dni',
                    'socio.nombre as nombre',
                    'socio.apellidos as apellidos')    
                
                    ->where('creditos.estado', '=', '1')
                    ->where('creditos.estadodesembolso','=','1') ->get();
          
       
        return [          
            'cuotas'=>$cuotas,
            'creditosporaprobar'=> $creditosporaprobar,
            'creditospordesembolsar'=> $creditospordesembolsar
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

                'cuotas.id as idcuota',
                'cuotas.numerodecuota',
                'cuotas.fechacancelo',
                'cuotas.fechapago',
                'cuotas.monto',
                'cuotas.interes',
                'cuotas.amortizacion',
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

    //selecionar socios con cuotas pendientes
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
        ->where('socios.estado', '=', '1') //socio activo
        ->where('socios.estadocredito', '=', '1') //socio con credito activo
        ->where('personas.dni', 'like', '%'. $filtro . '%')
        ->get();

        return ['socios' => $socios];
    }

    public function pagarCuota(Request $request)
    {        
       if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
            $cuota = Cuota::findOrFail($request->id);
            $cuota->descripcion ="Pago"; 
                 
            $cuota->mora =$request->mora;
            $cuota->fechacancelo = Carbon::now('America/Lima');
            $cuota->estado ='1';
            $cuota->tipopago=1;
            $cuota->transaccion='0';
            $cuota->pagodeposito = 0;
            $cuota->estado_mora = '1';
            $cuota->idcajero = \Auth::user()->id;; //cambiar por usuario
           $cuota->save();

           $idcredito = $cuota->idcredito;
            //Verificar que todas las cuotas del crédito se hayan pagado
            $cuotas = Cuota::join(
                'creditos', 'cuotas.idcredito', '=', 'creditos.id')
            ->select(
                'cuotas.id'
            )
            ->where('cuotas.estado', '=', '0')
            ->where('creditos.id', '=', $idcredito)
            ->get();

            if(sizeof($cuotas) == 0){//En este caso ya se pagaron todas las cuotas
                $credito = Credito::findOrFail($idcredito);
                $credito->estado = "2";//Crédito finalizado
                $credito->save();

                $idsocio = $request->idsocio;
                $cliente = Socio::findOrFail($idsocio);
                $cliente->estadocredito = "2";//Crédito finalizado
                $cliente->save();
            }

      
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
      
    }
    public function pagarCuotaDeposito(Request $request)
    {        
       if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
            $cuota = Cuota::findOrFail($request->id);
            $cuota->descripcion ="Pago"; 
                 
            $cuota->mora =$request->mora;
            $cuota->fechacancelo = Carbon::now('America/Lima');
            $cuota->fechadeposito = $request->fechapagodeposito;
            $cuota->transaccion = $request->transacciondeposito;
            $cuota->pagodeposito = $request->montodeposito;
            $cuota->estado ='1';
            $cuota->estado_mora = '1';
            $cuota->tipopago=2;
            $cuota->idcajero = \Auth::user()->id; //cambiar por usuario
           $cuota->save();

           $idcredito = $cuota->idcredito;
            //Verificar que todas las cuotas del crédito se hayan pagado
            $cuotas = Cuota::join(
                'creditos', 'cuotas.idcredito', '=', 'creditos.id')
            ->select(
                'cuotas.id'
            )
            ->where('cuotas.estado', '=', '0')
            ->where('creditos.id', '=', $idcredito)
            ->get();

            if(sizeof($cuotas) == 0){//En este caso ya se pagaron todas las cuotas
                $credito = Credito::findOrFail($idcredito);
                $credito->estado = "2";//Crédito finalizado
                $credito->save();

                $idsocio = $request->idsocio;
                $cliente = Socio::findOrFail($idsocio);
                $cliente->estadocredito = "2";//Crédito finalizado
                $cliente->save();
            }

      
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
      
    }
    public function pdfDetalleCuota(Request $request, $id){
        $cuotas = Cuota::join('creditos','cuotas.idcredito','=','creditos.id')
        -> join('personas as socio','creditos.idsocio','=','socio.id')
        ->join('personas as cajero','cuotas.idcajero','=','cajero.id')
      
        ->select(
            'creditos.id', 
            'creditos.numeroprestamo',           
             'creditos.montodesembolsado',
            'creditos.fechadesembolso',
            'creditos.numerocuotas',         
            'creditos.tasa',
            'creditos.estado',
            'creditos.periodo',

            'cuotas.id',
            'cuotas.numerodecuota',
            'cuotas.fechapago',
            'cuotas.fechacancelo',            
            'cuotas.saldopendiente',
            'cuotas.monto',
            'cuotas.interes',
            'cuotas.amortizacion',
            'cuotas.mora',
            'cuotas.estado_mora',
            'cuotas.descripcion',
            'cuotas.estado',

            'cuotas.transaccion',
            'cuotas.pagodeposito',
            'cuotas.fechadeposito',
            'cuotas.tipopago',


            'socio.nombre as socionombre',
            'socio.dni as sociodni',
            'socio.apellidos as socioapellidos',

            'cajero.nombre as cajeronombre',
            'cajero.dni as cajerodni',
            'cajero.apellidos as cajeroapellidos',
           )
        ->where('cuotas.id','=',$id)->take(1)->get();
            
       

            $numerocredito=Cuota::select('numerodecuota')
            ->where('id',$id)->get();

            $pdf= \PDF::loadView('pdf.detallecuota',[
                'cuotas'=>$cuotas]);
            return $pdf->download('Cuota-'.$cuotas[0]->numeroprestamo.'-'.$numerocredito[0]->numerodecuota.'.pdf');
        
    }

}
