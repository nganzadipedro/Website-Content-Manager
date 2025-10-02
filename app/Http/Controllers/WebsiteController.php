<?php

namespace App\Http\Controllers;

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
use Storage;

class WebsiteController extends Controller
{
    public function home(Request $request)
    {

        $noticia_destaque = Noticia::where('e_destaque', 'sim')->first();
        $this->acesso_pagina('home');
        return view('website.index', compact('noticia_destaque'));

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
        $advogados = Advogado::where('categoria', 'Advogado')->count();
        $estagiarios = Advogado::where('categoria', 'Estagiario')->count();
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
        $noticia_destaque = Noticia::where('e_destaque', 'sim')->first();
        $noticias = Noticia::where('e_destaque', 'nao')->orderBy('id', 'desc')->take(5)->get();
        // dd($noticias);
        $this->acesso_pagina('noticias');
        return view('website.news', compact('noticias', 'noticia_destaque'));
    }

    public function news_details($hash)
    {

        $noticia = Noticia::where('hash', $hash)->first();
        $noticia->views = $noticia->views + 1;
        $noticia->save();

        $outras_noticias = Noticia::where('id', '!=', $noticia->id)
            ->orderBy('id', 'desc')->take(2)->get();

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

        if (file_exists($path)) {
            return response()->download($path);
        }

        abort(404, 'Arquivo não encontrado');
    }

}
