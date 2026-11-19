<div>

    <style>
        .obs {
            background-color: red;
            color: white;
            display: block;
            padding: 3px;
            border-radius: 5px;
            margin-top: 3px;
        }
    </style>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ $registo->tipo_processo_id == 2 ? 'Registar Inscrição de Advogados' : 'Registar Inscrição de Advogados Estagiários' }}
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
                                <h4 class="card-title">
                                    {{ $registo->tipo_processo_id == 2 ? 'Registar Inscrição de Advogados' : 'Registar Inscrição de Advogados Estagiários' }}
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="alert alert-primary mt-3">
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p>
                                                        Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                        Requerente: {{ $registo->proveniencia }}<br>
                                                        <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                        Data de Entrada: {{ $registo->data_entrada }}<br>
                                                        Data de Registo na Secretaria: {{ $registo->created_at }}<br>
                                                        Tipo de Processo:
                                                        {{ $registo->tipo_processo_id == 9 ? $registo->outro_tipo_processo : $registo->gettipoprocesso->descricao }}
                                                        <br>
                                                    </p>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p>
                                                        Tipo de documento: {{ $registo->tipo_documento }}<br>
                                                        Estado: {{ $registo->estado }}<br>
                                                        Destinatário: {{ $registo->destinatario }}<br>
                                                        Encaminhado: {{ $registo->encaminhado }}<br>
                                                        @if($registo->observacao != null && $registo->observacao != '')
                                                            <span class="obs">{{ $registo->observacao }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <input type="hidden" value="{{ $registo->tipo_processo_id }}"
                                                id="tipo_processo_id" name="tipo_processo_id">
                                            <input type="hidden" value="{{ $registo->id }}" id="registo_entrada_id"
                                                name="registo_entrada_i">

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="sexo">Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-select">
                                                        <option value="" selected>Não Definido</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone1">Telefone 1</label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone2">Telefone 2</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2" value="">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-lg-4 col-12 col-md-4 col-sm-12 col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" maxlength="255" name="email"
                                                        class="form-control" id="email" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_bilhete">Nº Bilhete</label>
                                                    <input type="text" maxlength="15" name="num_bilhete"
                                                        class="form-control" id="num_bilhete" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12 col-md-4 col-sm-12 col-xl-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="codigo_validacao">Código de
                                                        Validação (Declaração FIO)</label>
                                                    <input type="text" maxlength="15" name="codigo_validacao"
                                                        class="form-control" id="codigo_validacao" value="">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="observacao2">Observação</label>
                                                    <input type="text" maxlength="255" name="observacao2"
                                                        class="form-control" id="observacao2" value="">
                                                </div>
                                            </div>
                                        </div>

                                        @if ($registo->tipo_processo_id == 3)
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="acto_pretendido">Acto Pretendido</label>
                                                        <select name="acto_pretendido" id="acto_pretendido"
                                                            class="form-control">
                                                            <option selected>Não Definido</option>
                                                            <option value="Inscrição" selected>Inscrição</option>
                                                            <option value="Reinscrição">Reinscrição</option>
                                                            <option value="Indicação de Patrono">Indicação de Patrono
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <h3 class="text-center mt-4">Zona de Validação da Declaração da Formação Inicial
                                            Obrigatória</h3>

                                        <div class="row text-center">
                                            <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                                <h3 id="vals" class="alert alert-success">A declaração foi validada com
                                                    sucesso</h3>
                                                <h3 id="valerr" class="alert alert-danger">A declaração não é válida
                                                </h3>

                                            </div>

                                        </div>


                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a id="btn-validar-declaracao" class="btn btn-primary mt-4">Validar
                                                    Declaração</a>
                                                <a id="btn-registar-inscricao" class="btn btn-success mt-4">Salvar Registo</a>
                                                <a href="{{ route('system.areatecnica.listar_advogados_pendentes') }}"
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
    <script src="{{ asset('assets/system/js/registar-inscricao.js') }}"></script>
@endsection