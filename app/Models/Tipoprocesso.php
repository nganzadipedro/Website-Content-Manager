<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipoprocesso extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="tipo_processo";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'codigo',
        'user_id'
    ];
}
