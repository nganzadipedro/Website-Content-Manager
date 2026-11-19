<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Models\User;
use Livewire\Component;

class Listar extends Component
{

    public $usuarios = array();
    public $homens;
    public $mulheres;

    public function render()
    {
        $this->usuarios = User::where('permission_id', '!=', 5)
        ->get();

        $this->homens = 0;
        $this->mulheres = 0;

        foreach($this->usuarios as $item){
            if($item->getPessoa->genero == 'Masculino'){
                $this->homens++;
            }
            else{
                $this->mulheres++;
            }
        }
        return view('dashboard.admin.usuarios.listar')->extends('layouts.app')->section('conteudo');
    }
}
