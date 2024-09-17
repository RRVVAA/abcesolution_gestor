<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestaoRecebersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestao_recebers', function (Blueprint $table) {
            $table->id();
            
            $table->BigInteger('empresa_id')->unsigned();
            $table->foreign("empresa_id")->references("id")->on("empresas");
            
            $table->bigInteger('recebimento_id')->nullable()->unsigned();
            $table->foreign('recebimento_id')->references('id')->on('gestao_recebimentos');
            
            $table->string('descricao',60)->nullable();            
            
            $table->BigInteger('status_id')->unsigned();
            $table->foreign("status_id")->references("id")->on("statuses");            
            
            $table->date('data_lancamento')->nullable();
            $table->date('data_vencimento');
            $table->string('observacao',60)->nullable();
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
        Schema::dropIfExists('gestao_recebers');
    }
}
