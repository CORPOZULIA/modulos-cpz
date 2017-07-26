<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitCompetenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.kits_competencias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('competencia_id')->unsigned();
            $table->float('precio_kit')->default(0.00);
            $table->integer('stock')->default(0);
            $table->text('descripcion_kit');
            $table->string('codigo_kit', 5)->unique();

            $table->index('codigo_kit');
            $table->foreign('competencia_id')->references('id')
                                            ->on('competencia.competencias')->onDelete('cascade')
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
        Schema::drop('competencia.kits_competencias');
    }
}
