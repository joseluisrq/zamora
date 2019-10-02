<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Credito;
use App\Cuota;
use App\User;
use App\Socio;


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
}
