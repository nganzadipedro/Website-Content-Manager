<!doctype html>
<html lang="pt-br" data-layout="horizontal" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Formulário de Inscrição</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- link do favicon -->

    <link rel="apple-touch-icon" sizes="57x57"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ URL::asset('assets/template/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ URL::asset('assets/template/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ URL::asset('assets/template/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ URL::asset('assets/template/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ URL::asset('assets/template/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('assets/template/img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('assets/template/img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- fim do favicon -->

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

    <link rel="stylesheet" href="{{ asset('assets/system/css/libs/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/system/css/libs/datatables/datatables.min.css') }}">

    <style>
        .obrigatorio {
            color: red;
            font-family: 8px !important;
        }
    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row" style="margin-top: -80px">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">
                            <img src="{{ asset('assets/system/logos/logo_enoaa_cor.png') }}" alt=""
                                width="240px" height="100px">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align: right">
                            <img src="{{ asset('assets/system/logos/logo_oaa_cor.png') }}" alt=""
                                width="100px" height="100px">
                        </div>
                    </div>

                    <!-- start page title -->
                    <div class="row mt-4">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">FORMULÁRIO DE INSCRIÇÃO</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">ENOAA - 2024</a>
                                        </li>
                                        <li class="breadcrumb-item active">Inscrição</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="div_form">
                        <form action="">

                            @csrf

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                                    <div class="page-title-box align-items-center text-center">
                                        <h4 class="mb-sm-0 alert alert-primary text-center">Preencha devidamente os
                                            campos a
                                            seguir com as suas informações</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Dados Iniciais</h4>
                                            <br>
                                            <span class="obrigatorio">** Todos os campos são obrigatórios **</span>

                                            <div class="flex-shrink-0">

                                            </div>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="nome_completo" class="form-label">Nome
                                                                completo</label>
                                                            <input type="text" class="form-control"
                                                                name="nome_completo" id="nome_completo">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-3">
                                                        <div>
                                                            <label for="documento" class="form-label">Documento de
                                                                Identificação</label>
                                                            <select class="form-select" id="documento"
                                                                name="documento">
                                                                <option selected>Nenhum...</option>
                                                                <option value="Bilhete de Identidade">Bilhete de
                                                                    Identidade</option>
                                                                <option value="Passaporte">Passaporte</option>
                                                                <option value="Carta de Condução">Carta de Condução
                                                                </option>
                                                                <option value="Outro">Outro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-3">
                                                        <div id="dv-documento">
                                                            <label for="documento2" class="form-label">Outro
                                                                Documento</label>
                                                            <input type="text" class="form-control"
                                                                id="documento2" name="documento2"
                                                                placeholder="Informe o documento">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row gy-4 mt-2">
                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="num_documento" class="form-label">Nº do
                                                                Documento
                                                                de
                                                                Identificação </label>
                                                            <input type="text" class="form-control"
                                                                id="num_documento" name="num_documento">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="basiInput" class="form-label">Género </label>
                                                            <br>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="genero" id="genero_m" value="Masculino">
                                                                <label class="form-check-label"
                                                                    for="genero_m">Masculino</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="genero" id="genero_f" value="Feminino">
                                                                <label class="form-check-label"
                                                                    for="genero_f">Feminino</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-xxl-3 col-md-3">
                                                        <div>
                                                            <label for="nacionalidade"
                                                                class="form-label">Nacionalidade</label>
                                                            <select class="form-select" id="nacionalidade"
                                                                name="nacionalidade">
                                                                <option value="0" selected>Nenhuma...</option>
                                                                <option value="Angola">Angola</option>
                                                                <option value="Outra">Outra</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-3">
                                                        <div id="dv-nacionalidade">
                                                            <label for="nacionalidade2" class="form-label">Outra
                                                                nacionalidade</label>
                                                            <input type="text" class="form-control"
                                                                id="nacionalidade2" name="nacionalidade2"
                                                                placeholder="Informe a nacionalidade">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row gy-4 mt-2">
                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="naturalidade" class="form-label">Naturalidade
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                id="naturalidade" name="naturalidade">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-3">
                                                        <div>
                                                            <label for="provincia_id"
                                                                class="form-label">Província</label>
                                                            <select class="form-select" id="provincia_id"
                                                                name="provincia_id">
                                                                <option value="0" selected>Nenhuma...</option>
                                                                @foreach ($provincias as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->descricao }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="municipio" class="form-label">Município
                                                            </label>
                                                            <input type="text" class="form-control" id="municipio"
                                                                name="municipio">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-3">
                                                        <div>
                                                            <label for="necessidade_especial" class="form-label">É
                                                                portador de
                                                                alguma
                                                                deficiência?</label>
                                                            <select class="form-select" id="necessidade_especial"
                                                                name="necessidade_especial">
                                                                <option value="0" selected>Nenhuma...</option>
                                                                <option value="Não">Não</option>
                                                                <option value="Deficiente">Deficiente</option>
                                                                <option value="Cadeirante">Cadeirante</option>
                                                                <option value="Outra deficiência">Outra deficiência
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row gy-4 mt-2">
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="instituicao_estudo"
                                                                class="form-label">Instituição do
                                                                ensino
                                                                superior em que frequentou o curso de direito</label>
                                                            <input type="text" class="form-control"
                                                                id="instituicao_estudo" name="instituicao_estudo">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-6 col-md-6">
                                                        <div>
                                                            <label for="provincia_exame" class="form-label">Onde
                                                                pretende fazer
                                                                o
                                                                exame?</label>
                                                            <select class="form-select" id="provincia_exame"
                                                                name="provincia_exame">
                                                                <option value="0" selected>Nenhuma...</option>
                                                                @foreach ($provincias as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->descricao }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Informações de Contacto</h4>
                                            <span class="obrigatorio">** Todos os campos são obrigatórios **</span>
                                            <div class="flex-shrink-0">

                                            </div>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="endereco" class="form-label">Endereço</label>
                                                            <input type="text" class="form-control" id="endereco"
                                                                name="endereco">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row gy-4 mt-2">
                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="tel1" class="form-label">Nº de telefone
                                                                principal</label>
                                                            <input type="text" maxlength="9" minlength="9"
                                                                class="form-control" id="tel1" name="tel1">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="tel2" class="form-label">Nº de telefone
                                                                alternativo</label>
                                                            <input type="email" maxlength="9" minlength="9"
                                                                class="form-control" id="tel2" name="tel2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Documentos</h4>
                                            <span class="obrigatorio">** Todos os campos são obrigatórios **</span>
                                            <div class="flex-shrink-0">

                                            </div>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="doc_bi" class="form-label">Documento de
                                                                Identificação</label>
                                                            <input type="file" class="form-control" id="doc_bi"
                                                                name="doc_bi">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                        <div>
                                                            <label for="doc_diploma" class="form-label">Documento que
                                                                atesta o grau de licenciatura</label>
                                                            <input type="file" class="form-control"
                                                                id="doc_diploma" name="doc_diploma">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gy-4 mt-3">
                                                    <div class="col-lg-12">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="autorizacao" id="autorizacao"
                                                                value="Autorizado">
                                                            <label style="font-weight: bold" class="form-check-label"
                                                                for="autorizacao">Concordo
                                                                com a política de protecção de dados</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a id="btn-submeter" class="btn btn-success">Submeter Candidatura</a>

                        </form>
                    </div>


                    <div class="" id="div_msg">
                        <div class="row mt-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <h5 class="alert alert-success text-center">

                                    O seu processo de inscrição para o EN-OAA foi submetido com sucesso e encontra-se
                                    pendente para validação.<br>
                                    As suas credenciais de acesso à plataforma de inscrição foram enviadas para o seu
                                    e-mail. Se não receber o email com as referidas
                                    credencias no prazo de 72 horas, por favor, contacte o CEF-OAA pelos seguintes
                                    contactos:
                                    924 956 037 ou 935 542 465 | email: enoaa@cef-oaa.org <br><br>

                                    Para aceder a sua conta <a href="https://enoaa.cef-oaa.org/login">clique aqui</a>.
                                    <br>
                                    Para voltar ao formulário de inscrição <a
                                        href="{{ route('register') }}">clique aqui</a> ou recarregue
                                    a
                                    página. <br><br>
                                    Obrigado.

                                </h5>
                            </div>
                        </div>
                    </div>

                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/template/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/template/js/plugins.js') }}"></script>

    <!-- prismjs plugin -->
    <script src="{{ asset('assets/template/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/template/js/app.js') }}"></script>

    <script src="{{ asset('assets/system/js/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/system/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/system/js/shared/functions.js') }}"></script>
    <script src="{{ asset('assets/system/js/inscricao.js') }}"></script>

</body>

</html>
