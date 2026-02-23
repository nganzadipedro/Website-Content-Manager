<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaaguardacerimoniaexport implements FromCollection, WithHeadings
{

    private $turma_id;

    function __construct()
    {
        
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $dados_turma = array();

        $result = Advogado::join('pessoa', 'pessoa.id', 'app_advogado.pessoa_id')
            ->where('app_advogado.estado', 'Aguarda Cerimónia')
            ->select('app_advogado.*')
            ->orderBy('pessoa.nome', 'asc')
            ->get();

        foreach ($result as $linha) {

            $registo = [];
            $registo[0] = $linha->id;
            $registo[1] = $linha->getpessoa->nome;
            $registo[2] = $linha->categoria;
            $registo[3] = $linha->categoria == 'Estagiario' ? $linha->num_estagiario : $linha->num_associado;
            $registo[4] = $linha->getpessoa->num_documento == 'NULL' ? '-----' : $linha->getpessoa->num_documento;
            $registo[5] = $linha->getpessoa->telefone1;
            $registo[6] = $linha->getpessoa->email;

            array_push($dados_turma, $registo);

        }

        return collect($dados_turma);

    }

    public function headings(): array
    {
        return [
            "ID",
            "NOME COMPLETO",
            "CATEGORIA",
            "Nº CÉDULA",
            "Nº BILHETE",
            "TELEFONE",
            "EMAIL"
        ];
    }
}
