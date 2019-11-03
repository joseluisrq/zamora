<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table='cajas';

    protected $fillable=[
            'id',
           'idusuario',         
           'montoinicial',
           'montorecaudado',
           'fechaapertura',
           'fechacierre',
           'estado ',          
     
    ];
    public $timestamps = false;
}
