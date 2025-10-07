<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\CursoRepository;
use App\Models\Curso;
use App\Models\Fio\Atribuicaoalunoprova;
use App\Models\Fio\Avaliacaoaluno;
use App\Models\Fio\Pagamento;
use App\Models\Fio\Actividadesistema;
use Illuminate\Http\Request;
use App\Lib\Traits\UserTrait;
use App\Models\AdminInstituicao;
use App\Models\Candidato;
use App\Models\Candidatura;
use App\Models\CoordenadorCurso;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Aluno;
use App\Models\Fio\Turma;
use App\Models\Fio\Formacao;
use App\Models\Fio\Alunoformacao;
use App\Models\Enoaa\Pessoa;
use App\Models\Provincia;
use App\Models\ResponsavelTurma;
use App\Http\Controllers\ActividadesistemaController;
use App\Http\Controllers\ProxyPayController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{

    public function register_member(){

        return view('auth.inscricao');

    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function insertAdmin()
    {
        $pessoa = PessoaController::inserirPessoa('Nganzadi Nsimba Pedro', '005691422BO048', 'nganzadipedro.emp@gmail.com', 'Bilhete de Identidade', 'Masculino', '941451449', null);
        $usuario = User::create([
            'primeiro_acesso' => 'Sim',
            'ativo' => 'Sim',
            'password' => md5('EN' . $pessoa->id . 'OAA'),
            'permission_id' => 1,
            'pessoa_id' => $pessoa->id
        ]);

        $usuario->hash = md5($usuario->id . $usuario->password);
        $usuario->save();
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
