<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Emitir Documento de Assistência Jurídica
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
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Emitir Documento de Assistência Jurídica</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        @if (count($this->advogado_atribuido) > 0)
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <div class="alert alert-primary">
                                                        <p class="detalhes">
                                                            Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                            Requerente: {{ $registo->proveniencia }}<br>
                                                            <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                            Data de Entrada: {{ $registo->data_entrada }}<br>
                                                            Data de Registo na Secretaria:
                                                            {{ $registo->created_at }}<br>
                                                            Tipo de Processo:
                                                            {{ $registo->gettipoprocesso->descricao }}<br>
                                                            Tipo de Indicação:
                                                            {{ $registo->tipo_indicacao }}<br>
                                                            Tipo de Situação:
                                                            {{ $registo->tipo_situacao_assistencia }}<br>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <div class="alert alert-primary">
                                                        <h4>Advogados/Advogados Estagiários Indicados</h4>
                                                        @foreach ($advogado_atribuido as $advs)
                                                            <p class="detalhes mb-3">
                                                                Nome: {{ $advs->getadvogado->getpessoa->nome }}<br>
                                                                Telefone:
                                                                {{ $advs->getadvogado->getpessoa->telefone1 }}/{{ $advs->getadvogado->getpessoa->telefone2 }}<br>
                                                                Categoria: {{ $advs->getadvogado->categoria }}<br>
                                                            </p>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (count($this->advogado_atribuido) == 0)
                                            <div class="row mt-3">
                                                <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                    <div class="alert alert-danger mt-3 text-center">
                                                        <h3>Não foram indicados advogados ou advogados estagiários para este
                                                            processo</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (count($this->advogado_atribuido) > 0)
                                            <div class="row mt-3">

                                                @if($this->registo->tipo_indicacao == null)
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="tipo_indicacao" class="form-label">Tipo de
                                                                Indicação</label>
                                                            <select class="form-select" name="tipo_indicacao"
                                                                id="tipo_indicacao">
                                                                <option value="" selected>Selecione...</option>
                                                                <option value="Auto-Indicação">Auto-Indicação</option>
                                                                <option value="Indicação-Conselheiro">Indicação-Conselheiro
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($this->registo->tipo_situacao_assistencia == null)
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="tipo_situacao_assistencia" class="form-label">Tipo de
                                                                Situação</label>
                                                            <select class="form-select" name="tipo_situacao_assistencia"
                                                                id="tipo_situacao_assistencia">
                                                                <option value="" selected>Selecione...</option>
                                                                <option value="Solicitação do Cidadão">Solicitação do Cidadão
                                                                </option>
                                                                <option value="Advogado Solicita Permissão de Intervenção">
                                                                    Advogado Solicita Permissão de Intervenção</option>
                                                                <option value="Solicitação de Instituição">Solicitação de
                                                                    Instituição</option>
                                                                <option value="Substituição de Advogado">Substituição de
                                                                    Advogado</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-lg-4 col-12 col-md-4">
                                                    <div class="form-group" id="insitituicao_copia_field">
                                                        <label for="insitituicao_copia" class="form-label">Instituição em
                                                            cópia</label>
                                                        <input type="text" id="insitituicao_copia" name="insitituicao_copia"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-3">


                                                <div class="col-lg-4 col-12 col-md-4">
                                                    <div class="form-group" id="requerente_field">
                                                        <label for="requerente" class="form-label">Nome do
                                                            Requerente</label>
                                                        <input type="text" id="requerente" name="requerente"
                                                            class="form-control">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-12">
                                                    <a id="btn-salvar" class="btn btn-success mt-4">Emitir Documento</a>
                                                    <a href="{{ route('system.secretaria.dashboard') }}"
                                                        class="btn btn-danger mt-4">Cancelar</a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <input type="hidden" id="tipo_indicacao_p" value="{{ $registo->tipo_indicacao }}">
                            <input type="hidden" id="registoentrada_id_p" value="{{ $registo->id }}">
                            <input type="hidden" id="registoentrada_hash_p" value="{{ $registo->hash }}">
                            <input type="hidden" id="tipo_situacao_assistencia_p"
                                value="{{ $registo->tipo_situacao_assistencia }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <script src="{{ asset('assets/system/js/emitir-documento-assistencia.js') }}"></script>
@endsection