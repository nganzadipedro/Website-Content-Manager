<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motivo extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "enoaa";
    protected $table="suspensao_motivos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
    ];
}
