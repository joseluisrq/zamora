<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimuladorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulador', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dnisolicitante');
       
                  
            $table->decimal('montodesembolsado',10,2);
            $table->date('fechadesembolso');
            $table->date('fechaprimeracuota');
            $table->integer('numerocuotas');           
            $table->decimal('tasa',4,2);
            $table->char('periodo',1);
            $table->char('estado',1);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simulador');
    }
}
