<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.documentos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('concepto_documento');

            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('bienes.tipos_documentos');
            $table->string('numero_documento');

            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')->references('id')->on('bienes.institucion');

            $table->integer('estado_documento')->unsigned();
            $table->foreign('estado_documento')->references('id')->on('bienes.estados');

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
        Schema::drop('bienes.documentos');
    }
}
