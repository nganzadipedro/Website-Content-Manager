<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Detalhes do Processo
                        </h2>
                        <button class="btn mt-3">Nº Processo <span
                                class="badge bg-azure text-azure-fg ms-2">{{ $registo->codigo }}</span></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tabs-home-1" class="nav-link active" data-bs-toggle="tab">Dados
                                            gerais</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-anexos-1" class="nav-link" data-bs-toggle="tab">Anexos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tabs-profile-1" class="nav-link" data-bs-toggle="tab">Histórico</a>
                                    </li>
                                    <li class="nav-item ms-auto">
                                        <a href="#tabs-settings-1" class="nav-link" title="Settings"
                                            data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tabs-home-1">
                                        <h3>Dados Gerais</h3>
                                        <div>

                                            Nº do Processo: {{ $registo->codigo }} <br><br>
                                            Proveniência: {{ $registo->proveniencia }} <br><br>
                                            
                                            <strong> Assunto: {{ $registo->assunto }}</strong> <br><br>
                                            Data de Entrada: {{ $registo->data_entrada }} <br><br>
                                            Data de Registo no Sistema: {{ $registo->created_at }} <br><br>
                                            Tipo de Processo: {{ $registo->tipo_processo_id == 9 ? $registo->outro_tipo_processo : $registo->gettipoprocesso->descricao }} <br><br>
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio" class="btn-check" name="btn-radio-dropdown"
                                                    id="btn-radio-dropdown-1" autocomplete="off" checked>
                                                <label for="btn-radio-dropdown-1" type="button" class="btn">Documento:
                                                    {{ $registo->tipo_documento }}</label>
                                                <input type="radio" class="btn-check" name="btn-radio-dropdown"
                                                    id="btn-radio-dropdown-2" autocomplete="off">
                                                <label for="btn-radio-dropdown-2" type="button" class="btn">Estado:
                                                    {{ $registo->estado }}</label>
                                                <input type="radio" class="btn-check" name="btn-radio-dropdown"
                                                    id="btn-radio-dropdown-3" autocomplete="off">
                                                <label for="btn-radio-dropdown-3" type="button"
                                                    class="btn">Destinatário: {{ $registo->destinatario }}</label>
                                                <input type="radio" class="btn-check" name="btn-radio-dropdown"
                                                    id="btn-radio-dropdown-4" autocomplete="off">
                                                <label for="btn-radio-dropdown-4" type="button" class="btn">Encaminhado:
                                                    {{ $registo->encaminhado }}</label>
                                            </div>
                                            <br>
                                            <br>
                                            @if ($registo->encaminhado != 'Não')
                                            Nota de Encaminhamento: {{ $registo->nota_encaminhamento }}  <br><br>
                                            @endif

                                            Registado Por: {{ $registo->getuser->getpessoa->nome }}

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-anexos-1">

                                        <div class="row">
                                            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 col-xl-8">
                                                <h3>Anexos</h3>
                                                <form class="">

                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                                            <div class="row">
                                                                <div class="col-lg-12 col-12">
                                                                    <div class="form-group">
                                                                        <label for="titulo">Título</label>
                                                                        <input type="text" name="titulo"
                                                                            class="form-control" id="titulo" value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" id="registo_id" name="registo_id"
                                                                value="{{ $registo->id }}">

                                                            <div class="row mt-3">


                                                                <div class="col-lg-3 col-12 col-md-3 col-xl-3">
                                                                    <div class="form-group">
                                                                        <label for="tipo_documento">Tipo de
                                                                            Anexo</label>
                                                                        <select clang="form-control" name="tipo_anexo"
                                                                            id="tipo_anexo" class="form-control">
                                                                            <option value="Documento" selected>
                                                                                Documento</option>
                                                                            <option value="Fotografia">Fotografia
                                                                            </option>
                                                                            <option value="Áudio">Áudio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-9 col-xl-9 col-md-9 col-12">
                                                                    <div class="form-group">
                                                                        <label for="observacao">Observação</label>
                                                                        <input type="text" name="observacao"
                                                                            class="form-control" id="observacao"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12">
                                                                    <div class="form-group">
                                                                        <label for="anexo">Carregue o Anexo</label>
                                                                        <input type="file" name="anexo"
                                                                            class="form-control" id="anexo" value="">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12">
                                                                    <a id="btn-salvar-anexo"
                                                                        class="btn btn-success mt-4">Salvar Anexo</a>
                                                                    <a href="{{ route('system.secretaria.dashboard') }}"
                                                                        class="btn btn-danger mt-4">Cancelar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 col-xl-4">
                                                <h3>Anexos Carregados</h3>

                                                <div class="card">
                                                    <div class="list-group list-group-flush">

                                                        @if (count($anexos_registo) == 0)
                                                            <div class="alert alert-warning m-3">
                                                                Nenhum anexo foi carregado para este registo.
                                                            </div>
                                                        @endif

                                                        @foreach ($anexos_registo as $anexo)
                                                            <a href="{{ asset('storage/secretaria/anexos_registos/' . $anexo->anexo) }}"
                                                                target="_blank"
                                                                class="list-group-item list-group-item-action active">
                                                                [{{ $anexo->tipo_anexo }}] {{ $anexo->titulo }}
                                                                <br>
                                                                <small class="text-muted">{{ $anexo->observacao }}</small>
                                                                <br>
                                                                <small class="text-muted">{{ $anexo->created_at }}</small>
                                                            </a>

                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tabs-profile-1">
                                        <h3>Histórico do Processo</h3>


                                        <div class="list-group list-group-flush list-group-hoverable">
                                            @foreach ($historico_registo as $item)
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto"><span class="badge bg-green"></span></div>
                                                        <div class="col-auto">
                                                            <a href="#">
                                                                <span class="avatar"
                                                                    style="background-image: url({{ asset('images/user-icon.png') }})"></span>
                                                            </a>
                                                        </div>
                                                        <div class="col text-truncate">
                                                            <a href="#"
                                                                class="text-reset d-block">{{$item->getuser->getpessoa->nome}}
                                                                | {{ $item->created_at }}</a>
                                                            <div class="d-block text-secondary text-truncate mt-n1">
                                                                {{$item->operacao}}
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-auto">
                                                                                                                            <a href="#"
                                                                                                                                class="list-group-item-actions">
                                                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                                    class="icon text-secondary" width="24" height="24"
                                                                                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                                                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                                                                                                    stroke-linejoin="round">
                                                                                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                                                                    <path
                                                                                                                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                                                                                                </svg>
                                                                                                                            </a>
                                                                                                                        </div> -->
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-settings-1">
                                        <h4>Encaminhar Processo</h4>
                                        <div>

                                            @if ($registo->encaminhado == 'Não')
                                                <form class="">

                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                                            <div class="row">

                                                            <input type="hidden" id="tipo_processo_id" value="{{ $registo->tipo_processo_id }}">
                                                            <input type="hidden" id="permissao_user_id" value="{{ Auth::user()->permissao_id }}">

                                                                <div class="col-lg-6 col-12 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="tipo_documento">Encaminhar Para</label>
                                                                        <select clang="form-control" name="encaminhar_para"
                                                                            id="encaminhar_para" class="form-control">
                                                                            <option value="Área Técnica" selected>
                                                                                Área Técnica</option>
                                                                            <option value="Presidente">Presidente
                                                                            </option>
                                                                            <option value="Conselheiro">Conselheiro</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-12 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="nota">Nota de encaminhamento</label>
                                                                        <input type="text" name="nota" class="form-control"
                                                                            id="nota" value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" id="registo_id" name="registo_id"
                                                                value="{{ $registo->id }}">

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12">
                                                                    <a id="btn-confirmar"
                                                                        class="btn btn-success mt-4">Confirmar</a>
                                                                    <a href="{{ route('system.secretaria.dashboard') }}"
                                                                        class="btn btn-danger mt-4">Cancelar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-success m-3">
                                                    Este processo já foi encaminhado para {{ $registo->encaminhado }}
                                                </div>
                                            @endif


                                        </div>
                                    </div>
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
    <script src="{{ asset('assets/system/js/adicionar-anexo.js') }}"></script>
@endsection