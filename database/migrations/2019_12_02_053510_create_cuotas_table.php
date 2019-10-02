<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numerodecuota');
            $table->integer('idcajero')->unsigned();
            $table->foreign('idcajero')->references('id')->on('personas');
            $table->integer('idcredito')->unsigned();
            $table->foreign('idcredito')->references('id')->on('creditos')->onDelete('cascade');          
            $table->date('fechapago');       
            $table->dateTime('fechacancelo');            
            $table->decimal('monto',7,2);
            $table->decimal('saldopendiente',12,2);  
            $table->decimal('mora',12,2)->default(0.0);    
            $table->string('descripcion',120)->nullable();
          
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
        Schema::dropIfExists('cuotas');
    }
}
