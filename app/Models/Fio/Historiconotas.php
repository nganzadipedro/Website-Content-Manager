<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historiconotas extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="historico_notas";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'disciplina_id',
        'oldnota1',
        'newnota1',
        'oldnota2',
        'newnota2',
        'oldnotafinal',
        'newnotafinal',
        'professor_id',
        'aluno_id',
        'turma_id',
        'user_id',
        'observacao'
    ];

    public function getprofessor(){
        return $this->belongsTo(Professor::class, 'professor_id', 'id');
    }

    public function getdisciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id');
    }

    public function getturma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }

    public function getuser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
