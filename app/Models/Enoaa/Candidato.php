<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "enoaa";
    protected $table="candidatos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'codigo',
        'hash',
        'nacionalidade',
        'naturalidade',
        'necessidade_especial',
        'provincia_id',
        'endereco',
        'municipio',
        'instituicao_estudo',
        'provincia_exame',
        'doc_bi',
        'doc_diploma',
        'pessoa_id'
    ];

    public function getPessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function getProvincia(){
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }

    public function getProvinciaExame(){
        return $this->belongsTo(Provincia::class, 'provincia_exame', 'id');
    }

    public function getCandidaturas(){
        return $this->hasMany(Candidatura::class, 'candidato_id', 'id');
    }
}
