<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\InscricaoRepository;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    public function detalhesInscricao($id){
        $inscricao = Inscricao::find($id);
        if(Auth::user()->permissao_id == 2){
            return view('dashboard.admin-instituicao.ver-inscricao', compact('inscricao'));
        }
        else if(Auth::user()->permissao_id == 1){
            return view('dashboard.admin-sistema.ver-inscricao', compact('inscricao'));
        }
        else if(Auth::user()->permissao_id == 4){
            return view('dashboard.responsavel-turma.ver-inscricao', compact('inscricao'));
        }
    }

    public function getFormSuspender($id){
        $inscricao = Inscricao::find($id);
        if(Auth::user()->permissao_id == 2){
            return view('dashboard.admin-instituicao.form-suspender', compact('inscricao'));
        }
        else if(Auth::user()->permissao_id == 1){
            return view('dashboard.admin-sistema.form-suspender', compact('inscricao'));
        }
    }

    public function aprovarInscricao($id){
        $inscricao = Inscricao::findOrFail($id);
        $inscricao->estado = 'aprovado';
        $inscricao->save();
        return $inscricao;
    }

    public function suspenderInscricao(Request $request, $id){
        $inscricao = Inscricao::findOrFail($id);
        $inscricao->estado = 'suspenso';
        $inscricao->motivo_suspensao = $request->motivo;
        $inscricao->save();
        return $inscricao;
    }
}
