<?php

namespace App\Http\Controllers;
use App\User;
use App\Caja;
use App\DetalleCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CajaController extends Controller
{
    //
    public function seleccionarCaja(){
        $user=\Auth::user()->id;
        $caja=Caja::
         select('cajas.id','cajas.idusuario')
        ->where('cajas.estado','=',1)
        ->where('cajas.idusuario','=',$user)
        ->orderBy('cajas.id', 'DESC')
        ->take(1)
        ->get();

        return [
            'caja'=>$caja,
             'user'=>$user

        ];
    }
    public function MovimientosCaja(Request $request){
        $idcaja=$request->id;
        $detallecaja=DetalleCaja::join('cajas','detallecaja.idcaja','cajas.id')
         ->select(
             'detallecaja.monto',
             'detallecaja.idmovimiento',
             'detallecaja.fecha',
             'detallecaja.tipo',
             'detallecaja.estado'
             )
        ->where('cajas.id','=',$idcaja)
        ->where('cajas.estado','=',1)
        ->orderBy('detallecaja.iddetalle', 'DESC')
        ->get();

        $datoscaja=Caja::
        select(
            'cajas.id',
             'cajas.idusuario',
             'cajas.montoinicial',
             'cajas.fechaapertura',
             'cajas.montorecaudado',
        )   
        ->where('cajas.id','=',$idcaja)
       ->orderBy('cajas.id', 'DESC')
       ->take(1)
       ->get();

        return [
            'detallecaja'=>$detallecaja, 
            'datoscaja'=>$datoscaja, 
        ];
    }
    public function CajasAperturadas(){
   
        $cajas=Caja::join('personas','cajas.idusuario','personas.id')
        ->select('cajas.id','cajas.idusuario','personas.nombre',
        'personas.apellidos')
        ->where('cajas.estado','=',1)
        ->get();

        return [
            'cajas'=>$cajas,
        ];
    }
    public function abrirCaja(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
      
        try{
        DB::beginTransaction();
        $caja=new Caja();
        $caja->idusuario = \Auth::user()->id;
        $caja->montoinicial = $request->montoinicial;
        $caja->fechaapertura = $mytime;
        $caja->fechacierre = null;
        $caja->montorecaudado = 0;
        $caja->estado =1;
        $caja->save();
        DB::commit();

       // return ['idcredito' =>  $simulacion->id];
         }
         catch (Exception $e){
            DB::rollBack();
         }
    }
    public function CerrarCaja(Request $request){

        $mytime= Carbon::now('America/Lima');

        $caja = Caja::findOrFail($request->id);         
        $caja->fechacierre = $mytime;       
        $caja->montorecaudado = $request->montorecaudado;
        $caja->estado =0;
        $caja->save();
       
       
    }
    public function ActualizarMontoIncial(Request $request){

        $mytime= Carbon::now('America/Lima');

        $caja = Caja::findOrFail($request->id);         
        $caja->montoinicial =$request->montoinicial; 
        $caja->save();
       
       
    }
}
