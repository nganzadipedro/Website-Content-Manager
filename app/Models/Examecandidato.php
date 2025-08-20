<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examecandidato extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = "enoaa";
    protected $table = "exame_candidatos";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        "year_id",
        "candidato_id",
        "total",
        "avaliador",
        "perg_1",
        "perg_2",
        "perg_3",
        "perg_4",
        "perg_5",
        "perg_6",
        "perg_7",
        "perg_8",
        "perg_9",
        "perg_10",
        "perg_11",
        "perg_12",
        "perg_13",
        "perg_14",
        "perg_15",
        "perg_16",
        "perg_17",
        "perg_18",
        "perg_19",
        "perg_29",
        "perg_30",
        "perg_31",
        "perg_32",
        "perg_33",
        "perg_34",
        "perg_35",
        "perg_36",
        "perg_37",
        "perg_38",
        "perg_39",
        "perg_40",
        "perg_41",
        "perg_42",
        "perg_43",
        "perg_44",
        "perg_45",
        "perg_46",
        "perg_47",
        "perg_48",
        "perg_49",
        "perg_50",
        "perg_51",
        "perg_52",
        "perg_53",
        "perg_54",
        "perg_55",
        "perg_56",
        "perg_57",
        "perg_58",
        "perg_59",
        "perg_60",
        "candidatura_id"
    ];

    public function year()
    {
        return $this->belongsTo(Ano::class, 'year_id', 'id');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id', 'id');
    }

    public function candidatura()
    {
        return $this->belongsTo(Candidatura::class, 'candidatura_id', 'id');
    }

    public function avaliador()
    {
        return $this->belongsTo(User::class, 'avaliador_id', 'id');
    }
}
