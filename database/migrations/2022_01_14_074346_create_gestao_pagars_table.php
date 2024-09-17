2<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestaoPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestao_pagars', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('pagamento_id')->nullable()->unsigned();
            $table->foreign('pagamento_id')->references('id')->on('gestao_pagamentos');
            
            $table->string('descricao',60)->nullable();
            
            $table->BigInteger('fornecedor_id')->unsigned();
            $table->foreign("fornecedor_id")->references("id")->on("gestao_fornecedors");
            
            $table->BigInteger('status_id')->unsigned();
            $table->foreign("status_id")->references("id")->on("statuses");            
            
            $table->integer('num_parcela')->nullable();
            $table->integer('ult_parcela')->nullable();
            
            $table->date('data_lancamento')->nullable();
            $table->date('data_vencimento');
            $table->string('observacao',90)->nullable();
            $table->decimal('valor', 10,2)->default(0);            
            
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
        Schema::dropIfExists('gestao_pagars');
    }
}
