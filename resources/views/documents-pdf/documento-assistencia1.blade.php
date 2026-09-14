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
        font-size: 22px;
        margin-top: -10px;
    }

    .centro-estudo {
        margin-top: -2px;
    }

    .destinatarios {
        color: black;
        font-weight: bold;
        position: relative;
        top: -20px;
        left: 320px;
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
        line-height: 1.5;
        font-size: 12px;
        font-family: minhafonte;
    }

    .corpo .requerente {
        font-weight: bold;
        display: block;
    }

    .assinatura {
        top: 850px;
        left: 220px;
        text-align: center;
        position: fixed;
        font-size: 12px;
    }

    .assinatura .linha {
        display: inline-block;
        border-bottom: solid 1px black;
        width: 250px;
    }

    .assinatura img {
        width: 180px;
        height: 180px;
        position: fixed;
        top: 820px;
        left: 260px;
    }

    .rodape {
        top: 1000px;
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

    .barra {
        display: block;
        border: solid 1px black;
        position: relative;
        top: -30px;
    }

    .identificador-candidato {
        text-align: center;
        width: 50px;
        height: 50px;
        position: fixed;
        top: 860px;
        left: 40px;
    }
</style>

<div class="cabecalho">
    <img src="https://enoaa.cef-oaa.org/images/logo_oaa_cor.png" alt="" width="100px" height="100px">
    <h6 class="centro-estudo">Conselho Provincial de Luanda</h6>
    <span class="barra"></span>
</div>

<p class="destinatarios">
    @if ($varios == false)
        Exmo./a Dr.(a) <br>
    @endif
    @if ($varios == true)
        Exmos. Drs.(a) <br>
    @endif
    @foreach ($advogados as $adv)
        {{ $adv->getadvogado->getpessoa->nome }}<br>
    @endforeach
    {{ $endereco }}<br>
    TEL: (+244) {{ $contactos }}<br><br>
    <span class="provincia">LUANDA</span>
    <br><br>
    @if ($copia_patrono == true)
        <span class="patrono">C/C: Patrono Dr.(ª) HÉLDER BAPTISTA ANTUNES COM MAIS OUTROS NOMES CINCO</span>
    @endif
    @if ($copia_instituicao == true)
        <span class="instituicao">C/C: Provedor de Justiça Dr. João Manuel Francisco</span>
    @endif
</p>

<div class="referencia-data">
    <p class="p1">N/Ref.ª N.º {{ $doc->num_referencia }}/OAA-CPL/2026</p>
    <p class="p2">Luanda, {{ $data_emissao[0] }} de {{ $data_emissao[1] }} de {{ $data_emissao[2] }}</p>
</div>

<div class="corpo">
    Ilustre(s) Colega(s),<br>
    <p class="pg1">
        Serve o presente para informar o(a)s Ilustre(s) Colega(s) que nos termos da alínea d), do n.º 1, do art.º 7.º,
        do Dec. Lei n.º 15/95, de 10 de Novembro, foi indicado(a) para intervir no processo de patrocínio judiciário
        requerido pelo(a) cidadão(ã):
        <br><br>
        <span class="requerente">1.{{ $nome_requerente }}</span>
    </p>
    @if ($auto_indicacao == true)
        <p class="pg2">
            Tratando-se de um pedido atendível, nos termos do artigo 39º do Dec. Lei nº 15/95, de 10 de Novembro a Ordem não
            vê qualquer inconveniente, devendo apenas cumprimentar o(a) cidadão(ã):
        </p>
    @endif
    @if ($substituicao == true)
        <p class="pg3">
            Em substituição do(a) Dra. Edna de Lima, juntando-se para o efeito cópia do expediente apresentado pelo(a)
            requerente.
        </p>
    @endif
    <p class="pg4">
        Solicitamos que tão logo o(a) Colega tenha o 1.º encontro com o(a) Assistido(a), informe ao Conselho Provincial
        de Luanda sobre a viabilidade da pretensão.<br><br>
        Informamos igualmente o(a) Colega que deverá comunicar ao Conselho Nacional da OAA sobre a conclusão do processo
        ora remetido, assim como, nos termos dos art.º 37.º do Dec. Lei n.º 15/95, remeter a factura para Pagamento de
        honorários e reembolsos das despesas.<br><br>
        Com os melhores cumprimentos, subscrevo-me.
    </p>
</div>

<div class="assinatura">
    <img src="https://cpl-oaa.ao/assets/system/logos/assinatura_dr_nilton_praia.png" alt="">
    Atenciosamente<br><br>
    O PRESIDENTE<br><br>
    <span class="linha"></span><br>
    Nilton Praia
</div>

<div class="identificador-candidato">
    @php
        $link = $qrcode;
    @endphp
    <span> @php echo DNS2D::getBarcodeHTML($link, 'QRCODE', 2, 2);  @endphp </span>
</div>

<div class="rodape">
    <span class="barra-baixo"></span>
    Largo João Seca, Casa n.º 6, R/C, Distrito Urbano da Maianga - Telef. 928 410 082<br>
    NIF: 5000389510 - Luanda - Angola | Código de Validação: {{ $doc->hash_control }}<br>
</div>