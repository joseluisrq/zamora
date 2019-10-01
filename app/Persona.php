<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable=[
        'nombre',
        'dni',
        'apellidos',
        'fechanacimiento',
        'direccion',
        'telefono',
        'email',
        'estado',
        'tipo'
    ];

    public function socio(){
        return $this->hasOne('App\Socio');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}
