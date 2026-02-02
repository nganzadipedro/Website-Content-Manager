<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidoassistencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pedido_assistencia";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'observacao',
        'numero',
        'codigo',
        'sexo',
        'natureza',
        'localizacao',
        'user_id',
        'registo_entrada_id',
        'estado',
        'nota_encaminhamento',
        'encaminhado'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getregisto(){
        return $this->belongsTo(Registoentrada::class, 'registo_entrada_id', 'id');
    }

}
