<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emissaodeclaracao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="emissao_declaracao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'aluno_id',
        'codigo',
        'numero',
        'user_id',
        'full_hash',
        'min_hash',
        'turma_id',
        'formacao_id'
    ];

    public function getAluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id');
    }

    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }

    public function getTurma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }
    
}
