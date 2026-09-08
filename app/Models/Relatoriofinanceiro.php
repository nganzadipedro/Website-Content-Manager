<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relatoriofinanceiro extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="relatorio_financeiro";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'ano',
        'trimestre',
        'categoria',
        'slug',
        'hash',
        'documento_anexo',
        'user_id',
        'qtd_download'
    ];

}
