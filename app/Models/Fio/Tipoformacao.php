<?php

namespace App\Models\Fio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipoformacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="tipoformacao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'user_id'
    ];
}
