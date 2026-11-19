<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Candidatura;
use Illuminate\Support\Facades\Storage;
use App\Models\CursoInscricao;
use App\Models\Enoaa\Ano;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Pessoa;
use App\Models\Provincia;
use App\Models\UserCandidato;
use Illuminate\Support\Facades\Auth;

class PainelCandidatoController extends Controller
{

    public function index()
    {

        $user_logado = UserCandidato::where('user_id', Auth::user()->id)->first();
        $candidato = $user_logado->getCandidato();
        return view('dashboard.painel-candidato.index', compact('candidato', 'user_logado'));
    }

    public function candidatura()
    {

        $user_logado = UserCandidato::where('user_id', Auth::user()->id)->first();
        $inscricao = Inscricao::where('candidato_id', $user_logado->candidato_id)->first();
        return view('dashboard.painel-candidato.ver-inscricao', compact('inscricao'));
    }

    public function dadosExameAcesso()
    {

        $user_logado = UserCandidato::where('user_id', Auth::user()->id)->first();
        $inscricao = Inscricao::where('candidato_id', $user_logado->candidato_id)->first();
        $curso_inscricao = CursoInscricao::where('inscricao_id', $inscricao->id)->first();
        return view('dashboard.painel-candidato.ver-dados-exame', compact('inscricao', 'curso_inscricao'));
    }

    public function verDocumentos($id, $tipo)
    {

        $candidatura = Candidaturaformacao::find($id);
        $ano = Ano::where('estado', 'Activo')->first();

        if ($tipo == 'identificação') {
            return $this->verDocumento($candidatura->bilhete_identidade);
        } else if ($tipo == 'cedula') {
            return $this->verDocumento($candidatura->cedula_advogado);
        } else if ($tipo == 'ficha') {

            $path = Storage::disk('public')->path("candidatos/" . $ano->descricao . "/" . $candidatura->codigo . "/" . 'ficha_candidato_' . $candidato->id . ".pdf");
            $content = file_get_contents($path);

            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path),
                'title' => $candidato->getPessoa->nome
            ]);
        }
    }

    public function verDocumento($documento)
    {
        // dd($documento);

        $path = Storage::disk('public')->path("" . $documento);
        $content = file_get_contents($path);

        return response($content)->withHeaders([
            'Content-Type' => mime_content_type($path),
            'title' => $documento
        ]);
    }

    public function getFormularioEditar($hash)
    {
        $candidato = Pessoa::find(Auth::user()->pessoa_id);

        $candidatura = Candidatura::where('hash', $hash)->first();
        $candidato = $candidatura->getCandidato;
        $provincias = Provincia::all();
        return view('dashboard.candidato.editar-candidatura', compact('candidatura', 'candidato', 'provincias'));
    }
}
