<?php

namespace App\Http\Controllers;

use App\Models\Anexosregisto;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Platform\Advogado;
use App\Models\Registoentrada;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

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

}
