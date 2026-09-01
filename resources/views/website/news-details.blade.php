<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta name="author" content="Conselho Provincial de Luanda da Ordem dos Advogados de Angola">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Detalhes da Notícia</title>
    <link rel="icon" href="{{ asset('assets/website/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-details.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/news-details-responsive.css') }}">
</head>

<body class="news-details-page">

    @include('website.menu')

    <div class="container">
        <section class="title-page">
            <div class="row">
                <div class="col-12 text-center" style="margin-top: 80px">
                    <h3>Detalhes da Notícia</h3>
                    <h4>Confira as informações completas</h4>
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

                $conta = 1;

            @endphp

            <div class="row main-row">

                <!-- 1. IMAGEM (mobile primeiro) -->
                <div class="col-lg-5 col-md-12 left-column">
                    <img src="{{ asset('application/storage/app/public/' . $noticia->imagem) }}"
                        alt="{{ $noticia->titulo }}" class="news-details-main-img">
                </div>

                <!-- 2. TEXTO DA NOTÍCIA -->
                <div class="col-lg-7 col-md-12 right-column">
                    <article class="news-details-card">
                        <h1 class="title">{{ $noticia->titulo }}</h1>
                        <label class="date-news">{{$data_destaque[2]}}, {{$meses[$data_destaque[1]]}}.
                            {{$data_destaque[0]}}<span class="category">| {{ $noticia->categoria }}</span></label>
                        <div class="description mt-4">
                            <p>{!! $noticia->texto_completo !!}</p>
                        </div>
                        @if($noticia->anexo_pdf)

                            @php
                        
                            $ficheiro = explode('/', $noticia->anexo_pdf);

                            @endphp

                            <div class="mt-4">
                                <a href="{{ route('open_doc_attach', $ficheiro[1]) }}" target="_blank" class="btn btn-warning">Visualizar Anexo PDF</a>
                            </div>
                        @endif
                    </article>
                </div>

                <!-- 3. NOTÍCIAS RELACIONADAS -->
                <div class="col-12 related-news">
                    <h5 class="related-title">Notícias Relacionadas</h5>
                    <div class="d-flex">

                        <div class="row col-md-6">
                            @foreach ($outras_noticias as $not)


                                @if ($conta <= 3)

                                    @php

                                        $data = explode(' ', $not->created_at);
                                        $data = explode('-', $data[0]);

                                    @endphp





                                    <div class="related-item">
                                        <img src="{{ asset('application/storage/app/public/' . $not->imagem) }}"
                                            alt="{{ $not->titulo }}">
                                        <div class="related-content">
                                            <a href="{{ route('news_details', $not->slug) }}"
                                                class="related-link">{{ $not->titulo }}</a>
                                            <label class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                                {{$data[0]}} <span class="category">|
                                                    {{ $not->categoria }}</span></label>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $conta++; 
                                @endphp

                            @endforeach

                        </div>

                        @php
                            $conta = 1; 
                        @endphp

                        <div class="row col-md-6">

                            @foreach ($outras_noticias as $not)

                                @if ($conta >= 4)

                                    @php

                                        $data = explode(' ', $not->created_at);
                                        $data = explode('-', $data[0]);

                                    @endphp


                                    <div class="related-item">
                                        <img src="{{ asset('application/storage/app/public/' . $not->imagem) }}"
                                            alt="{{ $not->titulo }}">
                                        <div class="related-content">
                                            <a href="{{ route('news_details', $not->slug) }}"
                                                class="related-link">{{ $not->titulo }}</a>
                                            <label class="date-news">{{$data[2]}}, {{$meses[$data[1]]}}.
                                                {{$data[0]}} <span class="category">|
                                                    {{ $not->categoria }}</span></label>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $conta++; 
                                @endphp

                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>