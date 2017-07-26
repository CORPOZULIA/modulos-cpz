<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDiscapacidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_discapacidades', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->string('codigo_tipo')->unique();
            $table->string('denominacion_tipo', 133);

            $table->index('codigo_tipo');
        });

        \DB::table('tipos_discapacidades')->insert([
            'codigo_tipo' => 'NT',
            'denominacion_tipo' => '-------',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipos_discapacidades');
    }
}
