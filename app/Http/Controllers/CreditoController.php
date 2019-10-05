<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Credito;
use App\Cuota;
use App\Persona;
use App\Socio;
use App\User;



class CreditoController extends Controller
{
    //LISTAR CREDITOS
    public function index(Request $request)
    {
      // if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $creditos = Credito::join('personas as socio','creditos.idsocio','=','socio.id')
            ->join('personas as user','creditos.idusuario','=','user.id')
            ->join('personas as garante','creditos.idgarante','=','garante.id')
            ->select(
                'creditos.id', 
                'creditos.numeroprestamo',                
                'creditos.montodesembolsado',
                'creditos.fechadesembolso',                  
                'creditos.numerocuotas',
                'creditos.tipocambio',
                'creditos.tasa',
                'creditos.estado',
                'creditos.periodo',

               
                'socio.dni as sociodni',
                'socio.nombre as socionombre',
                'socio.apellidos as socioapellido'
                )
            ->orderBy('creditos.id', 'desc')->paginate(10);
        }
        else{
            if($criterio=='dni'){
                $creditos = Credito::join('personas as socio','creditos.idsocio','=','socio.id')
                ->join('personas as user','creditos.idusuario','=','user.id')
                ->join('personas as garante','creditos.idgarante','=','garante.id')
                ->select(
                    'creditos.id', 
                    'creditos.numeroprestamo',                
                    'creditos.montodesembolsado',
                    'creditos.fechadesembolso',                  
                    'creditos.numerocuotas',
                    'creditos.tipocambio',
                    'creditos.tasa',
                    'creditos.estado',
                    'creditos.periodo',
    
                   
                    'socio.dni as sociodni',
                    'socio.nombre as socionombre',
                    'socio.apellidos as socioapellido'
                    )
                ->where('socio.dni', 'like', '%'. $buscar . '%')
                ->orderBy('creditos.id', 'desc')->paginate(10);

            }else{

                $creditos = Credito::join('personas as socio','creditos.idsocio','=','socio.id')
                ->join('personas as user','creditos.idusuario','=','user.id')
                ->join('personas as garante','creditos.idgarante','=','garante.id')
                ->select(
                    'creditos.id', 
                    'creditos.numeroprestamo',                
                    'creditos.montodesembolsado',
                    'creditos.fechadesembolso',                  
                    'creditos.numerocuotas',
                    'creditos.tipocambio',
                    'creditos.tasa',
                    'creditos.estado',
                    'creditos.periodo',
    
                   
                    'socio.dni as sociodni',
                    'socio.nombre as socionombre',
                    'socio.apellidos as socioapellido'
                    )
                ->where('creditos.'.$criterio, 'like', '%'. $buscar . '%')
                ->orderBy('creditos.id', 'desc')->paginate(10);
            }
           
        }
         
        return [
            'pagination' => [
                'total'        => $creditos->total(),
                'current_page' => $creditos->currentPage(),
                'per_page'     => $creditos->perPage(),
                'last_page'    => $creditos->lastPage(),
                'from'         => $creditos->firstItem(),
                'to'           => $creditos->lastItem(),
            ],
            'creditos' => $creditos
        ];
    }

    //Detalle de un credito recibe id
    public function detallecredito(Request $request){
        $id=$request->id;
        $detallecredito = Credito::join('personas as socio','creditos.idsocio','=','socio.id')
            ->join('personas as user','creditos.idusuario','=','user.id')
            ->join('personas as garante','creditos.idgarante','=','garante.id')
            ->select(
                'creditos.id', 
                'creditos.numeroprestamo',                
                'creditos.montodesembolsado',
                'creditos.fechadesembolso',                  
                'creditos.numerocuotas',
                'creditos.tipocambio',
                'creditos.tasa',
                'creditos.estado',
                'creditos.periodo',

               
                'socio.dni as sociodni',
                'socio.nombre as socionombre',
                'socio.apellidos as socioapellidos',
                'socio.fechanacimiento as sociofechanacimiento',
                'socio.direccion as sociodireccion',
                'socio.telefono as sociotelefono',
                'socio.email as socioemail',

               
                'user.nombre as usernombre',
                'user.apellidos as userapellidos'
                )
                ->where('creditos.id','=',$id)->take(1)->get();

        $cuotas = Cuota::join('personas as cajero','cuotas.idcajero','=','cajero.id')
                ->join('creditos','cuotas.idcredito','=','creditos.id')               
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

                    'cajero.nombre as nombre',
                    'cajero.apellidos as apellidos',      
                    )
                    ->where('creditos.id','=',$id)->get();
        return
        [
            'detallecredito'=>$detallecredito,
            'cuotas'=>$cuotas
        ];
    }


    //listar socio para agregar()
    public function selectCliente(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $clientes = Persona::join('socios','personas.id','=','socios.id')
        ->where('socios.estadocredito', '=', '0') //cliente sin credito cambiar a 0
        ->where('socios.estado', '=', '1') //cliente activo
        ->where('personas.dni', 'like', '%'. $filtro . '%')       
        ->select('personas.id','personas.dni',
        'personas.nombre','personas.apellidos',
        )->get();

        return ['clientes' => $clientes];
    }

    //guardar un credito
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();       
            $credito = new Credito();            
            $credito->idsocio = $request->idcliente;
            $credito->idgarante = $request->idcliente;
            $credito->idusuario = $request->idcliente;// \Auth::user()->id;
            $credito->numeroprestamo = $request->numeroprestamo;
           
            $credito->montodesembolsado = $request->montodesembolsado;
            $credito->fechadesembolso = $request->fechadesembolso; 
          
            $credito->numerocuotas = $request->numerocuotas; //cantidad de cuiotas
            $credito->tipocambio = 3.35; //de dolares a soles
            $credito->tasa = $request->tasa;
            $credito->estado = '1'; //Credito activo /2 credito inactivo //3 credito pagado completado
            $credito->periodo = $request->periodo; //1mensual/2bimensual/3trimestral/6semmestral/12anual
          
            $credito->save();

            $cuotas = $request->data;
 
            foreach($cuotas as $ep=>$cuot)
            {
                $cuota = new Cuota();
                $cuota->idcredito = $credito->id;                
                $cuota->numerodecuota = $cuot['contador'];
                $cuota->idcajero=$credito->idusuario;
                $cuota->fechapago = $cuot['fechapago'];               
                $cuota->saldopendiente =  $cuot['saldopendiente'];
                $cuota->monto = $cuot['monto'];
                $cuota->mora = 0;
                $cuota->descripcion ='Debe'; 
                $cuota->estado = '0';                              
                $cuota->save();
            }   
            
            $cliente = Socio::findOrFail($request->idcliente);
            $cliente->estadocredito = '1';
            $cliente->save();
         
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    
}
