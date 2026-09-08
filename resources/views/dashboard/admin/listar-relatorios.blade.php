<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Listagem dos relatórios financeiros</h3>
                            <div class="markdown text-secondary">
                                Encontre na tabela abaixo a lista de todos os relatórios financeiros carregados no sistema.
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('cadrelatorio') }}" class="btn btn-info" rel="noopener">Cadastrar novo
                                    relatório</a>
                                <a href="{{ route('manage_website') }}" class="btn btn-warning" target="_blank"
                                    rel="noopener">Gerenciar Website</a>
                            </div>
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
                                        <th>Descrição</th>
                                        <th>Trimestre</th>
                                        <th>Categoria</th>
                                        <th>Ano</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->descricao}}</td>
                                            <td>{{$item->trimestre}}</td>
                                            <td>{{$item->categoria}}</td>
                                            <td>{{$item->ano}}</td>
                                            <td>
                                                <a data-id="{{ $item->id }}" class="btn btn-danger delete-news">
                                                    Eliminar
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
    <script src="{{ asset('assets/system/js/listar-relatorios.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection