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

                            <input type="hidden" name="hash_noticia" id="hash_noticia" value="{{ $advogado->hash }}">

                            <div class="row mt-3">

                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label for="titulo">Nome completo</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->getpessoa->nome }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="form-group">
                                        <label for="titulo">Email</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->getpessoa->email }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="titulo">Documento de Identificação</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->getpessoa->documento }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="titulo">Nº Documento</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->getpessoa->num_documento }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="titulo">Nº Telefone</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->getpessoa->telefone1 }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="titulo">Nº Telefone Alternativo</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
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
                                        <label for="genero">Categoria</label>
                                        <select class="form-control form-control-sm" name="genero" id="genero">
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
                                        <label for="titulo">Nº Cédula Advogado</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
                                            value="{{ $advogado->num_associado }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3">
                                    <div class="form-group">
                                        <label for="titulo">Nº Cédula Estagiário</label>
                                        <input type="text" id="titulo" class="form-control form-control-sm" id="titulo"
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
                                            <label for="titulo">Nome do patrono</label>
                                            <input type="text" id="titulo" class="form-control form-control-sm"
                                                id="titulo" value="{{ $advogado->nome_patrono }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <label for="titulo">Email do patrono</label>
                                            <input type="text" id="titulo" class="form-control form-control-sm"
                                                id="titulo" value="{{ $advogado->email_patrono }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <label for="telefone_patrono">Nº Telefone do Patrono</label>
                                            <input type="text" id="telefone_patrono"
                                                class="form-control form-control-sm" name="telefone_patrono"
                                                value="{{ $advogado->telefone_patrono }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3 mb-4">

                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="nome_escritorio">Nome do escritório</label>
                                            <input type="text" id="nome_escritorio" class="form-control form-control-sm"
                                                id="nome_escritorio" value="{{ $advogado->nome_escritorio }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="form-group">
                                            <label for="endereco_escritorio">Endereço do escritório</label>
                                            <input type="text" id="endereco_escritorio"
                                                class="form-control form-control-sm" id="endereco_escritorio"
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
    <script src="{{ asset('assets/system/js/editar-noticia.js') }}"></script>
@endsection