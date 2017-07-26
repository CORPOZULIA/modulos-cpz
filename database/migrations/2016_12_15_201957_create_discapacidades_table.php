<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discapacidades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_discapacidad', 170);
            $table->string('codigo_discapacidad', 7)->unique();
            $table->integer('tip_disc_id')->unsigned()->default(1);

            $table->index('codigo_discapacidad');
            $table->foreign('tip_disc_id')->references('id')
                    ->on('tipos_discapacidades')->onDelete('cascade')
                                                ->onUpdate('cascade');
        });

        \DB::table('discapacidades')->insert([
            'codigo_discapacidad' => 'NT',
            'nombre_discapacidad' => 'NO TENGO DISCAPACIDAD',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discapacidades');
    }
}
