<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{
    //
    protected $table='aportaciones';
    protected $fillable=[
        'id','idsocio','idusuario',
        'monto','fecharegistro','descripcion',
        'tasa','estado'
    ];
    public function personas(){
        return  $this->belongsTo('App\Persona');
    }
}
