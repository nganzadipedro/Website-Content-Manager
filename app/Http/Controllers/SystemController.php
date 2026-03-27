<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Anexosregisto;
use App\Models\Denuncia;
use App\Models\Estagiariospatrono;
use App\Models\Galeria;
use App\Models\Historicosistema;
use App\Models\Inscricaoadvogado;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Patrono;
use App\Models\Pedidointervencao;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Mail;
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

        date_default_timezone_set("Africa/Luanda");

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

        date_default_timezone_set("Africa/Luanda");

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

        date_default_timezone_set("Africa/Luanda");

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

    public function distribuicao_grupo_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $selecionados = $request->selecionados;

        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);

            $inscricao_adv->observacao_distribuicao = $request->observacao_distribuicao;
            $inscricao_adv->data_levantamento_distribuicao = $request->data_levantamento_distribuicao;
            $inscricao_adv->conselheiro_id = $request->conselheiro_id;
            $inscricao_adv->estado_distribuicao = 'Distribuido';
            $inscricao_adv->estado = 'análise de conselheiro';
            $inscricao_adv->save();

            $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
            $registo->estado = 'em tratamento';
            $registo->save();

            // notifica o advogado por SMS e email
            $obmsg = new OmbalaController();
            $obmail = new MailController();
            $telefone = $inscricao_adv->telefone1;
            $nome = $registo->proveniencia;
            $email = $inscricao_adv->email;
            $data_entrada = $registo->data_entrada;
            $conselheiro = User::find($request->conselheiro_id);
            $nome_conselheiro = $conselheiro->getpessoa->nome;

            $mensagem = "Caríssimo(a), o seu processo de inscrição para advogado foi entregue aos conselheiros para a devida análise.";
            try {
                $obmsg->enviarMensagem($telefone, $mensagem);
            } catch (\Throwable $th) {

            }

            $mensagem = "O seu processo de inscrição para advogado foi entregue aos conselheiros para a devida análise.";
            try {
                $obmail->mailNotificacao($email, $nome, $mensagem, $data_entrada);
            } catch (\Throwable $th) {

            }

            // regista actividade no sistema
            ActividadesistemaController::inserir(Auth::id(), "O processo foi remetido ao conselheiro $nome_conselheiro para a devida análise.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou a distribuição do processo de inscrição para advogado do(a) senhor(a) $nome ao conselheiro $nome_conselheiro para a devida análise.", 'user', $inscricao_adv->id);

        }

        return 'sucesso';

    }

    public function entrega_conselheiro_grupo_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $selecionados = $request->selecionados;

        // primeiro verifica se dos selecionados tem algum que já foi devolvido
        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);
            if ($inscricao_adv->data_entrega_distribuicao != null) {
                $nome = $inscricao_adv->getregistoentrada->proveniencia;
                return "O processo de inscrição do senhor $nome já foi devolvido. Não pode ser devolvido duas vezes.";
            }

        }

        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);

            $inscricao_adv->data_entrega_distribuicao = $request->data_entrega_distribuicao;
            $inscricao_adv->save();

            $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
            $registo->estado = 'em tratamento';
            $registo->save();

            // notifica o advogado por SMS e email
            $nome = $registo->proveniencia;
            $conselheiro = User::find($inscricao_adv->conselheiro_id);
            $nome_conselheiro = $conselheiro->getpessoa->nome;

            // regista actividade no sistema
            ActividadesistemaController::inserir(Auth::id(), "O(A) conselheiro(a) $nome_conselheiro fez a devolução do processo para a área técnica.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou a devolução do processo de inscrição para advogado do(a) senhor(a) $nome analisado pelo(a) conselheiro(a) $nome_conselheiro.", 'user', $inscricao_adv->id);

        }

        return 'sucesso';

    }

    public function remessa_comissaoetica_grupo_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $selecionados = $request->selecionados;

        // primeiro verifica se dos selecionados tem algum que já foi remetido a comissao de ética
        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);
            $nome = $inscricao_adv->getregistoentrada->proveniencia;

            if ($inscricao_adv->data_levantamento_comissao_etica != null || $inscricao_adv->estado == 'análise comissão de ética') {
                return "O processo de inscrição do senhor $nome já foi remetido à comissão de ética. Não pode ser remetido duas vezes.";
            }

            if ($inscricao_adv->data_entrega_distribuicao == null) {
                return "O processo de inscrição do senhor $nome ainda não foi devolvido pelo conselheiro. Não pode ser entregue à comissáo de ética";
            }

        }

        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);

            $inscricao_adv->data_levantamento_comissao_etica = $request->data_remessa_comissao;
            $inscricao_adv->estado = 'análise comissão de ética';
            $inscricao_adv->save();

            $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
            $registo->estado = 'em tratamento';
            $registo->save();

            $obmsg = new OmbalaController();
            $obmail = new MailController();
            $telefone = $inscricao_adv->telefone1;
            $nome = $registo->proveniencia;
            $email = $inscricao_adv->email;
            $data_entrada = $registo->data_entrada;

            // $mensagem = "Caríssimo(a), o seu processo de inscrição para advogado foi entregue à Comissão de Ética para a devida análise.";
            // try {
            //     $obmsg->enviarMensagem($telefone, $mensagem);
            // } catch (\Throwable $th) {

            // }

            // $mensagem = "Caríssimo(a), o seu processo de inscrição para advogado foi entregue à Comissão de Ética para a devida análise.";
            // try {
            //     $obmail->mailNotificacao($email, $nome, $mensagem, $data_entrada);
            // } catch (\Throwable $th) {

            // }

            // regista actividade no sistema
            ActividadesistemaController::inserir(Auth::id(), "O processo foi remetido à comissão de ética para a devida análise.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou a remessa do processo de inscrição para advogado do(a) senhor(a) $nome à comissão de ética para a devida análise.", 'user', $inscricao_adv->id);

        }

        return 'sucesso';

    }

    public function entrega_comissaoetica_grupo_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $selecionados = $request->selecionados;

        // primeiro verifica se dos selecionados tem algum que já foi devolvico pela comissao de ética
        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);
            $nome = $inscricao_adv->getregistoentrada->proveniencia;

            if ($inscricao_adv->data_entrega_comissao_etica != null) {
                return "O processo de inscrição do senhor $nome já foi devolvido pela comissão de ética. Não pode ser devolvido duas vezes.";
            }

            if ($inscricao_adv->data_entrega_distribuicao == null) {
                return "O processo de inscrição do senhor $nome ainda não foi devolvido pelo conselheiro. Não pode ser remetido à mesa do Presidente";
            }

            if ($inscricao_adv->data_levantamento_comissao_etica == null) {
                return "O processo de inscrição do senhor $nome ainda não foi entregue à comissão de ética. Não pode ser remetido à mesa do Presidente";
            }

        }

        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);

            $inscricao_adv->data_entrega_comissao_etica = $request->data_entrega_comissao_etica;
            $inscricao_adv->estado = 'Sobre a mesa do Presidente';
            $inscricao_adv->save();

            $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
            $registo->estado = 'em tratamento';
            $registo->save();

            $obmsg = new OmbalaController();
            $obmail = new MailController();
            $telefone = $inscricao_adv->telefone1;
            $nome = $registo->proveniencia;
            $email = $inscricao_adv->email;
            $data_entrada = $registo->data_entrada;

            // $mensagem = "Caríssimo(a), o seu processo de inscrição para advogado foi avaliado pela comissão de ética e aguarda avaliação do Sr. Presidente do CPL.";
            // try {
            //     $obmsg->enviarMensagem($telefone, $mensagem);
            // } catch (\Throwable $th) {

            // }

            // $mensagem = "Caríssimo(a), o seu processo de inscrição para advogado foi avaliado pela comissão de ética e aguarda avaliação do Sr. Presidente do CPL.";
            // try {
            //     $obmail->mailNotificacao($email, $nome, $mensagem, $data_entrada);
            // } catch (\Throwable $th) {

            // }

            // regista actividade no sistema
            ActividadesistemaController::inserir(Auth::id(), "O processo foi devolvido pela comissão de ética.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "O processo foi remetido à mesa do Sr. Presidente.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou a devolução do processo de inscrição pela comissão de ética e remeteu à mesa do Sr. Presidente.", 'user', $inscricao_adv->id);

        }

        return 'sucesso';

    }

    public function entrega_comissaoetica_indeferido_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");
        $inscricao_adv = Inscricaoadvogado::find($request->inscricao_id);

        $inscricao_adv->data_entrega_comissao_etica = $request->data_entrega_comissao_etica;
        $inscricao_adv->texto_despacho = $request->texto_despacho;
        $inscricao_adv->observacao = $request->texto_despacho;
        $inscricao_adv->observacao_comissao_etica = $request->texto_despacho;
        $inscricao_adv->observacao_distribuicao = $request->texto_despacho;
        $inscricao_adv->data_despacho = $request->data_entrega_comissao_etica;
        $inscricao_adv->despacho = 'Indeferido';
        $inscricao_adv->save();

        $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
        $registo->estado = 'indeferido';
        $registo->save();

        $obmsg = new OmbalaController();
        $obmail = new MailController();
        $telefone = $inscricao_adv->telefone1;
        $nome = $registo->proveniencia;
        $email = $inscricao_adv->email;
        $data_entrada = $registo->data_entrada;

        $mensagem = $inscricao_adv->texto_despacho;

        // $mensagem = "Caríssimo(a), foi emitido um despacho para o seu processo de inscrição para advogado. Verifique o seu email.";
        // try {
        //     $obmsg->enviarMensagem($telefone, $mensagem);
        // } catch (\Throwable $th) {

        // }

        // $mensagem = $inscricao_adv->texto_despacho;
        // try {
        //     $obmail->mailDespacho($email, $nome, $mensagem, $inscricao_adv->data_despacho);
        // } catch (\Throwable $th) {

        // }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "O processo foi devolvido pela comissão de ética.", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "O processo foi despachado como indeferido com a seguinte observação: $mensagem", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Registou a devolução do processo de inscrição do(a) Sr(a). $nome pela comissão de ética, com o despacho indeferido", 'user', $inscricao_adv->id);

        return 'sucesso';

    }

    public function pedido_intervencao_post(Request $request)
    {

        // verifica se já esxite na bd
        $existe = Pedidointervencao::where('advogado_id', $request->advogado_id)
            ->where('tipo_processo', $request->tipo_processo)->first();

        if ($existe != null) {
            return 'duplicado';
        } else {
            // inserir na tabela de pedido de intervanção
            $pedido_interv = Pedidointervencao::create([
                'user_id' => Auth::user()->id,
                'advogado_id' => $request->advogado_id,
                'tipo_processo' => $request->tipo_processo,
                'hash' => Str::uuid(),
            ]);

            // actualizar dados da pessoa na base de dados
            $advogado = Advogado::find($request->advogado_id);
            $pessoa = Pessoa::find($advogado->pessoa_id);

            $pessoa->telefone1 = $request->telefone1;
            $pessoa->telefone2 = $request->telefone2;
            $pessoa->email = $request->email;
            $pessoa->save();

            $advogado->categoria = $request->categoria;
            $advogado->num_associado = $request->categoria == 'Advogado' ? $request->num_cedula : $request->num_associado;
            $advogado->num_estagiario = $request->categoria == 'Estagiario' ? $request->num_cedula : $request->num_estagiario;
            $advogado->nome_patrono = $request->nome_patrono;
            $advogado->email_patrono = $request->email_patrono;
            $advogado->telefone_patrono = $request->telefone_patrono;
            $advogado->nome_escritorio = $request->nome_escritorio;
            $advogado->municipio_id = $request->municipio_id;
            $advogado->endereco_escritorio = $request->endereco_escritorio;
            $advogado->save();

            return 'sucesso';

        }






    }

    public function pedido_intervencao_novo_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        // verifica se já esxite na bd
        if ($request->categoria == 'Advogado') {
            $existe = Advogado::where('categoria', 'Advogado')
                ->where('num_associado', $request->num_cedula)->first();
            if ($existe) {
                return 'duplicado';
            }
        } else {
            $existe = Advogado::where('categoria', 'Estagiario')
                ->where('num_estagiario', $request->num_cedula)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        // insere na tabela pessoa;
        $pessoa = Pessoa::create([
            'nome' => $request->nome_advogado,
            'num_documento' => $request->num_documento,
            'email' => $request->email,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'documento' => 'Bilhete de Identidade',
            'genero' => $request->genero
        ]);

        $conta = Advogado::count() + 1;

        // insere na tabela de advogado
        $advogado = Advogado::create([
            'categoria' => $request->categoria,
            'num_associado' => $request->categoria == 'Advogado' ? $request->num_cedula : null,
            'num_estagiario' => $request->categoria == 'Estagiario' ? $request->num_cedula : null,
            'pessoa_id' => $pessoa->id,
            'codigo' => 'CPL' . $conta,
            'nome_patrono' => $request->nome_patrono,
            'email_patrono' => $request->email_patrono,
            'cedula_patrono' => $request->cedula_patrono,
            'telefone_patrono' => $request->telefone_patrono,
            'nome_escritorio' => $request->nome_escritorio,
            'municipio_id' => $request->municipio_id,
            'endereco_escritorio' => $request->endereco_escritorio,
            'hash' => Str::uuid()
        ]);

        // inserir na tabela de pedido de intervanção
        $pedido_interv = Pedidointervencao::create([
            'user_id' => Auth::user()->id,
            'advogado_id' => $advogado->id,
            'tipo_processo' => $request->tipo_processo,
            'hash' => Str::uuid()
        ]);

        return 'sucesso';

    }

    public function registo_associado_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        // verifica se já esxite na bd
        if ($request->categoria == 'Advogado') {
            $existe = Advogado::where('categoria', 'Advogado')
                ->where('num_associado', $request->num_associado)->first();
            if ($existe) {
                return 'duplicado';
            }
        } else {
            $existe = Advogado::where('categoria', 'Estagiario')
                ->where('num_estagiario', $request->num_estagiario)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        $existe = Pessoa::where('num_documento', $request->num_bi)
            ->first();
        if ($existe) {
            return 'bilhete';
        }

        // insere na tabela pessoa;
        $pessoa = Pessoa::create([
            'nome' => mb_strtoupper($request->nome_completo, 'UTF-8'),
            'num_documento' => $request->num_bi,
            'email' => $request->email,
            'telefone1' => $request->telefone1,
            'telefone2' => $request->telefone2,
            'documento' => 'Bilhete de Identidade',
            'genero' => $request->sexo
        ]);

        $conta = Advogado::count() + 1;

        // insere na tabela de advogado
        $advogado = Advogado::create([
            'categoria' => $request->categoria,
            'nome_profissional' => $request->nome_profissional,
            'num_associado' => $request->num_associado,
            'num_estagiario' => $request->num_estagiario,
            'data_inscricao_oaa' => $request->data_inscricao_oaa,
            'data_inscricao_estagiario' => $request->data_inscricao_estagiario,
            'pessoa_id' => $pessoa->id,
            'codigo' => 'CPL' . $conta,
            'nome_patrono' => $request->nome_patrono,
            'email_patrono' => $request->email_patrono,
            'telefone_patrono' => $request->tel_patrono,
            'nome_escritorio' => $request->nome_escritorio,
            'estado' => 'Aguarda Cerimónia',
            'municipio_id' => $request->categoria == 'Advogado' ? $request->municipio_id_adv : $request->municipio_id_est,
            'endereco_escritorio' => $request->categoria == 'Advogado' ? $request->endereco_profissional_adv : $request->endereco_escritorio_est,
            'hash' => Str::uuid()
        ]);

        return 'sucesso';

    }

    public function registo_associado_update(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $advogado = Advogado::find($request->advogado_id);
        $pessoa = Pessoa::find($advogado->pessoa_id);

        // verifica se já esxite na bd
        if ($request->categoria == 'Advogado') {
            $existe = Advogado::where('categoria', 'Advogado')
                ->where('num_associado', $request->num_associado)
                ->where('pessoa_id', '!=', $pessoa->id)->first();
            if ($existe) {
                return 'duplicado';
            }
        } else {
            $existe = Advogado::where('categoria', 'Estagiario')
                ->where('num_estagiario', $request->num_estagiario)
                ->where('pessoa_id', '!=', $pessoa->id)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        $existe = Pessoa::where('num_documento', $request->num_bi)
            ->where('id', '!=', $pessoa->id)
            ->first();

        if ($existe) {
            return 'bilhete';
        }

        // actualiza na tabela pessoa;

        $pessoa->nome = mb_strtoupper($request->nome_completo, 'UTF-8');
        $pessoa->num_documento = $request->num_bi;
        $pessoa->email = $request->email;
        $pessoa->telefone1 = $request->telefone1;
        $pessoa->telefone2 = $request->telefone2;
        $pessoa->documento = 'Bilhete de Identidade';
        $pessoa->genero = $request->sexo;
        $pessoa->save();

        // actualiza na tabela de advogado
        $advogado->categoria = $request->categoria;
        $advogado->nome_profissional = $request->nome_profissional;
        $advogado->num_associado = $request->num_associado;
        $advogado->num_estagiario = $request->num_estagiario;
        $advogado->data_inscricao_oaa = $request->data_inscricao_oaa;
        $advogado->data_inscricao_estagiario = $request->data_inscricao_estagiario;
        $advogado->nome_patrono = $request->nome_patrono;
        $advogado->email_patrono = $request->email_patrono;
        $advogado->telefone_patrono = $request->tel_patrono;
        $advogado->nome_escritorio = $request->nome_escritorio;
        $advogado->estado = 'Aguarda Cerimónia';
        $advogado->municipio_id = $request->categoria == 'Advogado' ? $request->municipio_id_adv : $request->municipio_id_est;
        $advogado->endereco_escritorio = $request->categoria == 'Advogado' ? $request->endereco_profissional_adv : $request->endereco_escritorio_est;
        $advogado->save();

        return 'sucesso';

    }

    public function registo_patrono_update(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $patrono = Patrono::find($request->patrono_id);
        $advogado = null;
        $pessoa = null;

        if ($patrono->advogado_id != null) {
            $advogado = Advogado::find($patrono->advogado_id);
            $pessoa = Pessoa::find($advogado->pessoa_id);
        }

        // verifica se já esxite na bd
        if ($advogado != null) {
            $existe = Advogado::where('categoria', 'Advogado')
                ->where('num_associado', $request->num_associado)
                ->where('pessoa_id', '!=', $pessoa->id)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        if ($pessoa != null) {
            $existe = Pessoa::where('num_documento', $request->num_bi)
                ->where('id', '!=', $pessoa->id)
                ->first();

            if ($existe) {
                return 'bilhete';
            }
        }

        // actualiza na tabela pessoa;
        if ($pessoa != null) {
            $pessoa->nome = mb_strtoupper($request->nome_completo, 'UTF-8');
            $pessoa->num_documento = $request->num_bi;
            $pessoa->email = $request->email;
            $pessoa->telefone1 = $request->telefone1;
            $pessoa->telefone2 = $request->telefone2;
            $pessoa->documento = 'Bilhete de Identidade';
            $pessoa->genero = $request->genero;
            $pessoa->save();
        }

        // actualiza na tabela de advogado
        if ($advogado != null) {
            $advogado->nome_profissional = mb_strtoupper($request->nome_profissional, 'UTF-8');
            $advogado->num_associado = $request->num_associado;
            $advogado->data_inscricao_oaa = $request->data_inscricao_oaa;
            $advogado->endereco_escritorio = $request->endereco_escritorio;
            $advogado->estado = 'Registado';
            $advogado->municipio_id = $request->municipio_id;
            $advogado->save();
        }

        // actualiza na tabela patrono
        $patrono->nome_escritorio = $request->nome_escritorio;
        $patrono->endereco_escritorio = $request->endereco_escritorio;
        $patrono->municipio_id = $request->municipio_id;
        $patrono->save();

        return 'sucesso';

    }

    public function data_cerimonia_update(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $advogado = Advogado::find($request->advogado_id);

        if ($advogado->categoria == 'Advogado') {
            $advogado->data_cerimonia_associado = $request->data_cerimonia;
        } else {
            $advogado->data_cerimonia_estagiario = $request->data_cerimonia;
        }
        $advogado->estado = 'Registado';
        $advogado->save();

        return 'sucesso';

    }

    public function pedido_intervencao_delete(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $pedido_id = $request->pedido_id;

        $pedido = Pedidointervencao::find($pedido_id);
        $pedido->delete();

        return 'sucesso';
    }

    public function estagiario_patrono_delete(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $registo = Estagiariospatrono::find($request->id);

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Exclusão de um advogado estagiário na lista de um patrono", 'geral', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Eliminou um advogado estagiário na lista de um patrono", 'user', auth()->user()->id);

        $registo->delete();
        return 'sucesso';

    }

    public function atribuir_advogado_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $registo = Registoentrada::find($request->registo_id);
        $advogado = Advogado::find($request->advogado_id);

        $existe = Advogadoatribuido::where('registo_entrada_id', $registo->id)
            ->where('advogado_id', $advogado->id)
            ->first();

        if ($existe) {
            return 'duplicado';
        }

        $atribuicao = Advogadoatribuido::create([
            'registo_entrada_id' => $registo->id,
            'advogado_id' => $advogado->id,
            'user_id' => auth()->user()->id
        ]);

        $nome_advogado = $advogado->getpessoa->nome;

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Atribuição de advogado para a assistência judiciária", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Atribuiu o advogado $nome_advogado para a assistência judiciária", 'user', auth()->user()->id);

        return 'sucesso';

    }

    public function atribuir_advogado_delete(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $registo = Registoentrada::find($request->registo_id);
        $id = $request->id;

        $existe = Advogadoatribuido::find($id);
        $existe->delete();

        return 'sucesso';

    }

    public function registo_inscricao_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $registo = Registoentrada::find($request->registo_entrada_id);
        $registo->estado = 'em tratamento';
        $registo->save();

        $numero = '';
        if ($registo->tipo_processo_id == 2) {
            $numero = Inscricaoadvogado::where('tipo_processo_id', 2)->whereYear('created_at', now()->year)->count() + 1;
        } else {
            $numero = Inscricaoadvogado::where('tipo_processo_id', 3)->whereYear('created_at', now()->year)->count() + 1;
        }

        // registo de inscrição para advogados
        if ($request->tipo_processo_id == 2) {

            $inscricao = Inscricaoadvogado::create([
                'hash' => Str::uuid(),
                'numero' => $numero,
                'codigo' => "$numero/" . now()->year,
                'observacao' => $request->observacao2,
                'tipo_processo_id' => $registo->tipo_processo_id,
                'sexo' => $request->sexo == null ? 'Não Definido' : $request->sexo,
                'telefone1' => $request->telefone1,
                'telefone2' => $request->telefone2,
                'email' => $request->email,
                'acto_pretendido' => $request->acto_pretendido,
                'registo_entrada_id' => $registo->id,
                'user_id' => Auth::user()->id
            ]);

            $ob = new MailController();
            $obmsg = new OmbalaController();
            $nome = $registo->proveniencia;

            $mensagem_not = "O seu processo de inscrição para advogado foi registado pela área técnica, aguardando por avaliação.";

            try {
                $obmsg->enviarMensagem($inscricao->telefone1, $mensagem_not);
                if ($request->email != null && $request->email != '') {
                    $ob->mailNotificacao($request->email, $nome, $mensagem_not, $registo->data_entrada);
                }
            } catch (\Throwable $th) {

            }

            ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Processo está aguardando por avaliação de conselheiros e comissão de ética.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou o processo de inscrição ($inscricao->id)", 'user', $inscricao->id);

        }

        // registo de inscrição para advogados estagiários
        else {

            $patrono_id = null;

            // avaliação da situação de patronos existentes
            if ($request->patrono_id != null && $request->patrono_id != '') {

                $patrono_id = $request->patrono_id;
                $patrono = Patrono::find($patrono_id);
                $advogado = Advogado::find($patrono->advogado_id);
                $pessoa = Pessoa::find($advogado->pessoa_id);

                // faz validações
                if ($request->num_cedula_patrono != null && $request->num_cedula_patrono != '') {
                    $existe = null;
                    $existe = Advogado::where('categoria', 'Advogado')
                        ->where('num_associado', $request->num_cedula_patrono)
                        ->where('pessoa_id', '!=', $pessoa->id)->first();

                    if ($existe) {
                        return 'duplicado';
                    }

                    $advogado->num_associado = $request->num_cedula_patrono;
                    $advogado->save();
                }

                if ($request->tel_patrono != null && $request->tel_patrono != '') {
                    $pessoa->telefone1 = $request->tel_patrono;
                    $pessoa->save();
                }

                if ($request->email_patrono != null && $request->email_patrono != '') {
                    $pessoa->email = $request->email_patrono;
                    $pessoa->save();
                }

                if ($request->nome_escritorio != null && $request->nome_escritorio != '') {
                    $advogado->nome_escritorio = $request->nome_escritorio;
                    $advogado->save();
                }

                if ($request->endereco_escritorio != null && $request->endereco_escritorio != '') {
                    $advogado->endereco_escritorio = $request->endereco_escritorio;
                    $advogado->save();
                }

                if ($request->municipio_id != null && $request->municipio_id != '') {
                    $advogado->municipio_id = $request->municipio_id;
                    $advogado->save();
                }

            }
            // avaliação da situação de novos patronos
            else if ($request->acto_pretendido != 'Indicação de Patrono') {

                // cadastra pessoa
                $pessoa = Pessoa::create([
                    'nome' => mb_strtoupper($request->nome_patrono, 'UTF-8'),
                    'email' => $request->email_patrono,
                    'telefone1' => $request->tel_patrono,
                    'documento' => 'Bilhete de Identidade',
                ]);

                // cadastra advogado
                $advogado = Advogado::create([
                    'categoria' => 'Advogado',
                    'nome_profissional' => $pessoa->nome,
                    'num_associado' => $request->num_cedula_patrono,
                    'pessoa_id' => $pessoa->id,
                    'codigo' => 'CPL$numero',
                    'hash' => Str::uuid(),
                    'endereco_escritorio' => $request->endereco_escritorio,
                    'municipio_id' => $request->municipio_id,
                    'nome_escritorio' => $request->nome_escritorio,
                    'estado' => 'Registado',
                    'user_id' => Auth::user()->id
                ]);

                // cadastra patrono
                $patrono = Patrono::create([
                    'hash' => Str::uuid(),
                    'advogado_id' => $advogado->id,
                    'user_id' => Auth::user()->id
                ]);

                $patrono_id = $patrono->id;

            }

            $dataHoje = date('Y-m-d');

            $inscricao = Inscricaoadvogado::create([
                'hash' => Str::uuid(),
                'numero' => $numero,
                'codigo' => "$numero/" . now()->year,
                'observacao' => $request->observacao,
                'texto_despacho' => $request->observacao,
                'tipo_processo_id' => $registo->tipo_processo_id,
                'sexo' => $request->genero == null ? 'Não Definido' : $request->genero,
                'telefone1' => $request->telefone1,
                'telefone2' => $request->telefone2,
                'email' => $request->email,
                'despacho' => 'Deferido',
                'data_despacho' => $dataHoje,
                'acto_pretendido' => $request->acto_pretendido,
                'registo_entrada_id' => $registo->id,
                'patrono_id' => $patrono_id,
                'num_bilhete' => $request->num_bilhete,
                'user_id' => Auth::user()->id
            ]);

            if ($request->acto_pretendido != 'Indicação de Patrono') {

                $est_patrono = Estagiariospatrono::create([
                    'patrono_id' => $patrono_id,
                    'inscricao_advogado_id' => $inscricao->id,
                    'estado' => 'frequenta',
                    'user_id' => Auth::user()->id
                ]);

            }

            // envia notificacao ao requerente
            $mensagem_not = "";

            if ($request->acto_pretendido == 'Indicação de Patrono') {

                $inscricao->despacho = null;
                $inscricao->save();

                $mensagem_not = "O seu processo já foi registado na área técnica, mas aguarda por indicação de patrono";
                ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
                ActividadesistemaController::inserir(Auth::id(), "Processo está pendente aguardando indicação de patrono", 'registo-entrada', $registo->id);

            } else {

                if ($request->observacao != null && $request->observacao != '') {

                    $inscricao->despacho = 'Indeferido';
                    $inscricao->save();

                    $mensagem_not = $request->observacao;

                    ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
                    ActividadesistemaController::inserir(Auth::id(), "Processo despachado como Indeferido: $mensagem_not", 'registo-entrada', $registo->id);

                } else {

                    $inscricao->despacho = 'Deferido';
                    $inscricao->save();

                    $mensagem_not = "O seu processo já foi registado na área técnica. O processo aguarda pela assinatura do Presidente";

                    ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
                    ActividadesistemaController::inserir(Auth::id(), "Processo despachado como deferido.", 'registo-entrada', $registo->id);
                    ActividadesistemaController::inserir(Auth::id(), "Processo aguardando a assinatura do Presidente.", 'registo-entrada', $registo->id);

                }

            }

            $ob = new MailController();
            $obmsg = new OmbalaController();
            $nome = $registo->proveniencia;

            try {
                $obmsg->enviarMensagem($inscricao->telefone1, $mensagem_not);
                if ($request->email != null && $request->email != '') {
                    $ob->mailNotificacao($request->email, $nome, $mensagem_not, $registo->data_entrada);
                }
            } catch (\Throwable $th) {

            }

            ActividadesistemaController::inserir(Auth::id(), "Registou o processo de inscrição ($inscricao->id)", 'user', $inscricao->id);

        }

        return 'sucesso';

    }

    public function editar_inscricao_estagiario_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $registo = Registoentrada::find($request->registo_entrada_id);
        $inscricao = Inscricaoadvogado::where('registo_entrada_id', $request->registo_entrada_id)->first();

        $patrono_id = null;

        // avaliação da situação de patronos existentes
        if ($request->patrono_id != null && $request->patrono_id != '') {

            $patrono_id = $request->patrono_id;
            $patrono = Patrono::find($patrono_id);
            $advogado = Advogado::find($patrono->advogado_id);
            $pessoa = Pessoa::find($advogado->pessoa_id);

            // faz validações
            if ($request->num_cedula_patrono != null && $request->num_cedula_patrono != '') {
                $existe = null;
                $existe = Advogado::where('categoria', 'Advogado')
                    ->where('num_associado', $request->num_cedula_patrono)
                    ->where('pessoa_id', '!=', $pessoa->id)->first();

                if ($existe) {
                    return 'duplicado';
                }

                $advogado->num_associado = $request->num_cedula_patrono;
                $advogado->save();
            }

            if ($request->tel_patrono != null && $request->tel_patrono != '') {
                $pessoa->telefone1 = $request->tel_patrono;
                $pessoa->save();
            }

            if ($request->email_patrono != null && $request->email_patrono != '') {
                $pessoa->email = $request->email_patrono;
                $pessoa->save();
            }

            if ($request->nome_escritorio != null && $request->nome_escritorio != '') {
                $advogado->nome_escritorio = $request->nome_escritorio;
                $advogado->save();
            }

            if ($request->endereco_escritorio != null && $request->endereco_escritorio != '') {
                $advogado->endereco_escritorio = $request->endereco_escritorio;
                $advogado->save();
            }

            if ($request->municipio_id != null && $request->municipio_id != '') {
                $advogado->municipio_id = $request->municipio_id;
                $advogado->save();
            }

            // verifica se o registo anterior tinha patrono e se é diferente do novo, remove o antigo
            if ($inscricao->patrono_id != null && $inscricao->patrono_id != $request->patrono_id) {

                $est = Estagiariospatrono::where('patrono_id', $inscricao->patrono_id)
                    ->where('inscricao_advogado_id', $inscricao->id)->first();
                $est->delete();

            }

        }
        // avaliação da situação de novos patronos
        else if ($request->acto_pretendido != 'Indicação de Patrono') {

            // cadastra pessoa
            $pessoa = Pessoa::create([
                'nome' => mb_strtoupper($request->nome_patrono, 'UTF-8'),
                'email' => $request->email_patrono,
                'telefone1' => $request->tel_patrono,
                'documento' => 'Bilhete de Identidade',
            ]);

            // cadastra advogado
            $advogado = Advogado::create([
                'categoria' => 'Advogado',
                'nome_profissional' => $pessoa->nome,
                'num_associado' => $request->num_cedula_patrono,
                'pessoa_id' => $pessoa->id,
                'codigo' => 'CPL$numero',
                'hash' => Str::uuid(),
                'endereco_escritorio' => $request->endereco_escritorio,
                'municipio_id' => $request->municipio_id,
                'nome_escritorio' => $request->nome_escritorio,
                'estado' => 'Registado',
                'user_id' => Auth::user()->id
            ]);

            // cadastra patrono
            $patrono = Patrono::create([
                'hash' => Str::uuid(),
                'advogado_id' => $advogado->id,
                'user_id' => Auth::user()->id
            ]);

            $patrono_id = $patrono->id;

        }

        $dataHoje = date('Y-m-d');

        $inscricao->observacao = $request->observacao;
        $inscricao->texto_despacho = $request->observacao;
        $inscricao->sexo = $request->genero == null ? 'Não Definido' : $request->genero;
        $inscricao->telefone1 = $request->telefone1;
        $inscricao->telefone2 = $request->telefone2;
        $inscricao->email = $request->email;
        $inscricao->despacho = 'Deferido';
        $inscricao->data_despacho = $dataHoje;
        $inscricao->acto_pretendido = $request->acto_pretendido;
        $inscricao->patrono_id = $patrono_id;
        $inscricao->num_bilhete = $request->num_bilhete;
        $inscricao->save();

        if ($request->acto_pretendido != 'Indicação de Patrono') {

            $est_patrono = Estagiariospatrono::create([
                'patrono_id' => $patrono_id,
                'inscricao_advogado_id' => $inscricao->id,
                'estado' => 'frequenta',
                'user_id' => Auth::user()->id
            ]);

        }

        // envia notificacao ao requerente
        $mensagem_not = "";

        if ($request->acto_pretendido == 'Indicação de Patrono') {

            $inscricao->despacho = null;
            $inscricao->save();

            $mensagem_not = "O seu processo foi actualizado na área técnica, mas aguarda por indicação de patrono";
            ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição actualizado pela área técnica.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Processo está pendente aguardando indicação de patrono", 'registo-entrada', $registo->id);

        } else {

            if ($request->observacao != null && $request->observacao != '') {

                $inscricao->despacho = 'Indeferido';
                $inscricao->save();

                $mensagem_not = $request->observacao;

                ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição actualizado pela área técnica.", 'registo-entrada', $registo->id);
                ActividadesistemaController::inserir(Auth::id(), "Processo despachado como Indeferido: $mensagem_not", 'registo-entrada', $registo->id);

            } else {

                $inscricao->despacho = 'Deferido';
                $inscricao->save();

                $mensagem_not = "O seu processo foi actualizado na área técnica. O processo aguarda pela assinatura do Presidente";

                ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
                ActividadesistemaController::inserir(Auth::id(), "Processo despachado como deferido.", 'registo-entrada', $registo->id);
                ActividadesistemaController::inserir(Auth::id(), "Processo aguardando a assinatura do Presidente.", 'registo-entrada', $registo->id);

            }

        }

        $ob = new MailController();
        $obmsg = new OmbalaController();
        $nome = $registo->proveniencia;

        try {
            $obmsg->enviarMensagem($inscricao->telefone1, $mensagem_not);
            if ($request->email != null && $request->email != '') {
                $ob->mailNotificacao($request->email, $nome, $mensagem_not, $registo->data_entrada);
            }
        } catch (\Throwable $th) {

        }

        ActividadesistemaController::inserir(Auth::id(), "Registou o processo de inscrição ($inscricao->id)", 'user', $inscricao->id);



        return 'sucesso';

    }

    public function registo_remetercn_update(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $selecionados = $request->selecionados;
        // dd($request->all());
        foreach ($selecionados as $item) {

            $inscricao_adv = Inscricaoadvogado::find($item);
            $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);
            $registo->estado = 'deferido';
            $registo->save();
            $inscricao_adv->despacho = 'Deferido';
            $inscricao_adv->data_remessa_cn = $request->data_remessa_cn;
            $inscricao_adv->save();

            // notifica o advogado por SMS
            $obmsg = new OmbalaController();
            $telefone = $registo->telefone;
            $mensagem = "Caríssimo(a), o seu processo de inscrição foi remetido ao Conselho Nacional na data " . $request->data_remessa_cn;

            try {
                $obmsg->enviarMensagem($telefone, $mensagem);
            } catch (\Throwable $th) {

            }

            // regista actividade no sistema
            ActividadesistemaController::inserir(Auth::id(), "Processo remetido ao Conselho Nacional pela área técnica.", 'registo-entrada', $registo->id);
            ActividadesistemaController::inserir(Auth::id(), "Registou a data de remessa ao conselho nacional do processo de inscrição ($inscricao_adv->codigo)", 'user', $inscricao_adv->id);

        }

        return 'sucesso';


    }

    public function registo_mudarindeferido_update(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $inscricao_adv = Inscricaoadvogado::find($request->inscricao_id);
        $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);

        $registo->estado = 'em tratamento';
        $registo->save();

        $inscricao_adv->despacho = 'Indeferido';
        $inscricao_adv->data_despacho = $request->data_despacho;
        $inscricao_adv->observacao = $request->mensagem_despacho;
        $inscricao_adv->texto_despacho = $request->mensagem_despacho;
        $inscricao_adv->save();

        // notifica o advogado por SMS
        $obmsg = new OmbalaController();
        $ob = new MailController();
        $telefone = $registo->telefone;
        $email = $inscricao_adv->email;
        $nome = $registo->proveniencia;
        $mensagem = $inscricao_adv->texto_despacho;

        try {
            $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. Consulte o seu email, verificou-se uma irregularidade no seu processo de inscrição.");
            if ($email != null && $email != '') {
                $ob->mailDespacho($email, $nome, $mensagem, $inscricao_adv->data_despacho);
            }
        } catch (\Throwable $th) {

        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Processo alterado para indeferido com a seguinte mensagem: $inscricao_adv->texto_despacho", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Alterou o estado do processo ($inscricao_adv->codigo) para indeferido com a seguinte mensagem: $inscricao_adv->texto_despacho", 'user', $inscricao_adv->id);

        return 'sucesso';

    }

    public function registoadicional_ceduladisponivel(Request $request)
    {

        $inscricao_adv = Inscricaoadvogado::find($request->inscricao_id);
        $registo = Registoentrada::find($inscricao_adv->registo_entrada_id);

        // verifica se o número da cédula já existe
        if ($inscricao_adv->tipo_processo_id == 3) {
            $existe = Advogado::where('categoria', 'Estagiario')->where('num_estagiario', $request->numero_cedula)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        if ($inscricao_adv->tipo_processo_id == 2) {
            $existe = Advogado::where('categoria', 'Advogado')->where('num_associado', $request->numero_cedula)->first();
            if ($existe) {
                return 'duplicado';
            }
        }

        date_default_timezone_set("Africa/Luanda");

        $registo->estado = 'em tratamento';
        $registo->save();

        $inscricao_adv->numero_cedula = $request->numero_cedula;
        $inscricao_adv->cedula_disponivel = $request->cedula_disponivel;
        $inscricao_adv->data_emissao_cedula = $request->data_emissao_cedula;
        $inscricao_adv->estado = 'aguarda cerimonia';
        $inscricao_adv->save();

        // insere na tabela de pessoa
        $pessoa = Pessoa::create([
            'nome' => mb_strtoupper($registo->proveniencia, 'UTF-8'),
            'num_documento' => $inscricao_adv->num_bilhete,
            'email' => strtolower($inscricao_adv->email),
            'telefone1' => $inscricao_adv->telefone1,
            'telefone2' => $inscricao_adv->telefone2,
            'documento' => 'Bilhete de Identidade',
            'genero' => $inscricao_adv->sexo
        ]);

        // insere na tabela dos advogados
        $advogado = Advogado::create([
            'categoria' => $inscricao_adv->tipo_processo_id == 3 ? 'Estagiario' : 'Advogado',
            'nome_profissional' => $pessoa->nome,
            'num_associado' => $inscricao_adv->tipo_processo_id == 3 ? null : $inscricao_adv->numero_cedula,
            'num_estagiario' => $inscricao_adv->tipo_processo_id == 2 ? null : $inscricao_adv->numero_cedula,
            'pessoa_id' => $pessoa->id,
            'hash' => Str::uuid(),
            'estado' => 'Aguarda Cerimónia',
            'data_inscricao_oaa' => $inscricao_adv->tipo_processo_id == 3 ? null : $inscricao_adv->data_emissao_cedula,
            'data_inscricao_estagiario' => $inscricao_adv->tipo_processo_id == 2 ? null : $inscricao_adv->data_emissao_cedula
        ]);

        $advogado->codigo = 'CPL' . $advogado->id;
        $advogado->municipio_id = $inscricao_adv->municipio_id;
        $advogado->endereco_escritorio = $inscricao_adv->endereco_escritorio;
        $advogado->save();

        if ($inscricao_adv->tipo_processo_id == 3) {
            $patrono = Patrono::find($inscricao_adv->patrono_id);
            $advogado->nome_patrono = $patrono->getadvogado->getpessoa->nome;
            $advogado->email_patrono = $patrono->getadvogado->getpessoa->email;
            $advogado->telefone_patrono = $patrono->getadvogado->getpessoa->telefone1;
            $advogado->nome_escritorio = $patrono->getadvogado->nome_escritorio;
            $advogado->save();
        }

        // notifica o advogado por SMS
        $obmsg = new OmbalaController();
        $ob = new MailController();
        $telefone = $inscricao_adv->telefone1;
        $email = strtolower($inscricao_adv->email);
        $nome = $pessoa->nome;

        try {
            $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. A sua cédula já está disponível no CPL, mas deverá aguardar a cerimónia de entrega.");
            if ($email != null && $email != '') {
                // $ob->mailDespacho($email, $nome, $mensagem, $inscricao_adv->data_despacho);
            }
        } catch (\Throwable $th) {

        }

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "A cédula já está disponível, aguardando a data de cerimónia de entrega", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Fez o registo da disponibilidade da cédula e aguardando a cerimónia de entrega", 'user', $inscricao_adv->id);

        return 'sucesso';

    }
    public function registo_despacho_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $inscricao_advogado = Inscricaoadvogado::find($request->inscricao_advogado_id);
        $registo = Registoentrada::find($request->registo_entrada_id);

        if ($request->despacho == 'Deferido') {

            $inscricao_advogado->texto_despacho = $request->mensagem_despacho;
            $inscricao_advogado->despacho = $request->despacho;
            $inscricao_advogado->data_despacho = $request->data_despacho;
            $inscricao_advogado->save();

            $registo->estado = 'deferido';
            $registo->save();

            $telefone = $inscricao_advogado->telefone1;
            $obmsg = new OmbalaController();
            $obmsg->enviarMensagem($telefone, "Caríssimo(a), o seu processo de inscrição foi despachado como Deferido.");

            $msg = "Processo de inscrição despachado como $request->despacho.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo->id);

        } else if ($request->despacho == 'Indeferido') {

            $inscricao_advogado = Inscricaoadvogado::find($request->inscricao_advogado_id);
            $inscricao_advogado->observacao = $request->mensagem_despacho;
            $inscricao_advogado->texto_despacho = $request->mensagem_despacho;
            $inscricao_advogado->despacho = $request->despacho;
            $inscricao_advogado->data_despacho = $request->data_despacho;
            $inscricao_advogado->save();

            $nome = $registo->proveniencia;
            $email = $inscricao_advogado->email;
            $telefone = $inscricao_advogado->telefone1;
            $data_despacho = $request->data_despacho;
            $ob = new MailController();
            $obmsg = new OmbalaController();

            try {
                $obmsg->enviarMensagem($telefone, "Caríssimo(a), consulte o seu email, verificou-se uma irregularidade no seu processo de inscrição.");
                if ($email != null && $email != '') {
                    $ob->mailDespacho($email, $nome, $request->mensagem_despacho, $data_despacho);
                }
            } catch (\Throwable $th) {

            }

            $msg = "Processo de inscrição despachado como $request->despacho, com a seguinte mensagem: $request->mensagem_despacho.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo->id);

        }
        else if ($request->despacho == 'Sobre a mesa do Presidente') {

            $inscricao_advogado = Inscricaoadvogado::find($request->inscricao_advogado_id);
            $inscricao_advogado->texto_despacho = "";
            $inscricao_advogado->observacao = "";
            $inscricao_advogado->despacho = null;
            $inscricao_advogado->estado = 'Sobre a mesa do Presidente';
            $inscricao_advogado->data_despacho = $request->data_despacho;
            $inscricao_advogado->save();

            $nome = $registo->proveniencia;
            $email = $inscricao_advogado->email;
            $telefone = $inscricao_advogado->telefone1;
            $data_despacho = $request->data_despacho;
            $ob = new MailController();
            $obmsg = new OmbalaController();

            $mensagem = "Caríssimo(a), foi sanada a irregularidade do seu processo e a mesma foi remetida à mesa do Sr. Presidente do CPL.";

            try {
                $obmsg->enviarMensagem($telefone, $mensagem);
                if ($email != null && $email != '') {
                    $ob->mailNotificacao($email, $nome, $mensagem, $registo->data_entrada);
                }
            } catch (\Throwable $th) {

            }

            $msg = "Processo de inscrição remetido à mesa do Sr. Presidente do CPL.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo->id);

        }

        $msg = "Registou a emissão de despacho para o processo de inscrição como $request->despacho.";
        ActividadesistemaController::inserir(Auth::id(), $msg, 'user', $registo->id);

        return 'sucesso';

    }

    public function actualizar_despacho_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $inscricao_advogado = Inscricaoadvogado::find($request->inscricao_advogado_id);
        $registo_inscricao_old = Inscricaoadvogado::where('registo_entrada_id', $request->registo_entrada_id)->first();
        if ($registo_inscricao_old->data_remessa_cn != $request->data_remessa_cn && $request->data_remessa_cn != null) {

            $inscricao_advogado->data_remessa_cn = $request->data_remessa_cn;
            $inscricao_advogado->save();
            $msg = "Actualizou a data de remessa para o CN ($request->data_remessa_cn).";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);

        }
        if ($registo_inscricao_old->data_emissao_cedula != $request->data_emissao_cedula && $request->data_emissao_cedula != null) {

            $inscricao_advogado->data_emissao_cedula = $request->data_emissao_cedula;
            $inscricao_advogado->save();
            $msg = "Actualizou a data de emissão da cédula ($request->data_emissao_cedula).";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
        }
        if ($registo_inscricao_old->numero_cedula != $request->numero_cedula && $request->numero_cedula != null) {

            $inscricao_advogado->numero_cedula = $request->numero_cedula;
            $inscricao_advogado->save();
            $msg = "Actualizou o número da cédula ($request->numero_cedula).";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
        }
        if ($registo_inscricao_old->cedula_disponivel != $request->cedula_disponivel && $request->cedula_disponivel != null) {

            $inscricao_advogado->cedula_disponivel = $request->cedula_disponivel;
            $inscricao_advogado->save();
            $msg = "Actualizou o estado de disponibilidade da cédula. Cédula disponível: $request->cedula_disponivel.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);
        }
        if ($registo_inscricao_old->data_cerimonia != $request->data_cerimonia && $request->data_cerimonia != null) {

            $inscricao_advogado->data_cerimonia = $request->data_cerimonia;
            $inscricao_advogado->save();
            $msg = "Actualizou a data da cerimónia ($request->data_cerimonia).";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo_inscricao_old->id);

        }

        return 'sucesso';

    }

    public function getDataInscricaoAdvogadoById($id)
    {
        $inscricao = Inscricaoadvogado::with(['getregistoentrada', 'getconselheiro', 'patrono'])->findOrFail($id);
        return response()->json($inscricao);
    }

    public function getAdvogadoById($id)
    {
        $advogado = Advogado::with(['getpessoa', 'getmunicipio'])->findOrFail($id);
        return response()->json($advogado);
    }

    public function getAdvogadoByData($tipo_p, $numero_p, $categoria_p)
    {

        $advogado = null;

        if ($tipo_p == 'cedula') {

            // pesquisar pela cédula e categoria
            if ($categoria_p == 'Advogado') {
                $advogado = Advogado::with(['getpessoa', 'getmunicipio'])
                    ->where('num_associado', $numero_p)->first();
                return response()->json($advogado);
            } else {
                $advogado = Advogado::with(['getpessoa', 'getmunicipio'])
                    ->where('num_estagiario', $numero_p)->first();
                return response()->json($advogado);
            }

        } else {

            // pesquisar pelo número do bilhete
            $bilhete = strtoupper($numero_p);
            $pessoa = Pessoa::where('num_documento', $bilhete)->first();
            if ($pessoa) {
                $advogado = Advogado::with(['getpessoa', 'getmunicipio'])->where('pessoa_id', $pessoa->id)->first();
                return response()->json($advogado);
            }

        }

    }

    public function getHistoricoProcesso($id)
    {
        $historico = Historicosistema::join('users', 'users.id', 'historico_sistema.user_id')
            ->join('pessoa', 'pessoa.id', 'users.pessoa_id')
            ->where('historico_sistema.destino', 'registo-entrada')
            ->where('historico_sistema.destino_id', $id)
            ->select('historico_sistema.*', 'pessoa.nome')
            ->orderBy('historico_sistema.id', 'desc')
            ->get();

        return response()->json($historico);
    }

    public function getPatronoById($id)
    {
        $patrono = Patrono::with(['getadvogado', 'getmunicipio'])->findOrFail($id);
        return response()->json($patrono);
    }

    public function getEstagiariosPatrono($id)
    {
        $estagiarios = Estagiariospatrono::with(['getpatrono', 'getestagiario', 'getinscricao'])
            ->where('patrono_id', $id)->get();
        return response()->json($estagiarios);
    }

    public function getLinhaEstagiariosPatrono($id)
    {
        $estagiarios = Estagiariospatrono::find($id);

        $nome = '';
        $cedula = '';
        $categoria = '';
        $estado = '';


        if ($estagiarios->estagiario_id != null) {
            $nome = $estagiarios->getestagiario->getpessoa->nome;
            $categoria = $estagiarios->getestagiario->categoria;
            $cedula = $estagiarios->getestagiario->num_estagiario;
            if ($categoria == 'Advogado') {
                $cedula = $estagiarios->getestagiario->num_associado;
            }
            $estado = $estagiarios->estado;
        } else if ($estagiarios->inscricao_advogado_id != null) {
            $nome = $estagiarios->getinscricao->getregistoentrada->proveniencia;
            $categoria = 'Estagiario';
            $cedula = '----';
            $estado = $estagiarios->estado;
        } else {
            $nome = $estagiarios->nome_estagiario;
            $categoria = 'Estagiario';
            $cedula = '----';
            $estado = $estagiarios->estado;
        }

        return [
            'nome' => $nome,
            'categoria' => $categoria,
            'cedula' => $cedula,
            'estado' => $estado
        ];



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

    public function documento_assistencia($hash_registo)
    {

        $registo_entrada = Registoentrada::where('hash', $hash_registo)->first();
        $advogado_atribuido = null;
        $inscricao_advogado = null;

        $nome_advogado = '';
        $telefone_advogado = '';
        $email_advogado = '';
        $categoria_advogado = '';
        $endereco_advogado = '';

        if ($registo_entrada) {
            $inscricao_advogado = Inscricaoadvogado::where('registo_entrada_id', $registo_entrada->id)->first();
            $advogado_atribuido = Advogadoatribuido::where('registo_entrada_id', $registo_entrada->id)->first();
        }

        if ($advogado_atribuido) {
            if ($advogado_atribuido->advogado_id != null) {
                $nome_advogado = $advogado_atribuido->getadvogado->getpessoa->nome;
                $telefone_advogado = $advogado_atribuido->getadvogado->getpessoa->telefone;
                $email_advogado = $advogado_atribuido->getadvogado->getpessoa->email;
                $categoria_advogado = $advogado_atribuido->getadvogado->categoria;
                $endereco_advogado = $advogado_atribuido->getadvogado->endereco;
            } else {
                $nome_advogado = $advogado_atribuido->nome_completo;
                $telefone_advogado = $advogado_atribuido->telefone;
                $email_advogado = $advogado_atribuido->email;
                $categoria_advogado = $advogado_atribuido->categoria;
                $endereco_advogado = $advogado_atribuido->endereco;
            }
        } else {
            $nome_advogado = 'Não atribuído';
            $telefone_advogado = 'Não atribuído';
            $email_advogado = 'Não atribuído';
            $categoria_advogado = 'Não atribuído';
            $endereco_advogado = 'Não atribuído';
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

        $pdf = Pdf::loadView('documents-pdf.documento-assistencia1', [
            'nome_advogado' => $nome_advogado,
            'telefone_advogado' => $telefone_advogado,
            'email_advogado' => $email_advogado,
            'categoria_advogado' => $categoria_advogado,
            'endereco_advogado' => $endereco_advogado
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
            if (str_contains($dado->proveniencia, '(')) {
                $partes = explode('(', $dado->proveniencia);
                $proveniencia = trim($partes[0]);
                $partes = explode(')', $partes[1]);
                $titulo = trim($partes[0]);
            } else {
                $proveniencia = $dado->proveniencia;
                $titulo = 'Cidadão';
            }

            if (str_contains($dado->assunto, 'Inscrição para Advogado')) {
                $tipo_processo_id = 2;
            } else if (str_contains($dado->assunto, 'Pedido de AJ')) {
                $tipo_processo_id = 1;
            } else if (str_contains($dado->assunto, 'Reinscrição')) {
                $tipo_processo_id = 2;
            } else if (str_contains($dado->assunto, 'Solicitação de Declaração')) {
                $tipo_processo_id = 5;
            } else if (str_contains($dado->assunto, 'mudança de patrono')) {
                $tipo_processo_id = 6;
            } else {
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

    public function trata_patronos()
    {

        dd('stop');
        $dados = DB::select('select * from patronos_old where feito = 0');

        foreach ($dados as $dado) {

            set_time_limit(0);
            date_default_timezone_set("Africa/Luanda");

            if ($dado->nome_patrono != null && $dado->nome_patrono != '' && $dado->nome_patrono != '??') {

                // pega todas linhas deste patrono
                $linhas_patrono = DB::select("select * from patronos_old where nome_patrono = '$dado->nome_patrono'");
                $contador = 0;

                // dd($linhas_patrono);

                foreach ($linhas_patrono as $linha) {

                    if ($linha->feito == 0) {

                        if ($contador == 0) {
                            // cadastra patrono
                            $advogado_id = null;
                            $existe = Pessoa::where('nome', $linha->nome_patrono)->first();
                            if ($existe != null) {
                                $advogado = Advogado::where('pessoa_id', $existe->id)->first();
                                if ($advogado) {
                                    $advogado_id = $advogado->id;
                                }
                            }

                            $patrono = Patrono::create([
                                'nome' => $advogado_id == null ? $dado->nome_patrono : null,
                                'hash' => Str::uuid(),
                                'advogado_id' => $advogado_id,
                                'user_id' => 1
                            ]);

                            echo "Patrono: $patrono->id - $patrono->nome <br><br>";
                        }

                        // verifica se o estagiario dele já existe

                        if ($linha->nome_advogado_estagiario != null && $linha->nome_advogado_estagiario != '' && $linha->nome_advogado_estagiario != '??') {

                            $estagiario_id = null;
                            $existe = null;
                            $estado = 'frequenta';

                            $existe = Pessoa::where('nome', $linha->nome_advogado_estagiario)->first();
                            if ($existe != null) {
                                $advogado = Advogado::where('pessoa_id', $existe->id)->first();
                                if ($advogado != null) {
                                    $estagiario_id = $advogado->id;
                                    if ($advogado->num_associado != null) {
                                        $estado = 'terminado';
                                    }
                                }
                            }

                            $est_patrono = Estagiariospatrono::create([
                                'estagiario_id' => $estagiario_id,
                                'nome_estagiario' => $estagiario_id == null ? $linha->nome_advogado_estagiario : null,
                                'patrono_id' => $patrono->id,
                                'estado' => $estado,
                                'user_id' => 1
                            ]);
                        }

                        DB::update("update patronos_old set feito = 1 where id = $linha->id");
                    }

                    $contador++;
                }

            }

        }
    }

    public function trata_patronos_2()
    {

        $dados = Patrono::whereNull('advogado_id')->get();

        foreach ($dados as $dado) {

            set_time_limit(0);
            date_default_timezone_set("Africa/Luanda");

            // cadastra pessoa
            $pessoa = Pessoa::create([
                'nome' => mb_strtoupper($dado->nome, 'UTF-8'),
                'documento' => 'Bilhete de Identidade'
            ]);

            $conta = Advogado::count() + 1;

            // cadastra advogado
            $advogado = Advogado::create([
                'pessoa_id' => $pessoa->id,
                'categoria' => 'Advogado',
                'nome_profissional' => mb_strtoupper($dado->nome, 'UTF-8'),
                'codigo' => "CPL$conta",
                'hash' => Str::uuid(),
                'estado' => 'Registado'
            ]);

            // actualiza patrono
            $dado->advogado_id = $advogado->id;
            $dado->nome = null;
            $dado->save();

            echo "Patrono: $dado->id - $dado->nome <br><br>";

        }
    }

    public function trata_patronos_3()
    {

        $dados = Estagiariospatrono::where('estado', 'terminado')->get();

        $conta = 0;
        foreach ($dados as $dado) {

            $res = Advogado::find($dado->estagiario_id);
            if ($res->categoria == 'Estagiario') {
                if ($res->num_associado == '' || $res->num_associado == null || $res->num_associado == 'NULL') {
                    $dado->estado = 'frequenta';
                    $dado->save();
                    echo $res->getpessoa->nome . '<br><br>';
                }
            } else if ($res->categoria == 'Advogado') {
                if ($res->num_associado == '' || $res->num_associado == null || $res->num_associado == 'NULL') {
                    $dado->estado = 'frequenta';
                    $dado->save();
                    echo $res->getpessoa->nome . '<br><br>';
                }
            }

            $conta++;

        }
    }

    public function trata_advogados_especificar()
    {

        $dados = Advogado::where('categoria', 'Por especificar')->get();
        $conta = 0;

        foreach ($dados as $dado) {

            if ($dado->num_estagiario != '' && $dado->num_estagiario != null && $dado->num_estagiario != 'NULL') {
                $dado->categoria = 'Estagiario';
                $dado->save();
                echo $conta . ' Estagiario <br><br>';
            }

            if ($dado->num_associado != '' && $dado->num_associado != null && $dado->num_associado != 'NULL') {
                $dado->categoria = 'Advogado';
                $dado->save();
                echo $conta . ' Advogado <br><br>';
            }



            $conta++;

        }
    }

}
