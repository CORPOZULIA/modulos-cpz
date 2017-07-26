<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBIENESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes.bienes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Edo_reg');
            $table->string('Cod_cia');
            $table->string('Cod_bie');
            $table->string('Des_cua');
            $table->string('Descrip');
            $table->string('Cedula');
            $table->string('cod_ter');
            $table->string('Cod_gru');
            $table->string('Cod_adm');
            $table->string('Deprecia');
            $table->float('Por_dep');
            $table->integer('Tie_dep');
            $table->integer('Per_eje');
            $table->date('Fec_ini');
            $table->date('Fec_des');
            $table->float('Mon_ite');
            $table->float('Val_agr');
            $table->date('Fec_agr');
            $table->float('Val_rev');
            $table->date('Fec_rev');
            $table->float('Val_ite');
            $table->float('Dep_acu');
            $table->float('Dep_eje');
            $table->float('Dep_mes');
            $table->float('Dep_men');
            $table->integer('Can_exi');
            $table->integer('Can_inv');
            $table->date('Fec_inv');
            $table->string('Tip_ing');
            $table->string('Doc_ing');
            $table->string('Tip_rel');
            $table->string('Rel_ing');
            $table->string('Tip_egr');
            $table->string('Doc_egr');
            $table->string('Edo_item');
            $table->string('Edo_tra');
            $table->string('Edo_doc');
            $table->string('Usr_inc');
            $table->string('Usr_mod');
            $table->string('Usr_eli');
            $table->string('Cta_cre');
            $table->string('Cta_deb');
            $table->string('Ing_cre');
            $table->string('Ing_deb');
            $table->string('Edo_reg2');
            $table->string('Ite_mon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bienes.BIENES');
    }
}
