<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/services-responsive.css') }}">
</head>

<body class="services-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Conheça os nossos serviços</h3>
                    <h4>Temos à disposição vários serviços para os nossos associados</h4>
                </div>
            </div>
        </section>

        <section class="section-services">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <div class="item-service">
                            <div class="header">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="" class="icon">
                                <h3 class="title">
                                    Solicitação de Audiência
                                </h3>
                            </div>
                            <div class="body">
                                <span></span>
                                <p>
                                    Para solicitar uma audiência, o interessado deve apresentar de forma presencial um
                                    requerimento formal
                                    dirigido ao Conselho Provincial de Luanda, indicando expressamente o pedido de
                                    agendamento de reunião com o Presidente ou Vice-Presidente do CPL, conforme a
                                    natureza do assunto a ser tratado.
                                </p>
                                <!-- <a href="">Ler Mais...</a> -->
                            </div>
                        </div>
                        <div class="item-service">
                            <div class="header">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="" class="icon">
                                <h3 class="title">
                                    2ª Via da Cédula de Estagiário
                                </h3>
                            </div>
                            <div class="body">
                                <span></span>
                                <p>
                                    Para dar seguimento ao processo, é necessário apresentar um requerimento formal
                                    dirigido ao Conselho Provincial de Luanda. Além disso, deve ser efetuado o pagamento
                                    da taxa no valor de 6.000 Kz, mediante depósito na conta do Conselho Nacional. O
                                    processo deve ser acompanhado de uma fotografia tipo passe atualizada. Após a
                                    reunião de todos os documentos, a solicitação deverá ser formalmente submetida junto
                                    ao CPL.
                                </p>
                                <!-- <a href="">Ler Mais...</a> -->
                            </div>
                        </div>
                        <div class="item-service">
                            <div class="header">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="" class="icon">
                                <h3 class="title">
                                    Mudança de Patrono
                                </h3>
                            </div>
                            <div class="body">
                                <span></span>
                                <p>
                                    Para a formalização do pedido de mudança de patrono, o interessado deverá apresentar
                                    um requerimento dirigido ao Conselho Provincial de Luanda, acompanhado da declaração
                                    do novo patrono e do relatório parcial emitido pelo patrono anterior. É igualmente
                                    necessário proceder ao pagamento da taxa aplicável: no valor de 7.000 Kz caso a
                                    cédula se encontre plastificada, ou 1.000 Kz caso não esteja, mediante depósito na
                                    conta do Conselho Nacional. Nos casos em que a cédula for plastificada, deve também
                                    ser incluída uma fotografia tipo passe atualizada.
                                </p>
                                <!-- <a href="">Ler Mais...</a> -->
                            </div>
                        </div>
                        <!-- <div class="item-service">
                            <div class="header">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="" class="icon">
                                <h3 class="title">
                                    Inscrição no Conselho Provincial
                                </h3>
                            </div>
                            <div class="body">
                                <span></span>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting.
                                </p>
                                <a href="">Ler Mais...</a>
                            </div>
                        </div> -->
                        <!-- <div class="item-service">
                            <div class="header">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="" class="icon">
                                <h3 class="title">
                                    Processo de Conclusão do Estágio
                                </h3>
                            </div>
                            <div class="body">
                                <span></span>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting.
                                </p>
                                <a href="">Ler Mais...</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="scroll-down-arrow">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <section class="section-cta">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <img src="{{ asset('assets/website/img/img-services.jpg') }}" alt="">
                        <div class="text-area">
                            <h3 class="title">Estamos disponíveis para atendé-lo.</h3>
                            <h4 class="subtitle">Temos uma equipa pronta para dar tratamento à tua questão. Entre em
                                contacto com a nossa central de atendimentos e solicite já o serviço que deseja.</h4>
                            <a href="https://wa.me/244928410082">Solicitar Agora >></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website.footer')


</body>

<script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/website/js/services-animations.js') }}"></script>

</html>