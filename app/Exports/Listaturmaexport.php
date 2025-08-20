<?php

namespace App\Exports;

use App\Models\Fio\Alunoformacao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Listaturmaexport implements FromCollection, WithHeadings
{

    private $turma_id;

    function __construct($pturma_id){
        $this->turma_id = $pturma_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dados_turma = array();
        $result = Alunoformacao::join('aluno', 'aluno.id', 'alunos_formacao.aluno_id')
        ->join('pessoas', 'pessoas.id', 'aluno.pessoa_id')
        ->where('alunos_formacao.turma_id', $this->turma_id)
        ->select('alunos_formacao.*')
        ->orderBy('pessoas.nome', 'asc')
        ->get();

        foreach($result as $linha){

            $registo = [];
            $registo[0] = $linha->id;
            $registo[1] = $linha->getAluno->codigo;
            $registo[2] = $linha->getAluno->num_cedula_advogado;
            $registo[3] = $linha->getAluno->getPessoa->nome;
            $registo[4] = $linha->getAluno->getPessoa->num_documento;
            $registo[5] = $linha->getAluno->getPessoa->genero;
            $registo[6] = $linha->getAluno->getPessoa->telefone1;
            $registo[7] = $linha->getAluno->getPessoa->email;
            $registo[8] = $linha->getFormacao->nome;
            $registo[9] = $linha->getTurma->descricao;
            array_push($dados_turma, $registo);

        }
        
        return collect($dados_turma);

    }

    public function headings(): array
    {
        return [
            "ID",
            "CÓDIGO",
            "Nº CÉDULA",
            "NOME COMPLETO",
            "Nº DOCUMENTO",
            "GÉNERO",
            "TELEFONE",
            "EMAIL",
            "FORMAÇÃO",
            "TURMA"
        ];
    }
}
