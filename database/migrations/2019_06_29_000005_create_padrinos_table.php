<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePadrinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padrinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('alias')->nullable();
            $table->string('dni');
            $table->string('cuil');
            $table->string('email');
            $table->string('segundo_email')->nullable();
            $table->string('telefono');
            $table->string('segundo_telefono')->nullable();
            $table->text('contacto');

            $table->unsignedBigInteger('domicilio_id');
            $table->foreign('domicilio_id')->references('id')->on('domicilios')
            ->onDelete('cascade');

            $table->boolean('checklist');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('padrinos');
    }
}
