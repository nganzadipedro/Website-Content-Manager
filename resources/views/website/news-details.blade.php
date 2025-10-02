<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Notícia</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-details.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-details-responsive.css') }}">
</head>

<body class="news-details-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">
        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Detalhes da Notícia</h3>
                    <h4>Confira as informações completas sobre a notícia selecionada</h4>
                </div>
            </div>
        </section>
    </div>

    <section class="details-section">

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

                $data_destaque = explode(' ', $noticia->created_at);
                $data_destaque = explode('-', $data_destaque[0]);

            @endphp



            <div class="row news-details-row p-2">
                <section class="news-details-section fade-in">
                    <article class="card news-details-card">
                        <img src="{{ asset('application/storage/app/public/' . $noticia->imagem) }}"
                            alt="{{ $noticia->titulo }}" class="news-details-main-img">
                        <hr>
                        <h5 class="title">{{$noticia->titulo}}</h5>
                        <label for="" class="date-news">{{$data_destaque[2]}}, {{$meses[$data_destaque[1]]}}.
                                {{$data_destaque[0]}} <span class="category">|
                                {{$noticia->categoria}}</span><span class="views"><i class="bi bi-eye"></i>
                                {{$noticia->views}}</span></label>
                        <p class="description">{!! $noticia->texto_completo !!}</p>
                    </article>
                </section>
                <aside class="news-details-aside fade-in">
                    @foreach ($outras_noticias as $not)


                        @php

                            $data = explode(' ', $not->created_at);
                            $data = explode('-', $data[0]);

                        @endphp

                        <article class="card news-details-card">
                            <img src="{{ asset('application/storage/app/public/' . $not->imagem) }}" alt="{{$not->titulo}}"
                                class="news-details-aside-img">
                            <a href="{{ route('news_details', $not->hash) }}" class="title">{{$not->titulo}}</a>
                            <label for="" class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                            {{$data[0]}} <span class="category">| {{$not->categoria}}</span><span
                                    class="views"><i class="bi bi-eye"></i> {{$not->views}}</span></label>
                        </article>
                    @endforeach
                </aside>
            </div>
        </div>

    </section>


    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/index.js') }}"></script>
    <script src="{{ asset('assets/website/js/news-details.js') }}"></script>
</body>

</html>