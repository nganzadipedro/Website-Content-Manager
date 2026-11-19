<?php

namespace App\Http\Controllers;

use App\Exports\Listaaguardacerimoniaexport;
use App\Exports\Listaestindicacaopatrono;
use App\Exports\Listaindefinidosexport;
use App\Exports\Listaestagiariosexport;
use App\Exports\Listaadvogadosexport;
use App\Exports\Listaremessacnexport;
use App\Exports\Listaremessacnexportcompleta;
use App\Exports\Listaselecionadosexport;
use App\Models\Advogadoassistencia;
use App\Models\Assistenciajudiciaria;
use App\Models\Denuncia;
use App\Models\Estagiariospatrono;
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

    public function export_remessa_cn_completa(Request $request)
    {
        $nome_file = 'lista_inscricoes_remetidos_cn_completa';
        return Excel::download(new Listaremessacnexportcompleta($request->tipo_processo), $nome_file . '.xlsx');
    }

    public function export_xls_selecionados(Request $request)
    {
        // dd($request->all());
        $nome_file = 'lista_inscricoes_selecionados';
        return Excel::download(new Listaselecionadosexport($request->selecionados, $request->tipo_processo), $nome_file . '.xlsx');
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

    public function export_pdf_lista_completa_remessacn(Request $request)
    {

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', $request->tipo_processo)
            ->where('inscricao_advogado.estado', 'remetido ao CN')
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

        $pdf = Pdf::loadView('documents-pdf.lista-remessa-cn-completa', [
            'inscricoes' => $result,
            'num_candidatos' => $num_candidatos,
            'tipo_processo' => $request->tipo_processo,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

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
            ->where('encaminhado', 'Área Técnica')
            ->count();

        $processosAdvogados['mapa-distribuicao'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado_distribuicao', 'Por Distribuir')
            ->count();

        $processosAdvogados['analise-conselheiro'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->whereNull('despacho')
            ->where('estado', 'análise de conselheiro')
            ->count();

        $processosAdvogados['comissao-etica'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'análise comissão de ética')
            ->whereNull('despacho')
            ->count();

        $processosAdvogados['mesa-presidente'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'Sobre a mesa do Presidente')
            ->whereNull('despacho')
            ->count();

        $processosAdvogados['indeferido'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('despacho', 'Indeferido')
            ->count();

        $processosAdvogados['remetidocn'] = Inscricaoadvogado::where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'remetido ao CN')
            ->count();

        $processosAdvogados['cerimonia'] = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', 'Advogado')
            ->where('app_advogado.presenca_cerimonia', 'Presente')
            ->count();

        $processosAdvogados['cedula'] = Advogado::
            whereNotNull('data_cerimonia_associado')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Advogado')
            ->count();

        $processosAdvogados['execucao'] =
            $processosAdvogados['mapa-distribuicao'] +
            $processosAdvogados['analise-conselheiro'] +
            $processosAdvogados['comissao-etica'] +
            $processosAdvogados['mesa-presidente'];

        $processosAdvogados['total'] = $processosAdvogados['pendentes'] +
            $processosAdvogados['mapa-distribuicao'] +
            $processosAdvogados['analise-conselheiro'] +
            $processosAdvogados['comissao-etica'] +
            $processosAdvogados['mesa-presidente'] +
            $processosAdvogados['indeferido'] +
            $processosAdvogados['remetidocn'] +
            $processosAdvogados['cerimonia'] +
            $processosAdvogados['cedula'];

        $processosAdvogadosEstagiarios['pendentes'] = Registoentrada::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'pendente')
            ->where('encaminhado', 'Área Técnica')
            ->count();

        $processosAdvogadosEstagiarios['mesa-presidente'] = Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('estado', 'Sobre a mesa do Presidente')
            ->where('acto_pretendido', '!=', 'Indicação de Patrono')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogadosEstagiarios['indeferido'] = Inscricaoadvogado::where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('despacho', 'Indeferido')
            ->where('acto_pretendido', '!=', 'Indicação de Patrono')
            ->whereNull('data_remessa_cn')
            ->count();

        $processosAdvogadosEstagiarios['indicacao-patrono'] = Inscricaoadvogado::where('tipo_processo_id', 3)
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

        $processosAdvogadosEstagiarios['cerimonia'] = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->where('app_advogado.categoria', 'Estagiario')
            ->where('app_advogado.presenca_cerimonia', 'Presente')
            ->count();

        $processosAdvogadosEstagiarios['cedula'] = Advogado::
            whereNotNull('data_cerimonia_estagiario')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->where('categoria', 'Estagiario')
            ->count();

        $processosAdvogadosEstagiarios['total'] = $processosAdvogadosEstagiarios['pendentes'] +
            $processosAdvogadosEstagiarios['mesa-presidente'] +
            $processosAdvogadosEstagiarios['indeferido'] +
            $processosAdvogadosEstagiarios['indicacao-patrono'] +
            $processosAdvogadosEstagiarios['remetidocn'] +
            $processosAdvogadosEstagiarios['cerimonia'] +
            $processosAdvogadosEstagiarios['cedula'];

        $processosAdvogadosEstagiarios['execucao'] =
            $processosAdvogadosEstagiarios['mesa-presidente'] +
            $processosAdvogadosEstagiarios['indicacao-patrono'];

        $datas_cerimonia_adv = Advogado::select('data_cerimonia_associado')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->distinct()
            ->get();

        $datas_cerimonia_est = Advogado::select('data_cerimonia_estagiario')
            ->whereBetween('created_at', [$data_inicial, $data_final])
            ->distinct()
            ->get();

        $vetor_data_cedula = [];
        $linha = 0;

        foreach ($datas_cerimonia_adv as $data_linha) {

            if ($data_linha->data_cerimonia_associado != null) {

                $cadv = Advogado::
                    where('data_cerimonia_associado', $data_linha->data_cerimonia_associado)
                    ->where('categoria', 'Advogado')
                    ->count();

                $vetor_data_cedula[$linha] = [
                    'data' => $data_linha->data_cerimonia_associado,
                    'adv' => $cadv,
                    'est' => 0
                ];

                $linha++;
            }

        }

        foreach ($datas_cerimonia_est as $data_linha) {

            if ($data_linha->data_cerimonia_estagiario != null) {
                $cest = Advogado::
                    where('data_cerimonia_estagiario', $data_linha->data_cerimonia_estagiario)
                    ->where('categoria', 'Estagiario')
                    ->count();

                $vetor_data_cedula[$linha] = [
                    'data' => $data_linha->data_cerimonia_estagiario,
                    'adv' => 0,
                    'est' => $cest
                ];

                $linha++;
            }

        }

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

    public function delete_advogado_post(Request $request)
    {

        $advogado_apagar = Advogado::find($request->advogado_id);
        $pessoa = Pessoa::find($advogado_apagar->pessoa_id);
        $nome = $pessoa->nome;

        $registos = Pessoa::where('nome', $nome)->get();

        if (count($registos) == 2) {

            $inscricao = Inscricaoadvogado::where('advogado_id', $advogado_apagar->id)->first();
            if ($inscricao) {
                $registo = Registoentrada::find($inscricao->registo_entrada_id);
                if ($registo) {
                    // actualiza os dados com os id do que vai manter
                    foreach ($registos as $r) {
                        if ($r->id == $advogado_apagar->pessoa_id) {

                        } else {
                            $adv = Advogado::where('pessoa_id', $r->id)->first();
                            $inscricao->advogado_id = $adv->id;
                            $inscricao->save();

                            if ($adv->categoria == 'Estagiario') {
                                $est = Estagiariospatrono::where('inscricao_advogado_id', $inscricao->id)->first();
                                if ($est) {
                                    $est->estagiario_id = $adv->id;
                                    $est->save();
                                }
                            }
                        }
                    }

                    $pessoa->delete();
                    $advogado_apagar->delete();
                    return 'sucesso';

                }
            } else {
                $registo = Registoentrada::where('proveniencia', $nome)->first();
                if ($registo) {
                    $inscricao = Inscricaoadvogado::where('registo_entrada_id', $registo->id)->first();
                    if ($inscricao) {
                        if ($inscricao->advogado_id != null && $inscricao->advogado_id != $advogado_apagar->id) {
                            $pessoa->delete();
                            $advogado_apagar->delete();
                            return 'sucesso';
                        } else {
                            // não pode excluir
                            return 'tecnico';
                        }
                    }
                }
            }

        } else {
            return 'não-duplicado';
        }


    }

    public function trata_dados()
    {

        $advogados = Advogadoassistencia::all();
        // dd($advogados);

        set_time_limit(0);

        foreach ($advogados as $adv) {

            $assistencias = Assistenciajudiciaria::where('advogado_assist_id', $adv->advogado_assist_id)->get();
            foreach ($assistencias as $item) {
                $item->advogado_assist_id = $adv->id;
                $item->created_at = $item->data_registo_bd;
                $item->save();

                echo $adv->nome_advogado . '<br>';
            }

        }
    }


}
