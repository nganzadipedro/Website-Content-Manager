<?php

namespace App\Http\Livewire\Admin;

use App\Models\Noticia;
use Livewire\Component;

class Listarnoticia extends Component
{

    public $lista_noticias;
    public function render()
    {

        $this->lista_noticias = Noticia::orderBy('id', 'desc')->get();
        return view('dashboard.admin.listar-noticias')->extends('layouts.main')->section('content');
    }
}
