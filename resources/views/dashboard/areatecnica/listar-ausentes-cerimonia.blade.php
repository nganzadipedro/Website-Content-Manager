<div>

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Lista de {{$categoria_nome}} ausentes na cerimónia</h3>
                                <a id="btn-recepcao-cedula" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-certificate">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 15a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                                        <path
                                            d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                                        <path d="M6 9l12 0" />
                                        <path d="M6 12l3 0" />
                                        <path d="M6 15l2 0" />
                                    </svg>Recepção da Cédula</a>
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
                                            <th>
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Categoria</th>
                                            <th>Nº Cédula</th>
                                            <th>Nº Bilhete</th>
                                            <th>Data Cerimónia</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista_advogados as $item)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>
                                                    <input type="checkbox" class="checkItem" value="{{$item->id}}">
                                                </td>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->getpessoa->nome}}</td>
                                                <td>{{$item->categoria}}</td>
                                                <td>{{$item->categoria == 'Advogado' ? $item->num_associado : $item->num_estagiario}}
                                                </td>
                                                <td>{{$item->getpessoa->num_documento}}</td>
                                                <td>{{$item->categoria == 'Advogado' ? $item->data_cerimonia_associado : $item->data_cerimonia_estagiario}}</td>
                                                <td>
                                                    <a title="Detalhes do Registo" data-id="{{ $item->id }}"
                                                        style="cursor: pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#modal-detalhes"
                                                        class="badge bg-blue-lt btn-detalhes">
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

        <div class="modal modal-blur fade" id="modal-detalhes" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes do advogado/advogado estagiário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row"">
                        <div class=" alert alert-primary" id="dv-detalhes"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-cerimonia" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recepção da Cédula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="advogado_id" id="advogado_id" value="">

                    <div class=" alert alert-primary" id="dv-detalhes-2"></div>

                    <div class="mb-3">
                        <label class="form-label">Data da Cerimónia</label>
                        <input type="date" class="form-control" name="data_cerimonia" id="data_cerimonia">
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-cerimonia" class="btn btn-success mt-4">Salvar</a>
                        <a id="btn-cancelar" class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-cerimonia-grupo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recepção da Cédula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Data da Cerimónia</label>
                                <input type="date" class="form-control" name="data_cerimonia_grupo"
                                    id="data_cerimonia_grupo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estiveram presentes?</label>
                                <select name="presente_ausente_grupo" id="presente_ausente_grupo" class="form-select">
                                    <option selected value="presente">Sim, estiveram presentes</option>
                                    <option value="ausente">Não, estiveram ausentes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-cerimonia-grupo" class="btn btn-success mt-4">Salvar</a>
                        <a id="btn-cancelar-grupo" class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

</div>


@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/lista-ausentes-cerimonia.js') }}"></script>
    <script>
        $('#myTable').DataTable({
            paging: false, // Desabilita a paginação
            searching: true, // Habilita a barra de pesquisa
            ordering: false
        });
    </script>
@endsection