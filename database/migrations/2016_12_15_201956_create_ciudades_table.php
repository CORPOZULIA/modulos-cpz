<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.ciudades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nombre_ciudad', 130);
            $table->string('codigo_ciudad', 7)->unique();

            $table->integer('pais_id')->unsigned()->default(1);
            $table->index('codigo_ciudad');

            $table->foreign('pais_id')->references('id')
                    ->on('paises');
        });
        \DB::table('ciudades')->insert([
            'nombre_ciudad' => '------',
            'codigo_ciudad' => 'NC',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('general.ciudades');
    }
}
