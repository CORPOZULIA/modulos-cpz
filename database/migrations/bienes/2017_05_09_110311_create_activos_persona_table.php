<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.activos_persona', function (Blueprint $table) {
            $table->increments('id');

            $table->string('cedper');

            $table->integer('activo_id')->unsigned();
            $table->foreign('activo_id')->references('id')->on('bienes.activos')->onDelete('cascade');

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
        Schema::drop('bienes.activos_persona');
    }
}
