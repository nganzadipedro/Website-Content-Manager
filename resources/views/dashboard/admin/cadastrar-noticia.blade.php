@section('css-aux')

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/yi1vu2xffwe71q0zslc61jlmvrtyrpkku759py80ne0x7sz1/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: '#texto_completo',
            plugins: 'anchor autolink charmap codesample emoticons link lists searchreplace visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link | numlist bullist | emoticons | removeformat',
        });
    </script>

@endsection

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Cadastrar Notícias
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
                            <h4 class="card-title">Cadastrar Notícia</h4>
                        </div>
                        <div class="card-body">

                            @csrf

                            <div class="row">
                                <div class="col-lg-8 col-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="titulo">Título da notícia</label>
                                                <input type="text" id="titulo" class="form-control"
                                                    id="titulo" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="texto_resumo">Texto de resumo</label>
                                                <textarea name="texto_resumo" class="form-control" id="texto_resumo"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="texto_completo">Corpo da notícia</label>
                                                <textarea name="texto_completo" class="form-control" id="texto_completo"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-3">

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="categoria">Categoria</label>
                                                <input type="text" name="categoria" id="categoria" class="form-control">
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="nome_completo">Destaque</label>
                                                <select clang="form-control" name="e_destaque" id="e_destaque"
                                                    class="form-control">
                                                    <option value="nao" selected>Não</option>
                                                    <option value="sim">Sim</option>
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
                                            <a id="btn-salvar" class="btn btn-success mt-4">Salvar Notícia</a>
                                            <a href="{{ route('listnoticia') }}"
                                                class="btn btn-danger mt-4">Cancelar</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <img width="100%" src="https://placehold.net/default.png" alt=""
                                                name="imagemExibida" id="imagemExibida">
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
    <script src="{{ asset('assets/system/js/cadastrar-noticia.js') }}"></script>
@endsection