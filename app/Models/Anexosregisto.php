<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anexosregisto extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="anexos_registo_entrada";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'titulo',
        'hash',
        'observacao',
        'tipo_anexo',
        'anexo',
        'user_id',
        'registo_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getRegisto(){
        return $this->belongsTo(Registoentrada::class, 'registo_id', 'id');
    }

}
