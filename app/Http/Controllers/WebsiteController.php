<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Galeria;
use App\Models\Mensagem;
use App\Models\Noticia;
use Auth;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(Request $request)
    {

        return view('website.index');

    }

    public function messages()
    {

    }

    public function contact()
    {

    }

    public function members()
    {

    }

    public function services()
    {

    }

    public function complaints()
    {

    }

    public function legal_assistance()
    {

    }

}
