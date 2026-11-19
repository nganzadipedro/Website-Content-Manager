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
                        <!-- <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold active" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-15 fw-semibold" href="#services">Valores</a>
                        </li> -->
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
                            class="btn btn-link fw-medium text-decoration-none text-dark">Acessar</a>
                        <a href="{{ route('register') }}" class="btn btn-warning">Inscrever-se</a>
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
                        <div class="text-center mt-lg-5 pt-5">
                            <h1 class="display-6 fw-bold mb-3 lh-base">Estude no CEF e garanta <span
                                    class="text-warning">uma boa formação </span></h1>
                            <p class="lead text-muted lh-base">O CEF é o Centro de Estudos e Formação da Ordem dos
                                Advogados de Angola.</p>

                            <div class="d-flex gap-2 justify-content-center mt-4">
                                <a href="{{ route('login') }}" class="btn btn-primary">Acessar <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                                <a href="{{ route('register') }}" class="btn btn-warning">Inscrever-se <i
                                        class="ri-eye-line align-middle ms-1"></i></a>
                            </div>
                        </div>

                        <div class="mt-4 mt-sm-5 pt-sm-5 mb-sm-n5 demo-carousel">
                            <div class="demo-img-patten-top d-none d-sm-block">
                                <img src="{{ asset('assets/template/images/landing/img-pattern.png') }}"
                                    class="d-block img-fluid" alt="...">
                            </div>
                            <div class="demo-img-patten-bottom d-none d-sm-block">
                                <img src="{{ asset('assets/template/images/landing/img-pattern.png') }}"
                                    class="d-block img-fluid" alt="...">
                            </div>
                            <div class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner shadow-lg p-2 bg-white rounded">
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item active" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
            <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none">
                        <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z">
                        </path>
                    </g>
                </svg>
            </div>
            <!-- end shape -->
        </section>
        <!-- end hero section -->


        <!-- Start footer -->
        <div class="mt-5"></div>
        <footer class="custom-footer py-5 position-relative mt-5">
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
                                <h5 class="text-white mb-0">Contactos</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="#">(+244) 924 956 037</a></li>
                                        <li><a href="#">(+244) 935 542 465</a></li>
                                        <!-- <li><a href="#">Testemunhos</a></li>
                                        <li><a href="#">Equipa</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Outros links</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="www.cef-oaa.org">Website - CEF</a></li>
                                        {{-- <li><a href="apps-mailbox.html">Mailbox</a></li>
                                        <li><a href="apps-chat.html">Chat</a></li>
                                        <li><a href="apps-crm-deals.html">Deals</a></li>
                                        <li><a href="apps-tasks-kanban.html">Kanban Board</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Suporte</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list fs-14">
                                        <li><a href="#">geral@cef-oaa.org</a></li>
                                        <!-- <li><a href="pages-faqs.html">Contact</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script> document.write(new Date().getFullYear()) </script> © CEF - OAA
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-social-link">
                                <li class="list-inline-item">
                                    <a href="#" class="avatar-xs d-block">
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
                                    <a href="#" class="avatar-xs d-block">
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
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
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