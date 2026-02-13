<?php

namespace App\Models;

use App\Models\Platform\Advogado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedidointervencao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="pedido_intervencao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'advogado_id',
        'tipo_processo',
        'user_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getadvogado(){
        return $this->belongsTo(Advogado::class, 'advogado_id', 'id');
    }

}
