<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="municipio";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao'
    ];
}
