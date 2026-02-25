<div>

    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Formulário de edição de dados dos patronos
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" value="{{ $patrono->id }}" name="patrono_id" id="patrono_id">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_completo">Nome completo</label>
                                                    <input type="text" maxlength="200" name="nome_completo"
                                                        class="form-control" id="nome_completo"
                                                        value="{{ $pessoa != null ? $pessoa->nome : $patrono->nome }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_profissional">Nome profissional</label>
                                                    <input type="text" maxlength="200" name="nome_profissional"
                                                        class="form-control" id="nome_profissional"
                                                        value="{{ $advogado != null ? $advogado->nome_profissional : '' }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_bi">Nº Bilhete</label>
                                                    <input type="text" maxlength="15" name="num_bi" class="form-control"
                                                        id="num_bi" value="{{ $pessoa != null ? $pessoa->num_documento : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone1">Telefone principal</label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1"
                                                        value="{{ $pessoa != null ? $pessoa->telefone1 : $patrono->telefone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone2">Telefone alternativo</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2"
                                                        value="{{ $pessoa != null ? $pessoa->telefone2 : '' }}">
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Género</label>
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="">Selecione...</option>
                                                        <option {{ $pessoa->genero == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                                        <option {{ $pessoa->genero == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_associado">Nº Associado (Nº Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_associado"
                                                        class="form-control" id="num_associado"
                                                        value="{{ $advogado != null ? $advogado->num_associado : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" maxlength="200" name="email"
                                                        class="form-control" id="email" value="{{ $pessoa != null ? $pessoa->email : $patrono->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label for="data_inscricao_oaa">Data de Inscrição Advogado</label>
                                                    <input type="date" name="data_inscricao_oaa" class="form-control"
                                                        id="data_inscricao_oaa"
                                                        value="{{ $advogado != null ? $advogado->data_inscricao_oaa : '' }}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_escritorio">Nome do Escritório</label>
                                                    <input type="text" class="form-control" maxlength="200"
                                                        id="nome_escritorio" name="nome_escritorio"
                                                        value="{{ $advogado != null ? $advogado->nome_escritorio : $patrono->nome_escritorio }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="endereco_escritorio">Endereço do
                                                        Escritório</label>
                                                    <input type="text" class="form-control" maxlength="200"
                                                        id="endereco_escritorio" name="endereco_escritorio"
                                                        value="{{ $advogado != null ? $advogado->endereco_escritorio: $patrono->endereco_escritorio }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="municipio_id">Município</label>
                                                    <select name="municipio_id" id="municipio_id"
                                                        class="form-control">
                                                        <option value="">Selecione...</option>
                                                        @foreach ($municipios as $muni)
                                                            <option {{ $advogado->municipio_id == $muni->id ? 'selected' : '' }} value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a id="btn-registar" class="btn btn-success mt-4">Salvar</a>
                                                <a href="{{ route('system.areatecnica.list_patronos') }}"
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

@section('script-aux')
    <script src="{{ asset('assets/system/js/editar-patrono.js') }}"></script>
@endsection