<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuota;

class CuotaController extends Controller
{
    //
    public function index(){
        $cuotas = Cuota::
            select(
                'cuotas.id')->get();
               
                return['cuotas'=>$cuotas];
    }
}
