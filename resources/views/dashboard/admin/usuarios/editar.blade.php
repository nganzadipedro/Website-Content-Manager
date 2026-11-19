<div>
    <div class="row">

        <div class="col-xl-4" id="card-none2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center text-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-0"></h6>
                        </div>

                    </div>
                </div>
                <div class="card-body collapse show" id="informacoes" style="">

                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            @if ($usuario->getPessoa->avatar == null)
                                <img class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    src="{{ asset('assets/template/images/users/user_default.jpg') }}" alt="Header Avatar">
                            @else
                                <img src="{{ asset('sysapp/storage/app/public/' . $usuario->getPessoa->avatar) }}"
                                    alt="user-img" class="rounded-circle avatar-xl img-thumbnail user-profile-image" />
                            @endif

                            {{-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </div> --}}
                        </div>
                        <h5 class="fs-17 mb-1">{{ $usuario->getPessoa->nome }}</h5>
                        {{-- <p class="text-muted mb-0">{{ $resultados->getSector->sector }}</p> --}}
                    </div>
                    <hr>


                    <div class="list-group list-group-fill-success shadow-sm">


                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="ri-notification-3-line align-middle me-2"></i>
                            Identificador (P): {{ $usuario->pessoa_id }}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="ri-notification-3-line align-middle me-2"></i>
                            Identificador (U): {{   $usuario->id }}
                        </a>


                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="ri-notification-3-line align-middle me-2"></i>

                            Nível de Acesso: {{ $usuario->getPermissao->descricao }}

                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="ri-notification-3-line align-middle me-2"></i>
                            Data de registro: {{ $usuario->created_at }}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="ri-notification-3-line align-middle me-2"></i>
                            Conta ativa: {{ $usuario->ativo != 'Sim' ? 'Não' : 'Sim' }}
                        </a>
                    </div>

                    <div class="row mt-5">

                        @if (Auth::user()->permission_id == 1)
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">
                                @if ($usuario->ativo == 'Sim')
                                    <button style="width: 100%;" wire:click="desativar({{ $usuario->id }})"
                                        class="btn btn-danger btn-label  rounded-pill" type="button"><i
                                            class=" ri-close-line  label-icon align-middle rounded-pill fs-16 me-2"></i>
                                        Desativar conta</button>
                                @else
                                    <button style="width: 100%;" wire:click="activar({{ $usuario->id }})"
                                        class="btn btn-success btn-label  rounded-pill" type="button"><i
                                            class=" ri-check-double-fill  label-icon align-middle rounded-pill fs-16 me-2"></i>
                                        Activar conta</button>
                                @endif
                            </div>
                        @endif

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">

                            <button style="width: 100%;" wire:click="enviar_credencial({{ $usuario->id }})"
                                class="btn btn-primary btn-label rounded-pill" type="button"><i
                                    class=" ri-check-double-fill   label-icon align-middle rounded-pill fs-16 me-2"></i>
                                Enviar Credenciais (SMS)</button>

                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mb-3">

                            <button style="width: 100%;" wire:click="enviar_credencial_email({{ $usuario->id }})"
                                class="btn btn-success btn-label  rounded-pill" type="button"><i
                                    class=" ri-check-double-fill   label-icon align-middle rounded-pill fs-16 me-2"></i>
                                Enviar Credenciais (Email)</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8" id="card-none2">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-0">Formulário de edição dos dados do
                                usuário</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body collapse show" id="collapseExample2" style="">

                    <ul class="nav nav-pills nav-primary mb-3" role="tablist">
                        {{-- <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link active" wire:ignore.self data-bs-toggle="tab" href="#dashborad"
                                role="tab" aria-selected="true">Overview</a>
                        </li> --}}
                    </ul>

                    <div class="tab-content text-muted">

                        <div class="tab-pane active" id="editardados" role="tabpanel" wire:ignore.self>

                            <form method="POST" wire:submit.prevent="actualizarDados({{ $usuario->id }})">
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Nome</label>
                                            <input wire:model="nome" {{ $usuario->permission_id == 5 ? 'disabled' : '' }}
                                                type="text" class="form-control" id="firstNameinput" required>
                                        </div>
                                    </div>

                                    @if ($usuario->permission_id != 5)


                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">Documento</label>
                                                <select wire:model="documento" id="ForminputState" required
                                                    class="form-select">
                                                    <option value="">Vazio</option>
                                                    <option value="Bilhete de Identidade">Bilhete de Identidade</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="lastNameinput" class="form-label">Nº do Documento</label>
                                                <input wire:model="num_documento" maxlength="15" type="text"
                                                    class="form-control" id="lastNameinput" required>
                                            </div>
                                        </div>


                                    @endif


                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label for="lastNameinput" class="form-label">Telefone1</label>
                                            <input wire:model="tel1" maxlength="9" type="text" class="form-control"
                                                id="lastNameinput" required>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label for="lastNameinput" class="form-label">Telefone2</label>
                                            <input wire:model="tel2" maxlength="9" type="text" class="form-control"
                                                id="lastNameinput" required>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Genero</label>
                                            <select wire:model="genero" required id="ForminputState"
                                                class="form-select">
                                                <option value="">Vazio</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Feminino">Feminino</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if ($usuario->permission_id != 5)
                                        <div class="col-3">
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">Categoria</label>
                                                <select wire:model="categoria_id" id="ForminputState" class="form-select"
                                                    required>
                                                    <option value="">Vazio</option>
                                                    @foreach ($categorias as $item)
                                                        @if ($item->id < 4)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->descricao }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">E-mail</label>
                                            <input wire:model="email" type="email" class="form-control"
                                                id="emailidInput" required>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Ativo</label>
                                            <select wire:model="ativo" id="ForminputState" required class="form-select">
                                                <option value="">Vazio</option>
                                                <option value="Sim">Sim</option>
                                                <option value="Não">Não</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>