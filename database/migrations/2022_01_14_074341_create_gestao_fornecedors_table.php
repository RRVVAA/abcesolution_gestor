<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestaoFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestao_fornecedors', function (Blueprint $table) {
            $table->id();
            
            $table->string('razao_social', 100)->unique();
            $table->string('nome_fantasia', 100)->nullable()->unique();
            $table->string('cpf_cnpj', 19)->nullable()->unique();
            $table->string('email', 90)->nullable();
            
            $table->string('cep', 10)->nullable()->nullable();
            $table->string('logradouro', 80)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('complemento', 80)->nullable();
            $table->char('uf', 2)->nullable();
            $table->string('cidade', 30)->nullable();
            $table->string('fone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('ibge', 20)->nullable();
            
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');
            
            
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
        Schema::dropIfExists('gestao_fornecedors');
    }
}
