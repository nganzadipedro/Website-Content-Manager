<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Cadastrar Usuário
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cadastrar Usuário</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="nome_completo">Nome Completo</label>
                                                    <input type="text" wire:model="nome_completo" class="form-control"
                                                        id="nome_completo" value="">
                                                    @error('nome_completo')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" wire:model="email" class="form-control"
                                                        id="email" value="">
                                                    @error('email')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="tel1">Documento</label>
                                                    <select wire:model="documento" name="" id="" class="form-control">
                                                        <option>Selecione...</option>
                                                        <option value="Bilhete de Identidade">Bilhete de Identidade
                                                        </option>
                                                    </select>
                                                    @error('documento')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="num_bi">Nº do BI</label>
                                                    <input wire:model="num_documento" type="text" maxlength="15"
                                                        class="form-control" id="num_bi" value="">
                                                    @error('num_documento')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="tel1">Telefone 1</label>
                                                    <input wire:model="telefone1" type="text" maxlength="9"
                                                        class="form-control" id="tel1" value="">
                                                    @error('telefone1')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="tel2">Telefone 2</label>
                                                    <input type="text" wire:model="telefone2" maxlength="9"
                                                        class="form-control" id="tel2" value="">
                                                    @error('telefone2')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="tel1">Género</label>
                                                    <select wire:model="genero" name="" id="" class="form-control">
                                                        <option>Selecione...</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                    </select>
                                                    @error('genero')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="tel1">Nível de Acesso</label>
                                                    <select wire:model="nivel_acesso" name="" id=""
                                                        class="form-control">
                                                        <option>Selecione...</option>
                                                        @foreach ($permissoes as $perm)
                                                            @if ($perm->id != 3)
                                                                <option value="{{$perm->id}}">{{$perm->descricao}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('nivel_acesso')
                                                        <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <button type="button" wire:click="salvar" class="btn btn-success mt-4">
                                                    Salvar
                                                </button>
                                                <a href="{{ route('system.secretaria.dashboard') }}"
                                                    class="btn btn-danger mt-4">Cancelar</a>
                                            </div>
                                        </div>
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