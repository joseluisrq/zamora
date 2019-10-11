<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulador extends Model
{
    //
    protected $table='simulaciones';
    protected $fillable =[
      
        'montodesembolsado',
        'fechadesembolso',
        'fechaprimeracuota',      
        'numerocuotas',
        'tipocambio',
        'tasa',
        'estado',
        'periodo','dni','nombresapellidos'
    ];
}
