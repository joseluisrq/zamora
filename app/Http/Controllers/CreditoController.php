<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\DetalleCaja;
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
                'creditos.interes',
                'creditos.estadodesembolso',

               
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
                    'creditos.interes',
                    'creditos.estadodesembolso',
    
                   
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
                    'creditos.interes',
                    'creditos.estadodesembolso',
    
                   
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

    public function ultimocredito(Request $request){
        
        $ultimo=Credito::select(
        'creditos.id')
        ->orderBy('creditos.id', 'desc')
        ->take(1)->get();
      

        return[
            'idultimocredito'=> $ultimo
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
                'creditos.interes',
                'creditos.estadodesembolso',

                'socio.id as idsocio',
                'socio.dni as sociodni',
                'socio.nombre as socionombre',
                'socio.apellidos as socioapellidos',
                'socio.fechanacimiento as sociofechanacimiento',
                'socio.direccion as sociodireccion',
                'socio.telefono as sociotelefono',
                'socio.email as socioemail',
                
                'garante.id as idgarante',
                'garante.dni as garantedni',
                'garante.nombre as garantenombre',
                'garante.apellidos as garanteapellidos',
                'garante.fechanacimiento as garantefechanacimiento',
                'garante.direccion as garantedireccion',
                'garante.telefono as garantetelefono',
                'garante.email as garanteemail',

               
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
                    'cuotas.interes',
                    'cuotas.amortizacion',
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

        $mytime= Carbon::now('America/Lima');
        $mytime = $mytime->format('Y-m-d');
        $idgarante=0;

        $estadogarante= $request->garanteestado;
        try{
            DB::beginTransaction(); 
            if($estadogarante==1){
                $dni = $request->dnig;
                    $personaregistrada = Persona::
                    where('personas.dni', '=', $dni)->exists();//BUSCAMOS SI EXISTE EL DNI QUE INTENTA INGRESAR
                   if($personaregistrada==true) 
                   {
                    $per = Persona::
                    select('personas.id as id')
                   ->where('personas.dni', '=', $dni)->first();
                    $idgarante=$per->id;
                   }
                   else{
                    $garante=new Persona();
                    $garante->dni = $request->dnig;
                    $garante->nombre = $request->nombreg;
                    $garante->apellidos = $request->apellidosg;
                    $garante->fechanacimiento = $request->fechanacimientog;
                    $garante->direccion = $request->direcciong;
                    $garante->departamento = $request->departamentog;
                    $garante->ciudad = $request->ciudadg;
                    $garante->telefono = $request->telefonog;
                    $garante->email = $request->emailg;
                    $garante->save();

                    $idgarante=$garante->id;
                   }
              
               
            }
            


            $credito = new Credito();            
            $credito->idsocio = $request->idcliente;
            //si existe garante registra a la personas caso contrario el es su garante
            if($estadogarante==1)$credito->idgarante = $idgarante;
            else $credito->idgarante = $request->idcliente;

            $credito->idusuario = \Auth::user()->id;
            $credito->numeroprestamo = $request->numeroprestamo;           
            $credito->montodesembolsado = $request->montodesembolsado;
            $credito->fechadesembolso = $mytime;           
            $credito->numerocuotas = $request->numerocuotas; //cantidad de cuiotas
            $credito->tipocambio = 3.35; //de dolares a soles
            $credito->tasa = $request->tasa;
            $credito->interes = $request->interes;
            $credito->estado = '1'; 
            $credito->estadodesembolso = '0';
            $credito->periodo = $request->periodo; //1mensual/2bimensual/3trimestral/6semmestral/12anual
          
            $credito->save();

            $cuotas = $request->data;
 
            foreach($cuotas as $ep=>$cuot)
            {
                $cuota = new Cuota();
                $cuota->idcredito = $credito->id;                
                $cuota->numerodecuota = $cuot['contador'];
                $cuota->idcajero=\Auth::user()->id; //cambiar a usuario  
                $cuota->fechapago = $cuot['fechapago'];            
                $cuota->saldopendiente =  $cuot['saldopendiente'];
                $cuota->monto = $cuot['monto'];
                $cuota->interes=$cuot['interes'];
                $cuota->amortizacion=$cuot['amortizacion'];
                $cuota->mora = 0;
                $cuota->descripcion ='Debe'; 
                $cuota->estado = '0';                              
                $cuota->save();
            }   
            
            $cliente = Socio::findOrFail($request->idcliente);
            $cliente->estadocredito = '1';
            $cliente->save();
         
            DB::commit();
            return ['idcredito' =>  $credito->id];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    //DESEMBOLSAR CREDITO
    public function desembolsar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
     

        $cuota = Credito::findOrFail($request->id);
        $cuota->estadodesembolso = '2';      
        $cuota->save();
        try{
            DB::beginTransaction();
            $mytime= Carbon::now('America/Lima');
            $caja=new DetalleCaja();
            $caja->idcaja =$request->caja; 
            $caja->idmovimiento = $request->id;
            $caja->tipo = 4;
            $caja->estado = 0;
            $caja->monto = $request->montodesembolsado;
            $caja->fecha =  $mytime;           
            $caja->save();
            DB::commit();
        }
        catch (Exception $e){
            DB::rollBack();
        }

    }

      //aprobar CREDITO
      public function aprobar(Request $request)
      {
          if (!$request->ajax()) return redirect('/');
       
  
          $cuota = Credito::findOrFail($request->id);
          $cuota->estadodesembolso = '1';      
          $cuota->save();
      }
          //aprobar DESAPROBAR
        public function desaprobar(Request $request)
        {
            if (!$request->ajax()) return redirect('/');
        
    
            $credito = Credito::findOrFail($request->id);
            $credito->estadodesembolso = '3'; 
            $credito->estado = '0';           
            $credito->save();


            $idsocio=$credito->idsocio;
            
            $cliente = Socio::findOrFail($idsocio);
            $cliente->estadocredito = '0';
            $cliente->save();
          }


    //pdf contrato y cronograma decuiotas
   
      public function pdfDetallecredito(Request $request, $id)
      {
        $credito = Credito::join('personas as socio','creditos.idsocio','=','socio.id')       
        ->join('personas as usuario','creditos.idusuario','=','usuario.id')
        ->select(
            'creditos.id', 
            'creditos.numeroprestamo',           
            'creditos.montodesembolsado',
            'creditos.fechadesembolso',
            'creditos.numerocuotas',
            'creditos.tipocambio',
            'creditos.tasa',
            'creditos.estado',
            'creditos.interes as credinteres',
            'creditos.periodo',

            'socio.nombre',
            'socio.dni',
            'socio.direccion',
            'socio.telefono',
            'socio.email',
            'socio.apellidos',
            
            'usuario.nombre as usuario')
            ->where('creditos.id','=',$id)->take(1)->get();

            $cuotas = Cuota::
            select(
                'cuotas.numerodecuota',
                'cuotas.fechapago',
                'cuotas.fechacancelo',
                'cuotas.saldopendiente',
                'cuotas.monto',
                'cuotas.interes',
                'cuotas.amortizacion',
                'cuotas.mora',
                'cuotas.descripcion',
                'cuotas.estado')
            ->where('cuotas.idcredito','=',$id)
            ->orderBy('cuotas.id', 'asc')->get();

          /*  return[
                "credito"=>$credito,
                "cuotas"=>$cuotas
            ];*/

          $numerocredito=Credito::select('numeroprestamo')
            ->where('id',$id)->get();

          
            $pdf= \PDF::loadView('pdf.detallecredito',[
                'credito'=>$credito,
                'cuotas'=>$cuotas]);
            return $pdf->download('Credito-'.$numerocredito[0]->numeroprestamo.'.pdf');
        
    }

    
}
