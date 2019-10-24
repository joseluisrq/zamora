<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        $ano=date('Y');

        //CANTIDAD DE DESEMBOLSOS POR MES
        $desembolsos=DB::table('creditos as c')
        ->select(
            DB::raw('MONTH(c.fechadesembolso) as mes'),
            DB::raw('YEAR(c.fechadesembolso) as ano'),
            DB::raw('SUM(c.montodesembolsado) as total'),
        )
        ->whereYear('c.fechadesembolso',$ano)
        ->groupBy(
            DB::raw('MONTH(c.fechadesembolso)'),
            DB::raw('YEAR(c.fechadesembolso)'))
        ->get();


        $enproceso=DB::table('creditos as c')       
        ->where('c.estado','1')
        ->count();

        $rechazados=DB::table('creditos as c')       
        ->where('c.estado','0')
        ->count();

        $terminados=DB::table('creditos as c')       
        ->where('c.estado','2')
        ->count();







        return [
            'desembolsos'=>$desembolsos,
            'enproceso'=>$enproceso,
            'rechazados'=>$rechazados,
            'terminados'=>$terminados,
            'ano'=>$ano
        ];
    }
}
