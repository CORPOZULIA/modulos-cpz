<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.premiaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('ctcrpar_id')
                    ->unsigned();

            $table->integer('tipo_premio_id')->unsigned();

            $table->foreign('ctcrpar_id')->references('id')
                    ->on('competencia.categoria_carrera_participante')->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('tipo_premio_id')->references('id')
                    ->on('competencia.tipos_premios')->onDelete('cascade')
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
        Schema::drop('competencia.premiaciones');
    }
}
