<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>CEF | Perfil do Formador</title>
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
    <link href="{{ asset('assets/system/css/formacao-especializada.css') }}" rel="stylesheet" type="text/css" />


</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing pg-formacao-especializada">
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
                            <a class="page-link" href="{{ url('/formacoes') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="page-link" href="{{ url('/formacoes') }}">Formações Especializadas</a>
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
        <section class="section hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container mt-5">
                <div class="row mt-5 justify-content-center">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="avatar-xl mx-auto mb-4 position-relative">
                            <img width="100%" src="{{ asset('assets/template/images/users/avatar-3.jpg') }}" alt=""
                                class="img-fluid rounded-circle">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                        <div class="mt-3">
                            <h1 class="title-formation fw-bold">Dr. Miguel de Carvalho</h1>
                            <p class="formation-date">ANPG e Professor de Dto. Bancário</p>
                            <p class="lead description-formation lh-base">
                                Email: emailformador@gmail.com <br>
                                LinkedIn: perfil-linkedin
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- end hero section -->

        <section class="main-section mt-5" id="formacoes-especializadas">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <section id="apresentacao" class="presentation-section mb-5">
                            <h3 class="title-section fw-bold mb-3">
                                Nota Biográfica
                            </h3>

                            <p class="full-description">
                                A formação terá como meta aprofundar os temas actuais inerentes ao mercado Bancário,
                                quer na sua dimensão pública (relação entre os Bancos e os órgãos reguladores), quer na
                                sua dimensão privada (relação entre o Banco e os clientes) no sentido de explorar a
                                situação regulatória e de supervisão actual, em função das últimas da reformas
                                legislativa e operacional que tem vindo a ser feita nos últimos anos em Angola.
                            </p>

                            <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box mb-5"
                                id="genques-accordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="genques-headingOne">
                                        <button class="accordion-button fs-15 fw-semibold text-black" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#genques-collapseOne"
                                            aria-expanded="true" aria-controls="genques-collapseOne">
                                            Experiência Pedagógica
                                        </button>
                                    </h2>
                                    <div id="genques-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
                                        <div class="accordion-body ff-secondary">

                                            <p class="description">A presente pós-graduação visa identificar os desafios
                                                colocados pelo Direito das Crianças, promover abordagens
                                                interdisciplinares no exercício do Direito das Crianças, esclarecer os
                                                problemas jurídicos suscitados pelo Direito das Crianças, na teoria e na
                                                prática e dotar os participantes de novas ferramentas que permitam
                                                melhorar a sua atuação. </p>



                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="genques-headingTwo">
                                        <button class="accordion-button fs-15 fw-semibold text-black collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#genques-collapseTwo" aria-expanded="false"
                                            aria-controls="genques-collapseTwo">
                                            Publicações
                                        </button>
                                    </h2>
                                    <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                        <div class="accordion-body ff-secondary">
                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>

                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>

                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="genques-heading3">
                                        <button class="accordion-button fs-15 fw-semibold text-black collapsed"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapse3"
                                            aria-expanded="false" aria-controls="genques-collapse3">
                                            Áreas de Investigação
                                        </button>
                                    </h2>
                                    <div id="genques-collapse3" class="accordion-collapse collapse"
                                        aria-labelledby="genques-heading3" data-bs-parent="#genques-accordion">
                                        <div class="accordion-body ff-secondary">

                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>

                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>

                                            <p class="description">Contrary to popular belief, Lorem Ipsum is not simply
                                                random text. It has roots in a piece of classical Latin literature from
                                                45 BC, making it over 2000 years old. Richard McClintock, a Latin
                                                professor at Hampden-Sydney College in Virginia, looked up one of the
                                                more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                                                going through the cites of the word in classical literature, discovered
                                                the undoubtable source.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>

                    </div>
                </div>
            </div>
        </section>

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
                                        <!-- <li><a class="text-white" href="#razoes">Porquê estudar no CEF?</a></li>
                                        <li><a class="text-white" href="#team">Equipa</a></li> -->
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