<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompetenciaParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.competencia_participante', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('competencia_id')->unsigned();
            $table->integer('participante_id')->unsigned();
            $table->string('numero_deposito', 39)->nullable();
            $table->string('imagen_deposito', 157)->nullable();

            $table->enum('guarda_ropa', ['SI', 'NO'])->default('NO');

            $table->foreign('competencia_id')->references('id')
                    ->on('competencia.competencias')->onDelete('cascade')
                                        ->onUpdate('cascade');

            $table->foreign('participante_id')->references('id')
                    ->on('competencia.participantes')->onDelete('cascade')
                                        ->onUpdate('cascade');

            $table->index('numero_deposito');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.competencia_participante');
    }
}
