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
                            <p class="user-name" data-name="Alan Green">{{$mensagem->nome}}</p>

                            @if ($tipo == 'mensagem')
                                <p class="user-work" data-occupation="Web Developer">
                                    {{ $mensagem->tipo_remetente }}
                                </p>
                            @endif

                        </div>

                        @if ($tipo == 'mensagem')
                            <div class="user-email">
                                <p class="info-title">Email: {{$mensagem->email}}</p>
                            </div>
                            @if ($mensagem->tipo_remetente == 'advogado')
                                <div class="user-location">
                                    <p class="info-title">Nº Cédula: {{ $mensagem->num_identificacao }}</p>
                                </div>
                            @else
                                <div class="user-location">
                                    <p class="info-title">Nº Bilhete: {{ $mensagem->num_identificacao }}</p>
                                </div>
                            @endif
                        @endif


                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="widget-content widget-content-area br-8" style="min-height: 270px;">
                        <h4 class="subject">Assunto: {{ $mensagem->assunto }}</h4>
                        @if ($mensagem->estado == 'pendente')
                            <span class="status-1">Pendente</span>
                        @else
                            <span class="status-2">Atendida</span>
                        @endif

                        <p class="mt-3">{{ $mensagem->mensagem }}</p>
                        <div class="btns-actions">
                            @if ($mensagem->estado == 'pendente')
                                <a wire:click="marcar_atendida()" class="btn btn-success">Marcar como atendida</a>
                            @endif
                            @if ($tipo == 'denuncia' && $mensagem->ficheiro != null)
                                <a href="" target="_blank" class="btn btn-warning">Ver Ficheiro Anexado</a>
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