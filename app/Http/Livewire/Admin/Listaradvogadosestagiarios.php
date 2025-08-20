<?php

namespace App\Http\Livewire\Admin;

use App\Models\Advogado;
use Livewire\Component;

class Listaradvogadosestagiarios extends Component
{
    public function render()
    {

        // $total = Advogado::count();
        // $res = Advogado::where('id', '<', ($total/2))->get();
        // foreach ($res as $item) {
        //     $item->categoria = 'Advogado Estagiário';
        //     $item->save();
        // }

        // $res = Advogado::where('id', '>=', ($total/2))->get();
        // foreach ($res as $item) {
        //     $item->categoria = 'Advogado';
        //     $item->save();
        // }


        $this->lista_advogados = Advogado::where('categoria', 'Advogado Estagiário')->get();
        return view('dashboard.admin.listar-advogados-estagiarios')->extends('layouts.main')->section('content');
    }
}
