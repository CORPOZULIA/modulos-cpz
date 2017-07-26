<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.personas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombres', 250)->nullable();
            $table->string('apellidos', 250)->nullable();
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->string('cedula', 20)->nullable();
            $table->string('telefono_personal')->nullable();
            $table->string('telefono_habitacion')->nullable();
            $table->tinyInteger('edo_reg')->default(1);
            $table->string('codper')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('sexo_id')->default(1);
            $table->integer('nacionalidad_id')->unsigned()->default(1);
            $table->integer('discapacidad_id')->unsigned()->default(1);
            $table->integer('pais_id')->unsigned()->default(1);
            $table->integer('ciudad_id')->unsigned()->default(1);

            $table->foreign('nacionalidad_id')->references('id')
                    ->on('nacionalidades')->onDelete('cascade')
                                            ->onUpdate('cascade');

            $table->foreign('discapacidad_id')->references('id')
                    ->on('discapacidades')->onDelete('cascade')
                                            ->onUpdate('cascade');

            $table->foreign('pais_id')->references('id')
                    ->on('paises')->onDelete('cascade')
                                    ->onUpdate('cascade');
                                    
            $table->foreign('ciudad_id')->references('id')
                    ->on('ciudades')->onDelete('cascade')
                                    ->onUpdate('cascade');

            $table->foreign('sexo_id')->references('id')
                    ->on('sexo')->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->index(['cedula', 'codper']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('general.personas');
    }
}
