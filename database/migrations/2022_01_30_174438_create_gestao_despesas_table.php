<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestaoDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestao_despesas', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('fornecedor_id')->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('gestao_fornecedors');
            
            $table->bigInteger('tipo_despesa_id')->unsigned();
            $table->foreign('tipo_despesa_id')->references('id')->on('gestao_tipo_despesas');
            
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
            
            $table->bigInteger('pagamento_id')->nullable()->unsigned();
            $table->foreign('pagamento_id')->references('id')->on('gestao_pagamentos');
            
            $table->string("descricao", 60);
            $table->decimal("valor", 10,2);
            $table->date("data_lancamento");
            $table->date("data_vencimento");
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
        Schema::dropIfExists('gestao_despesas');
    }
}
