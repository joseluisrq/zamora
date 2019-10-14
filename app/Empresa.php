<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table='empresa';

    protected $fillable=[
        'mora',
        'interes',
        'abonosocio',
        'tasa_ahorros',
        'tasa_creditos',
        'tasa_aportes'
    ];
}
