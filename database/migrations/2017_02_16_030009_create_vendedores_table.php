<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia.vendedores', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
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
        Schema::drop('competencia.vendedores');
    }
}
