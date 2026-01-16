<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card card-md">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                            <path d="M10 10l.01 0" />
                            <path d="M14 10l.01 0" />
                            <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                        </svg>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Listagem dos registos de entrada</h3>
                            @if (Auth::user()->permissao_id == 2)
                            <div class="mt-3">
                                <a href="{{ route('system.secretaria.registar_entrada') }}" class="btn btn-info"
                                    rel="noopener">+ Novo Registo de Entrada +</a>
                            </div>
                            @endif
                            
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
                                        <th>Assunto</th>
                                        <th>Tipo</th>
                                        <th>Data de Entrada</th>
                                        <th>Proveniência</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->assunto}}</td>
                                            <td>{{$item->gettipoprocesso->descricao}}</td>
                                            <td>{{$item->data_entrada}}</td>
                                            <td>{{$item->proveniencia}}</td>
                                            <td>
                                                @if (Auth::user()->permissao_id == 2)
                                                    @if ($item->encaminhado == 'Não')
                                                        <a class="btn btn-primary"
                                                            href="{{ route('system.secretaria.editar_registo', $item->hash) }}">
                                                            Editar
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                             @if (Auth::user()->permissao_id == 2)
                                            <td>
                                                <a href="{{ route('system.secretaria.detalhes_registo', $item->hash) }}"
                                                    class="btn btn-info">
                                                    Detalhes
                                                </a>
                                            </td>
                                             @endif
                                              @if (Auth::user()->permissao_id == 6)
                                            <td>
                                                <a href="{{ route('system.recepcionista.detalhes_registo', $item->hash) }}"
                                                    class="btn btn-info">
                                                    Detalhes
                                                </a>
                                            </td>
                                            @endif

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
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection