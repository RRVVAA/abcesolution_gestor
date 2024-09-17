<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanoModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plano_modulos', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("plano_id")->unsigned();
            $table->BigInteger("modulo_id")->unsigned(); 
            
            $table->foreign("plano_id")->references("id")->on("planos");
            $table->foreign("modulo_id")->references("id")->on("modulos");
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
        Schema::dropIfExists('plano_modulos');
    }
}
