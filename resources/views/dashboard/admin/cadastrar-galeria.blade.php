<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Adicionar imagem na galeria
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
                            <h4 class="card-title">Adicionar imagem na galeria</h4>
                        </div>
                        <div class="card-body">

                            @csrf

                            <div class="row">
                                <div class="col-lg-6 col-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="titulo">Título</label>
                                                <input type="text" name="titulo" class="form-control" id="titulo"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="nome_completo">Categoria</label>
                                                <select clang="form-control" name="categoria" id="categoria"
                                                    class="form-control">
                                                    <option value="institucional" selected>Institucional</option>
                                                    <option value="responsabilidade social">Responsabilidade Social
                                                    </option>
                                                    <option value="eventos">Eventos</option>
                                                    <option value="formações">Formações</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="imagem">Imagem</label>
                                                <input type="file" name="imagem" id="imagem" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <a id="btn-salvar" class="btn btn-success mt-4">Salvar Imagem</a>
                                            <a href="{{ route('listgaleria') }}"
                                                class="btn btn-danger mt-4">Cancelar</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <img width="100%" src="https://placehold.net/default.png" alt=""
                                                name="imagemExibida" id="imagemExibida">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success ms-auto">Enviar dados</button>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <script src="{{ asset('assets/system/js/cadastrar-galeria.js') }}"></script>
@endsection