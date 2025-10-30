<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaindefinidosexport implements FromCollection, WithHeadings
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
            ->where('app_advogado.categoria', 'Por especificar')
            ->select('app_advogado.*')
            ->orderBy('pessoa.nome', 'asc')
            ->get();

        foreach ($result as $linha) {

            $registo = [];
            $registo[0] = $linha->id;
            $registo[1] = $linha->getpessoa->nome;
            $registo[2] = $linha->categoria;
            $registo[3] = $linha->num_associado == 'NULL' ? '-----' : $linha->num_associado;
            $registo[4] = $linha->num_estagiario == 'NULL' ? '-----' : $linha->num_estagiario;
            $registo[5] = $linha->getpessoa->num_documento == 'NULL' ? '-----' : $linha->getpessoa->num_documento;
            $registo[6] = $linha->getpessoa->telefone1;
            $registo[7] = $linha->getpessoa->email;

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
            "Nº CÉDULA ADVOGADO",
            "Nº CÉDULA ESTAGIÁRIO",
            "Nº BILHETE",
            "TELEFONE",
            "EMAIL"
        ];
    }
}
