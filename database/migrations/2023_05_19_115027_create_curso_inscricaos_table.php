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
        Schema::create('curso_inscricaos', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->bigInteger('inscricao_id')->unsigned();
            $table->bigInteger('curso_id')->unsigned();
            $table->bigInteger('instituicao_id')->unsigned();

            $table->foreign('inscricao_id')
                ->references('id')
                ->on('inscricaos')
                ->onDelete('cascade');

            $table->foreign('curso_id')
                ->references('id')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('instituicao_id')
                ->references('id')
                ->on('instituicaos')
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
        Schema::dropIfExists('curso_inscricaos');
    }
};