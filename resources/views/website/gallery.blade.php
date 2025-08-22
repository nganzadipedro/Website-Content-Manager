<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                <div class="image-card" data-category="institucional">
                    <img src="{{ asset('assets/website/img/galeria/adv01.jpg') }}" alt="Reunião de Equipe">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Guiados por princípios éticos</p>
                    </div>
                </div>

                <div class="image-card" data-category="institucional">
                    <img src="{{ asset('assets/website/img/galeria/adv02.jpg') }}" alt="Workshop de Inovação">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Guiados por princípios éticos</p>
                    </div>
                </div>

                <div class="image-card" data-category="institucional">
                    <img src="{{ asset('assets/website/img/galeria/adv03.jpg') }}" alt="Workshop de Inovação">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Guiados por princípios éticos</p>
                    </div>
                </div>

                <div class="image-card" data-category="institucional">
                    <img src="{{ asset('assets/website/img/galeria/adv04.jpg') }}" alt="Workshop de Inovação">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Guiados por princípios éticos</p>
                    </div>
                </div>

                <!--RESPONSABILIDADE SOCIAL-->
                <div class="image-card" data-category="responsabilidade-social">
                    <img src="{{ asset('assets/website/img/galeria/adv01.jpg') }}" alt="Responsabilidade social">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Cumprimento dos nossos deveres</p>
                    </div>
                </div>

                <div class="image-card" data-category="responsabilidade-social">
                    <img src="{{ asset('assets/website/img/galeria/adv02.jpg') }}" alt="Responsabilidade social">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Cumprimento dos nossos deveres</p>
                    </div>
                </div>

                <div class="image-card" data-category="responsabilidade-social">
                    <img src="{{ asset('assets/website/img/galeria/adv03.jpg') }}" alt="Responsabilidade social">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Cumprimento dos nossos deveres</p>
                    </div>
                </div>

                <div class="image-card" data-category="responsabilidade-social">
                    <img src="{{ asset('assets/website/img/galeria/adv04.jpg') }}" alt="Responsabilidade social">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Cumprimento dos nossos deveres</p>
                    </div>
                </div>

                <!--FORMAÇÕES-->
                <div class="image-card" data-category="formacoes">
                    <img src="{{ asset('assets/website/img/galeria/academy07.jpg') }}" alt="Formação em Leis">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo o conhecimento em leis</p>
                    </div>
                </div>

                <div class="image-card" data-category="formacoes">
                    <img src="{{ asset('assets/website/img/galeria/academy08.jpg') }}" alt="Formação em Leis">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo o conhecimento em leis</p>
                    </div>
                </div>

                <div class="image-card" data-category="formacoes">
                    <img src="{{ asset('assets/website/img/galeria/academy09.jpg') }}" alt="Formação em Leis">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo o conhecimento em leis</p>
                    </div>
                </div>

                <div class="image-card" data-category="formacoes">
                    <img src="{{ asset('assets/website/img/galeria/academy010.jpg') }}" alt="Formação em Leis">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo o conhecimento em leis</p>
                    </div>
                </div>

                <!-- Eventos -->
                <div class="image-card" data-category="eventos">
                    <img src="{{ asset('assets/website/img/galeria/união.jpg') }}" alt="Fortalecendo laços com parceiros">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo relações com parceiros</p>
                    </div>
                </div>

                <div class="image-card" data-category="eventos">
                    <img src="{{ asset('assets/website/img/galeria/transparence.jpg') }}" alt="Fortalecendo laços com parceiros">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo laços com parceiros</p>
                    </div>
                </div>

                <div class="image-card" data-category="eventos">
                    <img src="{{ asset('assets/website/img/galeria/pexels-august-de-richelieu-4427430.jpg') }}"
                        alt="Fortalecendo laços com parceiros">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo laços com parceiros</p>
                    </div>
                </div>

                <div class="image-card" data-category="eventos">
                    <img src="{{ asset('assets/website/img/galeria/confiança.jpg') }}" alt="Fortalecendo laços com parceiros">
                    <div class="image-card-overlay">
                        <span class="view-icon">&#128065;</span>
                    </div>
                    <div class="image-info">
                        <p>Fortalecendo laços com parceiros</p>
                    </div>
                </div>
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