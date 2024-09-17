<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_faturas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            
            $table->string('descricao',80)->nullable();
            $table->string('observacao',80)->nullable();
            
            $table->BigInteger('forma_pagto_id')->unsigned()->nullable();
            $table->foreign("forma_pagto_id")->references("id")->on("forma_pagtos");
            
            $table->BigInteger('planopreco_id')->unsigned()->nullable();
            $table->foreign("planopreco_id")->references("id")->on("plano_precos");
            
            $table->BigInteger('status_id')->unsigned()->nullable();
            $table->foreign("status_id")->references("id")->on("statuses");
            
            $table->bigInteger('pagamento_id')->nullable()->unsigned();
            $table->foreign('pagamento_id')->references('id')->on('fin_pagamentos');
            
            $table->bigInteger('recebimento_id')->nullable()->unsigned();
            $table->foreign('recebimento_id')->references('id')->on('gestao_recebimentos');
            
            $table->date('data_emissao')->nullable();
            $table->date('data_vencimento');
            $table->decimal('valor',10,2)->nullable()->default(0);
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
        Schema::dropIfExists('fin_faturas');
    }
}
