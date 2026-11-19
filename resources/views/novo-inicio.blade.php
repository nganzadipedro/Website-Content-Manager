<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>CEF | Formações</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CEF | Formações" name="description" />
    <meta content="CEF | Formações" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!--Swiper slider css-->
    <link href="{{ asset('assets/template/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/template/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <!-- <link href="{{ asset('assets/template/css/custom.min.css') }}" rel="stylesheet" type="text/css" /> -->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/system/css/novo-inicio.css') }}" rel="stylesheet" type="text/css" />


</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo_oaa_cor.png') }}" class="card-logo card-logo-dark" alt="logo dark"
                        height="50">
                    <img src="{{ asset('images/logo_oaa_cor.png') }}" class="card-logo card-logo-light" alt="logo light"
                        height="50">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="page-link" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-link" href="#formacoes-especializadas">Formações Especializadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-link" href="{{ route('register') }}">Formação Inicial Obrigatória</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#features">Valores</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#plans">Plans</a>
                        </li> --}}
                        <!-- <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#reviews">Testemunhos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#team">Equipa</a>
                        </li> -->
                        {{-- <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#contact">Contact</a>
                        </li> --}}
                    </ul>

                    <div class="">
                        <a href="{{ route('login') }}"
                            class="btn btn-warning fw-medium text-decoration-none text-black">Acessar</a>
                        <!-- <a href="{{ route('register') }}" class="btn btn-warning">Inscrever-se</a> -->
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        <!-- start hero section -->
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center mt-lg-5 pt-5 mb-5">
                            <h1 class="title-page">Formação jurídica com rigor técnico e qualidade garantida</h1>
                            <!-- <p class="lead text-muted lh-base">O CEF é o centro de estudos e formação da ordem dos advogados de Angola.</p> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- end hero section -->

        <section class="section-cursos mt-5" id="formacoes-especializadas">
            <div class="container text-center">

                <h3 class="title-section mb-5 fw-bold text-blue"><span class="text-black">Inscreva-se</span> nas nossas
                    formações especializadas</h3>

                <div class="lista-cursos">
                    <div class="card">
                        <img src="{{ asset('assets/template/images/demos/estrangeiros.jpg') }}" alt="Curso 1"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title" href="{{ url('/formacao-especializada') }}">Formação Especializada em Regulação e Supervisão
                                do Mercado Bancário</a>
                            <p class="card-description">A formação terá como meta aprofundar os temas actuais inerentes
                                ao mercado Bancário...</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('assets/template/images/demos/crianca.jpg') }}" alt="Curso 2"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title">Formação Especializada Em Regulação E Supervisão
                                Do Mercado Dos Seguros E Fundos De Pensões
                            </a>
                            <p class="card-description">A actividade dos seguros em Angola está a ter enormes reformas
                                legislativas, o que de
                                forma inevitável...</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('assets/template/images/demos/digital.jpg') }}" alt="Curso 3"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title">Formação Especializada Em Regulação E Supervisão
                                Do Mercado De Capitais
                            </a>
                            <p class="card-description">O Mercado de Capitais é o mercado com maior evolução legislativa
                                em Angola e que se
                                encontra em expansão. Por esta razão...</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('assets/template/images/demos/protecao-dados.jpg') }}" alt="Curso 3"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title">Formação Especializada Sobre A Gestão De Carreiras
                                Nas Sociedades De Advogados
                            </a>
                            <p class="card-description">A grande problemática na advocacia não é apenas o cumprimento de todas as
                            formalidades legais para o seu exercício.</p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('assets/template/images/demos/compliance.jpg') }}" alt="Curso 3"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title">Formação Especializada Sobre Contabilidade E
Finanças Para Advogados E Sociedades De Advogados
</a>
                            <p class="card-description">A actividade advocatícia é uma profissão no qual todos estão submetidos aos
                            pagamentos...</p>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <img src="{{ asset('assets/template/images/demos/consumo.jpg') }}" alt="Curso 3"
                            class="card-img">
                        <div class="card-content">
                            <p class="card-date">16 janeiro 2025 a 10 abril 2025</p>
                            <a class="card-title">Pós-Graduação em Direito do Consumo</a>
                            <p class="card-description">Breve descrição da formação.</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <!-- start client section -->
        <div class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="text-center">
                            <h5 class="title-section fw-bold">Conheça os nossos <span
                                    class="text-black">Parceiros</span></h5>

                            <div class="swiper trusted-client-slider mt-sm-5 mt-5 mb-sm-5 mb-4" dir="ltr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/amazon.svg')}}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/walmart.svg')}}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/lenovo.svg')}}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/paypal.svg')}}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/shopify.svg')}}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="client-images">
                                            <img src="{{ asset('assets/template/images/clients/verizon.svg') }}"
                                                alt="client-img" class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end client section -->

        <!-- start services -->
        <section class="section" id="razoes">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-bold lh-base title-section">Somos a escolha <span
                                    class="text-black">Certa</span></h1>
                            <p class="description-section">Veja a seguir, as principais razões que tornam o nosso centro virtual uma escolha certa.
                            </p>
                        </div>
                    </div>

                </div>


                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-transparent text-blue rounded-circle">
                                        <i class="ri-user-3-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 title-razao">
                                <h5 class="fs-18">Professores qualificados</h5>
                                <p class="my-3 ff-secondary">Acreditamos que a qualidade da formação está diretamente
                                    ligada à competência dos nossos professores. Contamos com uma equipa de docentes
                                    altamente qualificados.</p>
                                {{-- <div>
                                    <a href="#" class="fs-13 fw-semibold">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-transparent text-blue rounded-circle">
                                        <i class="ri-check-double-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 title-razao">
                                <h5 class="fs-18">Certificação reconhecida</h5>
                                <p class="my-3 ff-secondary"> Oferecemos aos nossos alunos uma formação de qualidade que
                                    resulta em certificações reconhecidas e valorizadas no mercado de trabalho.</p>
                                {{-- <div>
                                    <a href="#" class="fs-13 fw-semibold">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-transparent text-blue rounded-circle">
                                        <i class="ri-lightbulb-flash-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 title-razao">
                                <h5 class="fs-18">Perfil de saída</h5>
                                <p class="my-3 ff-secondary">Ao concluir o curso no nosso centro de estudos, os alunos
                                    estão prontos para enfrentar os desafios do mercado de trabalho com confiança e
                                    competência.</p>
                                {{-- <div>
                                    <a href="#" class="fs-13 fw-semibold">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-transparent text-blue rounded-circle">
                                        <i class="ri-number-3 fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 title-razao">
                                <h5 class="fs-18">3+ Anos de experiência</h5>
                                <p class="my-3 ff-secondary">Com mais de 3 anos de experiência no setor educacional, o
                                    nosso centro de estudos tem se destacado por oferecer uma formação sólida e de alta
                                    qualidade. </p>
                                {{-- <div>
                                    <a href="#" class="fs-13 fw-semibold">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-transparent text-blue rounded-circle">
                                        <i class="ri-shield-check-line fs-36"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 title-razao">
                                <h5 class="fs-18">Parceira de outras instituições</h5>
                                <p class="my-3 ff-secondary">Trabalhamos em conjunto com universidades, empresas e
                                    organizações profissionais para proporcionar aos nossos alunos uma formação ainda
                                    mais completa.</p>
                                {{-- <div>
                                    <a href="#" class="fs-13 fw-semibold">Learn More <i
                                            class="ri-arrow-right-s-line align-bottom"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end services -->



        <!-- start cta -->
        <section class="py-5 bg-black position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-sm">
                        <div>
                            <h4 class="text-white mb-0 fw-bold">Para advogados estagiários, temos a Formação Inicial
                                Obrigatória</h4>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div>
                            <a href="" target="_blank" class="btn btn-warning text-black">
                                Quero inscrever-me</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end cta -->

        <!-- start plan -->
        {{-- <section class="section bg-light" id="plans">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-bold">Escoha a formação que pretendes fazer</h3>
                            <p class="text-muted mb-4">Preços acessíveis, qualidade garantida.</p>

                            <div class="d-flex justify-content-center align-items-center">
                                <div>
                                    <h5 class="fs-15 mb-0">Month</h5>
                                </div>
                                <div class="form-check form-switch fs-20 ms-3 " onclick="check()">
                                    <input class="form-check-input" type="checkbox" id="plan-switch">
                                    <label class="form-check-label" for="plan-switch"></label>
                                </div>
                                <div>
                                    <h5 class="fs-15 mb-0">Annual <span class="badge badge-soft-success">Save 20%</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row gy-4">
                    <div class="col-lg-4">
                        <div class="card plan-box mb-0">
                            <div class="card-body p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">Basic Plan</h5>
                                        <p class="text-muted mb-0">For Startup</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-book-mark-line fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">19</span> <span
                                            class="fs-13 text-muted">/Month</span></h1>
                                    <h1 class="annual"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">171</span> <span
                                            class="fs-13 text-muted">/Year</span></h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>3</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>299</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>5</b> FTP Login
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-danger me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>24/7</b> Support
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-danger me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Storage
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-danger me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Domain
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="mt-4">
                                        <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card plan-box mb-0 ribbon-box right">
                            <div class="card-body p-4 m-2">
                                <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">Pro Business</h5>
                                        <p class="text-muted mb-0">Professional plans</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-medal-fill fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">29</span> <span
                                            class="fs-13 text-muted">/Month</span></h1>
                                    <h1 class="annual"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">261</span> <span
                                            class="fs-13 text-muted">/Year</span></h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Upto <b>15</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>12</b> FTP Login
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>24/7</b> Support
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-danger me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Storage
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-danger me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Domain
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="mt-4">
                                        <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="card plan-box mb-0">
                            <div class="card-body p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">Platinum Plan</h5>
                                        <p class="text-muted mb-0">Enterprise Businesses</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-stack-fill fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h1 class="month"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">39</span> <span
                                            class="fs-13 text-muted">/Month</span></h1>
                                    <h1 class="annual"><sup><small>$</small></sup><span
                                            class="ff-secondary fw-bold">351</span> <span
                                            class="fs-13 text-muted">/Year</span></h1>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3 ff-secondary">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Projects
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Customers
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Scalable Bandwidth
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> FTP Login
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>24/7</b> Support
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Unlimited</b> Storage
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    Domain
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="mt-4">
                                        <a href="javascript:void(0);" class="btn btn-soft-success w-100">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!-- end container -->
        </section> --}}
        <!-- end plan -->

        <!-- start faqs -->
        <!-- <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-bold">Principais perguntas sobre as nossas formações</h3>
                            <p class="text-muted mb-4 ff-secondary">Se não encontrar a sua questão, podes sempre
                                contactar a nossa equipa.</p>

                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                        class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                    Envie-nos um email</button>
                                <button type="button" class="btn btn-warning btn-label rounded-pill"><i
                                        class="ri-twitter-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                    Ligue para nós</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-lg-5 g-4">
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-1">
                                <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-bold">Principais questões</h5>
                            </div>
                        </div>
                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                            id="genques-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingOne">
                                    <button class="accordion-button fs-15 fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#genques-collapseOne"
                                        aria-expanded="true" aria-controls="genques-collapseOne">
                                        What is the purpose of using themes ?
                                    </button>
                                </h2>
                                <div id="genques-collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        A theme is a set of colors, fonts, effects, and more that can be applied to your
                                        entire presentation to give it a
                                        consistent, professional look. You've already been using a theme, even if you
                                        didn't know it: the default Office theme, which consists.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingTwo">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#genques-collapseTwo"
                                        aria-expanded="false" aria-controls="genques-collapseTwo">
                                        Can a theme have more than one theme?
                                    </button>
                                </h2>
                                <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        A story can have as many themes as the reader can identify based on recurring
                                        patterns and parallels within the story
                                        itself. In looking at ways to separate themes into a hierarchy, we might find it
                                        useful to follow the example of a single book.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingThree">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#genques-collapseThree"
                                        aria-expanded="false" aria-controls="genques-collapseThree">
                                        What are theme features?
                                    </button>
                                </h2>
                                <div id="genques-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Theme features is a set of specific functionality that may be enabled by theme
                                        authors. Themes must register each
                                        individual Theme Feature that the author wishes to support. Theme support
                                        functions should be called in the theme's functions.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingFour">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#genques-collapseFour"
                                        aria-expanded="false" aria-controls="genques-collapseFour">
                                        What is simple theme?
                                    </button>
                                </h2>
                                <div id="genques-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingFour" data-bs-parent="#genques-accordion">
                                    <div class="accordion-body ff-secondary">
                                        Simple is a free WordPress theme, by Themify, built exactly what it is named
                                        for: simplicity. Immediately upgrade the
                                        quality of your WordPress site with the simple theme To use the built-in Chrome
                                        theme editor.
                                    </div>
                                </div>
                            </div>
                        </div>
                  

                    </div>
                
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0 me-1">
                                <i class="ri-shield-keyhole-line fs-24 align-middle text-success me-1"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-bold">Outras questões</h5>
                            </div>
                        </div>

                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                            id="privacy-accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingOne">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#privacy-collapseOne"
                                        aria-expanded="false" aria-controls="privacy-collapseOne">
                                        Does Word have night mode?
                                    </button>
                                </h2>
                                <div id="privacy-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingOne" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        You can run Microsoft Word in dark mode, which uses a dark color palette to help
                                        reduce eye strain in low light
                                        settings. You can choose to make the document white or black using the Switch
                                        Modes button in the ribbon's View tab.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingTwo">
                                    <button class="accordion-button fs-15 fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#privacy-collapseTwo"
                                        aria-expanded="true" aria-controls="privacy-collapseTwo">
                                        Is theme an opinion?
                                    </button>
                                </h2>
                                <div id="privacy-collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="privacy-headingTwo" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        A theme is an opinion the author expresses on the subject, for instance, the
                                        author's dissatisfaction with the narrow
                                        confines of French bourgeois marriage during that period theme is an idea that a
                                        writer repeats.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingThree">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#privacy-collapseThree"
                                        aria-expanded="false" aria-controls="privacy-collapseThree">
                                        How do you develop a theme?
                                    </button>
                                </h2>
                                <div id="privacy-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingThree" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        A short story, novella, or novel presents a narrative to its reader. Perhaps
                                        that narrative involves mystery, terror,
                                        romance, comedy, or all of the above. These works of fiction may also contain
                                        memorable characters, vivid
                                        world-building, literary devices.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="privacy-headingFour">
                                    <button class="accordion-button fs-15 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#privacy-collapseFour"
                                        aria-expanded="false" aria-controls="privacy-collapseFour">
                                        Do stories need themes?
                                    </button>
                                </h2>
                                <div id="privacy-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="privacy-headingFour" data-bs-parent="#privacy-accordion">
                                    <div class="accordion-body ff-secondary">
                                        A story can have as many themes as the reader can identify based on recurring
                                        patterns and parallels within the story
                                        itself. In looking at ways to separate themes into a hierarchy, we might find it
                                        useful to follow the example of a
                                        single book.
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>
              
                </div>
              
            </div>
     
        </section> -->


        <!-- secção de testemunhos -->

        <!-- <section class="section bg-primary" id="reviews">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <div>
                                <i class="ri-double-quotes-l text-success display-3"></i>
                            </div>
                            <h4 class="text-white mb-5"><span class="text-white"></span>Alunos satisfeitos</h4>

                     
                            <div class="swiper client-review-swiper rounded" dir="ltr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 mb-4">" I am givng 5 stars. Theme is great and
                                                        everyone one stuff everything in theme. Future request should
                                                        not affect current state of theme. "</p>

                                                    <div>
                                                        <h5 class="text-white">gregoriusus</h5>
                                                        <p>- Skote User</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 mb-4">" Awesome support. Had few issues while
                                                        setting up because of my device, the support team helped me fix
                                                        them up in a day. Everything looks clean and good. Highly
                                                        recommended! "</p>

                                                    <div>
                                                        <h5 class="text-white">GeekyGreenOwl</h5>
                                                        <p>- Skote User</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 mb-4">" Amazing template, Redux store and components
                                                        is nicely designed. It's a great start point for an admin based
                                                        project. Clean Code and good documentation. Template is
                                                        completely in React and absolutely no usage of jQuery "</p>

                                                    <div>
                                                        <h5 class="text-white">sreeks456</h5>
                                                        <p>- Veltrix User</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                          
                                </div>
                                <div class="swiper-button-next bg-white rounded-circle"></div>
                                <div class="swiper-button-prev bg-white rounded-circle"></div>
                                <div class="swiper-pagination position-relative mt-2"></div>
                            </div>
                       
                        </div>
                    </div>
                 
                </div>
              
            </div>
         
        </section> -->


        <!-- start counter -->
        <!-- <section class="py-5 position-relative bg-light">
            <div class="container">
                <div class="row text-center gy-4">
                    <div class="col-lg-3 col-6">
                        <div>
                            <h2 class="mb-2"><span class="counter-value" data-target="100">0</span>+</h2>
                            <div class="text-muted">Formações ministradas</div>
                        </div>
                    </div>
        

                    <div class="col-lg-3 col-6">
                        <div>
                            <h2 class="mb-2"><span class="counter-value" data-target="24">0</span></h2>
                            <div class="text-muted">Professores</div>
                        </div>
                    </div>
             

                    <div class="col-lg-3 col-6">
                        <div>
                            <h2 class="mb-2"><span class="counter-value" data-target="20.3">0</span>k</h2>
                            <div class="text-muted">Estudantes satisfeitos</div>
                        </div>
                    </div>
              
                    <div class="col-lg-3 col-6">
                        <div>
                            <h2 class="mb-2"><span class="counter-value" data-target="50">0</span></h2>
                            <div class="text-muted">Colaboradores</div>
                        </div>
                    </div>
               
                </div>
             
            </div>
     
        </section> -->



        <!-- start team -->
        <section class="section bg-white" id="team">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-bold title-section">Conheça a nossa <span
                                    class="text-black">Equipa</span></h3>
                            <!-- <p class="text-muted mb-4 ff-secondary">To achieve this, it would be necessary to have
                                uniform grammar, pronunciation and more common  . If several languages coalesce the
                                grammar.</p> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <div class="avatar-xl mx-auto mb-4 position-relative">
                                    <img src="{{ asset('assets/template/images/users/carlota.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                    <!-- <a href="apps-mailbox.html"
                                        class="btn btn-success btn-sm position-absolute bottom-0 end-0 rounded-circle avatar-xs">
                                        <div class="avatar-title bg-transparent">
                                            <i class="ri-mail-fill align-bottom"></i>
                                        </div>
                                    </a> -->
                                </div>
                                <!-- end card body -->
                                <h5 class="mb-1 team-name">Carlota Cambenje
                                </h5>
                                <p class="text-black mb-0 ff-secondary">Directora</p>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <div class="avatar-xl mx-auto mb-4 position-relative">
                                    <img src="{{ asset('assets/template/images/users/eduardo_afonso.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                    <!-- <a href="apps-mailbox.html"
                                        class="btn btn-success btn-sm position-absolute bottom-0 end-0 rounded-circle avatar-xs">
                                        <div class="avatar-title bg-transparent">
                                            <i class="ri-mail-fill align-bottom"></i>
                                        </div>
                                    </a> -->
                                </div>
                                <!-- end card body -->
                                <h5 class="mb-1 team-name">Eduardo Afonso
                                </h5>
                                <p class="text-black mb-0 ff-secondary">Director-Adjunto</p>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <div class="avatar-xl mx-auto mb-4 position-relative">
                                    <img src="{{ asset('assets/template/images/users/avatar-3.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                    <!-- <a href="apps-mailbox.html"
                                        class="btn btn-success btn-sm position-absolute bottom-0 end-0 rounded-circle avatar-xs">
                                        <div class="avatar-title bg-transparent">
                                            <i class="ri-mail-fill align-bottom"></i>
                                        </div>
                                    </a> -->
                                </div>
                                <!-- end card body -->
                                <h5 class="mb-1 team-name">Francisco Nunes</h5>
                                <p class="text-black mb-0 ff-secondary">Função</p>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <div class="avatar-xl mx-auto mb-4 position-relative">
                                    <img src="{{ asset('assets/template/images/users/avatar-3.jpg') }}" alt=""
                                        class="img-fluid rounded-circle">
                                    <!-- <a href="apps-mailbox.html"
                                        class="btn btn-success btn-sm position-absolute bottom-0 end-0 rounded-circle avatar-xs">
                                        <div class="avatar-title bg-transparent">
                                            <i class="ri-mail-fill align-bottom"></i>
                                        </div>
                                    </a> -->
                                </div>
                                <!-- end card body -->
                                <h5 class="mb-1 team-name">Wagner Alexandre
                                </h5>
                                <p class="text-black mb-0 ff-secondary">Função</p>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <!-- end row -->
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-2">
                            <a href="pages-team.html" class="btn btn-primary">View All Members <i
                                    class="ri-arrow-right-line ms-1 align-bottom"></i></a>
                        </div>
                    </div>
                </div> --}}
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end team -->

        <!-- start contact -->
        {{-- <section class="section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-bold">Get In Touch</h3>
                            <p class="text-muted mb-4 ff-secondary">We thrive when coming up with innovative ideas but
                                also understand that a smart concept should be supported with faucibus sapien odio
                                measurable results.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row gy-4">
                    <div class="col-lg-4">
                        <div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">Office Address 1:</h5>
                                <div class="ff-secondary fw-semibold">4461 Cedar Street Moro, <br />AR 72368</div>
                            </div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">Office Address 2:</h5>
                                <div class="ff-secondary fw-semibold">2467 Swick Hill Street <br />New Orleans, LA</div>
                            </div>
                            <div class="mt-4">
                                <h5 class="fs-13 text-muted text-uppercase">Working Hours:</h5>
                                <div class="ff-secondary fw-semibold">9:00am to 6:00pm</div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-8">
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="form-label fs-13">Name</label>
                                            <input name="name" id="name" type="text"
                                                class="form-control bg-light border-light" placeholder="Your name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="form-label fs-13">Email</label>
                                            <input name="email" id="email" type="email"
                                                class="form-control bg-light border-light" placeholder="Your email*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="subject" class="form-label fs-13">Subject</label>
                                            <input type="text" class="form-control bg-light border-light" id="subject"
                                                name="subject" placeholder="Your Subject.." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="comments" class="form-label fs-13">Message</label>
                                            <textarea name="comments" id="comments" rows="3"
                                                class="form-control bg-light border-light"
                                                placeholder="Your message..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-end">
                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary"
                                            value="Send Message">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section> --}}
        <!-- end contact -->

        <!-- start cta -->
        {{-- <section class="py-5 bg-primary position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-sm">
                        <div>
                            <h4 class="text-white mb-0 fw-bold">Build your web App/SaaS with Velzon dashboard</h4>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-auto">
                        <div>
                            <a href="https://1.envato.market/velzon-admin" target="_blank"
                                class="btn bg-gradient btn-danger"><i
                                    class="ri-shopping-cart-2-line align-middle me-1"></i> Buy Now</a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section> --}}
        <!-- end cta -->

        <!-- Start footer -->
        <footer class="custom-footer bg-black py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="{{ asset('images/logo_oaa_cor.png') }}" alt="logo light" height="80">
                            </div>
                            {{-- <div class="mt-4 fs-13">
                                <p>Premium Multipurpose Admin & Dashboard Template</p>
                                <p class="ff-secondary">You can build any type of web application like eCommerce, CRM,
                                    CMS, Project management apps, Admin Panels, etc using Velzon.</p>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-warning mb-0">Secções</h5>
                                <div class="text-white mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a class="text-white" href="#hero">Início</a></li>
                                        <li><a class="text-white" href="#formacoes-especializadas">Formações
                                                Especializadas</a></li>
                                        <li><a class="text-white" href="#razoes">Porquê estudar no CEF?</a></li>
                                        <li><a class="text-white" href="#team">Equipa</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-warning mb-0">Outros links</h5>
                                <div class="text-white mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a class="text-white" href="https://cef-oaa.org">CEF Website</a></li>
                                        {{-- <li><a href="apps-mailbox.html">Mailbox</a></li>
                                        <li><a href="apps-chat.html">Chat</a></li>
                                        <li><a href="apps-crm-deals.html">Deals</a></li>
                                        <li><a href="apps-tasks-kanban.html">Kanban Board</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-warning mb-0">Suporte</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a class="text-white" href="#">geral@cef-oaa.org</a></li>
                                        <li><a class="text-white" href="#">(+244) 924 956 037</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="text-white copy-rights mb-0">
                                <script> document.write(new Date().getFullYear()) </script> Centro de Estudos e Formação
                                da Ordem dos Advogados de Angola
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-facebook-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                {{-- <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-github-fill"></i>
                                        </div>
                                    </a>
                                </li> --}}
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-linkedin-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                {{-- <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-google-fill"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="avatar-xs d-block">
                                        <div class="avatar-title rounded-circle">
                                            <i class="ri-dribbble-line"></i>
                                        </div>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-warning btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/template/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/template/js/plugins.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/template/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- landing init -->
    <script src="{{ asset('assets/template/js/pages/landing.init.js') }}"></script>
</body>

</html>