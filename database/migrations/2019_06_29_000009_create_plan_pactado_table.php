<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanPactadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_pactado', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('vinculacione_id');
            $table->foreign('vinculacione_id')->references('id')->on('vinculaciones')
            ->onDelete('cascade');

            $table->float('monto', 8, 2);
            $table->dateTime('year_lectivo');
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
        Schema::dropIfExists('plan_pactado');
    }
}
