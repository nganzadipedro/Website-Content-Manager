@section('css-aux')
    <link href="{{ asset('assets/template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div>

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Adicionar Imagens na Galeria</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            @csrf

                            <div class="row">
                                <div class="col-lg-6 col-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="titulo">Título</label>
                                                <input type="text" name="titulo" class="form-control form-control-sm"
                                                    id="titulo" value="">
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
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('assets/system/js/cadastrar-galeria.js') }}"></script>
@endsection