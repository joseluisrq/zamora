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


        //CANTIDAD DE creditos
        $creditospormes=DB::table('creditos as c')
        ->select(
            DB::raw('MONTH(c.fechadesembolso) as mes'),
            DB::raw('YEAR(c.fechadesembolso) as ano'), 
            DB::raw('COUNT(*) as total'),         
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

        $creditoDes=DB::table('creditos as c')       
        ->where('c.estado','1')
        ->where('c.estadodesembolso','2')
        ->count();

        $creditoporDes=DB::table('creditos as c')       
        ->where('c.estado','1')
        ->where('c.estadodesembolso','1')//creditos aprobados 
       // ->orWhere('c.estadodesembolso','3')//desaprobado
        ->count();


        $totalcreditos=DB::table('creditos')    
       ->count();

       //CAJAS
       $totalcajas=DB::table('cajas as c')       
       ->count();

       $cajasabiertas=DB::table('cajas as c')
       ->where('c.estado','1')       
       ->count();


       //socios
       $sociosactivos=DB::table('socios')
       ->where('socios.estado','1')    
       ->count();

        //socios
        $sociosinactivos=DB::table('socios')
        ->where('socios.estado','0')    
        ->count();

        $sociosconcreditos=DB::table('socios')
        ->where('socios.estadocredito','1')    
        ->count();
        

        return [
            'desembolsos'=>$desembolsos,
            
            'creditospormes'=>$creditospormes,

            'enproceso'=>$enproceso,
            'rechazados'=>$rechazados,
            'terminados'=>$terminados,
            'totalcreditos'=>$totalcreditos,

            'creditoDes'=>$creditoDes,
            'creditoporDes'=>$creditoporDes,

            //cajas
            'totalcajas'=>$totalcajas,
            'cajasabiertas'=>$cajasabiertas,

            'sociosactivos'=>$sociosactivos,
            'sociosinactivos'=>$sociosinactivos,
            'sociosconcreditos'=>$sociosconcreditos,
           


            'ano'=>$ano
        ];
    }
}
