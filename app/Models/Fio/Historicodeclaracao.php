<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historicodeclaracao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="historico_declaracao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'declaracao_id',
        'user_id'
    ];
    
}
