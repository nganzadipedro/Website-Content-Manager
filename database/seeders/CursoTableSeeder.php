<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Permissao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::insert([
            [
                "descricao"   => "Engenharia Informática",
                "instituicao_id"   => 1,
            ],
            [
                "descricao"   => "Engenharia de Telecomunicações",
                "instituicao_id"   => 1,
            ],      
            [
                "descricao"   => "Artes Visuais",
                "instituicao_id"   => 2,
            ],      
            [
                "descricao"   => "Design de Moda",
                "instituicao_id"   => 2,
            ],            
            [
                "descricao"   => "Música",
                "instituicao_id"   => 2,
            ],      
            [
                "descricao"   => "Teatro",
                "instituicao_id"   => 2,
            ],      
            [
                "descricao"   => "Educação de Infância",
                "instituicao_id"   => 4,
            ],      
            [
                "descricao"   => "Serviço Social",
                "instituicao_id"   => 4,
            ],      
            [
                "descricao"   => "Relações Internacionais",
                "instituicao_id"   => 4,
            ],      
            [
                "descricao"   => "Contabilidade",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Informática de Gestão",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Gestão de Empresas",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Gestão de Logística e Transporte",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Gestão Aeronáutica",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Engenharia Mecatrónica",
                "instituicao_id"   => 3,
            ],      
            [
                "descricao"   => "Engenharia dos Transportes",
                "instituicao_id"   => 3,
            ]    
        ]);
    }
}
