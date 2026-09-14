<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Carrossel;
use App\Models\Denuncia;
use App\Models\Documentoaj;
use App\Models\Estagiariospatrono;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Patrono;
use App\Models\Pedidoassistencia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\Relatoriofinanceiro;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
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

        $nome_patrono = '';
        $endereco = '';
        $contactos = '';
        $nome_requerente = '';

        $registo_entrada = Registoentrada::where('hash', $request->hash_registo)->first();
        $pedido = Pedidoassistencia::where('registo_entrada_id', $registo_entrada->id)->first();
        $doc = Documentoaj::where('pedido_assistencia_id', $pedido->id)->first();
        $advogados = Advogadoatribuido::where('registo_entrada_id', $registo_entrada->id)->get();
        $nome_requerente = $registo_entrada->proveniencia;

        if ($advogados[0]->municipio_id != null) {
            $municipio = $advogados[0]->getadvogado->getmunicipio->descricao;
            $endereco = $municipio . ', ' . $advogados[0]->getadvogado->endereco_escritorio;
        } else {
            $endereco = $advogados[0]->getadvogado->endereco_escritorio;
        }

        $contactos = $advogados[0]->getadvogado->getpessoa->telefone1 . '/' . $advogados[0]->getadvogado->getpessoa->telefone2;

        if (count($advogados) > 1) {
            $varios = true;
        } else {
            if ($advogados[0]->getadvogado->categoria == 'Estagiario') {
                $copia_patrono = true;
                $patrono = Estagiariospatrono::where('estagiario_id', $advogados[0]->advogado_id)->first();
                if ($patrono) {
                    $nome_patrono = $patrono->getpatrono->getadvogado->getpessoa->nome;
                }
            }
        }

        if ($pedido->tipo_indicacao == 'Auto-Indicação') {
            $auto_indicacao = true;
        }

        if ($pedido->tipo_situacao_assistencia == 'Substituição de Advogado') {
            $substituicao = true;
        } else if ($pedido->tipo_situacao_assistencia == 'Solicitação de Instituição') {
            $copia_instituicao = true;
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
        Requerente - $nome_requerente;
        Nº Ref. - $doc->num_referencia;
        Código de Validação - $doc->hash_control;
        Data de Emissão - $hoje
        ";

        $pdf = Pdf::loadView('documents-pdf.documento-assistencia1', [
            'doc' => $doc,
            'advogados' => $advogados,
            'registo_entrada' => $registo_entrada,
            'nome_patrono' => $nome_patrono,
            'endereco' => $endereco,
            'contactos' => $contactos,
            'varios' => $varios,
            'auto_indicacao' => $auto_indicacao,
            'substituicao' => $substituicao,
            'copia_instituicao' => $copia_instituicao,
            'nome_requerente' => $nome_requerente,
            'data_emissao' => $data_emissao,
            'qrcode' => $qrcode,
            'copia_patrono' => $copia_patrono
        ]);

        return $pdf->stream();

    }

}
