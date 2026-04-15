<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historicoprocesso extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="historico_processo";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'operacao',
        'registoentrada_id',
        'user_id'
    ];

     public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function registoentrada(){
        return $this->belongsTo(Registoentrada::class, 'registoentrada_id', 'id');
    }

}
