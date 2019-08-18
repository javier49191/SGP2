<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesVincularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones_vincular', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('vinculacione_id');
            $table->foreign('vinculacione_id')->references('id')->on('vinculaciones')
            ->onDelete('cascade');

            $table->text('observaciones');
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
        Schema::dropIfExists('observaciones_vincular');
    }
}
