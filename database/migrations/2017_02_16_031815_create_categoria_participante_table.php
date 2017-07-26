<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.categoria_carrera_participante', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('carr_part_id')->unsigned();
            $table->integer('categoria_id')->unsigned();

            $table->foreign('carr_part_id')->references('id')
                    ->on('competencia.competencia_participante')->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('categoria_id')->references('id')
                    ->on('competencia.categorias')->onDelete('cascade')
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
        Schema::drop('competencia.categoria_carrera_participante');
    }
}
