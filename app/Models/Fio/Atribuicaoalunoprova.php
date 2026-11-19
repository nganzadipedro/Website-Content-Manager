<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atribuicaoalunoprova extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="atribuicao_alunoprova";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'prova_id',
        'disciplina_id',
        'estado',
        'aluno_id',
        'user_id'
    ];

    public function getprova(){
        return $this->belongsTo(Prova::class, 'prova_id', 'id');
    }

    public function getdisciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id');
    }

    public function getaluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id');
    }
    
}
