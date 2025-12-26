<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registoentrada extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="registo_entrada";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'proveniencia',
        'hash',
        'assunto',
        'codigo',
        'observacao',
        'data_entrada',
        'tipo_documento',
        'tipo_registo',
        'destinatario',
        'user_id',
        'estado',
        'numero',
        'nota_encaminhamento',
        'encaminhado'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
