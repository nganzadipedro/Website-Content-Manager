<?php

namespace Database\Seeders;

use App\Models\Instituicao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituicaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instituicao::insert([
            [
                "descricao"   => "INSTIC"
            ],
            [
                "descricao"   => "FaArtes"
            ],        
            [
                "descricao"   => "IPGEST"
            ],    
            [
                "descricao"   => "FSS"
            ],        
        ]);
    }
}
