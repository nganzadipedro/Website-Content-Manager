<?php

namespace App\Http\Controllers;

use App\Models\Anexosregisto;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Inscricaoadvogado;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use \PDF;

class SystemController extends Controller
{

    public function diasUteis(): JsonResponse
    {
        $inicio = Carbon::now()->startOfWeek();      // Segunda
        $fim = Carbon::now()->startOfWeek()->addDays(4)->endOfDay(); // Sexta

        // Busca contagem agrupada por dia
        $registos = DB::table('registo_entrada')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->whereBetween('created_at', [$inicio, $fim])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        // Garante todos os dias (mesmo sem registos)
        $resultado = collect(range(0, 4))->map(function ($i) use ($inicio, $registos) {
            $dia = $inicio->copy()->addDays($i)->format('Y-m-d');

            return [
                'dia' => $dia,
                'valor' => $registos[$dia]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function diasUteisAssistencia(): JsonResponse
    {
        $inicio = Carbon::now()->startOfWeek();      // Segunda
        $fim = Carbon::now()->startOfWeek()->addDays(4)->endOfDay(); // Sexta

        // Busca contagem agrupada por dia
        $registos = DB::table('pedido_assistencia')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->whereBetween('created_at', [$inicio, $fim])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        // Garante todos os dias (mesmo sem registos)
        $resultado = collect(range(0, 4))->map(function ($i) use ($inicio, $registos) {
            $dia = $inicio->copy()->addDays($i)->format('Y-m-d');

            return [
                'dia' => $dia,
                'valor' => $registos[$dia]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function diasUteisInscricaoAdvogado(): JsonResponse
    {
        $inicio = Carbon::now()->startOfWeek();      // Segunda
        $fim = Carbon::now()->startOfWeek()->addDays(4)->endOfDay(); // Sexta

        // Busca contagem agrupada por dia
        $registos = DB::table('inscricao_advogado')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$inicio, $fim])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        // Garante todos os dias (mesmo sem registos)
        $resultado = collect(range(0, 4))->map(function ($i) use ($inicio, $registos) {
            $dia = $inicio->copy()->addDays($i)->format('Y-m-d');

            return [
                'dia' => $dia,
                'valor' => $registos[$dia]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function diasUteisInscricaoEstagiario(): JsonResponse
    {
        $inicio = Carbon::now()->startOfWeek();      // Segunda
        $fim = Carbon::now()->startOfWeek()->addDays(4)->endOfDay(); // Sexta

        // Busca contagem agrupada por dia
        $registos = DB::table('inscricao_advogado')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$inicio, $fim])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        // Garante todos os dias (mesmo sem registos)
        $resultado = collect(range(0, 4))->map(function ($i) use ($inicio, $registos) {
            $dia = $inicio->copy()->addDays($i)->format('Y-m-d');

            return [
                'dia' => $dia,
                'valor' => $registos[$dia]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }


    public function registosPorDiaMesAtual()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Query: conta registos agrupados por dia
        $registos = DB::table('registo_entrada')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->whereBetween('created_at', [$inicioMes, $fimMes])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $diasNoMes = $inicioMes->daysInMonth;

        // Monta o resultado com todos os dias do mês
        $resultado = collect(range(1, $diasNoMes))->map(function ($dia) use ($inicioMes, $registos) {
            $data = $inicioMes->copy()->day($dia)->format('Y-m-d');

            return [
                'dia' => $data,
                'valor' => $registos[$data]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function registosPorDiaMesAtualAssistencia()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Query: conta registos agrupados por dia
        $registos = DB::table('pedido_assistencia')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->whereBetween('created_at', [$inicioMes, $fimMes])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $diasNoMes = $inicioMes->daysInMonth;

        // Monta o resultado com todos os dias do mês
        $resultado = collect(range(1, $diasNoMes))->map(function ($dia) use ($inicioMes, $registos) {
            $data = $inicioMes->copy()->day($dia)->format('Y-m-d');

            return [
                'dia' => $data,
                'valor' => $registos[$data]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function registosPorDiaMesAtualInscricaoAdvogado()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Query: conta registos agrupados por dia
        $registos = DB::table('inscricao_advogado')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->where('tipo_processo_id', 2)
            ->whereBetween('created_at', [$inicioMes, $fimMes])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $diasNoMes = $inicioMes->daysInMonth;

        // Monta o resultado com todos os dias do mês
        $resultado = collect(range(1, $diasNoMes))->map(function ($dia) use ($inicioMes, $registos) {
            $data = $inicioMes->copy()->day($dia)->format('Y-m-d');

            return [
                'dia' => $data,
                'valor' => $registos[$data]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function registosPorDiaMesAtualInscricaoEstagiario()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        // Query: conta registos agrupados por dia
        $registos = DB::table('inscricao_advogado')
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->where('tipo_processo_id', 3)
            ->whereBetween('created_at', [$inicioMes, $fimMes])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $diasNoMes = $inicioMes->daysInMonth;

        // Monta o resultado com todos os dias do mês
        $resultado = collect(range(1, $diasNoMes))->map(function ($dia) use ($inicioMes, $registos) {
            $data = $inicioMes->copy()->day($dia)->format('Y-m-d');

            return [
                'dia' => $data,
                'valor' => $registos[$data]->total ?? 0
            ];
        });

        return response()->json($resultado);
    }

    public function anexo_post(Request $request)
    {

        $anexo = Anexosregisto::create([
            'titulo' => $request->titulo,
            'tipo_anexo' => $request->tipo_anexo,
            'observacao' => $request->observacao,
            'registo_id' => $request->registo_id,
            'user_id' => Auth::id()
        ]);

        $anexo->hash = md5($anexo->titulo . $anexo->created_at . $anexo->registo_id);
        $anexo->save();

        //faz upload da imagem
        $ficheiro = '';

        try {
            if ($request->hasFile('anexo') && $request->file('anexo')->isValid()) {
                $ficheiro = $request->anexo->store('anexos-registo-entrada');
                $anexo->anexo = $ficheiro;
                $anexo->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Adicionou um anexo para o processo ($anexo->titulo)", 'registo-entrada', $anexo->registo_id);
        return 'sucesso';

    }

    public function encaminhar_post(Request $request)
    {

        $registo = Registoentrada::find($request->registo_id);
        $registo->encaminhado = $request->encaminhar_para;
        $registo->estado = 'pendente';
        $registo->nota_encaminhamento = $request->nota;
        $registo->save();

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Encaminhou o processo para $registo->encaminhado", 'registo-entrada', $registo->id);
        return 'sucesso';

    }

    public function distribuicao_post(Request $request)
    {

        $registo = Inscricaoadvogado::find($request->inscricao_id);
        if ($registo->observacao_distribuicao != $request->observacao_distribuicao) {

            $registo->observacao_distribuicao = $request->observacao_distribuicao;
            $registo->save();
            ActividadesistemaController::inserir(Auth::id(), "Registou uma observação ao fazer a distribuição do processo", 'registo-entrada', $registo->id);

        }
        if ($registo->data_levantamento_distribuicao != $request->data_levantamento_distribuicao) {

            $registo->data_levantamento_distribuicao = $request->data_levantamento_distribuicao;
            $registo->save();
            ActividadesistemaController::inserir(Auth::id(), "Registou a data de levantamento do processo para a análise do Conselheiro", 'registo-entrada', $registo->id);
        }
        if ($registo->data_entrega_distribuicao != $request->data_entrega_distribuicao) {

            $registo->data_entrega_distribuicao = $request->data_entrega_distribuicao;
            $registo->save();
            ActividadesistemaController::inserir(Auth::id(), "Registou a data de entrega do processo pelo Conselheiro", 'registo-entrada', $registo->id);
        }
        if ($registo->conselheiro_id != $request->conselheiro_id) {
            ActividadesistemaController::inserir(Auth::id(), "Distribuiu o processo para o Conselheiro: " . User::find($request->conselheiro_id)->getpessoa->nome, 'registo-entrada', $registo->id);
            $registo->conselheiro_id = $request->conselheiro_id;
            $registo->estado_distribuicao = 'Distribuido';
            $registo->save();
        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Encaminhou o processo para $registo->encaminhado", 'registo-entrada', $registo->id);
        return 'sucesso';

    }

    public function getDataInscricaoAdvogadoById($id)
    {
        $inscricao = Inscricaoadvogado::find($id);
        return response()->json($inscricao);
    }

    public function documento_despacho($hash_inscricao)
    {

        $inscricao_advogado = Inscricaoadvogado::where('hash', $hash_inscricao)->first();
        $registo = Registoentrada::find($inscricao_advogado->registo_entrada_id);


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

        $pdf = Pdf::loadView('documents-pdf.documento-despacho', [
            'nome_requerente' => $registo->proveniencia,
            'data_despacho' => $inscricao_advogado->data_despacho,
            'mensagem_despacho' => $inscricao_advogado->texto_despacho,
            'data' => $data_emissao
        ]);

        return $pdf->stream();

    }

    public function trata_bd_antiga()
    {

        $dados = DB::select('select * from registos2026');

        foreach ($dados as $dado) {

        set_time_limit(0);

            date_default_timezone_set("Africa/Luanda");
            $numero = Registoentrada::whereYear('created_at', now()->year)->count() + 1;

            $titulo = '';
            $proveniencia = '';
            $tipo_processo_id = 1;
            if(str_contains($dado->proveniencia, '(')) {
                $partes = explode('(', $dado->proveniencia);
                $proveniencia = trim($partes[0]);
                $partes = explode(')', $partes[1]);
                $titulo = trim($partes[0]);
            }
            else{
                $proveniencia = $dado->proveniencia;
                $titulo = 'Cidadão';
            }

            if(str_contains($dado->assunto, 'Inscrição para Advogado')) {
                $tipo_processo_id = 2;
            } else if(str_contains($dado->assunto, 'Pedido de AJ')) {
                $tipo_processo_id = 1;
            }
            else if(str_contains($dado->assunto, 'Reinscrição')) {
                $tipo_processo_id = 2;
            }
            else if(str_contains($dado->assunto, 'Solicitação de Declaração')) {
                $tipo_processo_id = 5;
            }
            else if(str_contains($dado->assunto, 'mudança de patrono')) {
                $tipo_processo_id = 6;
            }
            else{
                $tipo_processo_id = 4;
            }

            $registo = Registoentrada::create([
                'assunto' => $dado->assunto,
                'proveniencia' => $proveniencia,
                'data_entrada' => $dado->data_entrada,
                'titulo' => $titulo,
                'tipo_processo_id' => $tipo_processo_id,
                'destinatario' => 'CPL-OAA',
                'tipo_documento' => 'Requerimento',
                'user_id' => 4055
            ]);

            $registo->hash = md5($registo->created_at . $registo->id . $registo->user_id);
            $registo->numero = $numero;
            $registo->save();
            $registo->codigo = "$numero/" . now()->year;
            $registo->created_at = $dado->data_bd != null ? $dado->data_bd : '2026-01-12 12:00:00';
            $registo->save();

        }

    }

}
