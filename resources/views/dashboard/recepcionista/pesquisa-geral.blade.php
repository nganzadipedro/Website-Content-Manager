<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Pesquisa geral de inscrições para advogados e advogados estagiários</h3>
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
                                        <th>Tipo Processo</th>
                                        <th>Data de Entrada</th>
                                        <th>Estado</th>
                                        <th>Despacho</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item[0]}}</td>
                                            <td>{{$item[1]}}</td>
                                            <td>{{$item[2]}}</td>
                                            <td>{{$item[3]}}</td>
                                            <td>{{$item[4]}}</td>
                                            <td>{{$item[5]}}</td>
                                            <td>
                                                <a data-id="{{ $item[6] }}" class="badge bg-blue-lt btn-detalhes"
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
                                                <a data-id="{{ $item[6] }}" class="btn-historico badge bg-yellow-lt"
                                                    title="Histórico do processo" style="cursor: pointer;"
                                                    data-bs-toggle="modal" data-bs-target="#modal-historico">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
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
        <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes do Processo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <h3 class="text-center">Dados da Secretaria</h3>
                            <div class=" alert alert-primary" id="dv-detalhes1">

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <h3 class="text-center">Outras Informações</h3>
                            <div class=" alert alert-info" id="dv-detalhes2">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>



@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/recepcionista-pesquisa-geral.js') }}"></script>
    <script>
        window.avatarUrl = "{{ asset('images/user-icon.png') }}";
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection