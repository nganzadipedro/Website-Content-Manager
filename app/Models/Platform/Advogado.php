<?php

namespace App\Models\Platform;

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
        'num_estagiario',
        'doc_bilhete',
        'doc_cedula_estagiario',
        'doc_cedula_associado',
        'nome_patrono',
        'email_patrono',
        'telefone_patrono',
        'municipio_id',
        'nome_escritorio',
        'endereco_escritorio',
        'categoria'
    ];

    public function getpessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
}
