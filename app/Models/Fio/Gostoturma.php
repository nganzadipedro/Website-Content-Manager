<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\Fio\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gostoturma extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="gostos_turma";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'formacao_id',
        'turma_id'
    ];

    public function getTurma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }

    
    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }

    public function getUser(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }
    
}
