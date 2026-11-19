<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidatura extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "enoaa";
    protected $table="candidaturas";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'year_id',
        'candidato_id',
        'estado',
        'pago',
        'email_registo',
        'referencia',
        'avaliador_id',
        'motivo_suspensao'
    ];

    
    public function getCandidato(){
        return $this->belongsTo(Candidato::class, 'candidato_id', 'id');
    }

    public function getAno(){
        return $this->belongsTo(Ano::class, 'year_id', 'id');
    }

    public function getAvaliador(){
        return $this->belongsTo(Pessoa::class, 'avaliador_id', 'id');
    }
}
