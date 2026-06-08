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
                        Adicionar Imagem ao Carrossel
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
                            <h4 class="card-title">Adicionar Imagem ao Carrossel</h4>
                        </div>
                        <div class="card-body">

                            @csrf

                            <div class="row">
                                <div class="col-lg-8 col-12">

                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="titulo" class="form-label">Título da imagem</label>
                                                <input type="text" id="titulo" class="form-control" id="titulo"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <div class="form-group">
                                                <label for="imagem" class="form-label">Imagem (1920 x 700)</label>
                                                <input type="file" name="imagem" id="imagem" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12 col-12">
                                            <a id="btn-salvar" class="btn btn-success mt-4">Salvar Imagem</a>
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
    <script src="{{ asset('assets/system/js/cadastrar-imagem-carrossel.js') }}"></script>
@endsection