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
                                <p class="card-subtitle">Este email será usado para notificações e acessar o sistema</p>
                                <div>
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" wire:model="email" class="form-control w-auto"
                                                value="{{ $pessoa->email }}">
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
                                    <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal-report"
                                        class="btn">
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

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Definir nova senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nova senha</label>
                                <input type="password" class="form-control" name="nova_senha" id="nova_senha">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Confirmar nova senha</label>
                                <input type="password" class="form-control" name="confirmar_nova_senha"
                                    id="confirmar_nova_senha">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-nova-senha" class="btn btn-success mt-4">Salvar</a>
                        <a href="{{ route('profile_user') }}"
                            class="btn btn-danger mt-4">Cancelar</a>
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