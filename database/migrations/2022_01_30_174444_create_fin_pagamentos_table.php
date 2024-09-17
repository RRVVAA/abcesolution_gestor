<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_pagamentos', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            
            $table->string('descricao_pagamento',60)->nullable(); 
            $table->integer('tipo_documento')->nullable();
            $table->integer('documento_id')->nullable();
            
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            
            $table->BigInteger('forma_pagto_id')->unsigned()->nullable();
            $table->foreign("forma_pagto_id")->references("id")->on("forma_pagtos");
            
            $table->date('data_pagamento')->nullable();
            
            $table->string('numero_documento',60)->nullable();
            $table->string('observacao',60)->nullable();
            $table->decimal('valor_original',10,2)->nullable()->default(0);
            $table->decimal('valor_pago', 10,2)->default(0);
            $table->decimal('juros',10,2)->nullable()->default(0);
            $table->decimal('desconto',10,2)->nullable()->default(0);
            $table->decimal('multa',10,2)->nullable()->default(0);
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
        Schema::dropIfExists('fin_pagamentos');
    }
}
