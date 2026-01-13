<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Pauta</title>
</head>

<body>

    <style>
        * {
            font-family: 'Century Gothic';
        }

        .mes {
            background-color: #073763;
            color: white;
            text-align: center;
            font-weight: bold;
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }

        .imagens {
            width: 100%;
            text-align: center;
        }

        .cabecalho {
            width: 90%;
            margin: 0 auto;
            color: #000000;
            padding: 1px;
            text-align: center;
            font-size: 18px;
            margin-top: -20px;
        }

        .cabecalho h4{
            font-weight: normal;
        }

        .content-table {
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 0.7em;
            width: 100%;
            border-radius: 5px;
        }

        .content-table thead tr {
            background-color: #073763;
            color: white;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 5px;
            text-align: center;
            border-bottom: 1px solid black;
        }

        .apto {
            color: blue;
        }

        .napto {
            color: red;
        }

        .rodape {
            text-align: center;
            font-style: italic;
        }
    </style>

    <div class="imagens">
        <img id="img_1" src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    </div>
    <div class="cabecalho">
        <h5>Centro de Estudos e Formação da Ordem dos Advogados de Angola</h5>
        <h4>MINI PAUTA<br> {{ $disciplina->descricao }} <br>
            {{ $turma->getFormacao->nome }} | {{ $turma->descricao }}
        </h4>
        <h5>Nº Formandos: {{ count($alunos) }} | Aprovados: {{ $aprovados }} | Reprovados: {{ count($alunos) - $aprovados }}</h5>
    </div>

    <div class="entradas">

        @if ($avaliacoes != null)

            <table class="content-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nome Completo</th>
                        <th>Nota1</th>
                        <th>Nota2</th>
                        <th>Nota Final</th>
                    </tr>
                </thead>
                @foreach ($alunos as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->getAluno->codigo }}</td>
                        <td>{{ $item->getAluno->getPessoa->nome }}</td>

                        @php
                        
                        $avaliacao = \App\Models\Fio\Avaliacaoaluno::where('aluno_id', $item->aluno_id)
                        ->where('turma_id', $item->turma_id)
                        ->where('disciplina_id', $disciplina->id)
                        ->first();

                        if($avaliacao != null){
                        $nota1 = $avaliacao->nota1;
                        $nota2 = $avaliacao->nota2;
                        $notafinal = $avaliacao->notafinal;
                        }
                        else{
                        $nota1 = 0;
                        $nota2 = 0;
                        $notafinal = 0;
                        }

                        @endphp

                        <td><span class="{{ $nota1 >= 9.5 ? 'apto' : 'napto' }}">{{ $nota1 }}</span></td>
                        <td><span class="{{ $nota2 >= 9.5 ? 'apto' : 'napto' }}">{{ $nota2 }}</span></td>
                        <td><span class="{{ $notafinal >= 9.5 ? 'apto' : 'napto' }}">{{ $notafinal }}</span></td>
                    </tr>
                @endforeach
            </table>

            <br>
            <br>
            <div class="rodape">
                Luanda, {{$data[0]}} de {{$data[1]}} de {{$data[2]}} <br><br><br>
                O(A) Formador(a) <br>
                {{ $professor->getPessoa->nome }}
            </div>

        @endif

    </div>

</body>

</html>