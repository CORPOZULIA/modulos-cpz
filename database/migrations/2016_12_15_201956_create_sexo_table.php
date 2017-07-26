<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSexoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sexo', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('codigo_sexo', 97)->unique();

            $table->index('codigo_sexo');
        });
        
        foreach (['-----', 'MASCULINO', 'FEMENINO'] as $key => $value) {
            \DB::table('sexo')->insert([
                'codigo_sexo' => $value,
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
        Schema::drop('sexo');
    }
}
