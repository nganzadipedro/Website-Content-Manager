<div class="page-wrapper">
    <!-- Page header -->
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
                            <h3 class="h1">Listagem das denúncias e reclamações pendentes</h3>
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
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Assunto</th>
                                        <th>Estado</th>
                                        <th class="no-content"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista_denuncias as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->nome}}</td>
                                            <td>{{$item->assunto}}</td>
                                            <td>{{$item->estado}}</td>
                                            <td>
                                                <span>
                                                    <a href="{{ route('system.admin.detalhesdenuncia', $item->hash) }}"
                                                        class="btn btn-primary">
                                                        Detalhes
                                                    </a>
                                                </span>
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