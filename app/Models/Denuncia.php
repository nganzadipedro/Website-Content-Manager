<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="denuncia_reclamacao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'hash',
        'assunto',
        'mensagem',
        'ficheiro'
    ];

}
