<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Aguardando Cerimónia</title>
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
        <img id="img_1" src="https://cpl-oaa.ao/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    </div>
    <div class="cabecalho">
        <h5>Conselho Provincial de Luanda - OAA</h5>
        <h4>Lista de {{ $categoria }} aguardando cerimónia<br>
            Data da Cerimónia: _____/_____/_______ | Nº de {{ $categoria }}: {{ $num_candidatos }}
        </h4>
    </div>

    <div class="entradas">

            <table class="content-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome completo</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                @foreach ($candidatos as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->getpessoa->nome }}</td>
                        <td>{{ $item->categoria }}</td>
                    </tr>
                @endforeach
            </table>

            <br>
            <div class="rodape">
                Luanda, {{$data[0]}} de {{$data[1]}} de {{$data[2]}} <br>
            </div>

    </div>

</body>

</html>