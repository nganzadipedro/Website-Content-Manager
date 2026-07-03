<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Gerar Relatórios
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card">
                            <div class="card-header">
                                <h4 class="card-title">Gerar Relatórios</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12 col-sm-3">
                                        <label for="data_inicial" class="form-label">Data Inicial</label>
                                        <input type="date" name="data_inicial" id="data_inicial" class="form-control">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3 col-12 col-sm-3">
                                        <label for="data_final" class="form-label">Data Final</label>
                                        <input type="date" name="data_final" id="data_final" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-12 col-12">
                                        <a id="btn-gerar" class="btn btn-success mt-4">Buscar
                                            Informações</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('script-aux')
    <script src="{{ asset('assets/system/js/gerar-relatorio.js') }}"></script>
@endsection