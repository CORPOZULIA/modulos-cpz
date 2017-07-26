<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.ventas_kits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('participante_id')->unsigned();
            $table->integer('kit_id')->unsigned();
            $table->integer('cantidad_vendida');

            $table->foreign('participante_id')->references('id')
                        ->on('competencia.participantes')->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->foreign('kit_id')->references('id')
                        ->on('competencia.kits_competencias')->onDelete('cascade')
                        ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.ventas_kits');
    }
}
