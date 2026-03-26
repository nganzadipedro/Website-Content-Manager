<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Inscricaoadvogado;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaestindicacaopatrono implements FromCollection, WithHeadings
{

    function __construct()
    {

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $dados_turma = array();

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', 3)
            ->where('inscricao_advogado.acto_pretendido', 'Indicação de Patrono')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $contador = 1;

        foreach ($result as $linha) {

            $registo = [];
            $registo[0] = $contador;
            $registo[1] = $linha->codigo;
            $registo[2] = mb_strtoupper($linha->getregistoentrada->proveniencia, 'UTF-8');
            $registo[3] = $linha->getregistoentrada->data_entrada;
            $registo[5] = $linha->telefone1 . '/' . $linha->telefone2;

            array_push($dados_turma, $registo);

            $contador++;

        }

        return collect($dados_turma);

    }

    public function headings(): array
    {
        return [
            "#",
            "Nº Processo",
            "Requerente",
            "Data de Entrada",
            "Contactos"
        ];
    }
}
