<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidato_turmas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('candidato_id')->unsigned();

            $table->foreign('turma_id')
                ->references('id')
                ->on('turmas')
                ->onDelete('cascade');

            $table->foreign('candidato_id')
                ->references('id')
                ->on('candidatos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('candidato_turmas');
    }
};
