<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enunciado</title>
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

        .cabecalho h4 {
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

        .resposta {
            font-weight: bold;
        }
    </style>

    <div class="cabecalho">
        <h5>Centro de Estudos e Formação da Ordem dos Advogados de Angola</h5>
        <h4>Enunciado de Prova</h4>
        <h5>Módulo/Disciplina: {{ $prova->getdisciplina->descricao }}</h5>
    </div>

    <div class="entradas">

        @if ($perguntas != null)


            @foreach ($perguntas as $linha)
                <p>
                    {{ $linha->numero }}) <br>
                    {{ $linha->corpo_pergunta }}
                </p>
                <ol>
                    <li class="{{ $linha->resposta_opcao == 'opcao1' ? 'resposta' : '' }}">{{ $linha->opcao1 }}</li>
                    <li class="{{ $linha->resposta_opcao == 'opcao2' ? 'resposta' : '' }}">{{ $linha->opcao2 }}</li>
                    <li class="{{ $linha->resposta_opcao == 'opcao3' ? 'resposta' : '' }}">{{ $linha->opcao3 }}</li>
                    @if ($linha->opcao4 != null)
                        <li class="{{ $linha->resposta_opcao == 'opcao4' ? 'resposta' : '' }}">{{ $linha->opcao4 }}</li>
                    @endif
                    @if ($linha->opcao5 != null)
                        <li class="{{ $linha->resposta_opcao == 'opcao5' ? 'resposta' : '' }}">{{ $linha->opcao5 }}</li>
                    @endif
                </ol>
                <label for="">Cotação: {{ $linha->cotacao }}</label><br>
                <br>
            @endforeach

            <br>
            <br>
            <div class="rodape">
                O(A) Formador(a) <br>
                {{ $prova->getprofessor->getPessoa->nome }}
            </div>

        @endif

    </div>

</body>

</html>