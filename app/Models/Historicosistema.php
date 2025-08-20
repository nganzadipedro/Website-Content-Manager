<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historicosistema extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="historico_sistema";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'operacao',
        'destino_id',
        'destino',
        'user_id'
    ];
}
