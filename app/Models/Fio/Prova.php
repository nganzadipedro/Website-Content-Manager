<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prova extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="prova";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'disciplina_id',
        'hash',
        'nome',
        'ativo',
        'user_id',
        'professor_id',
        'turma_id',
        'data_prova',
        'hora_inicio',
        'hora_fim',
        'ano_id'
    ];

    public function getano(){
        return $this->belongsTo(Ano::class, 'ano_id', 'id');
    }
    
    public function getdisciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id');
    }

    public function getprofessor(){
        return $this->belongsTo(Professor::class, 'professor_id', 'id');
    }

    public function getturma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }

    public function getperguntas(){
        return $this->hasMany(Perguntaprova::class, 'prova_id', 'id');
    }

    public function getalunos(){
        return $this->hasMany(Atribuicaoalunoprova::class, 'prova_id', 'id');
    }



    
}
