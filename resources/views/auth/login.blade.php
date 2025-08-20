<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/html/horizontal-dark-menu/auth-cover-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 03:58:28 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CPL | Acesso </title>
    <link rel="icon" type="image/x-icon" href="https://designreset.com/cork/html/src/assets/img/favicon.ico" />
    <link href="{{ asset('assets/template/layouts/horizontal-dark-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/template/layouts/horizontal-dark-menu/css/dark/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('assets/template/layouts/horizontal-dark-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/template/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/template/layouts/horizontal-dark-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/light/authentication/auth-cover.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- <link href="{{ asset('assets/template/layouts/horizontal-dark-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{ asset('assets/template/src/assets/css/dark/authentication/auth-cover.css') }}" rel="stylesheet" type="text/css" /> -->
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div
                    class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>

                    <div class="auth-cover">

                        <div class="position-relative">

                            <img src="https://designreset.com/cork/html/src/assets/img/auth-cover.svg" alt="auth-img">

                            <h2 class="mt-5 text-white font-weight-bolder px-2">Gestor de Conteúdos do Website
                            </h2>
                            <p class="text-white px-2">Conselho Provincial de Luanda da Ordem dos Advogados de Angola</p>
                        </div>

                    </div>

                </div>

                <div
                    class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('login') }}" method="POST">

                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Acessar</h2>
                                        <p>Digite as suas credenciais</p>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Senha</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <!-- <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                Remember me
                                            </label>
                                        </div> -->
                                        </div>
                                    </div>

                                    @if ($errors->has('error'))
                                        <div class="text-danger text-center mb-3" role="alert">
                                            <strong>Email ou Senha incorrectos!</strong>
                                        </div>
                                    @endif  

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary w-100">Acessar</button>
                                        </div>
                                    </div>

                                    <!-- <div class="col-12 mb-4">
                                    <div class="">
                                        <div class="seperator">
                                            <hr>
                                            <div class="seperator-text"> <span>Or continue with</span></div>
                                        </div>
                                    </div>
                                </div> -->

                                    <!-- <div class="col-sm-4 col-12">
                                    <div class="mb-4">
                                        <button class="btn  btn-social-login w-100 ">
                                            <img src="https://designreset.com/cork/html/src/assets/img/google-gmail.svg" alt="" class="img-fluid">
                                            <span class="btn-text-inner">Google</span>
                                        </button>
                                    </div>
                                </div>
    
                                <div class="col-sm-4 col-12">
                                    <div class="mb-4">
                                        <button class="btn  btn-social-login w-100">
                                            <img src="https://designreset.com/cork/html/src/assets/img/github-icon.svg" alt="" class="img-fluid">
                                            <span class="btn-text-inner">Github</span>
                                        </button>
                                    </div>
                                </div>
    
                                <div class="col-sm-4 col-12">
                                    <div class="mb-4">
                                        <button class="btn  btn-social-login w-100">
                                            <img src="https://designreset.com/cork/html/src/assets/img/twitter.svg" alt="" class="img-fluid">
                                            <span class="btn-text-inner">Twitter</span>
                                        </button>
                                    </div>
                                </div> -->

                                    <!-- <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Dont't have an account ? <a href="javascript:void(0);" class="text-warning">Sign Up</a></p>
                                    </div>
                                </div> -->

                                </div>

                            </form>


                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/template/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>

<!-- Mirrored from designreset.com/cork/html/horizontal-dark-menu/auth-cover-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 03:58:28 GMT -->

</html>