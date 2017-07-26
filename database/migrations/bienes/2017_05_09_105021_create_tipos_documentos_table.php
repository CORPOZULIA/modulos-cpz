<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.tipos_documentos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre_tipo');
            $table->string('codigo_tipo_documento')->unique();
            $table->string('descripcion_tipo_documento');

            $table->integer('estado_tipo_documento')->unsigned();
            $table->foreign('estado_tipo_documento')->references('id')->on('bienes.estados');



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
        Schema::drop('bienes.tipos_documentos');
    }
}
