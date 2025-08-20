<?php

namespace App\Models\Enoaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCandidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'candidato_id'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCandidato(){
        return $this->belongsTo(Candidato::class, 'candidato_id', 'id');
    }
}
