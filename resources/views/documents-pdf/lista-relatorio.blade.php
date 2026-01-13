<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório dos candidatos</title>
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
            padding: 1px;
        }

        #img_1 {
            position: relative;
            left: 50px;
        }

        .cabecalho {
            width: 90%;
            margin: 0 auto;
            color: #073763;
            padding: 1px;
            text-align: center;
            font-size: 18px;
            margin-top: 30px;
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
            text-align: left;
            border-bottom: 1px solid black;
        }
    </style>

    <div class="imagens">
        <img id="img_1" src="https://enoaa.cef-oaa.org/images/logo_enoaa_cor.png" alt="" width="120px" height="50px">
        <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="50px" height="50px" align="right">
    </div>
    <div class="cabecalho">
        <h4>LISTA DAS CANDIDATURAS {{ $tipo }} | ENOAA - {{ $desc_ano }}</h4>
        @if($filtros != '')
        <h5>Filtros | {{ $filtros }} </h5>
        @endif
    </div>

    <div class="entradas">

        @if ($result != null)

        <table class="content-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Nome Completo</th>
                    <th>Província Exame</th>
                </tr>
            </thead>
            @foreach ($result as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->codigo }}</td>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->desc_prov_exame }}</td>
            </tr>
            @endforeach
        </table>

        @endif

    </div>

</body>

</html>