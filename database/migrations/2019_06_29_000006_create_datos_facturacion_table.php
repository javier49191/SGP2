<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosFacturacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_facturacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni');
            $table->string('cuil_cuit');

            $table->unsignedBigInteger('domicilio_id');
            $table->foreign('domicilio_id')->references('id')->on('domicilios')
            ->onDelete('cascade');

            $table->unsignedBigInteger('padrino_id');
            $table->foreign('padrino_id')->references('id')->on('padrinos')
            ->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('datos_facturacion');
    }
}
