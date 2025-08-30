<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use App\Models\Website;
use Auth;
use Illuminate\Http\Request;

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
        $this->acesso_pagina('associados');
        return view('website.members');
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



    public function acesso_pagina($pagina)
    {

        $acesso = Website::create([
            'pagina' => $pagina
        ]);

    }

}
