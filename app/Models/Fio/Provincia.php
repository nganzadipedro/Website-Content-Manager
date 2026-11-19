<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Pessoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provincia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="provincias";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'descricao',
        'estado'
    ];
    
}
