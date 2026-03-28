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
    protected $table = "pedido_intervencao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hash',
        'advogado_id',
        'tipo_processo',
        'user_id',
        'nome',
        'num_documento',
        'num_cedula',
        'categoria',
        'email',
        'telefone1',
        'telefone2',
        'genero',
        'nome_patrono',
        'email_patrono',
        'telefone_patrono',
        'cedula_patrono',
        'nome_escritorio',
        'municipio_id',
        'endereco_escritorio',
        'documento_anexo',
        'motivo_rejeicao',
        'estado'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getadvogado()
    {
        return $this->belongsTo(Advogado::class, 'advogado_id', 'id');
    }

    public function getmunicipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

}
