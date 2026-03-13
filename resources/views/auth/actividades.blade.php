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
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Actividades do usuário no sistema</h3>
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
                                            <th>Operação</th>
                                            <th>Data e Hora</th>
                                            <th>Usuário</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($lista as $item)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$item->operacao}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>{{Auth::user()->getpessoa->nome}}</td>
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

</div>
@section('script-aux')
    <script src=" {{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true // Habilita a barra de pesquisa
            });
        });
    </script>
@endsection