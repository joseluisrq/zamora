<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAhorrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahorros', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idsocio')->unsigned();
            $table->foreign('idsocio')->references('id')->on('personas')->onDelete('cascade');

            

            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('personas')->onDelete('cascade');;

            $table->string('numerocuenta',12);
           
            $table->decimal('saldoefectivo',10,2);
            $table->date('fechaapertura');
            $table->date('ultimodesembolso');

            $table->integer('numerocuotas');
           
            $table->decimal('tasa',4,2);
            $table->char('estado',1)->default(1);
            
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
        Schema::dropIfExists('ahorros');
    }
}
