@section('css-aux')
    <link href="{{ asset('assets/template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>

    <style>
        .title-page {
            font-size: 20px !important;
            font-weight: bold !important;
            color: #fff !important;
            background-color: #3c7bb2ff !important;
            display: inline-block !important;
        }

        p {
            font-weight: bold;
            font-style: italic;
            color: #3c7bb2ff;
        }

        .sub-campos {
            background-color: #f4f4f4ff;
            padding: 5px 5px;
            border-radius: 10px;
        }
    </style>

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="title-page">Actualizar Dados do Associado</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            @csrf

                            <input type="hidden" name="advogado_id" id="advogado_id" value="{{ $advogado->id }}">

                            <div class="row mt-3">

                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label for="nome">Nome completo</label>
                                        <input type="text" name="nome" maxlength="255" class="form-control form-control-sm" id="nome"
                                            value="{{ $advogado->getpessoa->nome }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" maxlength="100" class="form-control form-control-sm" id="email"
                                            value="{{ $advogado->getpessoa->email }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="documento">Documento de Identificação</label>
                                        <input type="text" name="documento" maxlength="50" class="form-control form-control-sm" id="documento"
                                            value="{{ $advogado->getpessoa->documento }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="num_documento">Nº Documento</label>
                                        <input type="text" id="num_documento" maxlength="30" class="form-control form-control-sm" name="num_documento"
                                            value="{{ $advogado->getpessoa->num_documento }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="telefone1">Nº Telefone</label>
                                        <input type="text" id="telefone1" maxlength="9" class="form-control form-control-sm" name="telefone1"
                                            value="{{ $advogado->getpessoa->telefone1 }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="telefone2">Nº Telefone Alternativo</label>
                                        <input type="text" id="telefone2" maxlength="9" class="form-control form-control-sm" name="telefone2"
                                            value="{{ $advogado->getpessoa->telefone2 }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="genero">Género</label>
                                        <select class="form-control form-control-sm" name="genero" id="genero">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Feminino">Feminino</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="categoria">Categoria</label>
                                        <select class="form-control form-control-sm" name="categoria" id="categoria">
                                            <option {{ $advogado->categoria == 'Estagiario' ? 'selected' : '' }}
                                                value="Estagiario">Estagiario</option>
                                            <option {{ $advogado->categoria == 'Advogado' ? 'selected' : '' }}
                                                value="Advogado">Advogado</option>
                                            <option {{ $advogado->categoria == 'Por especificar' ? 'selected' : '' }}
                                                value="Por especificar">Por especificar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="num_associado">Nº Cédula Advogado</label>
                                        <input type="text" id="num_associado" maxlength="7" class="form-control form-control-sm" name="num_associado"
                                            value="{{ $advogado->num_associado }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="num_estagiario">Nº Cédula Estagiário</label>
                                        <input type="text" id="num_estagiario" maxlength="7" class="form-control form-control-sm" name="num_estagiario"
                                            value="{{ $advogado->num_estagiario }}">
                                    </div>
                                </div>

                            </div>

                            <p class="mt-5">
                                **Os campos a seguir são obrigatórios para advogados estagiários**
                            </p>

                            <div class="sub-campos">
                                <div class="row mt-3">

                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="nome_patrono">Nome do patrono</label>
                                            <input type="text" id="nome_patrono" class="form-control form-control-sm"
                                                name="nome_patrono" maxlength="80" value="{{ $advogado->nome_patrono }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <label for="email_patrono">Email do patrono</label>
                                            <input type="text" id="email_patrono" class="form-control form-control-sm"
                                                name="email_patrono" maxlength="150" value="{{ $advogado->email_patrono }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <label for="telefone_patrono">Nº Telefone do Patrono</label>
                                            <input type="text" id="telefone_patrono"
                                                class="form-control form-control-sm" maxlength="9" name="telefone_patrono"
                                                value="{{ $advogado->telefone_patrono }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3 mb-4">

                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="nome_escritorio">Nome do escritório</label>
                                            <input type="text" id="nome_escritorio" class="form-control form-control-sm"
                                                name="nome_escritorio" maxlength="100" value="{{ $advogado->nome_escritorio }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="endereco_escritorio">Endereço do escritório</label>
                                            <input type="text" id="endereco_escritorio"
                                                class="form-control form-control-sm" maxlength="200" name="endereco_escritorio"
                                                value="{{ $advogado->endereco_escritorio }}">
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="row mt-3 text-center">
                                <div class="col-lg-12 col-12">
                                    <a id="btn-salvar" class="btn btn-success mt-4">Confirmar Actualização</a>
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
    <script src="{{ asset('assets/system/js/actualizar-dados-advogado.js') }}"></script>
@endsection