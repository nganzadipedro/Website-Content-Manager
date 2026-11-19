<?php

namespace App\Models\Fio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emolumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="emolumentos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'user_id'
    ];
}
