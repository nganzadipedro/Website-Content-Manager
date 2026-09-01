<?php

namespace App\Http\Controllers;

use App\Models\Carrossel;
use App\Models\Estagiariospatrono;
use App\Models\Inscricaoadvogado;
use App\Models\Municipio;
use App\Models\Patrono;
use App\Models\Pedidointervencao;
use App\Models\Platform\Advogado;
use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\Website;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Storage;
use Str;

class WebsiteController extends Controller
{
    public function home(Request $request = null)
    {

        $carrossel = Carrossel::orderBy('id', 'desc')->take(3)->get();
        // dd($carrossel);
        $noticia_destaque = Noticia::where('e_destaque', 'sim')->first();
        $this->acesso_pagina('home');
        return view('website.index', compact('noticia_destaque', 'carrossel'));

    }

    public function comissions()
    {
        $this->acesso_pagina('comissoes');
        return view('website.comissions');
    }

    public function contact()
    {

        $this->acesso_pagina('contacto');
        return view('website.contact');

    }

    public function members()
    {
        $advogados = Advogado::where('categoria', 'Advogado')->where('estado', 'Registado')->count();
        $estagiarios = Advogado::where('categoria', 'Estagiario')->where('estado', 'Registado')->count();
        $total = $advogados + $estagiarios;
        $this->acesso_pagina('associados');
        return view('website.members', compact('advogados', 'estagiarios', 'total'));
    }

    public function services()
    {
        $this->acesso_pagina('servicos');
        return view('website.services');
    }

    public function legal_assistance()
    {
        $this->acesso_pagina('assistencia');
        return view('website.legal-assistance');
    }

    public function gallery()
    {

        $institucional = Galeria::where('categoria', 'institucional')->orderBy('id', 'desc')->take(4)->get();
        $formacoes = Galeria::where('categoria', 'formações')->orderBy('id', 'desc')->take(4)->get();
        $eventos = Galeria::where('categoria', 'eventos')->orderBy('id', 'desc')->take(4)->get();
        $resp_social = Galeria::where('categoria', 'responsabilidade social')->orderBy('id', 'desc')->take(4)->get();

        $this->acesso_pagina('galeria');
        return view('website.gallery', compact('eventos', 'institucional', 'formacoes', 'resp_social'));
    }

    public function news()
    {

        // gera slug para todas as notícias
        // $noticias = Noticia::all();
        // foreach ($noticias as $not) {
        //     $not->slug = Str::slug($not->titulo);
        //     $not->save();
        // }

        $noticia_destaque = Noticia::where('e_destaque', 'sim')->first();
        $noticias = Noticia::where('e_destaque', 'nao')->orderBy('id', 'desc')->take(5)->get();
        // dd($noticias);
        $this->acesso_pagina('noticias');
        return view('website.news', compact('noticias', 'noticia_destaque'));
    }

    public function news_details($slug)
    {

        $noticia = Noticia::where('slug', $slug)->first();
        $noticia->views = $noticia->views + 1;
        $noticia->save();

        $outras_noticias = Noticia::where('id', '!=', $noticia->id)
            ->orderBy('id', 'desc')->take(6)->get();

        return view('website.news-details', compact('noticia', 'outras_noticias'));

    }

    public function acesso_pagina($pagina)
    {

        $acesso = Website::create([
            'pagina' => $pagina
        ]);

    }

    public function trans_dados()
    {

        $dados = DB::select("select * from db_oaa_old where conselho like '%Luanda%' and lido = 0");

        foreach ($dados as $linha) {

            set_time_limit(0);

            $tel1 = $tel2 = null;
            if ($linha->contactos != null && $linha->contactos != "") {
                $tels = explode(" ", $linha->contactos);
                if (is_array($tels)) {

                    if (isset($tels[0])) {
                        $tel1 = $tels[0];
                    }
                    if (isset($tels[1])) {
                        $tel2 = $tels[1];
                    }
                }
            }

            // insere a pessoa
            $pessoa = Pessoa::create([
                'nome' => $linha->nome_completo,
                'num_documento' => $linha->num_bi,
                'email' => $linha->email,
                'telefone1' => $tel1,
                'telefone2' => $tel2,
                'documento' => "Bilhete de Identidade",
            ]);

            // insere na tabela de advogado
            $adv = Advogado::create([
                'pessoa_id' => $pessoa->id,
                'categoria' => $linha->categoria,
                'num_associado' => $linha->num_associado,
                'num_estagiario' => $linha->num_estagiario,
            ]);

            $adv->hash = md5($pessoa->id . $adv->created_at . $pessoa->created_at);
            $adv->codigo = 'CPL' . $adv->id;
            $adv->save();

            // insere usuário
            $senha = 'CPL' . $pessoa->id . $adv->id;
            $user = User::create([
                'password' => Hash::make($senha),
                'two_factor' => 'não',
                'estado' => 'inativo',
                'pessoa_id' => $pessoa->id,
                'permissao_id' => 3
            ]);

            $res = DB::update("update db_oaa_old set lido = 1 where id = $linha->id");

        }

    }

    public function list_lawyers()
    {

        $lista = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')->where('app_advogado.categoria', 'Advogado')
            ->select('pessoa.*', 'app_advogado.categoria', 'app_advogado.num_associado', 'app_advogado.num_estagiario')
            ->get();

        return view('website.list-lawyers', compact('lista'));

    }

    public function list_trainee()
    {

        $lista = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')->where('app_advogado.categoria', 'Estagiario')
            ->select('pessoa.*', 'app_advogado.categoria', 'app_advogado.num_associado', 'app_advogado.num_estagiario')
            ->get();

        return view('website.list-trainee', compact('lista'));

    }

    public function download_document($file)
    {
        $path = storage_path('app/public/docspdf/' . $file);

        if (!file_exists($path)) {
            return redirect()->route('home');
        }

        $tipo_ficheiro = explode('.', $file);
        $extensao = $tipo_ficheiro[1];

        if (file_exists($path)) {
            if ($extensao == 'docx' || $extensao == 'doc') {
                $response = response()->download($path);
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                return $response;
            } else if ($extensao == 'pdf' || $extensao == 'PDF') {
                $response = response()->download($path);
                $response->headers->set('Content-Type', 'application/pdf');
                return $response;
            }
        }

        abort(404, 'Arquivo não encontrado');
    }

    public function open_document_attach($file)
    {
        $path = storage_path('app/public/anexos/' . $file);

        if (!file_exists($path)) {
            return redirect()->route('home');
        }

        $tipo_ficheiro = explode('.', $file);
        $extensao = $tipo_ficheiro[1];

        if (file_exists($path)) {
            if ($extensao == 'docx' || $extensao == 'doc') {
                $response = response()->download($path);
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                return $response;
            } else if ($extensao == 'pdf' || $extensao == 'PDF') {
                $nome = 'anexo_pdf_cpl_website.pdf';
                return response()->file($path, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="' . $nome . '"']);
            }
        }

        abort(404, 'Arquivo não encontrado');
    }

    public function defesa_oficiosa()
    {

        $municipios = Municipio::orderBy('descricao', 'asc')->get();
        return view('defesa-oficiosa-solicitar', compact('municipios'));

    }

    public function corrigir_patrono()
    {
        return view('corrigir-patronos');
    }

    public function consultar_processo()
    {
        return view('historico-processo');
    }

    public function defesa_oficiosa_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        // verifica se o advogado já existe
        $advogado_id = null;
        $pedido = null;

        if ($request->advogado_id != null && $request->advogado_id != '') {

            // verifica se o advogado já solicitou defesa oficiosa
            $existe = Pedidointervencao::where('advogado_id', $request->advogado_id)->first();
            if ($existe != null && ($existe->estado == 'pendente' || $existe->estado == 'autorizado')) {
                return 'duplicado';
            }

            $existe = null;


            $advogado = Advogado::find($request->advogado_id);
            $pessoa = Pessoa::find($advogado->pessoa_id);

            // actualiza os dados da pessoa
            $pessoa->nome = mb_strtoupper($request->nome_completo, 'UTF-8');
            $pessoa->num_documento = $request->num_bilhete;
            $pessoa->email = strtolower($request->email);
            $pessoa->telefone1 = $request->telefone1;
            $pessoa->telefone2 = $request->telefone2;
            $pessoa->genero = $request->genero;
            $pessoa->save();

            // actualiza os dados do advogado
            $advogado->nome_profissional = $pessoa->nome;
            $advogado->nome_patrono = mb_strtoupper($request->nome_patrono, 'UTF-8');
            $advogado->email_patrono = $request->email_patrono;
            $advogado->telefone_patrono = $request->telefone_patrono;
            $advogado->cedula_patrono = $request->cedula_patrono;
            $advogado->nome_escritorio = $request->nome_escritorio;
            $advogado->municipio_id = $request->municipio_id;
            $advogado->endereco_escritorio = $request->endereco_escritorio;
            $advogado->save();

            $advogado_id = $advogado->id;

            $pedido = Pedidointervencao::create([
                'hash' => Str::uuid(),
                'advogado_id' => $advogado_id,
                'tipo_processo' => $request->tipo_processo
            ]);

        } else {

            // verifica se a cédula está duplicada
            $existe = null;

            if ($request->categoria == 'Estagiario') {
                $existe = Advogado::where('categoria', $request->categoria)
                    ->where('num_estagiario', $request->num_cedula)->first();
            } else {
                $existe = Advogado::where('categoria', $request->categoria)
                    ->where('num_associado', $request->num_cedula)->first();
            }

            if ($existe != null) {
                return 'cedula';
            }

            // verifica se o número do bilhete está duplicado
            $existe = null;

            $existe = Pessoa::where('num_documento', $request->num_bilhete)
                ->first();

            if ($existe != null) {
                return 'bilhete';
            }


            $pedido = Pedidointervencao::create([
                'hash' => Str::uuid(),
                'advogado_id' => $advogado_id,
                'tipo_processo' => $request->tipo_processo,
                'nome' => $request->nome_completo,
                'num_documento' => $request->num_bilhete,
                'num_cedula' => $request->num_cedula,
                'categoria' => $request->categoria,
                'email' => $request->email,
                'telefone1' => $request->telefone1,
                'telefone2' => $request->telefone2,
                'genero' => $request->genero,
                'nome_patrono' => $request->nome_patrono,
                'email_patrono' => $request->email_patrono,
                'telefone_patrono' => $request->telefone_patrono,
                'cedula_patrono' => $request->cedula_patrono,
                'nome_escritorio' => $request->nome_escritorio,
                'municipio_id' => $request->municipio_id,
                'endereco_escritorio' => $request->endereco_escritorio
            ]);


        }

        //faz upload da imagem
        $ficheiro = '';

        try {
            if ($request->hasFile('documento') && $request->file('documento')->isValid()) {
                $ficheiro = $request->documento->store('defesa-oficiosa/documentos');
                $pedido->documento_anexo = $ficheiro;
                $pedido->save();
            }
        } catch (Throwable $error) {
            // throw new Exception($error);
        }

        // envia notificação por email

        return 'sucesso';

    }

    public function corrigir_patrono_post(Request $request)
    {

        date_default_timezone_set("Africa/Luanda");

        $patronos_eliminar_ids = $request->patrono_eliminar;
        $patrono_ficar_id = $request->patrono_ficar;

        if (str_contains($patronos_eliminar_ids, ',')) {

            $patrono_ficar = Patrono::find($patrono_ficar_id);
            $patronos_eliminar_vetor = explode(',', $patronos_eliminar_ids);

            // dd($patronos_eliminar_vetor);
            foreach ($patronos_eliminar_vetor as $item_p) {

                $estagiarios = Estagiariospatrono::where('patrono_id', $item_p)->get();
                foreach ($estagiarios as $item_e) {
                    $item_e->patrono_id = $patrono_ficar->id;
                    $item_e->save();
                }

                $inscricoes = Inscricaoadvogado::where('patrono_id', $item_p)->get();
                foreach ($inscricoes as $item_i) {
                    $item_i->patrono_id = $patrono_ficar->id;
                    $item_i->save();
                }

                // apagar o patrono
                $patrono = Patrono::find($item_p);
                $advogado = Advogado::find($patrono->advogado_id);
                $pessoa = Pessoa::find($advogado->pessoa_id);
                $pessoa->delete();
                $advogado->delete();
                $patrono->delete();

            }

            return 'sucesso';


        } else {

            $patrono_eliminar = Patrono::find($patronos_eliminar_ids);
            $patrono_ficar = Patrono::find($patrono_ficar_id);

            $estagiarios = Estagiariospatrono::where('patrono_id', $patrono_eliminar->id)->get();
            foreach ($estagiarios as $item_e) {
                $item_e->patrono_id = $patrono_ficar->id;
                $item_e->save();
            }

            $inscricoes = Inscricaoadvogado::where('patrono_id', $patrono_eliminar->id)->get();
            foreach ($inscricoes as $item_i) {
                $item_i->patrono_id = $patrono_ficar->id;
                $item_i->save();
            }

            // apagar o patrono
            $advogado = Advogado::find($patrono_eliminar->advogado_id);
            $pessoa = Pessoa::find($advogado->pessoa_id);
            $pessoa->delete();
            $advogado->delete();
            $patrono_eliminar->delete();

            return 'sucesso';

        }

    }

}
