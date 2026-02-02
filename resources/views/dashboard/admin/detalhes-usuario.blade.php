<div>

    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detalhes do Usuário</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="text-center">

                                            <img width="100px" src="{{ asset('images/user-icon.png') }}" alt="avatar">
                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="Alan Green">{{$pessoa->nome}}</p>
                                                <p class="user-work" data-occupation="Web Developer">
                                                    {{ $user->getPermissao->descricao }}
                                                </p>
                                            </div>
                                            <div class="user-email">
                                                <p class="info-title">Email: {{$pessoa->email}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                                        <div class="widget-content widget-content-area br-8" style="min-height: 330px;">
                                            @if ($user->estado == 'inativo')
                                                Estado da Conta: <span class="status-1">Inactivo</span>
                                            @else
                                                Estado da Conta: <span class="status-2">Ativo</span>
                                            @endif

                                            <br>
                                            <br>
                                            <label for="">Nome: {{ $pessoa->nome }}</label> <br>
                                            <label for="">Email: {{ $pessoa->email }}</label> <br>
                                            <label for="">Nº BI: {{ $pessoa->num_documento }}</label> <br>
                                            <label for="">Género: {{ $pessoa->genero }}</label> <br>
                                            <label for="">Documento: {{ $pessoa->documento }}</label> <br>
                                            <label for="">Nº Telefone: {{ $pessoa->telefone1 }} /
                                                {{ $pessoa->telefone2 }}</label> <br>

                                            <div class="btns-actions mt-3">
                                                @if ($user->estado == 'ativo')
                                                    <a wire:click="desactivar()" class="btn btn-danger">Desactivar Conta</a>
                                                    <a wire:click="enviar_credenciais()" class="btn btn-success">Enviar
                                                        Credenciais de
                                                        Acesso</a>
                                                @endif
                                                @if ($user->estado == 'inativo')
                                                    <a wire:click="activar()" class="btn btn-success">Activar Conta</a>
                                                @endif
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