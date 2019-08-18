<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanCompletadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_completado', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('vinculacione_id');
            $table->foreign('vinculacione_id')->references('id')->on('vinculaciones')
            ->onDelete('cascade');

            $table->integer('cuotas_pagas');
            $table->dateTime('fecha_ultimo_pago');
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
        Schema::dropIfExists('plan_completado');
    }
}
