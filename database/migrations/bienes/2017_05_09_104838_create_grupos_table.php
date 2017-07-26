<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.grupos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre_grupo');
            $table->string('codigo_grupo',20)->unique();
            $table->integer('estado_grupo')->unsigned();
            
            $table->string('spg_cuenta');

           
            $table->foreign('estado_grupo')
                    ->references('id')
                    ->on('bienes.estados')
                    ->onDelete('cascade');

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
        Schema::drop('bienes.grupos');
    }
}
