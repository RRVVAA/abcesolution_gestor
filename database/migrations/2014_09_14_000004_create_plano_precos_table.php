<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanoPrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plano_precos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plano_id')->unsigned();
            $table->foreign('plano_id')->references('id')->on('planos');
            $table->integer("recorrencia");
            $table->decimal("preco_de", 10,2)->nullable();
            $table->decimal("preco", 10,2);
            $table->BigInteger('status_id')->nullable()->unsigned();
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
        Schema::dropIfExists('plano_precos');
    }
}
