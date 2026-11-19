<?php

namespace App\Models\Fio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="disciplina";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'user_id'
    ];
}
