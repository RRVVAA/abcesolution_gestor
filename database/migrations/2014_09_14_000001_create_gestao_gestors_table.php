<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestaoGestorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestao_gestors', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social', 100)->nullable();
            $table->string('nome_fantasia', 80)->nullable();
            $table->string('cnpj', 19)->nullable();
            $table->string('ie', 20)->nullable();
            $table->string('iest', 20)->nullable();
            $table->string('im', 20)->nullable();
            $table->string('foto', 100)->nullable();
            
            $table->string('cep', 10)->nullable();
            $table->string('logradouro', 80)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('complemento', 80)->nullable();
            $table->char('uf', 2)->nullable();
            $table->string('cidade', 30)->nullable();
            $table->string('fone', 20)->nullable();
            $table->string('ibge', 20)->nullable();
            $table->string('cnae', 20)->nullable();            
            
            $table->string('email', 90)->unique();
            $table->string('password');
            
            
            $table->string('pais', 20)->nullable();
            $table->integer('codPais')->nullable();
            $table->integer('crt')->nullable();
            
            
            $table->string('cst_csosn_padrao', 3)->nullable();
            $table->string('cst_cofins_padrao', 3)->nullable();
            $table->string('cst_pis_padrao', 3)->nullable();
            $table->string('cst_ipi_padrao', 3)->nullable();
            $table->integer('frete_padrao')->nullable();
            $table->string('tipo_pagamento_padrao', 2)->nullable();
            
            $table->string('nat_op_padrao',100)->nullable();
            $table->integer('ambiente')->nullable()->default(2);
            $table->string('numero_serie_nfe', 3)->nullable();
            $table->string('numero_serie_nfce', 3)->nullable();
            $table->integer('ultimo_numero_nfe')->nullable();
            $table->integer('ultimo_numero_nfce')->nullable();
            $table->integer('ultimo_numero_cte')->nullable();
            $table->integer('ultimo_numero_mdfe')->nullable();
            
            $table->string('certificado_nome_arquivo', 60)->nullable();
            $table->binary('certificado_arquivo_binario')->nullable();
            $table->string('certificado_senha', 60)->nullable();
            
            $table->string('csc', 60)->nullable();
            $table->string('csc_id', 10)->nullable();          
            
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
        Schema::dropIfExists('gestao_gestors');
    }
}
