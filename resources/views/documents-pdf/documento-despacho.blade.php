<style>

    @font-face {
        font-family: 'minhafonte';
        src: url('fonts/GARA.ttf') format('truetype');
    }

    
    @font-face {
        font-family: 'minhafontebold';
        src: url('fonts/GARABD.ttf') format('truetype');
    }

    .cabecalho {
        width: 90%;
        margin: 0 auto;
        background-color: white;
        color: black;
        text-align: center;
        font-size: 24px;
        margin-top: -10px;
    }

    .imagens {
        width: 90%;
        padding: 1px;
    }

    .corpo {
        width: 90%;
        margin: 0 auto;
        /* margin-top: -50px; */
        text-align: justify;
        line-height: 1.8;
        font-size: 16px;
        font-family: minhafonte;
    }

    .rodape {
        top: 970px;
        left: 20px;
        position: fixed;
        font-size: 12px;
        text-align: center;
    }

    .barra-baixo {
        display: block;
        width: 650px;
        border: solid 1px black;
    }

    .identificador-candidato {
        text-align: center;
        width: 50px;
        height: 50px;
        position: fixed;
        top: 800px;
        left: 40px;
    }

    #img_1 {
        position: relative;
        left: 50px;
    }

    .centro-estudo {
        margin-top: -2px;
    }

    .barra {
        display: block;
        border: solid 1px black;
        position: relative;
        top: -30px;
    }

    .declaracao {
        margin-top: 30px;
        margin-bottom: 20px;
        text-align: center;
        font-size: 25px;
    }

    .bold{
        font-family: minhafontebold;
        font-weight: 700;
    }

    /* .img-fundo{
        position: fixed;
        top: 230px;
        left: 100px;
        opacity: 0.1;
        z-index: -100;
    } */

</style>
<!-- 
<div class="img-fundo">
<img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="500px" height="500px">
</div> -->

<div class="cabecalho">
    <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="130px" height="130px">
    <h6 class="centro-estudo">Conselho Provincial de Luanda</h6>
    <span class="barra"></span>
</div>

<p class="declaracao">DESPACHO</p>

<div class="corpo">

    <P style="text-align:justify;">
        Exmo/a Dr.(ª) {{ $nome_requerente }}<br><br>
        Por despacho datado de {{ $data_despacho }} do Conselho Provincial de Luanda, que incidiu sobre o seu processo de inscrição, somos a transcrever o seguinte despacho:<br><br>
        <strong>{{ $mensagem_despacho }}</strong><br><br>
        <strong>Para mais informações, contacte a secretaria deste Conselho.<br>
        Largo João Seca, Casa n.º 6, R/C - Telef. 928 410 082<br><br></strong>
        Sem mais de momento, atenciosamente,<br>
        Assistente Administrativo<br>
        Conselho Provincial de Luanda<br>
        Ordem dos Advogados de Angola<br>
    </P>
</div>


<P style="text-align:center;">
    <br><br><br>
    <span style="font-family: minhafonte">Luanda, {{$data[0]}} de {{$data[1]}} de {{$data[2]}} </span><br><br><br>
</P>

<!-- <div class="rodape">
    <span class="barra-baixo"></span>
    Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>

    NIF: 500028959A | Tel.: +244 924 956 037 | 935 542 465 | 222 042 667 | e-mail: geral@cef-oaa.org | website:
    www.cef-oaa.org
</div> -->