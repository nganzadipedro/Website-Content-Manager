<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscricaoadvogado extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="inscricao_advogado";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'observacao',
        'observacao_distribuicao',
        'observacao_comissao_etica',
        'data_levantamento_distribuicao',
        'data_levantamento_comissao_etica',
        'data_entrega_distribuicao',
        'data_entrega_comissao_etica',
        'texto_despacho',
        'sexo',
        'acto_pretendido',
        'registo_entrada_id',
        'advogado_id',
        'tipo_processo_id',
        'acto_pretendido',
        'despacho',
        'user_id',
        'conselheiro_id',
        'telefone1',
        'telefone2',
        'email',
        'data_despacho',
        'data_cerimonia',
        'estado',
        'cedula_disponivel',
        'data_remessa_cn',
        'data_emissao_cedula',
        'numero',
        'numero_cedula',
        'estado_distribuicao',
        'codigo',
        'nome_patrono',
        'telefone_patrono',
        'email_patrono',
        'nome_escritorio',
        'endereco_escritorio',
        'cedula_patrono',
        'num_bilhete',
        'patrono_id',
        'municipio_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getconselheiro(){
        return $this->belongsTo(User::class, 'conselheiro_id', 'id');
    }

    public function getregistoentrada(){
        return $this->belongsTo(Registoentrada::class, 'registo_entrada_id', 'id');
    }

    public function patrono(){
        return $this->belongsTo(Patrono::class, 'patrono_id', 'id');
    }

}
