<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoPremioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.tipos_premios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_tipo', 160);

            $table->string('codigo_tipo', 7)->unique();

            $table->index('codigo_tipo');
        });

      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.tipos_premios');
    }
}
