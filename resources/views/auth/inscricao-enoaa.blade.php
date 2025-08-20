<!doctype html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>CEF - Formações | Criar Conta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="CEF - Formações | Criar Conta" name="description" />
    <meta content="CEF - OAA" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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


</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper  py-5 d-flex justify-content-center align-items-center min-vh-100">
        {{-- <div class="bg-overlay"></div> --}}
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0 p-5">
                                {{-- <div class="col-lg-4">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->

                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12">
                                    <div class="row p-5">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <img src="{{ asset('assets/system/logos/logo_oaa_cor.png') }}"
                                                alt="" width="100px" height="100px">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">

                                    <div class="row">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div
                                                class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                <h4 class="mb-sm-0 text-primary">CEFOnline | CRIE A SUA CONTA a partir do código ENOAA</h4>

                                                <div class="page-title-right">
                                                    <ol class="breadcrumb m-0">
                                                        <li class="breadcrumb-item"><a href="javascript: void(0);">CEF |
                                                                Formações </a>
                                                        </li>
                                                        <li class="breadcrumb-item active">2024</li>
                                                    </ol>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div id="div_form" class="">
                                        <div>
                                            
                                            {{-- <p class="text-muted">Crie agora a sua conta gratuitamente na nossa
                                                plataforma.</p> --}}
                                        </div>

                                        <div class="mt-4">

                                            <form>
                                                @csrf

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header align-items-center d-flex">
                                                                <h4 class="card-title mb-0 flex-grow-1 text-primary">Dados de confirmação
                                                                </h4>
                                                                <br>
                                                                <span class="obrigatorio">** Todos os campos são
                                                                    obrigatórios **</span>

                                                                <div class="flex-shrink-0">

                                                                </div>
                                                            </div><!-- end card header -->
                                                            <div class="card-body">
                                                                <div class="live-preview">
                                                                    <div class="row gy-4">
                                                                        <div
                                                                            class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="nome_completo"
                                                                                    class="form-label">Email que usou na sua conta do ENOAA</label>
                                                                                <input type="email"
                                                                                    class="form-control" placeholder="digite o email"
                                                                                    name="email"
                                                                                    id="email">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="row mt-3">
                                                                        <div class="col-xxl-6 col-md-6">
                                                                       
                                                                                <label for="codigo-enoaa"
                                                                                    class="form-label">Código ENOAA</label>
                                                                                <input type="text"
                                                                                    class="form-control" id="codigo-enoaa"
                                                                                    name="codigo-enoaa"
                                                                                    placeholder="Informe o código">
                                                                           
                                                                        </div>
                                                                        <div class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="num_documento"
                                                                                    class="form-label">Nº do
                                                                                    Documento
                                                                                    de
                                                                                    Identificação  que usou na sua conta do ENOAA</label>
                                                                                <input type="text"
                                                                                    class="form-control" placeholder="digite o nº de documento de identificação"
                                                                                    id="num_documento"
                                                                                    name="num_documento">
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
                                                                <h4 class="card-title mb-0 flex-grow-1 text-primary">Formação</h4>
                                                                <span class="obrigatorio">** Todos os campos são obrigatórios **</span>
                                                                <div class="flex-shrink-0">
                    
                                                                </div>
                                                            </div><!-- end card header -->
                                                            <div class="card-body">
                                                                <div class="live-preview">
                                                                    <div class="row gy-4">
                                                                        <div class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="doc_bi" class="form-label">Em qual formação vai inscrever-se?</label>
                                                                                <select name="formacao_id" id="formacao_id" class="form-control">
                                                                                    <option value="">Selecione...</option>
                                                                                    @foreach ($formacoes as $item)
                                                                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
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
                                                                <h4 class="card-title mb-0 flex-grow-1 text-primary">Documentos</h4>
                                                                <span class="obrigatorio">** Todos os campos são obrigatórios **</span>
                                                                <div class="flex-shrink-0">
                    
                                                                </div>
                                                            </div><!-- end card header -->
                                                            <div class="card-body">
                                                                <div class="live-preview">
                                                                    <div class="row gy-4">
                                                                        <div class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="doc_bi" class="form-label">Cédula de Advogado Estagiário</label>
                                                                                <input type="file" class="form-control" id="cedula_advogado"
                                                                                    name="cedula_advogado">
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


                                              

                                                <div class="mt-4">
                                                    <a id="btn-submeter" class="btn btn-success w-100" type="submit">SUBMETER INSCRIÇÃO</a>
                                                </div>

                                                <div class="row">
                                                    <div class="mt-4 text-center">
                                                        <div>
                                                            <a type="button" href="{{ route('register') }}"
                                                                class="btn btn-primary waves-effect waves-light">Criar conta de forma normal</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>

                                        {{-- <div class="mt-5 text-center">
                                            <p class="mb-0">Already have an account ? <a
                                                    href="auth-signin-cover.html"
                                                    class="fw-bold text-primary text-decoration-underline"> Signin</a>
                                            </p>
                                        </div> --}}
                                    </div>

                                    <div id="div_validacao" class="">
                                      
                                        <div class="mt-4">

                                            <form>
                                                @csrf

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header align-items-center d-flex">
                                                                <h4 class="card-title mb-0 flex-grow-1 text-primary">Validação da inscrição
                                                                </h4>
                                                                <br>
                                                                <span class="obrigatorio">** Todos os campos são
                                                                    obrigatórios **</span>

                                                                <div class="flex-shrink-0">

                                                                </div>
                                                            </div><!-- end card header -->
                                                            <div class="card-body">
                                                                <div class="live-preview">
                                                                    <div class="row gy-4">
                                                                        <div
                                                                            class="col-xxl-12 col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="codigo_validacao"
                                                                                    class="form-label">Código de validação</label>
                                                                                <input type="email"
                                                                                    class="form-control" placeholder="digite o código"
                                                                                    name="codigo_validacao"
                                                                                    id="codigo_validacao">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="mt-4">
                                                    <a id="btn-conf-codigo" class="btn btn-success w-100" type="submit">CONFIRMAR CÓDIGO</a>
                                                </div>
                                                
                                            </form>
                                        </div>

                                        {{-- <div class="mt-5 text-center">
                                            <p class="mb-0">Already have an account ? <a
                                                    href="auth-signin-cover.html"
                                                    class="fw-bold text-primary text-decoration-underline"> Signin</a>
                                            </p>
                                        </div> --}}
                                    </div>

                                    <div class="" id="div_msg">
                                        <div class="row mt-4">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                <h5 class="alert alert-success text-center">
                
                                                    O seu processo de inscrição para foi submetido e verificado com sucesso e encontra-se
                                                    pendente para validação.<br>
                                                    As suas credenciais de acesso à plataforma de formação, são as mesmas que usou na plataforma de inscrição para o ENOAA. <br>
                                                    Contactos:
                                                    924 956 037 ou 935 542 465 | email: enoaa@cef-oaa.org <br><br>
                
                                                    Para aceder a sua conta <a href="https://formacoes.cef-oaa.org/login">clique aqui</a>.
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
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        {{-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/template/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/template/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/template/js/plugins.js') }}"></script>

    <!-- validation init -->
    <script src="{{ asset('assets/template/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ asset('assets/template/js/pages/passowrd-create.init.js') }}"></script>
    <script src="{{ asset('assets/system/js/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/system/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/system/js/shared/functions.js') }}"></script>
    <script src="{{ asset('assets/system/js/inscricao-enoaa.js') }}"></script>
</body>

</html>
