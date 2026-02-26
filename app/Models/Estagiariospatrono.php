<?php

namespace App\Models;

use App\Models\Platform\Advogado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estagiariospatrono extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="estagiarios_patrono";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'estagiario_id',
        'nome_estagiario',
        'inscricao_advogado_id',
        'patrono_id',
        'estado',
        'user_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getpatrono(){
        return $this->belongsTo(Patrono::class, 'patrono_id', 'id');
    }

    public function getestagiario(){
        return $this->belongsTo(Advogado::class, 'estagiario_id', 'id');
    }

    public function getinscricao(){
        return $this->belongsTo(Inscricaoadvogado::class, 'inscricao_advogado_id', 'id');
    }

}
