<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\InscricaoRepository;
use App\Models\Curso;
use App\Models\Inscricao;
use App\Models\Turma;
use Illuminate\Http\Request;
use App\Lib\Traits\GeralTrait;
use App\Lib\Traits\UserTrait;
use App\Models\CursoInscricao;
use App\Models\Enoaa\Pessoa;

class PessoaController extends Controller
{

    public static function inserirPessoa($nome, $num_documento = null, $email,  $genero, $tel1, $tel2)
    {

        $encoding = mb_internal_encoding();
        $pessoa = Pessoa::create([
            'nome' => mb_strtoupper($nome, $encoding),
            'num_documento' => $num_documento,
            'email' => strtolower($email),
            'documento' =>'Bilhete de Identidade',
            'genero' => $genero,
            'telefone1' => $tel1,
            'telefone2' => $tel2
        ]);

        return $pessoa;
    }
}
