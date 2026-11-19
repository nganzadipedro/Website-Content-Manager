<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table="years";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'estado'
    ];
}
