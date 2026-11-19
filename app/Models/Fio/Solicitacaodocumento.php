<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacaodocumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="solicitacao_documento";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'aluno_id',
        'emolumento_id',
        'turma_id',
        'referencia',
        'validade_referencia',
        'referencia_factura',
        'ano_id',
        'estado',
        'user_id'
    ];
    
}
