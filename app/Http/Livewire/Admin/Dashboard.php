<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ano;
use App\Models\Candidatura;
use App\Models\Fio\Candidaturaformacao;
use App\Models\Fio\Formacao;
use Livewire\Component;

class Dashboard extends Component
{
    
    public function render()
    {
        return view('dashboard.admin.index')->extends('layouts.main')->section('content');
    }
}
