<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensagem extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="mensagem_contacto";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'hash',
        'email',
        'assunto',
        'tipo_remetente',
        'mensagem',
        'num_identificacao'
    ];

}
