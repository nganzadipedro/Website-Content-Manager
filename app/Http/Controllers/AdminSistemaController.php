<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\InscricaoRepository;
use App\Models\Curso;
use App\Models\Inscricao;
use App\Models\Turma;
use Illuminate\Http\Request;
use App\Lib\Traits\GeralTrait;
use App\Models\Ano;
use App\Models\CursoInscricao;
use App\Models\Instituicao;
use App\Models\Permissao;
use App\Models\Provincia;
use App\Models\User;
use \PDF;
use Illuminate\Support\Facades\DB;

class AdminSistemaController extends Controller
{

    public function gerar_resultado_exame(Request $request)
    {

        $string_query = "select * from vw_exames_relatorio where estado = 'terminado'";
        $nome_relatorio = 'resultados_exames';
        $desc_provincia = '';

        if ($request->exame != null) {

            if ($request->exame == 'geral') {
                $nome_relatorio .= '_geral';
                $desc_provincia = 'GERAL';
            } else {
                $string_query .= " and provincia_exame = {$request->provincia_exame_id}";
                $provincia = Provincia::findOrFail($request->provincia_exame_id);
                $desc_provincia = $provincia->descricao;
                $nome_relatorio .= '_' . $desc_provincia;
            }

            $result = DB::select($string_query);

            if ($request->ficheiro == 'pdf') {
                $pdf = PDF::loadView('dashboard.documents-pdf.resultado-exame', compact('result', 'desc_provincia'));
                return $pdf->download($nome_relatorio . '.pdf');
            } else {
                return Excel::download(new ResultadosExameExport($string_query), $nome_relatorio . '.xlsx');
            }
        }
    }

    public function gerar_relatorio(Request $request)
    {

        $string_query = 'select * from';
        $tipo = '';
        $filtros = '';
        $nome_relatorio = 'lista_candidatos';
        $ano = Ano::where('estado', 'Activo')->first();
        $id_ano = $ano->id;
        $desc_ano = $ano->descricao;

        if ($request->tipo != null) {
            if ($request->tipo == 'aprovadas') {
                $string_query .= ' vw_cand_aprovadas';
                $tipo = 'APROVADAS';
                $nome_relatorio .= '_aprovados';
            } else if ($request->tipo == 'pagas') {
                $string_query .= ' vw_cand_pagas';
                $tipo = 'PAGAS';
                $nome_relatorio .= '_pagas';
            } else if ($request->tipo == 'suspensas') {
                $string_query .= ' vw_cand_suspensas';
                $tipo = 'SUSPENSAS';
                $nome_relatorio .= '_suspensas';
            } else if ($request->tipo == 'pendentes') {
                $string_query .= ' vw_cand_pendentes';
                $tipo = 'PENDENTES';
                $nome_relatorio .= '_pendentes';
            } else if ($request->tipo == 'todas') {
                $string_query .= ' vw_candidaturas';
                $tipo = 'GERAL';
                $nome_relatorio .= '_geral';
            }

            if ($request->filtro_provincia != null) {
                if ($request->provincia_exame != null) {

                    $string_query .= ' where provincia_exame = ' . $request->provincia_exame;

                    $provincia = Provincia::find($request->provincia_exame);
                    $filtros = 'Província: ' . $provincia->descricao;

                    if ($request->filtro_necessidade != null) {
                        $string_query .= ' and necessidade_especial != \'Não\'';
                        $filtros .= '; Com Necessidade Especial';
                    } else {
                        $string_query .= ' and necessidade_especial != \'Sim\'';
                        $filtros .= '; Sem necessidade especial';
                    }

                    $string_query .= " and year_id = $id_ano";
                }
            } else if ($request->filtro_necessidade != null) {

                $string_query .= ' where necessidade_especial != \'Não\'';
                $filtros = 'Com necessidade especial';
                $string_query .= " and year_id = $id_ano";
            }
            else{
                $string_query .= " where year_id = $id_ano";
            }

            $result = DB::select($string_query);

            $pdf = PDF::loadView('documents-pdf.lista-relatorio', compact('result', 'tipo', 'filtros', 'desc_ano'));
            return $pdf->download($nome_relatorio . '.pdf');
        }
    }

    public function relatorios(){

        $provincias = Provincia::all();
        return view('dashboard.admin.relatorios.index', compact('provincias'));

    }
}
