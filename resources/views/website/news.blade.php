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

            @php

                $meses = [
                    '01' => 'Janeiro',
                    '02' => 'Fevereiro',
                    '03' => 'Março',
                    '04' => 'Abril',
                    '05' => 'Maio',
                    '06' => 'Junho',
                    '07' => 'Julho',
                    '08' => 'Agosto',
                    '09' => 'Setembro',
                    '10' => 'Outubro',
                    '11' => 'Novembro',
                    '12' => 'Dezembro'
                ];

                $data_destaque = explode(' ', $noticia_destaque->created_at);
                $data_destaque = explode('-', $data_destaque[0]);

            @endphp

            <div class="row">
                <div class="col-md-9 col-lg-9 col-sm-12 col-12">
                    <div class="left-feature">
                        <div class="card-text">
                            <label for="" class="highlight">Em Destaque</label>
                            <a class="title">{{$noticia_destaque->titulo}}</a>
                            <p class="description">
                                {{ $noticia_destaque->texto_resumo }}
                            </p>
                            <label for="" class="date-news">{{$data_destaque[2]}}, {{$meses[$data_destaque[1]]}}.
                                {{$data_destaque[0]}} <span class="category">|
                                    {{ $noticia_destaque->categoria }}</span><span class="views"><i
                                        class="bi bi-eye"></i> {{ $noticia_destaque->views }}</span></label>
                        </div>
                        <div class="card-image w-100">
                            <img src="{{ asset('sysapp/storage/app/public/' . $noticia_destaque->imagem) }}"
                                alt="{{ $noticia_destaque->titulo }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-12">
                    @if (count($noticias) > 0)

                        @php

                            $data = explode(' ', $noticias[0]->created_at);
                            $data = explode('-', $data[0]);

                        @endphp

                        <div class="features">
                            <div class="card-news">
                                <div class="card-image">
                                    <img src="{{ asset('sysapp/storage/app/public/' . $noticias[0]->imagem) }}"
                                        alt="{{ $noticias[0]->titulo }}">
                                </div>
                                <a class="card-title">{{ $noticias[0]->titulo }}</a>
                                <label for="" class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                    {{$data[0]}} <span class="category">|
                                        {{ $noticias[0]->categoria }}</span><span class="views"><i class="bi bi-eye"></i>
                                        {{ $noticias[0]->views }}</span></label>
                            </div>
                        </div>

                    @endif
                </div>
            </div>

            @if (count($noticias) >= 2)
                <div class="row mt-4">
                    <div class="col-mb-12 col-lg-12 col-sm-12 col-12">
                        <div class="others-news">

                            @php
                                $conta = 0;
                            @endphp

                            @foreach ($noticias as $not)
                                @if ($conta >= 2)

                                    @php
                                        $data = explode(' ', $not->created_at);
                                        $data = explode('-', $data[0]);
                                    @endphp

                                    <div class="card-news">
                                        <div class="card-image">
                                            <img src="{{ asset('sysapp/storage/app/public/' . $not->imagem) }}"
                                                alt="{{ $not->titulo }}">
                                        </div>

                                        <a class="card-title">{{ $not->titulo }}</a>
                                        <p class="card-description">
                                            {{ $not->texto_resumo }}
                                        </p>
                                        <label for="" class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                            {{$data[0]}} <span class="category">|
                                                {{ $not->categoria }}</span><span class="views"><i class="bi bi-eye"></i>
                                                {{ $not->views }}</span></label>
                                    </div>
                                @endif

                                @php
                                    $conta = $conta + 1;
                                @endphp

                            @endforeach

                            <!-- <div class="card-news">
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
                                            </div> -->
                            <!-- <div class="card-news">
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
                                            </div> -->
                            <!-- <div class="card-news">
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
                                            </div> -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('website.footer')


</body>

<script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</html>