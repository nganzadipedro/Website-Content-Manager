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
        font-size: 13px;
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
        font-size: 14px;
        font-family: minhafonte;
    }

    .corpo .requerente {
        font-weight: bold;
        display: block;
    }

    .assinatura {
        top: 760px;
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
        top: 730px;
        left: 260px;
    }

    .endereco {
        text-transform: uppercase;
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

    .instituicao{
        font-weight: bold;
        text-transform: uppercase;
    }

    .negrito{
        font-weight: bold;
    }

    .spanv {
        display: inline;
    }

    .spani {
        display: none;
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
    <span class="endereco">{{ $endereco }}</span><br>
    TEL: (+244) {{ $contactos }}<br><br>
    <span class="provincia">LUANDA</span>
    @if ($copia_patrono == true)
        <br><br>
        <span class="patrono">C/C: Patrono(a) Dr(a). {{ $nome_patrono }}</span>
    @endif
    @if ($copia_instituicao == true)
        <br><br>
        <span class="instituicao">AO(A) {{ $nome_instituicao }}</span>
    @endif
</p>

<div class="referencia-data">
    <p class="p1">N/Ref.ª N.º {{ $num_referencia }}</p>
    <p class="p2">Luanda, {{ $data_emissao[0] }} de {{ $data_emissao[1] }} de {{ $data_emissao[2] }}</p>
</div>

<div class="corpo">
    @if (count($advogados) > 1)
        Ilustre(s) Colega(s),<br>
    @endif
    @if (count($advogados) == 1)
        Ilustre Colega,<br>
    @endif
    @if ($auto_indicacao == true)
        <p class="pg1">
            O Conselho Provincial de Luanda da OAA recebeu do(a) Ilustre Colega uma carta, solicitando a indicação como
            Advogado(a), com vista a prestar assistência judiciária <span
                class="{{ $varios_req == true ? 'spanv' : 'spani' }}">aos cidadãos</span><span
                class="{{ $varios_req == true ? 'spani' : 'spanv' }}">ao(a) cidadão(ã)</span>:
            <br><br>
            @if($varios_req == true)
                @foreach ($nome_requerente as $requerente)
                    <span class="requerente">{{$loop->index + 1}}.{{ $requerente }}.</span>
                @endforeach
            @endif
            @if($varios_req == false)
                <span class="requerente">1.{{ $nome_requerente }}.</span>
            @endif
        </p>
    @endif
    @if ($auto_indicacao == false)
        <p class="pg1">
            Serve o presente para informar <span class="{{ count($advogados) > 1 ? 'spanv' : 'spani' }}">o(a)s Ilustre(s)
                Colega(s)</span> <span class="{{ count($advogados) > 1 ? 'spani' : 'spanv' }}">o(a) Ilustre Colega</span>
            que nos termos da alínea d), do n.º 1, do art.º 7.º,
            do Dec. Lei n.º 15/95, de 10 de Novembro, foi indicado(a) para intervir no processo de patrocínio judiciário
            requerido pelo(a) cidadão(ã):
            <br><br>
            @if($varios_req == true)
                @foreach ($nome_requerente as $requerente)
                    <span class="requerente">{{$loop->index + 1}}.{{ $requerente }}.</span>
                @endforeach
            @endif
            @if($varios_req == false)
                <span class="requerente">1.{{ $nome_requerente }}.</span>
            @endif
        </p>
    @endif
    @if ($auto_indicacao == true && count($advogados) == 1)
        <p class="pg2">
            Tratando-se de um pedido atendível, nos termos do artigo 39º do Dec. Lei nº 15/95, de 10 de Novembro a Ordem não
            vê qualquer inconveniente, devendo apenas cumprimentar o(a) Ilustre Colega pelo facto:
        </p>
    @endif
    @if ($auto_indicacao == true && count($advogados) > 1)
        <p class="pg2">
            Tratando-se de um pedido atendível, nos termos do artigo 39º do Dec. Lei nº 15/95, de 10 de Novembro a Ordem não
            vê qualquer inconveniente, devendo apenas cumprimentar o(a)s Ilustres Colegas pelo facto:
        </p>
    @endif
    @if ($substituicao == true)
        <p class="pg3">
            Em substituição <span class="{{ $varios_sub == true ? 'spanv' : 'spani' }}">do(a)s Dr(a)s.</span><span class="{{ $varios_sub == false ? 'spanv' : 'spani' }}">do(a) Dr(a).</span> <span class="negrito">{{ $advogado_substituido }}</span>, juntando-se para o efeito cópia do expediente
            apresentado pelo(a)
            requerente.
        </p>
    @endif
    <p class="pg4">
        Solicitamos que tão logo o(a) Colega tenha o 1.º encontro com o(a) Assistido(a), informe ao Conselho Provincial
        de Luanda sobre a viabilidade da pretensão.<br><br>
        Informamos igualmente o(a) Colega que deverá comunicar ao Conselho Nacional da OAA sobre a conclusão do processo
        ora remetido, assim como, nos termos dos artigos 37.º do Decreto-Lei n.º 15/95 e do artigo 4.º do Decreto
        Executivo
        Conjunto n.º 46/97, de 7 de Novembro, remeter a factura para Pagamento de
        honorários e reembolsos das despesas.<br><br>
        Com os melhores cumprimentos.
    </p>
</div>

<div class="assinatura">
    <img src="https://cpl-oaa.ao/assets/system/logos/assinatura_dr_nilton_praia.png" alt="">
    Atenciosamente<br><br>
    O PRESIDENTE<br><br><br><br>
    <span class="linha"></span><br>
    Nilton José Lopes Praia
</div>

<div class="identificador-candidato">
    @php
        $link = $qrcode;
    @endphp
    <span> @php echo DNS2D::getBarcodeHTML($link, 'QRCODE', 2, 2);  @endphp </span>
</div>

<div class="rodape">
    <span class="barra-baixo"></span>
    Largo João Seca, Casa n.º 6, R/C, Distrito Urbano da Maianga - Telef. 921 148 148<br>
    NIF: 5000389510 - Luanda - Angola | Código de Validação: {{ $doc->hash_control }}<br>
</div>