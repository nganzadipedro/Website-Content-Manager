<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perguntaprova extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pergunta_prova";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'prova_id',
        'hash',
        'corpo_pergunta',
        'resposta_opcao',
        'opcao1',
        'opcao2',
        'opcao3',
        'opcao4',
        'opcao5',
        'numero',
        'cotacao',
        'user_id'
    ];

    public function getprova(){
        return $this->belongsTo(Prova::class, 'prova_id', 'id');
    }
    
}
