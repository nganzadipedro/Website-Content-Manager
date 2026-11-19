<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Inscricaoadvogado;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaremessacnexportcompleta implements FromCollection, WithHeadings
{

    private $tipo_processo_p;

    function __construct($tipo_processo)
    {
        $this->tipo_processo_p = $tipo_processo;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $dados_turma = array();

        $result = Inscricaoadvogado::query()
            ->join('registo_entrada', 'registo_entrada.id', 'inscricao_advogado.registo_entrada_id')
            ->where('inscricao_advogado.tipo_processo_id', $this->tipo_processo_p)
            ->where('inscricao_advogado.estado', 'remetido ao CN')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $contador = 1;

        foreach ($result as $linha) {

            $registo = [];
            $registo[0] = $contador;
            $registo[1] = $linha->getregistoentrada->data_entrada;
            $registo[2] = $linha->data_remessa_cn;
            $registo[3] = mb_strtoupper($linha->getregistoentrada->proveniencia, 'UTF-8');
            $registo[4] = $linha->telefone1 . '/' . $linha->telefone2;
            $registo[5] = '';

            array_push($dados_turma, $registo);

            $contador++;

        }

        return collect($dados_turma);

    }

    public function headings(): array
    {
        return [
            "#",
            "Data de Entrada",
            "Data de Remessa ao CN",
            "Requerente",
            "Contactos",
            "Observação"
        ];
    }
}
