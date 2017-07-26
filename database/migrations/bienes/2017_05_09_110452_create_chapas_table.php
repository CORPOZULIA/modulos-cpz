<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.chapas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('codigo_chapa',20);
            
            $table->integer('activo_id')->unsigned();
            $table->foreign('activo_id')->references('id')->on('bienes.activos');

            $table->integer('estado_chapa')->unsigned();
            $table->foreign('estado_chapa')->references('id')->on('bienes.estados');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bienes.chapas');
    }
}
