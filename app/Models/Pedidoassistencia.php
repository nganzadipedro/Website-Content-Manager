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
        'numero',
        'codigo',
        'observacao',
        'sexo',
        'natureza',
        'localizacao',
        'insitituicao_copia',
        'requerente',
        'advogado_substituido',
        'user_id',
        'registo_entrada_id',
        'pedido_referencia_id',
        'estado',
        'tipo_situacao_assistencia',
        'tipo_indicacao'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getregisto(){
        return $this->belongsTo(Registoentrada::class, 'registo_entrada_id', 'id');
    }

}
