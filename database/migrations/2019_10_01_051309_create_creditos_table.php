<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idsocio')->unsigned();
            $table->foreign('idsocio')->references('id')->on('personas')->onDelete('cascade');

            $table->integer('idgarante')->unsigned();
            $table->foreign('idgarante')->references('id')->on('personas')->onDelete('cascade');

            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('personas')->onDelete('cascade');;

            $table->string('numeroprestamo',12);
           
            $table->decimal('montodesembolsado',10,2);
            $table->date('fechadesembolso');
            $table->integer('numerocuotas');
            $table->decimal('tipocambio',7,6);
            $table->decimal('tasa',4,2);
            $table->char('estado',1);
            $table->char('periodo',1);
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
        Schema::dropIfExists('creditos');
    }
}
