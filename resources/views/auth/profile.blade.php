<div>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Perfil do usuário
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body">
                                <h4 class="subheader">Perfil do usuário</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="./settings.html"
                                        class="list-group-item list-group-item-action d-flex align-items-center active">Minha
                                        Conta</a>
                                    <!-- <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center">Notificações</a> -->
                                    <a href="#"
                                        class="list-group-item list-group-item-action d-flex align-items-center">Actividades
                                        no Sistema</a>
                                </div>
                                <!-- <h4 class="subheader mt-4">Experience</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-12 col-md-9 d-flex flex-column">
                            <div class="card-body">
                                <h2 class="mb-4">Minha Conta</h2>
                                <h3 class="card-title">Detalhes do Perfil</h3>
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="avatar avatar-xl"
                                            style="background-image: url({{ asset('images/user-icon.png') }})"></span>
                                    </div>
                                    <div class="col-auto"><a href="#" class="btn">
                                            {{$user->getpermissao->descricao}}
                                        </a></div>
                                    <!-- <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                            Delete avatar
                                        </a></div> -->
                                </div>
                                <h3 class="card-title mt-4">Dados do Usuário</h3>
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-label">Nome</div>
                                        <input type="text" class="form-control" value="{{$pessoa->nome}}">
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">user ID</div>
                                        <input type="text" class="form-control" value="{{ $user->id }}" disabled>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">Telefone</div>
                                        <input type="text" class="form-control" value="{{ $pessoa->telefone1 }}">
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">Email</h3>
                                <p class="card-subtitle">Este email será usado para comunicações e acessar o sistema</p>
                                <div>
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" wire:model="email" class="form-control w-auto" value="{{ $pessoa->email }}">
                                        </div>
                                        <div class="col-auto"><a wire:click="actualizarEmail()" class="btn">
                                                Actualizar Email
                                            </a></div>
                                    </div>
                                </div>
                                <h3 class="card-title mt-4">Senha</h3>
                                <p class="card-subtitle">Se alterar a senha, deverá usá-la na próxima vez que acessar o
                                    sistema</p>
                                <div>
                                    <a href="#" class="btn">
                                        Definir nova senha
                                    </a>
                                </div>
                                <h3 class="card-title mt-4">Autenticação de 2 Factores</h3>
                                <p class="card-subtitle">Activar esta função, fará com que receba códigos de validação
                                    para acessar a plataforma</p>
                                <div>
                                    <label class="form-check form-switch form-switch-lg">
                                        <input class="form-check-input" type="checkbox">
                                        <span class="form-check-label form-check-label-on">Activado</span>
                                        <span class="form-check-label form-check-label-off">Desativado</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@section('script-aux')
    <script src="{{ URL::asset('assets/system/js/perfil-usuario.js') }} "></script>
    <script src="{{ URL::asset('assets/system/js/update-candidatura.js') }} "></script>
@endsection