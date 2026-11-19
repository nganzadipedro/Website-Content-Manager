<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pessoas";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'num_documento',
        'avatar',
        'email',
        'telefone1',
        'telefone2',
        'documento',
        'prov_residencia_id',
        'genero'
    ];
}
