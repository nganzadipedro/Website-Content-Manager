<?php

namespace App\Models\Fio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="turma";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'formacao_id',
        'provincia_id',
        'user_id',
        'modalidade',
        'ativo',
        'emitir_declaracao',
        'capacidade'
    ];

    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }

    public function getAlunos(){
        return $this->hasMany(Alunoformacao::class, 'turma_id', 'id');
    }

    public function getGostos(){
        return $this->hasMany(Gostoturma::class, 'turma_id', 'id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
