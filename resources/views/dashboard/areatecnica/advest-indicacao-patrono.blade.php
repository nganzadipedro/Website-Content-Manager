<div>

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="card card-md">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">

                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="h1">Inscrições Para Advogados Estagiários [Indicação de Patrono]</h3>
                        <div class="row mt-5">
                            <div class="col-4">

                                <a id="btn-gerar-excel" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-spreadsheet">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                                        <path d="M8 11h8v7h-8l0 -7" />
                                        <path d="M8 15h8" />
                                        <path d="M11 11v7" />
                                    </svg>Exportar em Excel</a>
                                <a id="btn-gerar-pdf" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                        <path d="M17 18h2" />
                                        <path d="M20 15h-3v6" />
                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1" />
                                    </svg>Exportar em PDF</a>

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

                            <div class="table-responsive" style="max-height: 550px; overflow: auto; padding: 5px;">
                                <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nº Processo</th>
                                            <th>Requerente</th>
                                            <th>Data de Entrada</th>
                                            <th>Acto Pretendido</th>
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
                                                <td>{{$item->getregistoentrada->data_entrada}}</td>
                                                <td>{{$item->acto_pretendido}}</td>
                                                <td>
                                                    <a style="cursor: pointer;" title="Indicar Patrono"
                                                        href="{{ route('system.areatecnica.editar_inscricao', $item->getregistoentrada->hash) }}"
                                                        class="badge bg-yellow-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                            <path d="M13.5 6.5l4 4" />
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-id="{{ $item->id }}" class="badge bg-blue-lt btn-detalhes"
                                                        title="Detalhes do processo" style="cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#modal-detalhes">
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
                                                    <a data-id="{{ $item->registo_entrada_id }}"
                                                        class="btn-historico badge bg-yellow-lt"
                                                        title="Histórico do processo" style="cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#modal-historico">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-history">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 8l0 4l2 2" />
                                                            <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
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

        <div class="modal modal-blur fade" id="modal-historico" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Histórico do Processo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-group-flush list-group-hoverable" id="list-group-item">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-detalhes" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes do Processo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class=" alert alert-primary" id="dv-detalhes"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @section('script-aux')
        <script src=" {{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('assets/system/js/advest-indicacao-patrono.js') }}"></script>
        <script>
            window.avatarUrl = "{{ asset('images/user-icon.png') }}";
            $(document).ready(function () {
                $('#myTable').DataTable({
                    paging: false, // Desabilita a paginação
                    searching: true // Habilita a barra de pesquisa
                });
            });
        </script>
    @endsection