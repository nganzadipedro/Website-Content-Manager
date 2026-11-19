<div class="row">

    <div class="col-xl-12" id="card-none2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        @if(Auth::user()->permission_id == 2)
                        <h6 class="card-title mb-0">CADASTRAR FORMANDO</h6>
                        @else
                        <h6 class="card-title mb-0">CADASTRAR USUÁRIO</h6>
                        @endif
                        
                    </div>
                    <div class="flex-shrink-0">
                        <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                            <li class="list-inline-item">
                                <a class="align-middle" href="javascript:void(0);" data-toggle="growing-reload">
                                    <i class="mdi mdi-refresh align-middle"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="align-middle minimize-card" data-bs-toggle="collapse" href="#collapseExample2"
                                    role="button" aria-expanded="true" aria-controls="collapseExample2">
                                    <i class="mdi mdi-plus align-middle plus"></i>
                                    <i class="mdi mdi-minus align-middle minus"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" onclick="delthis('card-none2')"
                                    class="btn-close fs-10 align-middle"></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body collapse show" id="collapseExample2" style="">
                <form method="POST" wire:submit.prevent="salvar">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nome</label>
                                <input wire:model="nome" type="text" class="form-control" id="firstNameinput"
                                    required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="ForminputState" class="form-label">Documento</label>
                                <select wire:model="documento" id="ForminputState" class="form-select">
                                    <option value="">Vazio</option>
                                    <option value="Bilhete de Identidade">Bilhete de Identidade</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="lastNameinput" class="form-label">Nº do Documento</label>
                                <input wire:model="num_documento" maxlength="15" type="text" class="form-control"
                                    id="lastNameinput">
                            </div>
                        </div>

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
                                    id="lastNameinput">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="ForminputState" class="form-label">Genero</label>
                                <select wire:model="genero" id="ForminputState" class="form-select">
                                    <option value="">Vazio</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="ForminputState" class="form-label">Categoria</label>
                                <select wire:model="categoria_id" id="ForminputState" class="form-select" required>
                                    <option value="">Vazio</option>
                                    @foreach ($categorias as $item)
                                    @if(Auth::user()->permission_id == 2)
                                        @if($item->id == 5)
                                        <option value="{{ $item->id }}">{{ $item->descricao }}</option>
                                        @endif
                                    @else
                                        @if($item->id != 10)
                                            <option value="{{ $item->id }}">{{ $item->descricao }}</option>
                                        @endif
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="emailidInput" class="form-label">E-mail</label>
                                <input wire:model="email" type="email" class="form-control" id="emailidInput"
                                    required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="ForminputState" class="form-label">Ativo</label>
                                <select wire:model="ativo" id="ForminputState" class="form-select">
                                    <option value="">Vazio</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="turma_id" class="form-label">Turma</label>
                                <select wire:model="turma_id" id="turma_id" class="form-select">
                                    <option value="">Vazio</option>
                                    @foreach ($turmas as $t)
                                    <option value="{{$t->id}}">{{$t->descricao}} ({{$t->getformacao->nome}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-end">
                                <a wire:click="salvar()" class="btn btn-success">Salvar</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
