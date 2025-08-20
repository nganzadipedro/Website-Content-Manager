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
        Schema::create('turmas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('descricao')->nullable();
            $table->date('data_exame')->nullable();
            $table->time('hora_exame')->nullable();
            $table->string('sala_exame')->nullable();

            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('ano_id')->unsigned();

            $table->foreign('curso_id')
                ->references('id')
                ->on('cursos')
                ->onDelete('cascade');

            $table->foreign('ano_id')
                ->references('id')
                ->on('anos')
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
        Schema::dropIfExists('turmas');
    }
};
