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
    <h6 class="centro-estudo">Centro de Estudos e Formação</h6>
    <span class="barra"></span>
</div>

<p class="declaracao">DECLARAÇÃO</p>

<div class="corpo">

    <P style="text-align:justify;">
        O Centro de Estudos e Formação da Ordem dos Advogados de Angola declara que o(a)
        senhor(a) Dr.(ª) <span class="bold">{{$nome}}</span>, titular da Cédula de Advogado(a)
        Estagiário(a) n.º <span class="bold">{{$cedula}}</span>, frequentou e concluiu com êxito nesta Instituição o
        <span class="bold">{{ $ciclo }}</span> curso,
        referente à Formação Inicial Obrigatória para Advogado(a)s Estagiário(a)s.
    </P>

    <P>
        Para os devidos efeitos, e para que não lhe sejam impostos impedimentos, é emitida a presente
        declaração que vai assinada pela sua Directora.
    </P>
</div>


<P style="text-align:center;">
    <br><br><br>
    <span style="font-family: minhafonte">Luanda, {{$data[0]}} de {{$data[1]}} de {{$data[2]}} </span><br><br><br>
    <br><br>
    <strong>A Directora</strong><br><br>
    <img style="margin-top: 0px;" width="250" src="https://fio.cef-oaa.org/images/assinaturacarlota.png" alt="">
    <br>
    <strong><em>Carlota Cambenje</em></strong>
</P>

<div class="identificador-candidato">
    @php
        $link = $qrcode;
    @endphp
    <span> @php echo DNS2D::getBarcodeHTML($link, 'QRCODE', 2,2); @endphp </span>
</div>

<div class="rodape">
    <span class="barra-baixo"></span>
    TOKEN-HASH: {{ $token }} | Urbanização Nova Vida, Rua 69, Casa n.º 7164, Kilamba Kiaxi, Luanda, Angola<br>

    NIF: 500028959A | Tel.: +244 924 956 037 | 935 542 465 | 222 042 667 | e-mail: geral@cef-oaa.org | website:
    www.cef-oaa.org
</div>