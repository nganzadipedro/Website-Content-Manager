<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Inscricaoadvogado;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaremessacnexport implements FromCollection, WithHeadings
{

    private $data_remessa_p;

    function __construct($data_remessa)
    {
        $this->data_remessa_p = $data_remessa;
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
            ->where('inscricao_advogado.data_remessa_cn', $this->data_remessa_p)
            ->whereNotNull('inscricao_advogado.data_remessa_cn')
            ->orderBy('registo_entrada.proveniencia', 'asc')
            ->select('inscricao_advogado.*')
            ->get();

        $contador = 1;

        foreach ($result as $linha) {

            $registo = [];
            $registo[0] = $contador;
            $registo[1] = $linha->getregistoentrada->data_entrada;
            $registo[2] = mb_strtoupper($linha->getregistoentrada->proveniencia, 'UTF-8');
            $registo[3] = $linha->telefone1 . '/' . $linha->telefone2;
            $registo[4] = '';

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
            "Requerente",
            "Contactos",
            "Observação"
        ];
    }
}
