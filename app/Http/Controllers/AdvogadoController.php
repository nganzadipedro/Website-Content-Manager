<?php

namespace App\Http\Controllers;

use App\Exports\Listaaguardacerimoniaexport;
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

    public function export_waiting_cerimony()
    {

        $nome_file = 'lista_aguardando_cerimonia';
        return Excel::download(new Listaaguardacerimoniaexport(), $nome_file . '.xlsx');
    }

    public function export_remessa_cn()
    {
        $nome_file = 'lista_inscricoes_estagiarios_remetidos_cn';
        return Excel::download(new Listaremessacnexport(), $nome_file . '.xlsx');
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


}
