<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->enum('recibir_sms', ['SI', 'NO'])->default('NO');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')
                    ->on('personas')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competencia.participantes');
    }
}
