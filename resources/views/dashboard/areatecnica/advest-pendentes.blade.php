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
                            <h3 class="h1">Inscrições Para Advogados Estagiários Pendentes</h3>
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
                                        <th>Nº Proc. Secretaria</th>
                                        <th>Assunto</th>
                                        <th>Data de Entrada</th>
                                        <th>Requerente</th>
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
                                            <td>{{$item->data_entrada}}</td>
                                            <td>{{$item->proveniencia}}</td>
                                            <td>
                                                <a href="{{ route('system.areatecnica.registar_inscricao', $item->hash) }}"
                                                    class="btn btn-success">
                                                    Registar
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('system.areatecnica.detalhes_registo', $item->hash) }}"
                                                    class="btn btn-info">
                                                    Detalhes
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
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection