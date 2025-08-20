<?php

namespace App\Lib\Repositories;

use Exception, Throwable;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Traits\UserTrait;
use App\Lib\Traits\GeralTrait;
use App\Lib\Interfaces\UserInterface;
use App\Models\Candidato;

use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidatura;
use App\Models\Curso;
use App\Models\CursoInscricao;
use App\Models\Inscricao;
use App\Models\Instituicao;
use App\Models\User;
use App\Models\UserCandidato;
use Illuminate\Support\Facades\Mail;

class CandidatoRepository
{

    use UserTrait;
    use GeralTrait;

    public function cadastrarCandidato(Request $request)
    {

        if ($this->validaBilhete($request->num_documento) == 'true') {
            if ($this->validaEmail($request->email) == 'true') {
                if ($this->validaTelefone($request->telefone) == 'true') {

                    DB::beginTransaction();
                    try {

                        $encoding = mb_internal_encoding();

                        $candidato = Candidato::create([
                            "nome_completo"   => mb_strtoupper($request->nome_completo, $encoding),
                            "num_documento"   => $request->num_documento,
                            "genero"   => $request->genero,
                            "naturalidade"   => $request->naturalidade,
                            "data_nascimento"   => $request->data_nascimento,
                            "telefone"   => $request->telefone,
                            "municipio"   => $request->municipio,
                            "endereco"   => $request->endereco,
                            "escola_ensino_medio"   => $request->escola_ensino_medio,
                            "email"   => strtolower($request->email)
                        ]);

                        // pega a instituição
                        $instituicao = Instituicao::find($request->unidade1);
                        // cria o código identificador do candidato
                        $codigo_candidato = 'UL-'. $instituicao->codigo.'-' . $candidato->id . '-' . $this->getAnoActivo();

                        $ano_exame = $this->getAnoActivo();

                        // faz upload dos documentos
                        $p_comprovativo = '';
                        $p_bi = '';
                        $p_certificado = '';

                        // comprovativo
                        try {
                            if ($request->hasFile('comprovativo_pagamento') && $request->file('comprovativo_pagamento')->isValid()) {
                                $p_comprovativo = $request->comprovativo_pagamento->storeAs('candidatos/' . $ano_exame . '/' . $codigo_candidato, 'comprovativo_' . $candidato->id . '.pdf');
                            }
                        } catch (Throwable $error) {
                            // throw new Exception($error);
                        }

                        // bilhete
                        try {
                            if ($request->hasFile('doc_bi') && $request->file('doc_bi')->isValid()) {
                                $p_bi = $request->doc_bi->storeAs('candidatos/' . $ano_exame . '/' . $codigo_candidato, 'bilhete_' . $candidato->id . '.pdf');
                            }
                        } catch (Throwable $error) {
                            // throw new Exception($error);
                        }

                        // certificado
                        try {
                            if ($request->hasFile('doc_certificado') && $request->file('doc_certificado')->isValid()) {
                                $p_certificado = $request->doc_certificado->storeAs('candidatos/' . $ano_exame . '/' . $codigo_candidato, 'certificado_' . $candidato->id . '.pdf');
                            }
                        } catch (Throwable $error) {
                            // throw new Exception($error);
                        }

                        // salva no banco de dados
                        $candidato->comprovativo_pagamento = $p_comprovativo;
                        $candidato->doc_bi = $p_bi;
                        $candidato->doc_certificado = $p_certificado;
                        $candidato->codigo = $codigo_candidato;
                        $candidato->hash = md5($codigo_candidato . $candidato->num_documento);
                        $candidato->save();

                        $curso1 = Curso::findOrFail($request->curso1);
                        $curso2 = $request->curso2;

                        if ($curso2 != 'null' && $curso2 != null && $curso2 != '' && $curso2 > 0) {
                            $curso2 = Curso::findOrFail($request->curso2);
                        } else {
                            $curso2 = null;
                        }

                        $inscricao = Inscricao::create([
                            "ano_id"   => $this->getIdAnoActivo(),
                            "candidato_id"   => $candidato->id,
                            "estado"   => 'pendente'
                        ]);

                        $curso_inscricao = CursoInscricao::create([
                            "inscricao_id"   => $inscricao->id,
                            "curso_id"   =>  $curso1->id
                        ]);

                        if ($curso2 != null) {
                            $curso_inscricao = CursoInscricao::create([
                                "inscricao_id"   => $inscricao->id,
                                "curso_id"   =>  $curso2->id
                            ]);
                        }



                        $ob = new UserCandidatoRepository();
                        $ob->createUser($candidato->id, $candidato->nome_completo, $candidato->num_documento, $candidato->email, $candidato->telefone, $candidato->codigo);

                        DB::commit();
                        return $candidato;
                    } catch (Throwable $error) {
                        DB::rollBack();
                        throw new Exception($error);
                    }
                }
                else{
                    return 'telefone';
                }
            }
            else{
                return 'email';
            }
        }
        else{
            return 'bilhete';
        }
    }

    public function updateCandidato(Request $request)
    {

        DB::beginTransaction();
        try {

            $candidato = Candidato::findOrFail($request->id);

            $candidato->update([
                "nome_completo"   => strtoupper($request->nome_completo),
                "documento"   => $request->documento,
                "num_documento"   => $request->num_documento,
                "genero"   => $request->genero,
                "nacionalidade"   => $request->nacionalidade,
                "naturalidade"   => $request->naturalidade,
                "provincia_id"   => $request->provincia_id,
                "municipio"   => $request->municipio,
                "necessidade_especial"   => $request->necessidade_especial,
                "endereco"   => $request->endereco,
                "provincia_exame"   => $request->provincia_exame,
                "email"   => strtolower($request->email),
                "tel1"   => $request->tel1,
                "tel2"   => $request->tel2,
                "instituicao_estudo" => $request->instituicao_estudo
            ]);

            $codigo_candidato = $candidato->codigo;

            // faz upload dos documentos
            $p_bilhete = '';
            $p_diploma = '';
            $ano_exame = $this->getAnoActivo();

            // bilhete
            try {
                if ($request->hasFile('doc_bi') && $request->file('doc_bi')->isValid()) {
                    $p_bilhete = $request->doc_bi->storeAs('candidatos/' . $ano_exame . '/' . $codigo_candidato, 'doc_identificação_' . $candidato->id . '.pdf');

                    $candidato->doc_bi = $p_bilhete;
                    $candidato->save();
                }
            } catch (Throwable $error) {
                // throw new Exception($error);
            }

            // diploma
            try {
                if ($request->hasFile('doc_diploma') && $request->file('doc_diploma')->isValid()) {
                    $p_diploma = $request->doc_diploma->storeAs('candidatos/' . $ano_exame . '/' . $codigo_candidato, 'doc_licenciatura_' . $candidato->id . '.pdf');

                    $candidato->doc_diploma = $p_diploma;
                    $candidato->save();
                }
            } catch (Throwable $error) {
                // throw new Exception($error);
            }

            DB::update("update candidaturas set estado = 'pendente' where candidato_id = {$candidato->id}");

            DB::commit();
            return $candidato;
        } catch (Throwable $error) {
            DB::rollBack();
            throw new Exception($error);
        }
    }

    public function validaEmail($email)
    {
        $result = Candidato::where("email", "=", "{$email}")->get();
        if (count($result) >= 2) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaTelefone($telefone)
    {
        $result = Candidato::where("telefone", "=", "{$telefone}")->get();
        if (count($result) >= 2) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaBilhete($bilhete)
    {
        $result = Candidato::where("num_documento", "=", "{$bilhete}")->get();
        if (count($result) >= 2) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaBilhete2($bilhete, $id)
    {
        $result = DB::select("select * from candidatos where (num_documento = '{$bilhete}' and id != {$id})");

        if ($result == null) {
            return 'true';
        } else if (count($result) > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaEmail2($email, $id)
    {
        $result = DB::select("select * from candidatos where (email = '{$email}' and id != {$id})");

        if ($result == null) {
            return 'true';
        } else if (count($result) > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function validaTelefone2($telefone, $id)
    {
        $result = DB::select("select * from candidatos where (tel1 = '{$telefone}' and id != {$id})");

        if ($result == null) {
            return 'true';
        } else if (count($result) > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }


    public function getCandidaturaById($id)
    {
        $candidatura = DB::select("select * from vw_candidaturas where id = {$id}");
        return $candidatura;
    }

    public function getCandidatoById($id)
    {
        $candidato = DB::select("select * from vw_candidaturas where candidato_id = {$id}");
        return $candidato[0];
    }

    public function getCandidatoByHash($hash)
    {
        $candidato = DB::select("select * from vw_candidaturas where hash = '{$hash}'");
        return $candidato != null ? $candidato[0] : null;
    }

    public function getCandidatoLogado()
    {
        $id_user = Auth::user()->id;
        $candidato = UserCandidato::where("user_id", "=", "{$id_user}")->first();
        $candidato = Candidato::where("id", "=", "{$candidato->candidato_id}")->first();
        return $candidato;
    }
}
