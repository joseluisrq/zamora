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
	//	if (!$request->ajax()) return redirect('/');

        $mytime= Carbon::now('America/Lima');
        $mytime = $mytime->format('Y-m-d');

		$config = Empresa::select(         
            //TEA, Tasa efectiva anual
            'empresa.id',
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
            'empresa.tasa_moratoria_anual',
        )
        ->orderBy('empresa.id', 'desc')->take(1)->get()[0];
         
        return [ 'config' => $config ,
    'hoy'=>$mytime];
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
   
}
