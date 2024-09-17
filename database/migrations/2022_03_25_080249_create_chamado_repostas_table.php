<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadoRepostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamado_repostas', function (Blueprint $table) {
            $table->id();      
            $table->text('descricao');
            
            $table->bigInteger('chamado_id')->unsigned();
            $table->foreign('chamado_id')->references('id')->on('chamados');
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
        Schema::dropIfExists('chamado_repostas');
    }
}
