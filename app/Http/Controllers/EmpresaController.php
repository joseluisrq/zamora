<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

        $mytime= Carbon::now('America/Lima');
        $mytime = $mytime->format('Y-m-d');

		$config = Empresa::select(
            //pra evaluar(se quitaran)
            'empresa.mora',
            'empresa.interes',
            'empresa.abonosocio',
            
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
            'empresa.tasa_ahorroplazo_361',
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

	}
}
