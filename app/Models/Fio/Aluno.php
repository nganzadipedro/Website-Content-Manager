<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Pessoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="aluno";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'pessoa_id',
        'codigo',
        'hash',
        'num_cedula_advogado',
        'documento_bilhete',
        'documento_cedula',
        'nome_patrono',
        'email_patrono',
        'telefone_patrono',
        'nome_escritorio',
        'endereco_escritorio',
        'e_antigo',
        'nota_civil',
        'nota_etica',
        'nota_penal',
        'nota_laboral',
        'nota_multidisciplinares',
        'media_final',
        'turma',
        'ciclo',
        'formacao'
    ];

    public function getPessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

}
