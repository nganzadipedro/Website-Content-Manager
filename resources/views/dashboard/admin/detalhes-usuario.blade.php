@section('css-aux')
    <link href="{{ asset('assets/template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/template/src/assets/css/light/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/template/src/assets/css/dark/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>

    <style>
        .subject {
            font-weight: bold;
            padding-bottom: 7px;
            border-bottom: double 4px #000;
        }

        .btns-actions {
            position: absolute;
            bottom: 15px;
        }

        .status-1 {
            background-color: #eaa810ff;
            color: #000;
            padding: 2px;
        }

        .status-2 {
            background-color: #10ea7dff;
            color: #000;
            padding: 2px;
        }
    </style>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">


            <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget-content widget-content-area br-8 text-center">

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

                        <div class="user-location">
                            <p class="info-title">Nº BI: {{ $pessoa->num_documento }}</p>
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
                        <label for="">Nº Telefone: {{ $pessoa->telefone1 }} / {{ $pessoa->telefone2 }}</label> <br>

                        <div class="btns-actions">
                            @if ($user->estado == 'ativo')
                                <a wire:click="desactivar()" class="btn btn-danger">Desactivar Conta</a>
                                <a wire:click="enviar_credenciais()" class="btn btn-success">Enviar Credenciais de Acesso</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>




        </div>

    </div>


</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/template/src/assets/js/apps/contact.js') }}"></script>
@endsection