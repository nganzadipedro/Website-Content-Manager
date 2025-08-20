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
        Schema::create('candidatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 100)->nullable();
            $table->string('hash', 100)->nullable();
            $table->string('nome_completo', 100)->nullable();
            $table->string('naturalidade', 100)->nullable();
            $table->string('num_documento', 20)->nullable();
            $table->string('genero', 16)->nullable();
            $table->string('endereco', 100)->nullable();
            $table->string('municipio', 80)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('telefone', 80)->nullable();
            $table->date('data_nascimento', 80)->nullable();
            $table->string('escola_ensino_medio', 80)->nullable();
            $table->string('doc_bi')->nullable();
            $table->string('doc_certificado')->nullable();
            $table->string('comprovativo_pagamento')->nullable();
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
        Schema::dropIfExists('candidatos');
    }
};
