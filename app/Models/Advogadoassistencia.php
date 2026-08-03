<?php

namespace App\Models;

use App\Models\Platform\Advogado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advogadoassistencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="advogado_assist";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'advogado_assist_id',
        'nome_advogado',
        'categoria',
        'hash',
        'sexo',
        'e_falecido',
        'user_id'
    ];

    public function getadvogado()
    {
        return $this->belongsTo(Advogado::class, 'advogado_id');
    }

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
