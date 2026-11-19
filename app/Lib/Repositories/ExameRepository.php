<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\UserTrait;
use App\Models\Candidato;
use App\Models\Emolumento;
use App\Models\Solicitacao;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;
use App\Models\Disciplina;
use App\Models\Exame;
use App\Models\UserCandidato;

class ExameRepository
{

    use UserTrait;

    public function cadastrarExame(Request $request)
    {

        DB::beginTransaction();
        try {

            $exame = Exame::create([
                "year_id"   => $this->getIdAnoActivo(),
                "disciplina_id"   =>  $request->disciplina_id,
                "opcao_a"   => $request->opcao_a,
                "opcao_b"   => $request->opcao_b,
                "opcao_c"   => $request->opcao_c,
                "opcao_d"   => $request->opcao_d,
                "opcao_e"   => $request->opcao_e,
                "desc_pergunta"   => $request->desc_pergunta,
                "pontuacao"   => $request->pontuacao,
                "numero"   => $request->numero,
                "resposta"   => $request->resposta,
                "hash_resposta"   => md5($request->resposta)
            ]);

            $disciplina = Disciplina::findOrFail($request->disciplina_id);
            // cria o código identificador do candidato
            $codigo_pergunta = 'Q-' . $disciplina->codigo . $exame->numero . '-' .  $this->getAnoActivo();

            // salva no banco de dados
            $exame->codigo = $codigo_pergunta;
            $exame->hash = md5($codigo_pergunta);
            $exame->save();

            DB::commit();
            return $exame;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

    public function updateExame(Request $request, $id)
    {

        $exame = Exame::findOrFail($id);

        DB::beginTransaction();
        try {

            $exame->update([
                "opcao_a"   => $request->opcao_a,
                "disciplina_id"   =>  $request->disciplina_id,
                "opcao_b"   => $request->opcao_b,
                "opcao_c"   => $request->opcao_c,
                "opcao_d"   => $request->opcao_d,
                "opcao_e"   => $request->opcao_e,
                "desc_pergunta"   => $request->desc_pergunta,
                "numero"   => $request->numero,
                "pontuacao"   => $request->pontuacao,
                "resposta"   => $request->resposta,
                "hash_resposta"   => md5($request->resposta)
            ]);

            $disciplina = Disciplina::findOrFail($request->disciplina_id);
            // cria o código identificador do candidato
            $codigo_pergunta = 'Q-' . $disciplina->codigo . $exame->numero . '-' .  $this->getAnoActivo();

            // salva no banco de dados
            $exame->codigo = $codigo_pergunta;
            $exame->hash = md5($codigo_pergunta);
            $exame->save();

            DB::commit();
            return $exame;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

    public function getQuestaoById($id)
    {
        $exame = Exame::with(["year", "disciplina"])->findOrFail($id);
        return $exame;
    }

    public function getQuestaoByHash($hash)
    {
        $exame = DB::select("select * from exames where hash = '{$hash}'");
        return $exame[0];
    }

    public function getAnoActivo()
    {
        $result = Year::where("estado", "=", "1")->get();
        return $result[0]->descricao;
    }

    public function getIdAnoActivo()
    {
        $result = Year::where("estado", "=", "1")->get();
        return $result[0]->id;
    }

    public function getUltimoNumeroQuestao()
    {
        $result = DB::select("select max(numero) as numero from exames where year_id = {$this->getIdAnoActivo()}");

        if ($result == null) {
            return 0;
        }
        return $result[0]->numero;
    }

    public function getAll()
    {
        $exames = Exame::with(["year", "disciplina"])->get();
        return $exames;
    }

    public function getAllByDisciplina($id)
    {
        $exames = Exame::with(["year", "disciplina"])->where("disciplina_id", "=", "{$id}")->get();
        return $exames;
    }

    public function validaNumPergunta($numero, $grupo){

        $result = DB::select("select * from exames where year_id = {$this->getIdAnoActivo()} and numero = {$numero} and disciplina_id = {$grupo}");

        if($result == null){
            return 'true';
        }
        else if (count($result) > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaNumPerguntaEditar($numero, $grupo, $id){

        $result = DB::select("select * from exames where year_id = {$this->getIdAnoActivo()} and numero = {$numero} and disciplina_id = {$grupo} and id != {$id}");

        if($result == null){
            return 'true';
        }
        else if (count($result) > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

}
