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
                        Editar Notícia
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
                            <h4 class="card-title">Editar Notícia</h4>
                        </div>
                        <div class="card-body">

                            @csrf

                            <input type="hidden" name="hash_noticia" id="hash_noticia" value="{{ $noticia->hash }}">



                            <div class="row">
                                <div class="col-lg-8 col-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="titulo">Título da notícia</label>
                                                <input type="text" id="titulo" class="form-control" id="titulo"
                                                    value="{{ $noticia->titulo }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="texto_resumo">Texto de resumo</label>
                                                <textarea name="texto_resumo" class="form-control" id="texto_resumo"
                                                    rows="3">{{ $noticia->texto_resumo }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="texto_completo">Corpo da notícia</label>
                                                <textarea name="texto_completo" class="form-control" id="texto_completo"
                                                    rows="5">{{ $noticia->texto_completo }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-3">

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="categoria">Categoria</label>
                                                <input type="text" name="categoria" id="categoria" class="form-control"
                                                    value="{{ $noticia->categoria }}">
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="nome_completo">Destaque</label>
                                                <select name="e_destaque" id="e_destaque" class="form-select">
                                                    <option value="nao" {{ $noticia->e_destaque == 'nao' ? 'selected' : '' }}>Não</option>
                                                    <option value="sim" {{ $noticia->e_destaque == 'sim' ? 'selected' : '' }}>Sim</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="imagem">Imagem</label>
                                                <input type="file" name="imagem" id="imagem" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label for="anexo_pdf">Anexo PDF (Opcional)</label>
                                                <input type="file" name="anexo_pdf" id="anexo_pdf" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <img width="100%"
                                                src="{{ asset('application/storage/app/public/' . $noticia->imagem) }}"
                                                alt="{{ $noticia->titulo }}" name="imagemExibida" id="imagemExibida">
                                        </div>
                                    </div>
                                    @if ($noticia->anexo_pdf)
                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <!-- <iframe width="100%" height="400px" src="{{ asset('storage/' . $noticia->anexo_pdf) }}" frameborder="0"></iframe> -->
                                                <iframe width="100%" height="400px" src="{{ asset('application/storage/app/public/' . $noticia->anexo_pdf) }}" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-lg-12 col-12">
                                    <a id="btn-salvar" class="btn btn-success mt-4">Salvar Actualizações</a>
                                    <a href="{{ route('listnoticia') }}" class="btn btn-danger mt-4">Cancelar</a>
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
    <script src="{{ asset('assets/system/js/editar-noticia.js') }}"></script>
@endsection