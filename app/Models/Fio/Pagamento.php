<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pagamentos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'aluno_id',
        'formacao_id',
        'descricao',
        'observacao',
        'emolumento_id',
        'solicitacao_id',
        'referencia',
        'referencia_factura',
        'forma_pagamento',
        'ano_id'
    ];

    public function getAluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id');
    }

    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }

    public function getEmolumento(){
        return $this->belongsTo(Emolumento::class, 'emolumento_id', 'id');
    }

    public function getSolicitacao(){
        return $this->belongsTo(Solicitacaodocumento::class, 'solicitacao_id', 'id');
    }
    
}
