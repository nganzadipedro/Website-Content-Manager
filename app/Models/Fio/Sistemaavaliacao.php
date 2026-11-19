<?php

namespace App\Models\Fio;

use App\Models\Enoaa\Ano;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sistemaavaliacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "mysql";
    protected $table="sistema_avaliacao";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'disciplina_id',
        'hash',
        'criterio_resultado_final',
        'qtd_notas_lancar',
        'qtd_provas',
        'percent_nota1',
        'percent_nota2',
        'prov_seg_nota',
        'tipo_prova',
        'professor_id',
        'turma_id',
        'user_id'
    ];

    public function getprofessor(){
        return $this->belongsTo(Professor::class, 'professor_id', 'id');
    }

    public function getdisciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id', 'id');
    }

    public function getturma(){
        return $this->belongsTo(Turma::class, 'turma_id', 'id');
    }

    public function getuser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
