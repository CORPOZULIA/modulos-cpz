<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.competencias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titulo_competencia', 170);
            $table->text('descripcion_competencia');
            $table->enum('estado_competencia', ['P', 'R', ])->default('P');

            $table->date('fecha_inic_insc');
            $table->date('fecha_fin_insc');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.competencias');
    }
}
