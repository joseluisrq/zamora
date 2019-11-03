<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositoFijo extends Model
{
	protected $table='depositos_fijo';
    protected $fillable=[
        'idcuenta',
        'fecha_inicio',
        'fecha_fin',
        'tasa'
    ];
}
