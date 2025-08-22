<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ano;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Formacao;
use App\Models\Noticia;
use App\Models\Website;
use Livewire\Component;
use Carbon\Carbon;
use PHPUnit\Framework\Error\Notice;

class Dashboard extends Component
{

    public $vetor_acessos = array();
    public $acessos_pagina = array();
    public $noticias = array();
    public $total_views_noticias = 0;

    public function render()
    {

        $inicioSemana = Carbon::now()->startOfWeek(); // segunda-feira
        $fimSemana = Carbon::now()->endOfWeek();      // domingo

        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;

        $this->vetor_acessos[0] = Website::where('pagina', 'home')->count();
        $this->noticias = Noticia::orderBy('views', 'desc')->take(5)->get();
        $this->vetor_acessos[1] = Website::where('pagina', 'home')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->vetor_acessos[2] = Website::where('pagina', 'home')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        foreach ($this->noticias as $not) {
            $this->total_views_noticias += $not->views;
        }

        // página serviços
        $this->acessos_pagina[0] = Website::where('pagina', 'servicos')->count();
        $this->acessos_pagina[1] = Website::where('pagina', 'servicos')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[2] = Website::where('pagina', 'servicos')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página notícias
        $this->acessos_pagina[3] = Website::where('pagina', 'noticias')->count();
        $this->acessos_pagina[4] = Website::where('pagina', 'noticias')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[5] = Website::where('pagina', 'noticias')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página associados
        $this->acessos_pagina[6] = Website::where('pagina', 'associados')->count();
        $this->acessos_pagina[7] = Website::where('pagina', 'associados')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[8] = Website::where('pagina', 'associados')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página comissoes
        $this->acessos_pagina[9] = Website::where('pagina', 'comissoes')->count();
        $this->acessos_pagina[10] = Website::where('pagina', 'comissoes')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[11] = Website::where('pagina', 'comissoes')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página assistencia
        $this->acessos_pagina[12] = Website::where('pagina', 'assistencia')->count();
        $this->acessos_pagina[13] = Website::where('pagina', 'assistencia')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[14] = Website::where('pagina', 'assistencia')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página galeria
        $this->acessos_pagina[15] = Website::where('pagina', 'galeria')->count();
        $this->acessos_pagina[16] = Website::where('pagina', 'galeria')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[17] = Website::where('pagina', 'galeria')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        // página contacto
        $this->acessos_pagina[18] = Website::where('pagina', 'contacto')->count();
        $this->acessos_pagina[19] = Website::where('pagina', 'contacto')->whereBetween('created_at', [$inicioSemana, $fimSemana])->count();
        $this->acessos_pagina[20] = Website::where('pagina', 'contacto')->whereMonth('created_at', $mesAtual)
            ->whereYear('created_at', $anoAtual)
            ->count();

        return view('dashboard.admin.index')->extends('layouts.main')->section('content');
    }
}
