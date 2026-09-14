<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentoaj extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="documentoaj";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'pedido_assistencia_id',
        'hash',
        'user_id',
        'assinado',
        'hash_control'
    ];

     public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function registoentrada(){
        return $this->belongsTo(Registoentrada::class, 'registoentrada_id', 'id');
    }

}
