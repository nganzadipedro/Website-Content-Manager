@section('css-aux')
    <link href="{{ asset('assets/template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Cadastrar Usuários</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="nome_completo">Nome Completo</label>
                                        <input type="text" wire:model="nome_completo"
                                            class="form-control form-control-sm" id="nome_completo" value="">
                                        @error('nome_completo')
                                            <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" wire:model="email" class="form-control form-control-sm"
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
                                        <select wire:model="documento" name="" id=""
                                            class="form-control form-control-sm">
                                            <option>Selecione...</option>
                                            <option value="Bilhete de Identidade">Bilhete de Identidade</option>
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
                                            class="form-control form-control-sm" id="num_bi" value="">
                                        @error('num_documento')
                                            <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="tel1">Telefone 1</label>
                                        <input wire:model="telefone1" type="text" maxlength="9"
                                            class="form-control form-control-sm" id="tel1" value="">
                                        @error('telefone1')
                                            <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="tel2">Telefone 2</label>
                                        <input type="text" wire:model="telefone2" maxlength="9"
                                            class="form-control form-control-sm" id="tel2" value="">
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
                                        <select wire:model="genero" name="" id="" class="form-control form-control-sm">
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
                                            class="form-control form-control-sm">
                                            <option>Selecione...</option>
                                            @foreach ($permissoes as $perm)
                                                <option value="{{$perm->id}}">{{$perm->descricao}}</option>
                                            @endforeach
                                        </select>
                                        @error('nivel_acesso')
                                            <span class="mt-3 badge bg-danger text-light">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if (session()->has('message'))
                                <div class="alert alert-success mt-3">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="row mt-3 text-center">
                                <div class="col-lg-12 col-12">
                                    <a wire:click="salvar()" class="btn btn-success mt-4">Salvar usuário</a>
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
    <script src="{{ asset('assets/template/src/assets/js/scrollspyNav.js') }}"></script>
@endsection