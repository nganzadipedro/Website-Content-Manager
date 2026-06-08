<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrossel extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="carrossel";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'hash',
        'titulo',
        'imagem'
    ];

}
