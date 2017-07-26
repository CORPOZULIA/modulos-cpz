<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.activos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_activo');

            $table->string('codigo_activo',20)->unique();
            $table->string('serial_activo')->unique();

            $table->text('descripcion');
            $table->float('costo_inicial_activo');
            
            $table->string('deprecia_activo',2);
            $table->integer('tiempo_deprec_activo');
            $table->float('porcent_deprec_anual_activo');
            
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('bienes.grupos')->onDelete('cascade');

            $table->integer('documento_id')->unsigned();
            $table->foreign('documento_id')->references('id')->on('bienes.documentos');

            $table->integer('ubic_fisica_id')->unsigned();
            $table->foreign('ubic_fisica_id')->references('id')->on('bienes.ubicaciones_fisicas')->onDelete('cascade');

            $table->integer('ubic_admin_id')->unsigned();
            $table->foreign('ubic_admin_id')->references('id')->on('bienes.ubicaciones_administrativas')->onDelete('cascade');

            $table->integer('estado_activo')->unsigned();
            $table->foreign('estado_activo')->references('id')->on('bienes.estados')->onDelete('cascade');

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
        Schema::drop('bienes.activos');
    }
}
