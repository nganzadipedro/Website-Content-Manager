<?php

namespace App\Models\Platform;

use App\Models\Municipio;
use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advogado extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="app_advogado";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'pessoa_id',
        'codigo',
        'hash',
        'num_associado',
        'nome_profissional',
        'num_estagiario',
        'doc_bilhete',
        'doc_cedula_estagiario',
        'doc_cedula_associado',
        'nome_patrono',
        'email_patrono',
        'telefone_patrono',
        'data_inscricao_oaa',
        'data_inscricao_estagiario',
        'municipio_id',
        'nome_escritorio',
        'endereco_escritorio',
        'estado',
        'categoria',
        'data_cerimonia_estagiario',
        'data_cerimonia_associado'
    ];

    public function getpessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function getmunicipio(){
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
}
