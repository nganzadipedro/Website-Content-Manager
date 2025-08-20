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
                                    <h4>Editar Notícias</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                                @csrf

                                <input type="hidden" name="hash_noticia" id="hash_noticia" value="{{ $noticia->hash }}">

                                <div class="row">
                                    <div class="col-lg-8 col-12">

                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="form-group">
                                                    <label for="titulo">Título da notícia</label>
                                                    <input type="text" id="titulo" class="form-control form-control-sm"
                                                        id="titulo" value="{{ $noticia->titulo }}">
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
                                                    <textarea name="texto_completo" class="form-control"
                                                        id="texto_completo" rows="5">{{ $noticia->texto_completo }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="row mt-3">
                                            
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="categoria">Categoria</label>
                                                    <input type="text" name="categoria" id="categoria" class="form-control" value="{{ $noticia->categoria }}">
                                                </div>

                                            </div>

                                             <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label for="nome_completo">Destaque</label>
                                                    <select clang="form-control" name="e_destaque" id="e_destaque"
                                                        class="form-control">
                                                        <option value="nao" {{ $noticia->e_destaque == 'nao' ? 'selected' : '' }}>Não</option>
                                                        <option value="sim" {{ $noticia->e_destaque == 'sim' ? 'selected' : '' }}>Sim</option>
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

                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <img width="100%" src="{{ asset('storage/' . $noticia->imagem) }}" alt="" name="imagemExibida" id="imagemExibida">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 text-center">
                                    <div class="col-lg-12 col-12">
                                        <a id="btn-salvar" class="btn btn-success mt-4">Salvar Notícia</a>
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
    <script src="{{ asset('assets/system/js/editar-noticia.js') }}"></script>
@endsection