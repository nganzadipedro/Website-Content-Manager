<?php

namespace App\Http\Controllers;

use App\Exports\Listaaguardacerimoniaexport;
use App\Exports\Listaindefinidosexport;
use App\Exports\Listaestagiariosexport;
use App\Exports\Listaadvogadosexport;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Pessoa;
use App\Models\Platform\Advogado;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

}
