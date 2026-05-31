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
    <title>Notícias</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-responsive.css') }}">

</head>

<body class="news-page">

    @include('website.menu')

    <div class="container">
        <section class="title-page">
            <div class="row">
                <div class="col-12 text-center" style="margin-top: 100px">
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


            <!-- 6 CARDS (3 por linha) -->
            <div class="others-news">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card-news">
                            <div class="card-image">
                                <img src="{{ asset('application/storage/app/public/' . $noticia_destaque->imagem) }}"
                                    alt="{{ $noticia_destaque->titulo }}">
                            </div>
                            <a href="{{ route('news_details', $noticia_destaque->hash) }}" class="card-title">
                                <span class="highlight">DESTAQUE</span>
                                <br>{{$noticia_destaque->titulo}}</a>
                            <p class="card-description"> {{ $noticia_destaque->texto_resumo }}</p>
                            <label class="date-news">{{$data_destaque[2]}}, {{$meses[$data_destaque[1]]}}.
                                {{$data_destaque[0]}} <span class="category">
                                    | {{ $noticia_destaque->categoria }}</span></label>
                        </div>
                    </div>
                    @if (count($noticias) > 0)

                        @foreach ($noticias as $not)

                            @php
                                $data = explode(' ', $not->created_at);
                                $data = explode('-', $data[0]);
                            @endphp

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card-news">
                                    <div class="card-image">
                                        <img src="{{ asset('application/storage/app/public/' . $not->imagem) }}"
                                            alt="{{ $not->titulo }}">
                                    </div>
                                    <a href="{{ route('news_details', $not->hash) }}" class="card-title">{{ $not->titulo }}</a>
                                    <p class="card-description">{{ $not->texto_resumo }}</p>
                                    <label class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                        {{$data[0]}} <span class="category">| {{ $not->categoria }}</span></label>
                                </div>
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>

        </div>
    </section>

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>