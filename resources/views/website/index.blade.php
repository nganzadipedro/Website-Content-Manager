<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta name="author" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Início</title>
    <link rel="icon" href="{{ asset('assets/website/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/team-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/brands-slider.css') }}">

</head>

<body class="main-page">

    @include('website.menu')

    <!-- CARROSSEL HERO -->
    <section class="hero-carousel">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">

            <!-- Indicadores -->
            <div class="carousel-indicators-custom">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                @foreach ($carrossel as $item)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('application/storage/app/public/' . $item->imagem) }}" alt="Banner{{ $item->id }}" class="hero-img">
                        <div class="carousel-caption">
                            <h1>{{$item->titulo}}</h1>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Setas de navegação -->
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </section>

    <div class="container">
        <section class="section-president">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="content">
                        <div class="img-advogado">
                            <img src="{{ asset('assets/website/img/dr_nilton_praia_2.png') }}" alt="">
                        </div>
                        <div class="description">
                            <h2>Nilton José Lopes Praia</h2>
                            <span>Presidente do CPL-OAA</span>
                            <p>
                                Ilustres Colegas,<br>
                                Caros Cidadãos,<br><br>
                                O Conselho Provincial de Luanda da Ordem dos Advogados de Angola (CPL) reafirma, através
                                desta mensagem, o seu compromisso inabalável com a defesa do Estado Democrático de
                                Direito, com a protecção dos direitos, liberdades e garantias fundamentais e com a
                                dignidade do exercício da Advocacia na nossa província.<br><br>
                                Vivemos um tempo de grandes desafios sociais, económicos e institucionais, em que a
                                Advocacia assume um papel cada vez mais determinante na promoção da justiça e na
                                salvaguarda dos direitos dos cidadãos. O CPL continuará a trabalhar para fortalecer a
                                confiança do público na Justiça e para valorizar o papel do Advogado enquanto órgão
                                auxiliar e essencial ao funcionamento de um Estado de Direito moderno, transparente e
                                inclusivo.<br><br>
                                A nossa actuação continuará assente na independência, na ética, na deontologia e na
                                excelência profissional. Estamos empenhados em elevar a qualidade dos serviços prestados
                                aos nossos associados, reforçar as acções de formação, assegurar maior celeridade
                                administrativa e promover iniciativas de responsabilidade social que aproximem a
                                Advocacia da comunidade. Aos Advogados e Advogados Estagiários, reitero o apelo à união,
                                colegialidade e
                                participação activa na vida da nossa instituição. É com o contributo de todos que
                                edificaremos uma Ordem mais forte, mais presente e mais preparada para os desafios do
                                futuro.<br><br>
                                Ao público em geral, renovamos o nosso compromisso de servir com transparência, rigor e
                                sentido de missão, garantindo que a Advocacia continue a ser voz da cidadania e
                                instrumento de protecção da justiça e da liberdade.
                                O Conselho Provincial de Luanda permanece aberto ao diálogo, à colaboração e à melhoria
                                contínua. Juntos, continuaremos a honrar a nobre missão da Advocacia angolana.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if ($noticia_destaque != null)
        <section class="section-feature">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="content">
                            <div class="text-area">
                                <h3 class="title-section">Em Destaque</h3>
                                <h3 class="title-feature">{{$noticia_destaque->titulo}}</h3>
                                <p class="description">
                                    {{ $noticia_destaque->texto_resumo }}
                                </p>
                                <a href="{{ route('news_details', $noticia_destaque->hash) }}">Saiba mais...</a>
                            </div>
                            <img src="{{ asset('application/storage/app/public/' . $noticia_destaque->imagem) }}"
                                alt="{{ $noticia_destaque->titulo }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section-about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="content">
                        <h3 class="title">Quem Somos?</h3>
                        <h4 class="subtitle">O Conselho Provincial de Luanda da Ordem dos Advogados de Angola</h4>
                        <p class="description">
                            O Conselho Provincial de Luanda da Ordem dos Advogados de Angola é a estrutura
                            representativa da classe dos Advogados e Advogados Estagiários na maior e mais dinâmica
                            província do país. Trabalhamos para garantir a dignidade, a independência e a
                            responsabilidade no exercício da Advocacia, promovendo a defesa dos direitos, liberdades e
                            garantias dos cidadãos e contribuindo para o fortalecimento do Estado Democrático de
                            Direito.
                        </p>
                        <p class="description">
                            A nossa actuação está assente numa missão clara: assegurar o cumprimento das normas
                            deontológicas, valorizar o papel social da Advocacia e garantir que a classe exerça a sua
                            função com excelência técnica, ética e autonomia. Orientamo-nos por uma visão de
                            modernidade, boa governação e compromisso público, procurando ser um Conselho Provincial de
                            referência nacional na defesa intransigente da classe e na promoção de uma Justiça mais
                            próxima, eficiente e confiável.
                            <br><br>
                            Inspiramo-nos nos valores que definem a melhor prática da Advocacia: independência, ética,
                            legalidade, excelência profissional, solidariedade, responsabilidade social e transparência.
                            Cada uma das nossas iniciativas reflecte estes princípios, reforçando o prestígio da Ordem
                            dos Advogados de Angola e contribuindo para uma relação construtiva entre os profissionais
                            do Direito, as instituições e a sociedade.

                            Somos uma entidade comprometida com a formação contínua, o rigor institucional e o serviço
                            público, trabalhando diariamente para fortalecer a imagem da Advocacia em Luanda e criar
                            condições para uma Justiça mais fiel aos seus princípios e à dignidade humana.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-values">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="content">
                        <div class="item">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>MISSÃO</h3>
                            </div>
                            <p class="description">
                                Garantir a defesa do Estado Democrático de Direito, assegurar o cumprimento das normas
                                deontológicas da Advocacia e promover o exercício digno, independente e responsável da
                                profissão, contribuindo para o acesso efectivo à justiça e para a protecção dos
                                direitos, liberdades e garantias dos cidadãos na Província de Luanda.
                            </p>
                        </div>
                        <div class="item">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>VISÃO</h3>
                            </div>
                            <p class="description">
                                Ser um Conselho Provincial de referência nacional na boa governação institucional, na
                                defesa intransigente da classe e na promoção de uma Advocacia tecnicamente qualificada,
                                ética, moderna e socialmente comprometida, fortalecendo a confiança do público na
                                Justiça e o prestígio da Ordem dos Advogados de Angola.
                            </p>
                        </div>
                    </div>

                    <div class="content-values">
                        <div class="description-values">
                            <div class="title">
                                <img src="{{ asset('assets/website/icons/law.png') }}" alt="">
                                <h3>VALORES</h3>
                            </div>

                            <!-- Grid com Bootstrap: 1 coluna em mobile, 2 colunas em md+ -->
                            <div class="items valores-grid">
                                <div class="item">
                                    <h4>Independência</h4>
                                    <p>Actuamos com autonomia funcional, técnica e institucional, assegurando que a
                                        Advocacia mantém a sua liberdade de pensamento e de intervenção pública.</p>
                                </div>
                                <div class="item">
                                    <h4>Ética e Deontologia</h4>
                                    <p>Pautamos toda a actuação pelos princípios éticos, pelo sigilo profissional, pela
                                        lealdade, transparência e rigor.</p>
                                </div>
                                <div class="item">
                                    <h4>Justiça e Legalidade</h4>
                                    <p>Promovemos a defesa dos direitos fundamentais, o respeito pela lei e o
                                        cumprimento das garantias processuais.</p>
                                </div>
                                <div class="item">
                                    <h4>Excelência Profissional</h4>
                                    <p>Estimamos a formação contínua, a competência técnica e a elevação da Advocacia
                                        como serviço essencial à sociedade.</p>
                                </div>
                                <div class="item">
                                    <h4>Solidariedade e Colegialidade</h4>
                                    <p>Valorizamos o espírito de união, respeito mútuo e apoio entre os Advogados e
                                        Advogados Estagiários.</p>
                                </div>
                                <div class="item">
                                    <h4>Responsabilidade Social</h4>
                                    <p>Actuamos comando com compromisso público, promovendo iniciativas de acesso à
                                        justiça, educação jurídica e intervenção cívica.</p>
                                </div>
                                <div class="item ultimo-valor">
                                    <h4>Transparência e Boa Governação</h4>
                                    <p>Promovemos gestão responsável, eficiência administrativa e comunicação clara com
                                        os associados e a sociedade.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="scroll-down-arrow">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                    <img src="{{ asset('assets/website/img/fotos/conselheiros/dra_lezly.jpg') }}"
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
                                <!-- <div class="membro">
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
                                </div> -->
                            </div>
                        </div>
                        <div class="slider-dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="section-brands">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <h3 class="title">Nossos Parceiros</h3>
                    <h4 class="subtitle">Colaborações que fortalecem nosso compromisso com a excelência.</h4>
                    <div class="brands-slider" id="brands-slider">
                        <div class="slider-container">
                            <div class="slider-track">
                                <div class="brand-logo">
                                    <img src="{{ asset('images/verticallogo.png') }}" alt="Brand 1">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/icons/2021/10/27/1olvMDK1ram-FD4.png"
                                        alt="Brand 2">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/icons/2021/10/27/NTs7EMHlHtbJE3B.png"
                                        alt="Brand 3">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/uploads/icon/2021/09/26/184ba634-a218-4d65-a2b4-f04626d05024.png"
                                        alt="Brand 4">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/icons/2021/12/02/y8oyEHx3FaUihRV.png"
                                        alt="Brand 5">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/icons/2021/12/02/_B1T-44r7kGbgWM.png"
                                        alt="Brand 6">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/icons/2021/12/02/TUhJtD3NM0l-Vtq.png"
                                        alt="Brand 7">
                                </div>
                                <div class="brand-logo">
                                    <img src="https://www.logoai.com/oss/ai-images/0b087526e9464e769d18c1871fbe2440.png"
                                        alt="Brand 8">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/index.js') }}"></script>
    <script src="{{ asset('assets/website/js/team-slider.js') }}"></script>
    <!-- <script src="{{ asset('assets/website/js/brands-slider.js') }}"></script> -->

</body>

</html>