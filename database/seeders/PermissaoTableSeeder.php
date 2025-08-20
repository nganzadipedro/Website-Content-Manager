<?php

namespace Database\Seeders;

use App\Models\Permissao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permissao::insert([
            [
                "descricao"   => "Admin Geral"
            ],
            [
                "descricao"   => "Candidato"
            ],            
        ]);
    }
}
