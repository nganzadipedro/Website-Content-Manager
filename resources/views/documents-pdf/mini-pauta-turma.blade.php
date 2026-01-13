<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Pauta da Turma</title>
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
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }

        #img_1 {
            position: relative;
            left: 50px;
        }

        .cabecalho {
            width: 90%;
            margin: 0 auto;
            color: #000;
            padding: 1px;
            text-align: center;
            font-size: 18px;
            margin-top: -30px;
        }

        .cabecalho .sub {
            font-weight: normal;
        }

        .titulo {
            width: 90%;
            margin: 0 auto;
            color: black;
            text-align: center;
            font-size: 22px;
            margin-top: 5px;
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
            border: 1px solid black;
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
        <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    </div>
    <div class="cabecalho">
        <h5>
            Centro de Estudos e Formação da Ordem dos Advogados de Angola<br>
            Formação Inicial Obrigatória
        </h5>
        <h5 class="sub">
            = MINI PAUTA =<br>
            {{ $turma->getFormacao->nome }} | {{ $turma->descricao }}<br>
            Nº Formandos: {{ count($avaliacoes) }} | Aprovados: {{ $aprovados }} | Reprovados: {{ $reprovados }}
        </h5>
    </div>

    <div class="entradas">

        @if ($avaliacoes != null)

            <table class="content-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nome Completo</th>
                        <th>P.P.P</th>
                        <th>P.P.C</th>
                        <th>E.D.P</th>
                        <th>P.J.M</th>
                        <th>LB</th>
                        <th>Nota Final</th>
                    </tr>
                </thead>
                @foreach ($avaliacoes as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item['codigo'] }}</td>
                        <td>{{ $item['nome'] }}</td>
                        <td><span class="{{ $item['1'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['1'] }}</span></td>
                        <td><span class="{{ $item['2'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['2'] }}</span></td>
                        <td><span class="{{ $item['3'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['3'] }}</span></td>
                        <td><span class="{{ $item['4'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['4'] }}</span></td>
                        <td><span class="{{ $item['5'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['5'] }}</span></td>

                        <td><span class="{{ $item['media'] >= 9.5 ? 'apto' : 'napto' }}">{{ $item['media'] }}</span></td>
                    </tr>
                @endforeach
            </table>

            <p style="font-size: 11px; font-style: italic;">
                Legenda das siglas: <br>
                P.P.P - Prática Processual Penal <br>
                P.P.C - Prática Processual Civil <br>
                E.D.P - Ética e Deontologia Profissional <br>
                P.J.M - Prática Jurídicas Multidisciplinares e Notariado <br>
                LB - Laboral <br>
            </p>
            <br>
            <br>
            <div class="rodape">
                Luanda, {{$data[0]}} de {{$data[1]}} de {{$data[2]}} <br><br><br>
            </div>

        @endif

    </div>

</body>

</html>