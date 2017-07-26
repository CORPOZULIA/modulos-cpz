<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtiquetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.etiquetas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('codigo_etiqueta',20);

            $table->integer('activo_id')->unsigned();
            $table->foreign('activo_id')->references('id')->on('bienes.activos');

            $table->integer('estado_etiqueta')->unsigned();
            $table->foreign('estado_etiqueta')->references('id')->on('bienes.estados');

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
        Schema::drop('bienes.etiquetas');
    }
}
