<?php

namespace App\Models;

use App\Models\Platform\Advogado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrono extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="patrono";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'advogado_id',
        'nome',
        'telefone',
        'email',
        'nome_escritorio',
        'endereco_escritorio',
        'municipio_id',
        'user_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getadvogado(){
        return $this->belongsTo(Advogado::class, 'advogado_id', 'id');
    }

    public function getmunicipio(){
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

}
