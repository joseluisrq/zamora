<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    //
    protected $table = 'socios';

    protected $fillable=[
        'estado',
        'estadoahorro',
        'estadocredito',
        'tipo'
    ];

    public function persona(){
        return $this->belongsTo('App\Persona');
    }
}
