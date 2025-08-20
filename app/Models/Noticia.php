<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="noticia";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'hash',
        'titulo',
        'texto_resumo',
        'texto_completo',
        'e_destaque',
        'imagem',
        'views'
    ];

}
