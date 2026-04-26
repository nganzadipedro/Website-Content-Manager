<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Editar Inscrição de Advogados
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
                                    Editar Inscrição de Advogados
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <!-- <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                <button class="btn">Nº Processo <span
                                                        class="badge bg-azure text-azure-fg ms-2">{{ $registo->codigo }}</span></button>
                                            </div>
                                        </div> -->

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
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <input type="hidden" value="{{ $inscricao->id }}" id="inscricao_id"
                                                name="inscricao_id">

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="" selected>Não Definido</option>
                                                        <option {{ $inscricao->sexo == 'Masculino' ? 'selected' : '' }}
                                                            value="Masculino">Masculino</option>
                                                        <option {{ $inscricao->sexo == 'Feminino' ? 'selected' : '' }}
                                                            value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="telefone1">Telefone 1</label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1"
                                                        value="{{ $inscricao->telefone1 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="telefone2">Telefone 2</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2"
                                                        value="{{ $inscricao->telefone2 }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xl-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" maxlength="255" name="email"
                                                        class="form-control" id="email" value="{{ $inscricao->email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xl-6">
                                                <div class="form-group">
                                                    <label for="observacao2">Observação</label>
                                                    <input type="text" maxlength="255" name="observacao2"
                                                        class="form-control" id="observacao2"
                                                        value="{{ $inscricao->observacao }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a id="btn-registar-inscricao" class="btn btn-success mt-4">Salvar</a>
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
    <script src="{{ asset('assets/system/js/editar-inscricao.js') }}"></script>
@endsection