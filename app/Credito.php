<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    //
    protected $fillable =[
        'idsocio',
        'idgarante',
        'idusuario',
        'numeroprestamo',
      
        'montodesembolsado',
        'fechadesembolso',
      
        'numerocuotas',
        'tipocambio',
        'tasa',
        'intes',
        'estado',
        'periodo',
        'estadodesembolso'
    ];
//usuario, socio que ha registrado el credito
    public function personas(){
        return  $this->belongsTo('App\Persona');
    }
//cliente que saco el credito
   /* public function socio(){
        return  $this->belongsTo('App\Socio');
    }*/

}
