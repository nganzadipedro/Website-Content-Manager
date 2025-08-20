<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advogado extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="advogado";
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
        'categoria'
    ];

    public function getpessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
}
