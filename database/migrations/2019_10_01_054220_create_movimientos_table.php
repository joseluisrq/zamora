<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users');
            $table->integer('idahorro')->unsigned();
            $table->foreign('idahorro')->references('id')->on('ahorros')->onDelete('cascade');          
            $table->dateTime('fecharegistro');            
            $table->decimal('monto',7,2);
            $table->decimal('saldopendiente',12,2);    
            $table->string('descripcion',120)->nullable();
            $table->char('tipomovimiento',1);
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
        Schema::dropIfExists('movimientos');
    }
}
