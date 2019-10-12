<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->ajax()) return redirect('/');

		$config = Empresa::select(
            'empresa.mora',
            'empresa.interes',
            'empresa.abonosocio',
            'empresa.tasa_ahorros',
            'empresa.tasa_creditos',
            'empresa.tasa_aportes'
        )
        ->orderBy('empresa.id', 'desc')->take(1)->get()[0];
         
        return [ 'config' => $config ];
	}

	public function update(Request $request)
	{

	}
}
