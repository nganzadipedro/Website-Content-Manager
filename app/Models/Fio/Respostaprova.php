<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respostaprova extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="resposta_prova";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'prova_id',
        'disciplina_id',
        'pergunta_id',
        'aluno_id',
        'resposta_aluno',
        'cotacao',
        'user_id'
    ];

    public function getprova(){
        return $this->belongsTo(Prova::class, 'prova_id', 'id');
    }
    
}
