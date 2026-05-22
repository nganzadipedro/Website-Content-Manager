<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo de Entrega</title>
</head>

<body>

    <style>
        * {
            font-family: 'Century Gothic';
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
            font-size: 30px;
        }

        .paragrafo {
            text-align: justify;
        }

        .data-entrega {
            text-align: center;
            font-style: italic;
            margin-top: 40px;
            margin-bottom: 70px;
        }

        .assinaturas {
            margin-top: 40px;
            display: inline;
        }
        .esquerda {
            width: 45%;
            text-align: center;
        }
        .direita {
            width: 45%;
            text-align: center;
            float: right;
            position: relative;
            top: -230px;
            left: 350px;
        }
    </style>

    <div class="imagens">
        <img id="img_1" src="https://cpl-oaa.ao/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    </div>
    <div class="cabecalho">
        <h5>Conselho Provincial de Luanda - OAA</h5>
        <h4>TERMO DE ENTREGA</h4>
    </div>

    <p class="paragrafo">
        Procedeu-se à entrega de processos de inscrição de Advogados ao(a) Conselheiro(a)
        <strong>{{ $nome_conselheiro }}</strong> para
        análise.
        <br><br>
        Nomeadamente:
    </p>

    <ol>
        @foreach ($lista as $linha)
            <li>{{ strtoupper($linha->getregistoentrada->proveniencia) }}</li>
        @endforeach
    </ol>

    <div class="data-entrega">
        Luanda, ..... de ......... de ..........
    </div>

    <div class="assinaturas">
        <div class="esquerda">
            Entreguei <br>
            _____________________________<br>
            O(A) Funcionário(a)<br><br><br><br>
            Recebi <br>
            _____________________________<br>
            O(A) Funcionário(a)<br><br><br><br>
        </div>
        <div class="direita">
            Recebi <br>
            _____________________________<br>
            O(A) Conselheiro(a)<br><br><br><br>
            Entreguei <br>
            _____________________________<br>
            O(A) Conselheiro(a)<br><br><br><br>
        </div>
    </div>


</body>

</html>