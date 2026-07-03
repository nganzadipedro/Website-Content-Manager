<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CPL - OAA || Sistema de Gestão de Informações</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/new-template/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('assets/new-template/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('assets/new-template/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('assets/new-template/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('assets/new-template/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('assets/new-template/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg"
                                    height="36" alt=""></a>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Bem-Vindo | Acesse a sua conta</h2>
                                <form action="{{ route('login') }}" method="POST">

                                @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Digite aqui o seu email"
                                            autocomplete="off">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">
                                            Senha

                                        </label>
                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Digite aqui a sua senha" autocomplete="off">
                                        </div>
                                    </div>

                                     @if ($errors->has('error'))
                                        <div class="text-danger text-center mb-3 mt-3" role="alert">
                                            <strong>Email ou Senha incorrectos!</strong>
                                        </div>
                                    @endif

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">Acessar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-secondary mt-3">
                            Ainda não tem uma conta? <a href="./sign-up.html" tabindex="-1">Informe-se no CPL</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('images/logo_oaa_cor.png') }}" height="300" class="d-block mx-auto" alt="">
                    <h3 class="mt-3 text-center">Conselho Provincial de Luanda da Ordem
                        dos Advogados de Angola
                    </h3>
                    <h4 class="text-center"> = Sistema de Gestão de Informações = </h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets/new-template/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('assets/new-template/dist/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>