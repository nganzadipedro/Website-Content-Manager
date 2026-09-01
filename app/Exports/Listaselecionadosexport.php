<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use App\Models\Inscricaoadvogado;
use App\Models\Platform\Advogado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaselecionadosexport implements FromCollection, WithHeadings
{

    private $lista_selecionados_p;
    private $tipo_processo_p;

    function __construct($lista_selecionados, $tipo_processo)
    {
        $this->lista_selecionados_p = json_decode($lista_selecionados, true);
        $this->tipo_processo_p = $tipo_processo;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $dados_exportar = array();

        $contador = 1;

        // dd($this->lista_selecionados_p);

        foreach ($this->lista_selecionados_p as $id_inscricao) {

            $linha = Inscricaoadvogado::find($id_inscricao);

            $registo = [];
            $registo[0] = $contador;
            $registo[1] = $linha->getregistoentrada->data_entrada;
            $registo[2] = mb_strtoupper($linha->getregistoentrada->proveniencia, 'UTF-8');
            $registo[3] = $linha->telefone1 . '/' . $linha->telefone2;
            $registo[4] = $linha->estado;
            $registo[5] = $linha->data_remessa_cn;
            $registo[6] = $linha->gettipoprocesso->descricao;
            $registo[7] = '';

            array_push($dados_exportar, $registo);
            $contador++;

        }

        return collect($dados_exportar);

    }

    public function headings(): array
    {
        return [
            "#",
            "Data de Entrada",
            "Requerente",
            "Contactos",
            "Estado",
            "Data Remessa ao CN",
            "Tipo Processo",
            "Observação"
        ];
    }
}
