<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaAhorro extends Model
{
        protected $table='cuentaahorros';
        protected $fillable=[
            'idsocio',
            'idusuario',
            'numerocuenta',
            'saldoefectivo',
            'fechaapertura',
            'ultimomovimiento',
            'descripcion',
            'tasa',
            'estado'
        ];
        public function personas(){
            return  $this->belongsTo('App\Persona');
        }
    
    
}
