<?php

namespace App\Models\Fio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividadesistema extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "seguranca";
    protected $table="actividades_sistema";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'operacao',
        'origem',
        'destino',
        'destino_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
