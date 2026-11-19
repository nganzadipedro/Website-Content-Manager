<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formacaodisciplina extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="formacao_disciplina";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'formacao_id',
        'disciplina_id',
        'user_id'
    ];

    public function getDisciplina(){
        return $this->belongsTo(Ano::class, 'ano_id', 'id');
    }
    
}
