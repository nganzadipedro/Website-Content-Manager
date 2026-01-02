<?php

namespace App\Models;

use App\Models\Platform\Advogado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advogadoatribuido extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="advogados_atribuidos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'advogado_id',
        'registo_entrada_id',
        'observacao',
        'telefone',
        'email',
        'cedula',
        'nome_completo',
        'user_id'
    ];

    public function getadvogado()
    {
        return $this->belongsTo(Advogado::class, 'advogado_id');
    }

    public function getregistoentrada()
    {
        return $this->belongsTo(Registoentrada::class, 'registo_entrada_id');
    }

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
