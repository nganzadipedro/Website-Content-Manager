<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\Enoaa\Pessoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="professor";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'pessoa_id',
        'codigo'
    ];

    public function getPessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
    
}
