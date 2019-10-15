<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table='empresa';

    protected $fillable=[
           //TEA, Tasa efectiva anual
           'tasa_creditos',
           //tasa de cuenta corriente
           'tasa_ahorros',
           'tasa_ahorros_comisiones',
           'tasa_ahorros_gastos',
           //tasadecuetnas aplazo fijo
           'tasa_ahorroplazo_30',
           'tasa_ahorroplazo_90',
           'tasa_ahorroplazo_180',
           'tasa_ahorroplazo_361',
           'tasa_ahorroplazo_361',
           //tasa de aportes
           'tasa_aportes',
           //calculo de mora
           'tasa_compensatoria_anual',
           'tasa_moratoria_anual'
     
    ];
    public $timestamps = false;
}
