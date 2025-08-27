<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/team-slider.css') }}">
</head>

<body class="main-page">
    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')


    <div class="container">
        <section class="section-president">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="content">
                        <div class="img-advogado order-sm-0 col-md-6">
                            <img src="{{ asset('assets/website/img/dr_nilton_praia_2.png') }}" alt="">
                        </div>
                        <div class="description order-sm-1 col-md-6">
                            <h2>Nilton Praia</h2>
                            <span>Presidente do CPL-OAA</span>
                            <h3>Mensagem do Presidente</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum
                                egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper
                                vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
                                himenaeos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($noticia_destaque != null)
            <section class="section-feature">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="content">
                            <div class="text-area">
                                <h3 class="title-section">Em Destaque</h3>
                                <h3 class="title-feature">{{$noticia_destaque->titulo}}</h3>
                                <p class="description">
                                    {{ $noticia_destaque->texto_resumo }}
                                </p>
                                <a href="">Saiba mais...</a>
                            </div>
                            <img src="{{ asset('storage/app/public/' . $noticia_destaque->imagem) }}" alt="">
                            <!-- <img src="{{ asset('sysapp/storage/app/public/' . $noticia_destaque->imagem) }}" alt=""> -->
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>

    <section class="section-about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="content">
                        <h3 class="title">Quem Somos?</h3>
                        <h4 class="subtitle">O Conselho Provincial de Luanda da Ordem dos Advogados de Angola</h4>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                            pellentesque
                            sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam
                            urna tempor.
                            Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada
                            lacinia
                            integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora
                            torquent per
                            conubia nostra inceptos himenaeos.
                        </p>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                            pellentesque
                            sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam
                            urna tempor.
                            Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada
                            lacinia
                            integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora
                            torquent per
                            conubia nostra inceptos himenaeos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <section class="section-values">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="content">
                        <div class="item">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>MISSÃO</h3>
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium etiam duis sem convallis. Tempus duis
                                eu
                                aenean sed sem urna tempor etiam. Pulvinar Vivamus etiam lacunei metus etiam bibendum
                                egestas. Iaculis massa justo lacinia lorem nunc posuere. Ut etiam semper viverra
                                id class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
                                himenaeos.
                            </p>
                        </div>
                        <div class="item">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>VISÃO</h3>
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium etiam duis sem convallis. Tempus duis
                                eu
                                aenean sed sem urna tempor etiam. Pulvinar Vivamus etiam lacunei metus etiam bibendum
                                egestas. Iaculis massa justo lacinia lorem nunc posuere. Ut etiam semper viverra
                                id class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
                                himenaeos.
                            </p>
                        </div>
                        <div class="item">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>VALORES</h3>
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium etiam duis sem convallis. Tempus duis
                                eu
                                aenean sed sem urna tempor etiam. Pulvinar Vivamus etiam lacunei metus etiam bibendum
                                egestas. Iaculis massa justo lacinia lorem nunc posuere. Ut etiam semper viverra
                                id class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos
                                himenaeos.
                            </p>
                        </div>
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

    <section class="section-team">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <h3 class="title-pt">A Nossa Equipa</h3>
                    <h4 class="subtitle">Colaboração, responsabilidade e integridade em cada ação.</h4>
                    <div class="team-slider" id="team-slider">
                        <div class="slider-container">
                            <div class="slider-track">
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/nilton_praia.webp') }}"
                                        alt="Nilton José Lopes Praia">
                                    <p>Nilton José Lopes Praia</p>
                                    <span class="card-number">Cédula Nº 1837</span>
                                    <span class="role">Presidente</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/nilton_praia.webp') }}"
                                        alt="Lezly Edith Orobio Da Silva Cardoso">
                                    <p>Lezly Edith Orobio Da Silva Cardoso</p>
                                    <span class="card-number">Cédula Nº 2914</span>
                                    <span class="role">Vice-Presidente</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/gomes_dos_santos.jpg') }}"
                                        alt="Gomes Mateus Dos Santos">
                                    <p>Gomes Mateus Dos Santos</p>
                                    <span class="card-number">Cédula Nº 4157</span>
                                    <span class="role">Secretário/Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/edgar_cassanje.jpg') }}"
                                        alt="Edgar Inácio Cassange">
                                    <p>Edgar Inácio Cassange</p>
                                    <span class="card-number">Cédula Nº 1650</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/dilson_barros.jpg') }}"
                                        alt="Dilson Esmael Da Fátima Barros">
                                    <p>Dilson Esmael Da Fátima Barros</p>
                                    <span class="card-number">Cédula Nº 1575</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/agostinho_paulo.jpg') }}"
                                        alt="Agostinho Da Conceição Paulo">
                                    <p>Agostinho Da Conceição Paulo</p>
                                    <span class="card-number">Cédula Nº 2999</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/belchior_catongo.jpg') }}"
                                        alt="Belchior Fidel Catongo">
                                    <p>Belchior Fidel Catongo</p>
                                    <span class="card-number">Cédula Nº 1716</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/emery_moio.jpg') }}"
                                        alt="Emery Moio Kudissadila">
                                    <p>Emery Moio Kudissadila</p>
                                    <span class="card-number">Cédula Nº 2702</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/nilton_praia.webp') }}"
                                        alt="José Rodrigues Vicente">
                                    <p>José Rodrigues Vicente</p>
                                    <span class="card-number">Cédula Nº 3213</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/edna_vandunem.jpg') }}"
                                        alt="Edna José Van-Dúnem">
                                    <p>Edna José Van-Dúnem</p>
                                    <span class="card-number">Cédula Nº 4345</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/aline_simoes.jpg') }}"
                                        alt="Aline Maura Da Cruz Simões">
                                    <p>Aline Maura Da Cruz Simões</p>
                                    <span class="card-number">Cédula Nº 2379</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/mauro_albuquerque.jpg') }}"
                                        alt="Mauro Ezer Reais Alburquerque">
                                    <p>Mauro Ezer Reais Alburquerque</p>
                                    <span class="card-number">Cédula Nº 3410</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/emilio_santos.jpg') }}"
                                        alt="Emílio William António Dos Santos">
                                    <p>Emílio William António Dos Santos</p>
                                    <span class="card-number">Cédula Nº 2281</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/nilton_praia.webp') }}"
                                        alt="Edvaldo Gonçalves Calitamba">
                                    <p>Edvaldo Gonçalves Calitamba</p>
                                    <span class="card-number">Cédula Nº 2709</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                                <div class="membro">
                                    <img src="{{ asset('assets/website/img/nilton_praia.webp') }}"
                                        alt="Ascânio Giovani Albino Do Nascimento">
                                    <p>Ascânio Giovani Albino Do Nascimento</p>
                                    <span class="card-number">Cédula Nº 2620</span>
                                    <span class="role">Conselheiro</span>
                                </div>
                            </div>
                        </div>
                        <div class="slider-dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/index.js') }}"></script>
    <script src="{{ asset('assets/website/js/team-slider.js') }}"></script>

</body>

</html>