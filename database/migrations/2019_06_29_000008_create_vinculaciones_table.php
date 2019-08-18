<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinculacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculaciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('padrino_id');
            $table->foreign('padrino_id')->references('id')->on('padrinos')
            ->onDelete('cascade');

            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')
            ->onDelete('cascade');

            $table->boolean('se_conocen')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('vinculaciones');
    }
}
