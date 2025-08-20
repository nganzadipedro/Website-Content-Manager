@extends('layouts.app')
@section('conteudo')
    <div>
        <div class="row  mt-2 mb-4">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Plataforma de gestão da Formação Inicial Obrigatória </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Perfil do Usuário</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-foreground position-relative mx-n4 mt-n4 mt-5">
            <div class="profile-wid-bg">
                <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">
                        @if ($usuario->getPessoa->avatar == null)
                            <img src="{{ asset('assets/template/images/users/user_default.jpg') }}" alt="user-img"
                                class="img-thumbnail rounded-circle" />
                        @else
                            <img src="{{ asset('storage/' . $usuario->getPessoa->avatar) }}" alt="user-img"
                                class="img-thumbnail rounded-circle" />
                        @endif

                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ $usuario->getPessoa->nome }}</h3>
                        <p class="text-white-75">Nível de acesso: {{ $usuario->getPermissao->descricao }}</p>
                        <div class="hstack text-white-50 gap-1">

                        </div>
                    </div>
                </div>
                <!--end col-->
                {{-- <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">24.3K</h4>
                            <p class="fs-15 mb-0">Followers</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">1.3K</h4>
                            <p class="fs-15 mb-0">Following</p>
                        </div>
                    </div>
                </div>
            </div> --}}
                <!--end col-->

            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a wire:ignore class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab"
                                    role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Geral</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:ignore class="nav-link fs-14" data-bs-toggle="tab" href="#detalhes" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Detalhes Pessoais</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a wire:ignore class="nav-link fs-14" data-bs-toggle="tab" href="#password" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Alterar Senha</span>
                                </a>
                            </li>
                            @if (Auth::user()->permission_id == 5)
                                <li class="nav-item">
                                    <a wire:ignore class="nav-link fs-14" data-bs-toggle="tab" href="#actualizar"
                                        role="tab">
                                        <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                            class="d-none d-md-inline-block">Actualização de dados</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                        {{-- <div class="flex-shrink-0">
                        <a href="pages-profile-settings.html" class="btn btn-success"><i
                                class="ri-edit-box-line align-bottom"></i> Editar Profile</a>
                    </div> --}}
                    </div>
                    <!-- Tab panes -->
                    <div wire:ignore class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    {{-- <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">30%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Informações</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Nome Completo :</th>
                                                            <td class="text-muted">{{ $usuario->getPessoa->nome }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Telefone :</th>
                                                            <td class="text-muted">{{ $usuario->getPessoa->telefone1 }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">E-mail :</th>
                                                            <td class="text-muted">{{ $usuario->getPessoa->email }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <th class="ps-0" scope="row">Location :</th>
                                                        <td class="text-muted">California, United States
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Joining Date</th>
                                                        <td class="text-muted">24 Nov 2021</td>
                                                    </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                            </div>
                            <!--end row-->
                        </div>
                        <div wire:ignore class="tab-pane fade" id="detalhes" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Detalhes Pessoais</h5>
                                    <form>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Nome</label>
                                                    <input disabled type="text" class="form-control" id="firstnameInput"
                                                        placeholder="Enter your firstname"
                                                        value="{{ $usuario->getPessoa->nome }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="lastnameInput" class="form-label">Telefone 1</label>
                                                    <input disabled type="text" class="form-control"
                                                        id="lastnameInput" placeholder="Enter your lastname"
                                                        value="{{ $usuario->getPessoa->telefone1 }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Telefone 2</label>
                                                    <input disabled type="text" class="form-control"
                                                        id="phonenumberInput" placeholder=""
                                                        value="{{ $usuario->getPessoa->telefone2 }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Género</label>
                                                    <input disabled type="text" class="form-control"
                                                        value="{{ $usuario->getPessoa->genero }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Documento de
                                                        Identificação</label>
                                                    <input disabled type="text" name="documento"
                                                        id="documento" class="form-control"
                                                        value="{{ $usuario->getPessoa->documento }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Nº Documento</label>
                                                    <input disabled type="text" name="num_documento"
                                                        id="num_documento" class="form-control"
                                                        value="{{ $usuario->getPessoa->num_documento }}">
                                                </div>
                                            </div>

                                            <!--end col-->
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email</label>
                                                    <input disabled type="email" class="form-control" id="emailInput"
                                                        placeholder="Enter your email"
                                                        value="{{ $usuario->getPessoa->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Foto de Perfil (formato
                                                        PNG)</label>
                                                    <input accept="image/png" required type="file"
                                                        class="form-control" id="fotografia">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a id="btn-update-foto" class="btn btn-success">Actualizar
                                                        Foto</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <div wire:ignore class="tab-pane fade" id="password" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Alterar Senha</h5>

                                    <div class="alert alert-info">
                                        Sempre que alterar a senha, deverá utilizar a nova senha na próxima vez que iniciar
                                        sessão na plataforma.
                                    </div>

                                    <form>

                                        @csrf

                                        <div class="row form-group">
                                            <div class="col-lg-12">
                                                Sugestões de segurança da palavra-passe:
                                                <ul>
                                                    <li>Pelo menos 8 caracteres (obrigatório)</li>
                                                    <li>Pelo menos 1 letra minúscula</li>
                                                    <li>Pelo menos 1 letra maiúscula</li>
                                                    <li>Pelo menos 1 número</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Senha antiga</label>
                                                    <input required type="password" id="senha_antiga"
                                                        class="form-control" id="firstnameInput"
                                                        placeholder="Digite a senha antiga" value=""> <i
                                                        class="bi bi-eye-slash" id="togglePassword"></i>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="lastnameInput" class="form-label">Nova senha</label>
                                                    <input id="nova" required type="password" class="form-control"
                                                        id="lastnameInput" placeholder="Digite a nova senha"
                                                        value="">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Confirmar
                                                        senha</label>
                                                    <input id="confirmar" required type="password" class="form-control"
                                                        id="phonenumberInput" placeholder="Confirme a nova senha"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a id="btn-update-senha" class="btn btn-success">Actualizar
                                                        senha</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        @if (Auth::user()->permission_id == 5)
                            <div wire:ignore class="tab-pane fade" id="actualizar" role="tabpanel">
                                <div class="row">

                                    <!--end col-->
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-body">
<!-- 
                                                <div class="alert alert-warning text-center">
                                                    <h4>Só poderá editar a sua candidatura, caso ainda esteja pendente ou
                                                        esteja
                                                        suspensa. Se estiver aprovada, já não poderá editar a sua
                                                        candidatura.
                                                    </h4>
                                                </div> -->

                                                {{-- <h4 class="card-title mb-3">Dados da Candidatura</h4> --}}


                                                <form action="">

                                                    @csrf

                                                    <input type="hidden" id="pessoa_id" name="pessoa_id" value="{{ $pessoa->id }}">
                                                    <input type="hidden" id="candidatura_id" name="candidatura_id" value="{{ $candidatura->id }}">

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-xs-12">
                                                            <div class="page-title-box align-items-center text-center">
                                                                <h4 class="mb-sm-0 alert alert-primary text-center">
                                                                    Preencha
                                                                    devidamente os campos a
                                                                    seguir com as suas informações</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end page title -->

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0 flex-grow-1">Dados Iniciais
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
                                                                                        class="form-label">Nome
                                                                                        completo</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="nome_completo"
                                                                                        value="{{ $pessoa->nome }}"
                                                                                        id="nome_completo">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                                                <div>
                                                                                    <label for="email"
                                                                                        class="form-label">Email</label>
                                                                                    <input
                                                                                        value="{{ $pessoa->email }}"
                                                                                        type="email" 
                                                                                        class="form-control"
                                                                                        id="email" name="email">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                                                <div>
                                                                                    <label for="tel1"
                                                                                        class="form-label">Nº de telefone
                                                                                        principal</label>
                                                                                    <input
                                                                                        value="{{ $pessoa->telefone1 }}"
                                                                                        type="text" minlength="9"
                                                                                        maxlength="9"
                                                                                        class="form-control"
                                                                                        id="telefone1" name="telefone1">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                                                <div>
                                                                                    <label for="tel2"
                                                                                        class="form-label">Nº de telefone
                                                                                        alternativo</label>
                                                                                    <input
                                                                                        value="{{ $pessoa->telefone2 }}"
                                                                                        type="email" minlength="9"
                                                                                        maxlength="9"
                                                                                        class="form-control"
                                                                                        id="telefone2" name="telefone2">
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                            class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="num_cedula"
                                                                                    class="form-label">N.º da Cédula de
                                                                                    Advogado(a) Estagiário(a)
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="num_cedula" name="num_cedula" value="{{ $candidatura->num_cedula }}">
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="basiInput"
                                                                                    class="form-label">Género </label>
                                                                                <br>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="genero"
                                                                                        id="genero_m"
                                                                                        value="Masculino" {{ $pessoa->genero == 'Masculino' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="genero_m">Masculino</label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="genero"
                                                                                        id="genero_f"
                                                                                        value="Feminino" {{ $pessoa->genero != 'Masculino' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="genero_f">Feminino</label>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div
                                                                            class="col-xxl-3 col-md-3 col-lg-3 col-sm-12 col-xs-12">
                                                                            <div>
                                                                                <label for="num_cedula"
                                                                                    class="form-label">Nº. Bilhete de Identidade
                                                                                </label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="num_documento2" name="num_documento2" maxlength="14" value="{{ $pessoa->num_documento }}">
                                                                            </div>
                                                                        </div>
                                                                            <!--end col-->
                                                                        </div>
                                                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                <div class="row mt-3">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header align-items-center d-flex">
                                                                <h4 class="card-title mb-0 flex-grow-1 text-primary">
                                                                    Informações do Patrono</h4>
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
                                                                                <label for="nome_patrono"
                                                                                    class="form-label">Nome do
                                                                                    Patrono</label>
                                                                                <input type="nome_patrono"
                                                                                    class="form-control"
                                                                                    id="nome_patrono" name="nome_patrono" value="{{$candidatura->nome_patrono}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-3">
                                                                        <div class="col-xxl-6 col-md-6">
                                                                            <div>
                                                                                <label for="email_patrono"
                                                                                    class="form-label">Email do
                                                                                    Patrono</label>
                                                                                <input type="email"
                                                                                    class="form-control"
                                                                                    name="email_patrono" id="email_patrono" value="{{$candidatura->email_patrono}}">
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-xxl-3 col-lg-3 col-md-3">

                                                                            <label for="telefone_patrono"
                                                                                class="form-label">Nº telefone do
                                                                                Patrono
                                                                                (9xxxxxxxx)</label>
                                                                            <input type="text" class="form-control"
                                                                                id="telefone_patrono" maxlength="9" name="telefone_patrono"
                                                                                placeholder="" value="{{$candidatura->telefone_patrono}}">

                                                                        </div>
                                                                    </div>

                                                                    <div class="row mt-3">
                                                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                                                                            <div>
                                                                                <label for="nome_escritorio"
                                                                                    class="form-label">Nome do Escritório</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="nome_escritorio" id="nome_escritorio" value="{{$candidatura->nome_escritorio}}">
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-12">

                                                                            <label for="endereco_escritorio"
                                                                                class="form-label">Endereço do Escritório</label>
                                                                            <input type="text" class="form-control"
                                                                                id="endereco_escritorio" value="{{$candidatura->endereco_escritorio}}" name="endereco_escritorio"
                                                                                placeholder="">

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
                                                                    <span class="opcional">** Os campos de sbmissão de
                                                                        documentos são opcionais **</span>
                                                                    <div class="flex-shrink-0">

                                                                    </div>
                                                                </div><!-- end card header -->
                                                                <div class="card-body">
                                                                    <div class="live-preview">
                                                                        <div class="row gy-4">
                                                                            <div
                                                                                class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                                                <div>
                                                                                    <label for="doc_bi"
                                                                                        class="form-label">Cópia da Cédula
                                                                                    de
                                                                                    Advogado Estagiário</label>
                                                                                    <input type="file"
                                                                                        class="form-control"
                                                                                        id="cedula_advogado" name="cedula_advogado">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-xxl-6 col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                                                                <div>
                                                                                    <label for="doc_diploma"
                                                                                        class="form-label">Cópia do BI</label>
                                                                                    <input type="file"
                                                                                        class="form-control"
                                                                                        id="bilhete_identidade"
                                                                                        name="bilhete_identidade">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a id="btn-submeter" class="btn btn-success">Confirmar Actualização</a>

                                                </form>
                                            </div>
                                            <!--end card-body-->
                                        </div><!-- end card -->

                                    </div>
                                    <!--end col-->
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
@endsection
@section('script-aux')
    <script src="{{ URL::asset('assets/system/js/perfil-usuario.js') }} "></script>
    <script src="{{ URL::asset('assets/system/js/update-candidatura.js') }} "></script>
@endsection
