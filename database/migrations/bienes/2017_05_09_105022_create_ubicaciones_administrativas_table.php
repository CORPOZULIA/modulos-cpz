<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesAdministrativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.ubicaciones_administrativas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('estado_ubic')->unsigned();

            $table->foreign('estado_ubic')
                    ->references('id')
                    ->on('bienes.estados')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bienes.ubicaciones_administrativas');
    }
}
