<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.paises', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_pais');

            $table->string('codigo_pais', 8)->unique();
            $table->string('codigo_telefonico', 15)->nullable();

            $table->index(['codigo_telefonico','codigo_pais']);
        });

        \DB::table('paises')->insert([
            'nombre_pais' => '---------------',
            'codigo_pais' => 'NN',
            'codigo_telefonico' => '+00',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('general.paises');
    }
}
