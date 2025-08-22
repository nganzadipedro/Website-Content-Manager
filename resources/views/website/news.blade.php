<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-responsive.css') }}">

</head>

<body class="news-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Notícias</h3>
                    <h4>Mantenha-te informado através do nosso website</h4>
                </div>
            </div>
        </section>
    </div>

    <section class="section-news">
        <div class="container">

            <div class="row">
                <div class="col-md-9 col-lg-9 col-sm-12 col-12">
                    <div class="left-feature">
                        <div class="card-text">
                            <label for="" class="highlight">Em Destaque</label>
                            <a class="title">Tomada de posse do Conselho Provincial de Luanda</a>
                            <p class="description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.
                            </p>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                        <div class="card-image w-100">
                            <img src="{{ asset('assets/website/img/noticias/img1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-12">
                    <div class="features">
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('assets/website/img/noticias/img2.jpg') }}" alt="">
                            </div>
                            <a class="card-title">Tomada de posse do Conselho Provincial de Luanda E SE O TEXTO FOR
                                MUITO LONGO DE MAIS</a>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-mb-12 col-lg-12 col-sm-12 col-12">
                    <div class="others-news">
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('assets/website/img/noticias/img4.jpg') }}" alt="">
                            </div>

                            <a class="card-title">In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.</a>
                            <p class="card-description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.
                            </p>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('assets/website/img/noticias/img5.jpg') }}" alt="">
                            </div>

                            <a class="card-title">In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.</a>
                            <p class="card-description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.
                            </p>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('assets/website/img/noticias/img6.jpg') }}" alt="">
                            </div>

                            <a class="card-title">In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.</a>
                            <p class="card-description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.
                            </p>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('assets/website/img/noticias/img3.jpg') }}" alt="">
                            </div>

                            <a class="card-title">In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.</a>
                            <p class="card-description">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu
                                aenean sed diam urna tempor.
                            </p>
                            <label for="" class="date-news">12, Abril. 2025 <span class="category">|
                                    Actualidade</span><span class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website.footer')


</body>

<script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</html>