<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Models\Ano;
use App\Models\Enoaa\Pessoa;
use App\Models\User;
use Auth;
use Livewire\Component;

class Candidatos extends Component
{

    public $usuarios = array();
    public $homens;
    public $mulheres;

    public function render()
    {

        // $ano = Ano::where('estado', 'Activo')->first();
        $this->usuarios = User::
            where('permission_id', 5)
            ->whereNull('deleted_at')
            ->get();


        if (Auth::user()->permission_id == 4) {

            $this->usuarios = User::join('pessoas', 'users.pessoa_id', '=', 'pessoas.id')
                ->where('users.permission_id', 5)
                ->where('pessoas.prov_residencia_id', Auth::user()->provincia_id)
                ->whereNull('users.deleted_at')
                ->get();

        }

        $this->homens = 0;
        $this->mulheres = 0;

        //dd($this->usuarios);

        foreach ($this->usuarios as $item) {
            if ($this->eliminado($item->pessoa_id) != 'false') {
                if ($item->getPessoa->genero == 'Masculino') {
                    $this->homens++;
                } else {
                    $this->mulheres++;
                }
            }

        }

        return view('dashboard.admin.usuarios.listar-candidatos')->extends('layouts.app')->section('conteudo');
    }

    public function eliminado($id)
    {

        $pes = Pessoa::find($id);
        if ($pes) {
            return 'true';
        } else {
            return 'false';
        }

    }
}
