<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->string('sku');
            $table->integer('quantidade');

            $table->foreign('produto_id')
                ->references('id')
                ->on('produtos');
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
        Schema::dropIfExists('log_produtos');
    }
}
