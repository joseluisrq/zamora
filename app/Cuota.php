<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table='cuotas';
    protected $fillable=[
        'id','numerodecuota','fechapago','interes','amortizacion',
        'fechacancelo','monto','saldopendiente',
        'mora','descripcion','estado'
    ];
    public function personas(){
        return  $this->belongsTo('App\Persona');
    }
}

