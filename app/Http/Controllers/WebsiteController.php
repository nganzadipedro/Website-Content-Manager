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

        $this->acesso_pagina('home');
        return view('website.index');

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
        $this->acesso_pagina('galeria');
        return view('website.gallery');
    }

    public function news()
    {
        $this->acesso_pagina('noticias');
        return view('website.news');
    }



    public function acesso_pagina($pagina)
    {

        $acesso = Website::create([
            'pagina' => $pagina
        ]);

    }

}
