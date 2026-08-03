<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistenciajudiciaria extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="assistencia_judiciaria";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'advogado_assist_id',
        'num_pedido',
        'data_registo_bd',
        'requerente',
        'hash',
        'sexo',
        'paroquia',
        'natureza',
        'nome_advogado',
        'situacao',
        'sexo_do_advogado',
        'user_id',
        'registo_entrada_id',
        'data_entrada_pedido',
        'data_envio_advogado',
        'data_recep_no_advogado',
        'data_conclusao',
        'forma_conclusao',
        'observacoes',
        'localizacao',
        'idade_requerente',
        'data_nascimento'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     public function getadvogado(){
        return $this->belongsTo(Advogadoassistencia::class, 'advogado_assist_id', 'id');
    }


    public function getregisto(){
        return $this->belongsTo(Registoentrada::class, 'registo_entrada_id', 'id');
    }

}
