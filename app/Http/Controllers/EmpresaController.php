<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        $mytime= Carbon::now('America/Lima');
        $mytime = $mytime->format('Y-m-d');

		$config = Empresa::select(
            //pra evaluar(se quitaran)
            'empresa.id',
         //   'empresa.mora',
        //    'empresa.interes',
        //    'empresa.abonosocio',
            
            //TEA, Tasa efectiva anual
            'empresa.tasa_creditos',

            //tasa de cuenta corriente
            'empresa.tasa_ahorros',
            'empresa.tasa_ahorros_comisiones',
            'empresa.tasa_ahorros_gastos',

            //tasadecuetnas aplazo fijo
            'empresa.tasa_ahorroplazo_30',
            'empresa.tasa_ahorroplazo_90',
            'empresa.tasa_ahorroplazo_180',
            'empresa.tasa_ahorroplazo_360',
            'empresa.tasa_ahorroplazo_361',

            //tasa de aportes
            'empresa.tasa_aportes',

            //calculo de mora
            'empresa.tasa_compensatoria_anual',
            'empresa.tasa_moratoria_anual'
        )
        ->orderBy('empresa.id', 'desc')->take(1)->get()[0];
         
        return [ 'config' => $config ,
    'hoy'=>$mytime];
	}

    public function tasaCrearCuenta0(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo = $request->tipo;

        $campo = 'tasa_';

        if($tipo == 1) {//ES UNA CUENTA DE AHORROS
            $campo .= 'ahorros';
        }
        else {
            $campo .= 'ahorroplazo_' . $request->tiempo;   
        }

        $tasa = Empresa::select(['empresa.'.$campo])
        ->orderBy('empresa.id', 'desc')->take(1)->get()[0]->$campo;
         
        return ['tasa' => $tasa];

    }    

	public function update(Request $request)
	{

        if (!$request->ajax()) return redirect('/');
     
        try{

            $empresa = Empresa::findOrFail($request->id);
            $empresa->tasa_creditos=$request->tasa_creditos;
            $empresa->tasa_compensatoria_anual=$request->tasa_compensatoria_anual;
            $empresa->tasa_moratoria_anual=$request->tasa_moratoria_anual;
            $empresa->tasa_ahorros=$request->tasa_ahorros;
            $empresa->tasa_ahorros_comisiones=$request->tasa_ahorros_comisiones;
            $empresa->tasa_ahorros_gastos=$request->tasa_ahorros_gastos;
            $empresa->tasa_aportes=$request->tasa_aportes;

            $empresa->tasa_ahorroplazo_30=$request->tasa_ahorroplazo_30;
            $empresa->tasa_ahorroplazo_90=$request->tasa_ahorroplazo_90;
            $empresa->tasa_ahorroplazo_180=$request->tasa_ahorroplazo_180;
            $empresa->tasa_ahorroplazo_360=$request->tasa_ahorroplazo_360;
            $empresa->tasa_ahorroplazo_361=$request->tasa_ahorroplazo_361;
            



            
        $empresa->save();
             DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function tasaCrearCuenta(Request $request)//Devuelve la tasa y monto mínimo para crear lacuenta
   
 {
        if (!$request->ajax()) return redirect('/');

    
    $tipo = $request->tipo;

        $campo_tasa = 'tasa_';
        $campo_monto_min = 'monto_min_';

     
   if($tipo == 1) {//ES UNA CUENTA DE AHORROS
            $campo_tasa .= 'ahorros';
       
     $campo_monto_min .= 'ahorros';
        }
        else {
            $campo_tasa .= 'ahorroplazo_' . $request->tiempo;
       
     $campo_monto_min .= $request->tiempo;
        }

        $datos_empresa = Empresa::select(['empresa.'.$campo_tasa, 'empresa.'.$campo_monto_min])
   
     ->orderBy('empresa.id', 'desc')->take(1)->get()[0];

        $tasa = $datos_empresa->$campo_tasa;
        $monto_min = $datos_empresa->$campo_monto_min;
       
  
        return ["tasa" => $tasa, "monto_min" => $monto_min];
    }

    public function tasaAportes(Request $request)//Devuelve la tasa de aportes
   
 {
        if (!$request->ajax()) return redirect('/');

        $tasa = Empresa::select('empresa.tasa_aportes')
   
     ->orderBy('empresa.id', 'desc')->take(1)->get()[0]->tasa_aportes;
         
        return ["tasa" => $tasa];
    }





}
