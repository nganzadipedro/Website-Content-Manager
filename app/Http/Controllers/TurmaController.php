<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use App\Lib\Traits\GeralTrait;
use App\Lib\Traits\UserTrait;
use App\Models\CandidatoTurma;
use App\Models\CursoInscricao;
use App\Models\Inscricao;

class TurmaController extends Controller
{

    use GeralTrait;
    use UserTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {

        $turma = Turma::create([
            "descricao" => $request->descricao,
            "sala_exame" => $request->sala_exame,
            "data_exame" => $request->data_exame,
            "hora_exame" => $request->hora_exame,
            "ano_id" => $this->getIdAnoActivo(),
            "curso_id" => $request->curso_id
        ]);

        return $turma;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Turma::find($id);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAll()
    {
        return Turma::all();
    }

    public function getByInstituicao()
    {
        $user_logado = $this->getUserLogado();
        $id_instituicao = $user_logado->instituicao_id;
        
        return Turma::with("getCurso")->whereHas('getCurso', function ($query) use ($id_instituicao) {
            $query->where('instituicao_id', $id_instituicao);
        })->get();
    }

    public function getTotalTurmasByCurso($curso){
        
        $id_ano = $this->getIdAnoActivo();
        $turmas = Turma::where("curso_id", $curso)->where("ano_id", $id_ano)->get();
        $inscricoes = CursoInscricao::with("getInscricao")->whereHas('getInscricao', function ($query) use ($id_ano){
            $query->where('ano_id', $id_ano);
        })->where("curso_id", $curso)->whereNull('turma_id')->get();

        return $dados = [
            'turmas' => count($turmas),
            'candidatos' => count($inscricoes)
        ];
    }

    public function getTurmasByCurso($curso){
        $id_ano = $this->getIdAnoActivo();
        $turmas = Turma::where("curso_id", $curso)->where("ano_id", $id_ano)->get();
        return $turmas;
    }

    public function getTurmasCurrentInstituicao(){

        $id_ano = $this->getIdAnoActivo();
        return Turma::with('getCurso')->whereHas('getCurso', function ($query) use ($id_ano){
            $query->where('instituicao_id', $this->getInstituicaoLogado()->id);
        })->get();
    }

    public function distribuirTurmas($curso){

        $id_ano = $this->getIdAnoActivo();
        $turmas = Turma::where("curso_id", $curso)->where("ano_id", $id_ano)->get();
        $inscricoes = CursoInscricao::with("getInscricao")->whereHas('getInscricao', function ($query) use ($id_ano){
            $query->where('ano_id', $id_ano)->where('estado', 'aprovado');
        })->where("curso_id", $curso)->whereNull('turma_id')->get();

        $ar_turmas = [];
        $i = 1;
        $tam = count($turmas);

        foreach($turmas as $t){
            $ar_turmas[$i] = $t->id;
            $i++;
        }

        $i = 1;
        foreach($inscricoes as $linha){

            if($i > $tam){
                $i = 1;
            }

            $inscricao = CursoInscricao::find($linha->id);
            $inscricao->turma_id = $ar_turmas[$i];
            $inscricao->save();
            
            $i++;
        }

        return true;
    }
}
