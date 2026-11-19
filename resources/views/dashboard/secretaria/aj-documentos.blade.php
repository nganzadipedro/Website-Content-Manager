<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Pedidos de Assistência Emitidos</h3>
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
                                        <th>Referência</th>
                                        <th>Assunto</th>
                                        <th>Tipo de Processo</th>
                                        <th>Requerente</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $item)
                                        @if ($this->tem_advogados($item->getregisto->id) == 'true')
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$item->getregisto->codigo}}</td>
                                                <td>{{$item->codigo}}</td>
                                                <td>{{$item->getregisto->assunto}}</td>
                                                <td>{{$item->getregisto->gettipoprocesso->descricao}}</td>
                                                <td>{{$item->getregisto->proveniencia}}</td>
                                                <td>
                                                    @if (Auth::user()->id == 1)
                                                        <a href="{{ route('system.secretaria.atribuir_advogado', $item->getregisto->hash) }}"
                                                            class="badge bg-blue-lt" title="Alterar Indicação">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-switch-2">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M3 17h5l1.67 -2.386m3.66 -5.227l1.67 -2.387h6" />
                                                                <path d="M18 4l3 3l-3 3" />
                                                                <path d="M3 7h5l7 10h6" />
                                                                <path d="M18 20l3 -3l-3 -3" />
                                                            </svg>
                                                        </a>
                                                    @endif
                                                    <a data-id="{{ $item->hash }}" class="btn-preview badge bg-green-lt"
                                                        title="Visualizar Documento" style="cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                                            <path d="M17 18h2" />
                                                            <path d="M20 15h-3v6" />
                                                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1" />
                                                        </svg>
                                                    </a>
                                                    <a data-id="{{ $item->hash }}" class="btn-delete badge bg-red-lt"
                                                        title="Eliminar Documento" style="cursor: pointer;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
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
    <script src="{{ asset('assets/system/js/aj-documentos.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection