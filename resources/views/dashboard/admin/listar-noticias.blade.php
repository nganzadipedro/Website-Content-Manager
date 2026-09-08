<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Listagem das notícias</h3>
                            <div class="markdown text-secondary">
                                Encontre na tabela abaixo a lista de todas as notícias cadastradas no sistema.
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('cadnoticia') }}" class="btn btn-info" rel="noopener">Cadastrar nova
                                    notícia</a>
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
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Destaque</th>
                                        <th>Categoria</th>
                                        <th>Views</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista_noticias as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->titulo}}</td>
                                            <td>{{$item->e_destaque}}</td>
                                            <td>{{$item->categoria}}</td>
                                            <td>{{$item->views}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('editnoticia', $item->hash) }}">
                                                    Editar
                                                </a>
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
    <script src="{{ asset('assets/system/js/listar-noticia.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection