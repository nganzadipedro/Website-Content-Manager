<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacaoaluno extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="avaliacao_aluno";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'formacao_id',
        'aluno_id',
        'disciplina_id',
        'nota1',
        'nota2',
        'notafinal',
        'editar',
        'turma_id'
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
