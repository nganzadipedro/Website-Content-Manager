<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="formacao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'descricao',
        'hash',
        'ativo',
        'user_id',
        'data_inicio',
        'data_fim',
        'imagem_capa',
        'valor_custo',
        'ano_id',
        'ciclo',
        'tipoformacao_id'
    ];

    public function getTipoformacao(){
        return $this->belongsTo(Tipoformacao::class, 'tipoformacao_id', 'id');
    }

    public function getAno(){
        return $this->belongsTo(Ano::class, 'ano_id', 'id');
    }

    public function getLikes(){
        return $this->hasMany(Gostoturma::class, 'formacao_id', 'id');
    }

    public function getDisciplinas(){
        return $this->hasMany(Formacaodisciplina::class, 'formacao_id', 'id');
    }

    public function getAlunos(){
        return $this->hasMany(Alunoformacao::class, 'formacao_id', 'id');
    }
    
}
