<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Plataforma de Inscrição - CEF | Acesso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CEFONLINE" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- link do favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/system/favicon.ico') }}">

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
    <link href="{{ asset('assets/system/css/login.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>


    <div class="auth-page-wrapper pt-5">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <img src="{{ asset('assets/system/logos/logo_oaa_cor.png') }}" alt="" width="100px" height="100px">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h2 class="title-page">CEFOnline</h2> <br>

                    <h2 class="subtitle">Bem-Vindo à Plataforma de Gestão de Formações do CEF</h2>
                </div>
            </div>


        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">

                <div class="row justify-content-center ">
                    <div class="col-md-8 col-lg-6 col-xl-5 caixa ">
                        <div class="card mt-4 ">

                            <div class="card-body p-4 ">
                                <div class="text-center mt-2">

                                    <p class="">Digite as suas credenciais de acesso</p>
                                </div>
                                <div class="">
                                    <form action="{{ route('login') }}" method="POST">

                                        @csrf

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="username"
                                                placeholder="Digite o seu email">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">

                                            </div>
                                            <label class="form-label" for="password-input">Senha</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="Digite a senha" name="password" id="password-input">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <!-- <div class="mb-3 text-center">
                                            <a href="#"
                                                class="text-muted text-decoration-underline">Esqueci a minha
                                                senha</a>
                                        </div> -->

                                        @if ($errors->has('error'))
                                            <br>
                                            <div class="text-danger text-center" role="alert">
                                                <strong>Email ou Senha incorrectos!</strong>
                                            </div>
                                        @endif


                                        <div class="mt-4 text-center">
                                            <button class="btn-access" type="submit">Acessar</button>
                                        </div>
                                    </form>
                                </div>


                                @if (session()->has('message'))
                                    <br>
                                    <br>
                                    <h5 class="text-success text-center">
                                        <strong>{{ session('message') }}</strong>
                                    </h5>
                                    <br>
                                @endif
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Ainda não inscreveu-se? <br> <a href="{{ route('register') }}"
                                    class="fw-bold text-warning text-decoration-underline">Clique aqui para inscrever-se
                                    nas nossas formações</a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/template/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/template/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('assets/template/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets/template/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('assets/template/js/pages/password-addon.init.js') }}"></script>
</body>

</html>