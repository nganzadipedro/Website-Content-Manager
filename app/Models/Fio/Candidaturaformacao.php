<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Pessoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidaturaformacao extends Model
{

    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="candidatura";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'hash',
        'codigo',
        'pessoa_id',
        'aluno_id',
        'cedula_advogado',
        'year_id',
        'motivo_suspensao',
        'formacao_id',
        'codigo_validacao',
        'pintar',
        'estado',
        'pago',
        'email_registo',
        'referencia',
        'referencia_factura',
        'validade_referencia',
        'codigo_validacao',
        'nome_patrono',
        'email_patrono',
        'telefone_patrono',
        'bilhete_identidade',
        'num_cedula',
        'nome_escritorio',
        'endereco_escritorio',
        'prov_formacao_id',
        'turma_id'
    ];


    public function getAno(){
        return $this->belongsTo(Ano::class, 'year_id', 'id');
    }

    public function getPessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function getFormacao(){
        return $this->belongsTo(Formacao::class, 'formacao_id', 'id');
    }

    public function getTurma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }
    
    public function getAluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id');
    }
    
}
