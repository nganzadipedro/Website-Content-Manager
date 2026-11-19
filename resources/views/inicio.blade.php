<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>CEF | Formações</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CEF | Formações" name="description" />
    <meta content="CEF | Formações" name="author" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/system/favicon.ico') }}">

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
    <link href="{{ asset('assets/template/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/system/css/home.css') }}" rel="stylesheet" type="text/css" />
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('inicio') }}">
                    <img src="{{ asset('images/logo_oaa_cor.png') }}" class="card-logo card-logo-dark" alt="logo dark"
                        height="60">
                    <img src="{{ asset('images/logo_oaa_cor.png') }}" class="card-logo card-logo-light" alt="logo light"
                        height="60">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-lg-0" id="navbar-example">

                    </ul>

                    <div class="">
                        <a href="{{ route('login') }}" class="btn btn-acessar">Acessar Conta</a>
                        <a href="{{ route('register') }}" class="btn btn-inscricao">Inscrever-se</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->
        <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>

        <section class="carrossel">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/system/images/banner-website3.jpg') }}" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/system/images/banner-website2.jpg') }}" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/system/images/banner-website.jpg') }}" class="d-block w-100"
                            alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- start hero section -->
        <section class="section hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-10">
                        <div class="text-center dv-textos">
                            <h5>Centro de Estudos e Formação da Ordem dos Advogados de Angola (CEF-OAA)
                            </h5>
                            <h4>É advogado estagiário e ainda não fez a Formação Inicial Obrigatória?
                                <span>Está no lugar certo, inscreva-se já.</span>
                            </h4>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="btn btn-acessar">Acessar Conta</a>
                            <a href="{{ route('register') }}" class="btn btn-inscricao">Inscrever-se</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="custom-footer py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="{{ asset('images/logo_oaa_cor.png') }}" alt="logo light" height="80">
                            </div>
                            {{-- <div class="mt-4 fs-13">
                                <p>Premium Multipurpose Admin & Dashboard Template</p>
                                <p class="ff-secondary">You can build any type of web application like
                                    eCommerce, CRM,
                                    CMS, Project management apps, Admin Panels, etc using Velzon.</p>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Contactos</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="#">(+244) 924 956 037</a></li>
                                        <li><a href="#">(+244) 935 542 465</a></li>
                                        <li><a href="#">geral@cef-oaa.org</a></li>
                                        <!-- <li><a href="#">Testemunhos</a></li>
                                        <li><a href="#">Equipa</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Outros links</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="www.cef-oaa.org">Website - CEF OAA</a></li>
                                        <li><a href="https://virtualcenter.cef-oaa.org">Centro de Estudos Virtual - CEF
                                                OAA</a></li>
                                        {{-- <li><a href="apps-mailbox.html">Mailbox</a></li>
                                        <li><a href="apps-chat.html">Chat</a></li>
                                        <li><a href="apps-crm-deals.html">Deals</a></li>
                                        <li><a href="apps-tasks-kanban.html">Kanban Board</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Redes Sociais</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="https://www.facebook.com/OAACEF">Facebook</a></li>
                                        <li><a href="https://www.instagram.com/cef_oaa/">Instagram</a></li>
                                        <li><a href="https://www.linkedin.com/company/centro-de-estudos-e-forma%C3%A7%C3%A3o-da-ordem-dos-advogados-de-angola-cef-oaa/?viewAsMember=true">LinkedIn</a></li>
                                    </ul>
                                </div>
                            </div>
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