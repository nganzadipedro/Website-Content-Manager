<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pessoa";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'num_documento',
        'avatar',
        'email',
        'telefone1',
        'telefone2',
        'documento',
        'genero'
    ];
}
