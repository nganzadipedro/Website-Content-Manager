<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta name="author" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Galeria</title>

    <!-- Links para arquivos CSS externos -->
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/gallery.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="gallery-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Galeria CPL</h3>
                    <h4>Momentos que marcam o nosso percurso</h4>
                </div>
            </div>
        </section>

        <!-- Conteúdo principal da galeria de imagens -->
        <main class="main-content">

            <!-- Contêiner de botões de categoria -->
            <div class="category-buttons">
                <button class="category-button active" data-category="all">Todas as Imagens</button>
                <button class="category-button" data-category="institucional">Institucional</button>
                <button class="category-button" data-category="responsabilidade-social">Responsabilidade Social</button>
                <button class="category-button" data-category="formacoes">Formações</button>
                <button class="category-button" data-category="eventos">Eventos</button>
            </div>

            <!-- Contêiner da galeria de imagens -->
            <div class="gallery-container" id="galleryContainer">

                @foreach ($institucional as $item)
                    <div class="image-card" data-category="institucional">
                        <img data-id="{{ $item->hash }}" src="{{ asset('application/storage/app/public/' . $item->imagem) }}" alt="{{$item->titulo}}">
                        <div class="image-card-overlay">
                            <span class="view-icon">&#128065;</span>
                        </div>
                        <div class="image-info">
                            <p>{{$item->titulo}}</p>
                        </div>
                    </div>
                @endforeach


                <!--RESPONSABILIDADE SOCIAL-->
                @foreach ($resp_social as $item)
                    <div class="image-card" data-category="responsabilidade-social">
                        <img data-id="{{ $item->hash }}" src="{{ asset('application/storage/app/public/' . $item->imagem) }}" alt="{{$item->titulo}}">
                        <div class="image-card-overlay">
                            <span class="view-icon">&#128065;</span>
                        </div>
                        <div class="image-info">
                            <p>{{$item->titulo}}</p>
                        </div>
                    </div>
                @endforeach

                <!--FORMAÇÕES-->
                @foreach ($formacoes as $item)
                    <div class="image-card" data-category="formacoes">
                        <img data-id="{{ $item->hash }}" src="{{ asset('application/storage/app/public/' . $item->imagem) }}" alt="{{$item->titulo}}">
                        <div class="image-card-overlay">
                            <span class="view-icon">&#128065;</span>
                        </div>
                        <div class="image-info">
                            <p>{{$item->titulo}}</p>
                        </div>
                    </div>
                @endforeach


                <!-- Eventos -->
                @foreach ($eventos as $item)
                    <div class="image-card" data-category="eventos">
                        <img data-id="{{ $item->hash }}" src="{{ asset('application/storage/app/public/' . $item->imagem) }}"
                            alt="{{$item->titulo}}">
                        <div class="image-card-overlay">
                            <span class="view-icon">&#128065;</span>
                        </div>
                        <div class="image-info">
                            <p>{{$item->titulo}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </main>
    </div>

    <!-- Lightbox Overlay -->
    <div class="lightbox-overlay" id="lightboxOverlay">
        <div class="lightbox-content">
            <img src="" alt="Imagem Ampliada" class="lightbox-image" id="lightboxImage">
            <button class="lightbox-button lightbox-prev" id="lightboxPrev">&#x2B05;</button>
            <button class="lightbox-button lightbox-next" id="lightboxNext">&#x27A1;</button>
            <button class="lightbox-button lightbox-close" id="lightboxClose">&#10006;</button>
        </div>
    </div>

    @include('website.footer')


    <!-- Links para arquivos JavaScript externos -->
    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/gallery.js') }}"></script>
</body>

</html>