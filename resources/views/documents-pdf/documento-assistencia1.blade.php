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

    .destinatarios {
        color: black;
        font-weight: bold;
        position: relative;
        left: 300px;
        font-size: 12px;
        width: 370px;
        overflow-wrap: break-word;
    }

    .destinatarios .provincia {
        text-decoration: underline;
    }

    .referencia-data {
        width: 90%;
        margin: 0 auto;
        padding-top: 20px;
    }

    .referencia-data p {
        font-size: 12px;
        display: inline-block;
        width: 48%;
    }

     .referencia-data .p2 {
        position: relative;
        left: 170px;
    }

    .corpo {
        width: 90%;
        margin: 0 auto;
        /* margin-top: -50px; */
        text-align: justify;
        line-height: 1.8;
        font-size: 12px;
        font-family: minhafonte;
    }

    .corpo .requerente {
        font-weight: bold;
        display: block;
    }

    .assinatura {
        margin-top: 50px;
        text-align: center;
        font-size: 12px;
    }

    .assinatura .linha {
        display: inline-block;
        border-bottom: solid 1px black;
        width: 250px;
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

    .bold {
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

<div class="cabecalho">
    <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    <h6 class="centro-estudo">Conselho Provincial de Luanda</h6>
    <span class="barra"></span>
</div>

<p class="destinatarios">
    Exmo/a Dr.(ª) <br>
    {{ $nome_advogado }}<br>
    {{ $endereco_advogado }}<br>
    TEL: (+244) {{ $telefone_advogado }}<br><br>
    <span class="provincia">LUANDA</span>
    <br><br>
    <span class="patrono">C/C: Patrono Dr.(ª) HÉLDER BAPTISTA ANTUNES COM MAIS OUTROS NOMES CINCO</span>
</p>

<div class="referencia-data">
    <p class="p1">N/Ref.ª N.º 0249/OAA-CPL/2026</p>
    <p class="p2">Luanda, 21 de Janeiro de 2026</p>
</div>

<div class="corpo">
    Ilustre(s) Colega(s),<br><br>
    <p class="pg1">
        Serve o presente para informar o(a)s Ilustre(s) Colega(s) que nos termos da alínea d), do n.º 1, do art.º 7.º,
        do Dec. Lei n.º 15/95, de 10 de Novembro, foi indicado(a) para intervir no processo de patrocínio judiciário
        requerido pelo(a) cidadão(ã):
        <br><br>
        <span class="requerente">1.Vieira Luciano Manuel</span>
    </p>
    <p class="pg2">
        Solicitamos que tão logo o(a) Colega tenha o 1.º encontro com o(a) Assistido(a), informe ao Conselho Provincial
        de Luanda sobre a viabilidade da pretensão.<br>
        Informamos igualmente o(a) Colega que deverá comunicar ao Conselho Nacional da OAA sobre a conclusão do processo
        ora remetido, assim como, nos termos dos art.º 37.º do Dec. Lei n.º 15/95, remeter a factura para Pagamento de
        honorários e reembolsos das despesas.<br><br>
        Com os melhores cumprimentos, subscrevo-me.
    </p>
    <p class="assinatura">
        Atenciosamente<br><br>
        O PRESIDENTE<br><br>
        <span class="linha"></span><br>
        Nilton Praia
    </p>
</div>

<div class="rodape">
    <span class="barra-baixo"></span>
    Largo João Seca, Casa n.º 6, R/C, Distrito Urbano da Maianga - Telef. 928 410 082<br>
    NIF: 5000389510 - Luanda - Angola<br>
</div>