<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table='cuotas';
    protected $fillable=[
        'id',
        'idcajero',
        'idcredito',
        'numerodecuota',
        'fechapago',
        'interes',
        'amortizacion',
        'fechacancelo',
        'monto',
        'saldopendiente',
        'mora',
        'descripcion',
        'estado',
        'estado_mora'
    ];
    public function personas(){
        return  $this->belongsTo('App\Persona');
    }
}

