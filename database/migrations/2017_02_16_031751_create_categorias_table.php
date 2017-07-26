<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nombre_categoria', 60);
            $table->text('descripcion_cat');
            $table->string('codigo', 13)->unique();
            $table->integer('edad_minima');
            $table->integer('edad_maxima');
            $table->integer('sexo_id')->unsigned();

            $table->foreign('sexo_id')->references('id')
                    ->on('sexo')->onDelete('cascade');
            $table->index('codigo');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.categorias');
    }
}
