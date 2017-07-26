<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNacionalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nacionalidades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('codigo_nac', 13)->unique();
            $table->string('descripcion_nac', 150);

            $table->index('codigo_nac');
        });

        foreach (['V' => 'VENEZOLANO', 'E' => 'EXTRANJERO'] as $codigo => $nacionalidad) {
            \DB::table('nacionalidades')->insert([
                'codigo_nac' => $codigo,
                'descripcion_nac' => $nacionalidad,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nacionalidades');
    }
}
