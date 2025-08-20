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
        Schema::create('inscricaos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->decimal('resultado_exame', 5, 2)->nullable();
            $table->enum('estado', ['pendente', 'suspenso', 'aprovado'])->default('pendente')->nullable();
            $table->string('motivo_suspensao')->nullable();
            $table->bigInteger('primeira_opcao_id')->unsigned()->nullable();
            $table->bigInteger('segunda_opcao_id')->nullable()->unsigned()->nullable();
            $table->bigInteger('candidato_id')->unsigned()->nullable();
            $table->bigInteger('ano_id')->unsigned()->nullable();

            $table->foreign('candidato_id')
                ->references('id')
                ->on('candidatos')
                ->onDelete('cascade');

            $table->foreign('ano_id')
                ->references('id')
                ->on('anos')
                ->onDelete('cascade');

            $table->foreign('primeira_opcao_id')
                ->references('id')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('segunda_opcao_id')
                ->references('id')
                ->on('cursos')
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
        Schema::dropIfExists('inscricaos');
    }
};
