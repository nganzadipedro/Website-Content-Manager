<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card card-md">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">

                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Mapa de Distribuição dos Processos de Inscrição</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nº Processo</th>
                                        <th>Requerente</th>
                                        <th>Estado</th>
                                        <th>Conselheiro</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->getregistoentrada->proveniencia}}</td>
                                            <td>{{$item->estado_distribuicao}}</td>
                                            <td>{{$item->conselheiro_id == null ? 'Não Atribuido' : $item->getconselheiro->getpessoa->nome}}</td>
                                            <td>
                                                <a data-id="{{ $item->id }}"
                                                    data-requerente="{{ $item->getregistoentrada->proveniencia }}"
                                                    data-entrada="{{ $item->getregistoentrada->data_entrada }}"
                                                    class="btn-distribuir" style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-report">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-forward-up-double">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M11 14l4 -4l-4 -4" />
                                                        <path d="M16 14l4 -4l-4 -4" />
                                                        <path d="M15 10h-7a4 4 0 1 0 0 8h1" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('system.areatecnica.detalhes_registo', $item->getregistoentrada->hash) }}"
                                                    class="badge bg-blue-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-align-box-left-middle">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14" />
                                                        <path d="M9 15h-2" />
                                                        <path d="M13 12h-6" />
                                                        <path d="M11 9h-4" />
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

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados de Distribuição</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="inscricao_id" id="inscricao_id" value="">
                    <div class="mb-3">
                        <label class="form-label">Nome do Requerente</label>
                        <input type="text" class="form-control" name="requerente" id="requerente" disabled value="">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de Entrada</label>
                                <input type="date" class="form-control" name="data_entrada" id="data_entrada" disabled>
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de Levantamento</label>
                                <input type="date" class="form-control" name="data_levantamento_distribuicao"
                                    id="data_levantamento_distribuicao">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="conselheiro_id">Conselheiro</label>
                        <select name="conselheiro_id" id="conselheiro_id" class="form-control">
                            <option selected>Não definido</option>
                            @foreach ($lista_conselheiros as $conselheiro)
                                <option value="{{ $conselheiro->id }}">{{ $conselheiro->getpessoa->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Entrega</label>
                        <input type="date" class="form-control" name="data_entrega_distribuicao"
                            id="data_entrega_distribuicao">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observação</label>
                        <input type="text" class="form-control" name="observacao_distribuicao"
                            id="observacao_distribuicao">
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-distribuicao" class="btn btn-success mt-4">Salvar</a>
                        <a href="{{ route('system.areatecnica.listar_advogados_registados') }}"
                            class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/mapa-distribuicao.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection