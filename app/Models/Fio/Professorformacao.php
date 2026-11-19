<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professorformacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="professor_formacao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'formacao_id',
        'professor_id',
        'disciplina_id',
        'turma_id',
        'user_id'
    ];

    public function getProfessor(){
        return $this->belongsTo(Professor::class, 'professor_id', 'id');
    }

    public function getDisciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id');
    }

    public function getTurma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }

    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }
    
}
