<?php

namespace App\Http\Controllers;

use App\Exports\Listaaguardacerimoniaexport;
use App\Exports\Listaestindicacaopatrono;
use App\Exports\Listaindefinidosexport;
use App\Exports\Listaestagiariosexport;
use App\Exports\Listaadvogadosexport;
use App\Exports\Listaremessacnexport;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Inscricaoadvogado;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use \PDF;

class AdvogadoController extends Controller
{

    public function update_data(Request $request)
    {

        $advogado = Advogado::find($request->advogado_id);
        $pessoa = Pessoa::find($advogado->pessoa_id);

        // verifica duplicidade do email
        $res = Pessoa::where('email', $request->email)
            ->where('id', '!=', $pessoa->id)->first();

        if ($res != null) {
            return 'email';
        }

        // verifica se tem número de documento duplicado
        $res = Pessoa::where('num_documento', $request->num_documento)
            ->where('id', '!=', $pessoa->id)->first();

        if ($res != null) {
            return 'num_documento';
        }

        // verifica cédulas duplicadas
        $res = Advogado::where('num_associado', $request->num_associado)
            ->where('pessoa_id', '!=', $pessoa->id)->first();

        if ($res != null) {
            return 'num_associado';
        }

        $res = Advogado::where('num_estagiario', $request->num_estagiario)
            ->where('pessoa_id', '!=', $pessoa->id)->first();

        if ($res != null) {
            return 'num_estagiario';
        }

        $pessoa->nome = strtoupper($request->nome);
        $pessoa->genero = $request->genero;
        $pessoa->num_documento = $request->num_documento;
        $pessoa->email = $request->email;
        $pessoa->telefone1 = $request->telefone1;
        $pessoa->telefone2 = $request->telefone2;
        $pessoa->documento = $request->documento;
        $pessoa->save();

        $advogado->categoria = $request->categoria;
        $advogado->num_associado = $request->num_associado;
        $advogado->num_estagiario = $request->num_estagiario;
        $advogado->save();

        if ($request->categoria == 'Estagiario') {
            $advogado->nome_patrono = $request->nome_patrono;
            $advogado->email_patrono = $request->email_patrono;
            $advogado->telefone_patrono = $request->telefone_patrono;
            $advogado->nome_escritorio = $request->nome_escritorio;
            $advogado->endereco_escritorio = $request->endereco_escritorio;
            $advogado->save();
        }

        ActividadesistemaController::inserir(Auth::id(), "Actualizou os dados do advogado ($pessoa->nome)", 'geral', $pessoa->id);
        return 'sucesso';

    }

    public function export_undefined()
    {

        $nome_file = 'lista_advogados_por_especificar';
        return Excel::download(new Listaindefinidosexport(), $nome_file . '.xlsx');

    }

    public function export_trainees()
    {

        $nome_file = 'lista_advogados_estagiarios';
        return Excel::download(new Listaestagiariosexport(), $nome_file . '.xlsx');

    }

    public function export_lawyers()
    {

        $nome_file = 'lista_advogados';
        return Excel::download(new Listaadvogadosexport(), $nome_file . '.xlsx');

    }

    public function export_waiting_cerimony($categoria)
    {

        $nome_file = 'lista_aguardando_cerimonia_' . $categoria;
        return Excel::download(new Listaaguardacerimoniaexport($categoria), $nome_file . '.xlsx');
    }

    public function export_remessa_cn(Request $request)
    {
        $nome_file = 'lista_inscricoes_estagiarios_remetidos_cn';
        return Excel::download(new Listaremessacnexport($request->data_remessa_cn, $request->tipo_processo), $nome_file . '.xlsx');
    }

    public function export_xls_indicacao_patrono(Request $request)
    {
        $nome_file = 'lista_inscricoes_estagiarios_indicacao_patrono';
        return Excel::download(new Listaestindicacaopatrono(), $nome_file . '.xlsx');
    }

    public function lista_estagiarios_remessacn()
    {

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', 3)
            ->whereNotNull('inscricao_advogado.data_remessa_cn')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $num_candidatos = count($result);

        // processo de emissão de documento de despacho
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.lista-remessa-cn', [
            'inscricoes' => $result,
            'num_candidatos' => $num_candidatos,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function export_pdf_lista_estagiarios_remessacn(Request $request)
    {

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', $request->tipo_processo)
            ->where('inscricao_advogado.data_remessa_cn', $request->data_remessa_cn)
            ->whereNotNull('inscricao_advogado.data_remessa_cn')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $num_candidatos = count($result);

        // processo de emissão de documento de despacho
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.lista-remessa-cn', [
            'inscricoes' => $result,
            'num_candidatos' => $num_candidatos,
            'tipo_processo' => $request->tipo_processo,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->output();
        // }, 'lista_remessa_cn.pdf');

    }

    public function export_pdf_indicacao_patrono(Request $request)
    {

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', 3)
            ->where('inscricao_advogado.acto_pretendido', 'Indicação de Patrono')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $num_candidatos = count($result);

        // processo de emissão de documento de despacho
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.lista-indicacao-patrono', [
            'inscricoes' => $result,
            'num_candidatos' => $num_candidatos,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->output();
        // }, 'lista_remessa_cn.pdf');

    }

    public function export_pdf_entrega_conselheiro(Request $request)
    {

        $lista = Inscricaoadvogado::where('conselheiro_id', $request->conselheiro_id)
            ->where('data_levantamento_distribuicao', $request->data_entrega)
            ->get();

        $conselheiro = User::find($request->conselheiro_id);
        $nome_conselheiro = $conselheiro->getpessoa->nome;

        // processo de emissão de documento de despacho
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.termo-entrega', [
            'lista' => $lista,
            'nome_conselheiro' => $nome_conselheiro
        ]);

        return $pdf->stream();

    }

    public function lista_aguardando_cerimonia($categoria)
    {

        $result = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', $categoria)
            ->select('app_advogado.*')
            ->orderBy('pessoa.nome', 'asc')
            ->get();

        $num_candidatos = count($result);

        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.pdf-lista-cerimonia', [
            'candidatos' => $result,
            'categoria' => $categoria == 'Advogado' ? 'advogados' : 'advogados estagiários',
            'num_candidatos' => $num_candidatos,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function export_pdf_relatorio_area_tecnica(Request $request)
    {

        $data_inicial = $request->input('data_inicial') . " 00:00:00";
        $data_final = $request->input('data_final') . " 23:59:59";

        $pea = Registoentrada::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->count();

        $peae = Registoentrada::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->count();

        $processosAdvogados = [];
        $processosAdvogadosEstagiarios = [];

        $processosAdvogados['pendentes'] = Registoentrada::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'pendente')
            ->count();

        $processosAdvogados['pendentes'] += Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado_distribuicao', 'Por Distribuir')
            ->count();

        $processosAdvogados['execucao'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado_distribuicao', 'Distribuido')
            ->where('estado', 'análise de conselheiro')
            ->count();

        $processosAdvogados['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'análise comissão de ética')
            ->count();

        $processosAdvogados['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'Sobre a mesa do Presidente')
            ->whereNull('despacho')
            ->count();

        $processosAdvogados['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('despacho', 'Indeferido')
            ->count();

        $processosAdvogados['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'remetido ao CN')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogados['remetidocn'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'remetido ao CN')
            ->count();

        $processosAdvogados['cerimonia'] = Advogado::
            where('estado', 'Aguarda Cerimónia')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Advogado')
            ->whereNull('data_cerimonia_associado')
            ->count();

        $processosAdvogados['cedula'] = Advogado::
            whereNotNull('data_cerimonia_associado')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Advogado')
            ->count();

        $processosAdvogados['total'] = $processosAdvogados['pendentes'] +
            $processosAdvogados['execucao'] +
            $processosAdvogados['remetidocn'] +
            $processosAdvogados['cerimonia'] +
            $processosAdvogados['cedula'];

        $processosAdvogadosEstagiarios['pendentes'] = Registoentrada::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'pendente')
            ->count();



        $processosAdvogadosEstagiarios['execucao'] = Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'Sobre a mesa do Presidente')
            ->where('acto_pretendido', '!=', 'Indicação de Patrono')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogadosEstagiarios['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('despacho', 'Indeferido')
            ->where('acto_pretendido', '!=', 'Indicação de Patrono')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogadosEstagiarios['execucao'] += Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('acto_pretendido', 'Indicação de Patrono')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogadosEstagiarios['remetidocn'] = Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('cedula_disponivel', 'Não')
            ->where('despacho', 'Deferido')
            ->where('estado', 'remetido ao CN')
            ->count();

        $processosAdvogadosEstagiarios['cerimonia'] = Advogado::
            where('estado', 'Aguarda Cerimónia')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Estagiario')
            ->whereNull('data_cerimonia_estagiario')
            ->count();

        $processosAdvogadosEstagiarios['cedula'] = Advogado::
            whereNotNull('data_cerimonia_estagiario')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Estagiario')
            ->count();

        $processosAdvogadosEstagiarios['total'] = $processosAdvogadosEstagiarios['pendentes'] + 
                                                    $processosAdvogadosEstagiarios['execucao'] + 
                                                    $processosAdvogadosEstagiarios['remetidocn'] +
                                                    $processosAdvogadosEstagiarios['cerimonia'] +
                                                    $processosAdvogadosEstagiarios['cedula'];

        // processo de emissão de documento de despacho
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_emissao[0] = date("d");
        $data_emissao[1] = $meses[date("m")];
        $data_emissao[2] = date("Y");

        $pdf = Pdf::loadView('documents-pdf.relatorio-areatecnica', [
            'pea' => $pea,
            'peae' => $peae,
            'data' => $data_emissao,
            'dataInicial' => $data_inicial,
            'dataFinal' => $data_final,
            'processosAdvogados' => $processosAdvogados,
            'processosEstagiarios' => $processosAdvogadosEstagiarios
        ]);

        return $pdf->stream();

    }


}
