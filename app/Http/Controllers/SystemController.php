<?php

namespace App\Http\Controllers;

use App\Models\Advogadoatribuido;
use App\Models\Anexosregisto;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Inscricaoadvogado;
use App\Models\Mensagem;
use App\Models\Noticia;
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

        // verifica se já esxite na bd
        $existe = Advogado::where('categoria', $request->categoria)
            ->where('num_associado', $request->num_cedula)->first();
        if ($existe) {
            return 'duplicado';
        }

        $existe = Advogado::where('categoria', $request->categoria)
            ->where('num_estagiario', $request->num_cedula)->first();
        if ($existe) {
            return 'duplicado';
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

    public function pedido_intervencao_delete(Request $request)
    {
        $pedido_id = $request->pedido_id;

        $pedido = Pedidointervencao::find($pedido_id);
        $pedido->delete();

        return 'sucesso';
    }

    public function registo_inscricao_post(Request $request)
    {

        $registo = Registoentrada::find($request->registo_entrada_id);
        $registo->estado = 'em tratamento';
        $registo->save();

        $numero = '';
        if ($registo->tipo_processo_id == 2) {
            $numero = Inscricaoadvogado::where('tipo_processo_id', 2)->whereYear('created_at', now()->year)->count() + 1;
        } else {
            $numero = Inscricaoadvogado::where('tipo_processo_id', 3)->whereYear('created_at', now()->year)->count() + 1;
        }

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

        // regista actividade no sistema
        ActividadesistemaController::inserir(Auth::id(), "Processo de inscrição registado pela área técnica.", 'registo-entrada', $registo->id);
        ActividadesistemaController::inserir(Auth::id(), "Registou o processo de inscrição ($inscricao->id)", 'user', $inscricao->id);
        return 'sucesso';

    }

    public function registo_despacho_post(Request $request)
    {

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
            $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. Já foi emitido um despacho para o seu processo de inscrição.");

            $msg = "Processo de inscrição despachado como $request->despacho.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo->id);

        } else if ($request->despacho == 'Indeferido') {

            $inscricao_advogado = Inscricaoadvogado::find($request->inscricao_advogado_id);
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
                $obmsg->enviarMensagem($telefone, "Caríssimo(a), saudações. Já foi emitido um despacho para o seu processo de inscrição.");
                if ($email != null && $email != '') {
                    $ob->mailDespacho($email, $nome, $request->mensagem_despacho, $data_despacho);
                }
            } catch (\Throwable $th) {

            }

            $msg = "Processo de inscrição despachado como $request->despacho, com a seguinte mensagem: $request->mensagem_despacho.";
            ActividadesistemaController::inserir(Auth::id(), $msg, 'registo-entrada', $registo->id);

        }

        $msg = "Registou a emissão de despacho para o processo de inscrição.";
        ActividadesistemaController::inserir(Auth::id(), $msg, 'user', $registo->id);

        return 'sucesso';

    }

    public function actualizar_despacho_post(Request $request)
    {

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
        $inscricao = Inscricaoadvogado::find($id);
        return response()->json($inscricao);
    }

    public function getAdvogadoById($id)
    {
        $advogado = Advogado::find($id);
        return response()->json($advogado);
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

}
