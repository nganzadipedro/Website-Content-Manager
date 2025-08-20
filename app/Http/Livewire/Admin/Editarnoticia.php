<?php

namespace App\Http\Livewire\Admin;

use App\Models\Noticia;
use Livewire\Component;
use PHPUnit\Framework\Error\Notice;

class Editarnoticia extends Component
{

    public $noticia_hash;
    public $noticia;

    public function mount($hash){

        $this->noticia_hash = $hash;
        $this->noticia = Noticia::where('hash', $this->noticia_hash)->first();

    }
    public function render()
    {
       return view('dashboard.admin.editar-noticia')->extends('layouts.main')->section('content');
    }
}
