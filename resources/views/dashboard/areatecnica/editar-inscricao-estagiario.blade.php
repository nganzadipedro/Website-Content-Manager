<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ $registo->tipo_processo_id == 2 ? 'Editar Inscrição de Advogados' : 'Editar Inscrição de Advogados Estagiários' }}
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
                                    {{ $registo->tipo_processo_id == 2 ? 'Editar Inscrição de Advogados' : 'Editar Inscrição de Advogados Estagiários' }}
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" value="{{ $inscricao->patrono_id }}" id="patrono_id">

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
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <input type="hidden" value="{{ $registo->tipo_processo_id }}"
                                                id="tipo_processo_id" name="tipo_processo_id">
                                            <input type="hidden" value="{{ $registo->id }}" id="registo_entrada_id"
                                                name="registo_entrada_i">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_bilhete">Nº Bilhete</label>
                                                    <input type="text" maxlength="20" name="num_bilhete"
                                                        class="form-control" id="num_bilhete" value="{{ $inscricao->num_bilhete }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Género</label>
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="" selected>Selecione...</option>
                                                        <option {{ $inscricao->sexo == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                                        <option {{ $inscricao->sexo == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone1">Telefone 1</label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1"
                                                        value="{{ $inscricao->telefone1 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone2">Telefone 2</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2"
                                                        value="{{ $registo->telefone2 }}">
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
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="acto_pretendido">Acto Pretendido</label>
                                                    <select name="acto_pretendido" id="acto_pretendido"
                                                        class="form-control">
                                                        <option value="">Selecione...</option>
                                                        <option {{ $inscricao->acto_pretendido == 'Inscrição' ? 'selected' : '' }} value="Inscrição">Inscrição</option>
                                                        <option {{ $inscricao->acto_pretendido == 'Reinscrição' ? 'selected' : '' }} value="Reinscrição">Reinscrição</option>
                                                        <option {{ $inscricao->acto_pretendido == 'Indicação de Patrono' ? 'selected' : '' }} value="Indicação de Patrono">Indicação de Patrono
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3 mt-3">
                                                <div class="form-group">
                                                    <a href="#" style="cursor: pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#modal-patronos"
                                                        class="btn btn-primary">Escolher Patrono</a>
                                                    <a id="btn-novo-patrono" style="cursor: pointer;"
                                                        class="btn btn-info">Novo Patrono</a>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_patrono">Nome do patrono</label>
                                                    <input type="text" value="{{ $patrono->getadvogado->getpessoa->nome }}" class="form-control" maxlength="200"
                                                        id="nome_patrono" name="nome_patrono">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_cedula_patrono">Nº Cédula</label>
                                                    <input type="text" class="form-control" maxlength="9"
                                                        id="num_cedula_patrono" value="{{ $patrono->getadvogado->num_associado }}" name="num_cedula_patrono">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="tel_patrono">Telefone do patrono</label>
                                                    <input type="text" class="form-control" maxlength="9"
                                                        id="tel_patrono" value="{{ $patrono->getadvogado->getpessoa->telefone1 }}" name="tel_patrono">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="email_patrono">Email do patrono</label>
                                                    <input type="email" class="form-control" maxlength="200"
                                                        id="email_patrono" value="{{ $patrono->getadvogado->getpessoa->email }}" name="email_patrono">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_escritorio">Nome do Escritório</label>
                                                    <input type="text" class="form-control" maxlength="200"
                                                        id="nome_escritorio" value="{{ $patrono->getadvogado->nome_escritorio }}" name="nome_escritorio">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="endereco_escritorio_est">Endereço do Escritório</label>
                                                    <input type="text" value="{{ $patrono->getadvogado->endereco_escritorio }}" class="form-control" maxlength="200"
                                                        id="endereco_escritorio_est" name="endereco_escritorio_est">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="municipio_id_est">Município</label>
                                                    <select name="municipio_id_est" id="municipio_id_est"
                                                        class="form-control">
                                                        <option value="" selected>Selecione...</option>
                                                        @foreach ($municipios as $muni)
                                                            <option {{ $patrono->getadvogado->municipio_id == $muni->id ? 'selected' : '' }} value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xl-6">
                                                <div class="form-group">
                                                    <label for="observacao2">Observação</label>
                                                    <input type="text" name="observacao2"
                                                        class="form-control" id="observacao2" value="{{ $inscricao->observacao }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-12 col-md-2 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label for="num_estagiarios">Nº Estagiários</label>
                                                    <input type="text" maxlength="10" disabled name="num_estagiarios"
                                                        class="form-control" id="num_estagiarios" value="{{ count($patrono->estagiarios) }}">
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
                            <!-- <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success ms-auto">Enviar dados</button>
                            </div>
                        </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-patronos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lista de Patronos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row"">
                        <div class=" table-responsive">
                        <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patronos as $item)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>

                                        <td>{{$item->advogado_id == null ? $item->nome : $item->getadvogado->getpessoa->nome}}
                                        </td>
                                        <td>
                                            <a title="Adicionar" data-id="{{ $item->id }}"
                                                class="btn-adicionar badge bg-blue-lt" style="cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/editar-inscricao-estagiario.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection