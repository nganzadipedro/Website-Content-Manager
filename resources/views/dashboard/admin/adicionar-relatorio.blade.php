<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Adicionar Relatório Financeiro
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('manage_website') }}" class="btn btn-warning">
                            Gerenciar Website
                        </a>
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
                    <form action="https://httpbin.org/post" method="post" class="card">
                        <div class="card-header">
                            <h4 class="card-title">Adicionar Relatório Financeiro</h4>
                        </div>
                        <div class="card-body">

                            @csrf

                            <div class="row">
                                <div class="col-lg-12 col-12">

                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="descricao">Descrição</label>
                                                <input type="text" id="descricao" class="form-control" id="descricao"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12">
                                            <div class="form-group">
                                                <label for="ano">Ano</label>
                                                <input name="ano" class="form-control" id="ano">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12">
                                            <div class="form-group">
                                                <label for="trimestre">Trimestre</label>
                                                <input name="trimestre" class="form-control" id="trimestre">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-lg-3 col-12">
                                            <div class="form-group">
                                                <label for="categoria">Categoria</label>
                                                <select name="categoria" id="categoria" class="form-select">
                                                    <option value="Relatório de Gestão" selected>Relatório de Gestão</option>
                                                    <option value="Balancete">Balancete</option>
                                                    <option value="Demonstração Financeira">Demonstração Financeira</option>
                                                    <option value="Relatório de Actividades">Relatório de Actividades</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="documento_anexo">Documento PDF</label>
                                                <input type="file" name="documento_anexo" id="documento_anexo"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <a id="btn-salvar" class="btn btn-success mt-4">Salvar</a>
                                            <a href="{{ route('listnoticia') }}"
                                                class="btn btn-danger mt-4">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <script src="{{ asset('assets/system/js/adicionar-relatorio.js') }}"></script>
@endsection