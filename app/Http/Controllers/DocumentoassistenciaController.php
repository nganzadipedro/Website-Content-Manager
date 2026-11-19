<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Documentoaj;
use App\Models\Estagiariospatrono;
use App\Models\Patrono;
use App\Models\Pedidoassistencia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Illuminate\Http\Request;
use \PDF;

class DocumentoassistenciaController extends Controller
{
    public function documento_assistencia(Request $request)
    {

        $copia_patrono = false;
        $copia_instituicao = false;
        $substituicao = false;
        $auto_indicacao = false;
        $varios = false;
        $varios_req = false;
        $varios_sub = false;

        $nome_patrono = '';
        $nome_instituicao = '';
        $advogado_substituido = '';
        $endereco = '';
        $contactos = '';
        $nome_requerente = '';

        $pedido = Pedidoassistencia::where('hash', $request->hash_registo)->first();
        $registo_entrada = Registoentrada::find($pedido->registo_entrada_id);
        $doc = Documentoaj::where('pedido_assistencia_id', $pedido->id)->first();
        $advogados = Advogadoatribuido::where('registo_entrada_id', $registo_entrada->id)->get();
        $nome_requerente = $pedido->requerente == null ? $registo_entrada->proveniencia : $pedido->requerente;

        if ($advogados[0]->getadvogado->categoria == 'Estagiario') {
            $est_patrono = Estagiariospatrono::where('estagiario_id', $advogados[0]->advogado_id)->first();
            if ($est_patrono) {
                $patrono = Patrono::find($est_patrono->patrono_id);
                $adv_patrono = Advogado::find($patrono->advogado_id);
                $nome_patrono = $adv_patrono->getpessoa->nome;
                if ($adv_patrono->municipio_id != null) {
                    $municipio = $adv_patrono->getmunicipio->descricao;
                    $endereco = $municipio . ', ' . $adv_patrono->endereco_escritorio;
                } else {
                    $endereco = $advogados[0]->getadvogado->endereco_escritorio;
                }
            }
        } else if ($advogados[0]->getadvogado->categoria == 'Advogado') {
            if ($advogados[0]->getadvogado->municipio_id != null) {
                $municipio = $advogados[0]->getadvogado->getmunicipio->descricao;
                $endereco = $municipio . ', ' . $advogados[0]->getadvogado->endereco_escritorio;
            } else {
                $endereco = $advogados[0]->getadvogado->endereco_escritorio;
            }
        }

        $contactos = $advogados[0]->getadvogado->getpessoa->telefone1 . '/' . $advogados[0]->getadvogado->getpessoa->telefone2;

        if (count($advogados) > 1) {
            $varios = true;
        } else {
            if ($advogados[0]->getadvogado->categoria == 'Estagiario') {
                $copia_patrono = true;
            }
        }

        if ($pedido->tipo_indicacao == 'Auto-Indicação') {
            $auto_indicacao = true;
            $nome_requerente = $pedido->requerente;
        }

        if ($pedido->insitituicao_copia != null) {
            $copia_instituicao = true;
            $nome_instituicao = $pedido->insitituicao_copia;
        }

        if ($pedido->tipo_situacao_assistencia == 'Substituição de Advogado') {
            $substituicao = true;
            $advogado_substituido = $pedido->advogado_substituido;
        } else if ($pedido->advogado_substituido != null) {
            $substituicao = true;
            $advogado_substituido = $pedido->advogado_substituido;
        } else if ($pedido->tipo_situacao_assistencia == 'Solicitação de Instituição') {
            $copia_instituicao = true;
            $nome_instituicao = $pedido->insitituicao_copia;
        }

        if (str_contains($nome_requerente, ';')) {
            $varios_req = true;
            $nome_requerente = explode(';', $nome_requerente);
        }

        if (str_contains($advogado_substituido, ';')) {
            $varios_sub = true;
            $advogados_sub = explode(';', $advogado_substituido);
            $tam = count($advogados_sub);
            $advogado_substituido = '';
            $i = 1;
            foreach ($advogados_sub as $linha) {
                if ($i == 1) {
                    $advogado_substituido = $linha;
                }
                else{
                    if($i == $tam){
                        $advogado_substituido .= ' e ' . $linha;
                    }
                    else{
                        $advogado_substituido .= ', ' . $linha;
                    }
                }
                $i++;
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

        $hoje = $doc->created_at;

        $qrcode = "
        Nº Ref. - $pedido->codigo;
        Código de Validação - $doc->hash_control;
        Data de Emissão - $hoje
        ";

        $pdf = Pdf::loadView('documents-pdf.documento-assistencia1', [
            'doc' => $doc,
            'advogados' => $advogados,
            'registo_entrada' => $registo_entrada,
            'nome_patrono' => $nome_patrono,
            'nome_instituicao' => $nome_instituicao,
            'endereco' => $endereco,
            'contactos' => $contactos,
            'varios' => $varios,
            'varios_req' => $varios_req,
            'varios_sub' => $varios_sub,
            'auto_indicacao' => $auto_indicacao,
            'substituicao' => $substituicao,
            'advogado_substituido' => $advogado_substituido,
            'copia_instituicao' => $copia_instituicao,
            'nome_requerente' => $nome_requerente,
            'num_referencia' => $pedido->codigo,
            'data_emissao' => $data_emissao,
            'qrcode' => $qrcode,
            'copia_patrono' => $copia_patrono
        ]);

        return $pdf->stream();

    }

}
