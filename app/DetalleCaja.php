<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCaja extends Model
{
    protected $table='detallecaja';

    protected $fillable=[
           'iddetalle ',
           'idcaja ',         
           'idmovimiento ',
           'tipo ',
           'fecha ',
           'monto ',             
     
    ];
    public $timestamps = false;
}
