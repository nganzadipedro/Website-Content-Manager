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
            <div class="row news-details-row p-2">
                <section class="news-details-section fade-in">
                    <article class="card news-details-card">
                        <img src="../assets/img/galeria/academy013.jpg" alt="" class="news-details-main-img">
                        <hr>
                        <h5 class="title">O título da notícia pode ser muito extenso e precisamos saber como a página
                            vai se comportar</h5>
                        <label for="" class="date-news">12, Abril. 2025 <span class="category">| Actualidade</span><span
                                class="views"><i class="bi bi-eye"></i> 1234</span></label>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
                            eligendi suscipit,
                            perferendis vitae enim provident debitis? Quae labore voluptates, quam soluta animi
                            similique laudantium quis cumque nulla corporis. Vel, ratione? Lorem ipsum dolor sit, amet
                            consectetur adipisicing elit. Molestias aut illo sint repellat atque obcaecati saepe
                            voluptas cum! Quisquam suscipit dolores rem explicabo illo sed eum porro nisi esse maxime?
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa impedit animi tenetur,
                            reiciendis autem excepturi veritatis at accusantium neque vitae, amet nostrum dicta ea,
                            dolore perspiciatis! Vero perspiciatis dolorem rem. Lorem ipsum dolor sit amet consectetur,
                            adipisicing elit. Totam omnis quas, placeat itaque eveniet accusamus corrupti maxime
                            voluptate molestias sapiente veritatis architecto ipsa aut sunt doloremque ex laudantium
                            ratione nam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis ipsum nobis a
                            provident rem rerum laboriosam et id? Ducimus fuga tenetur corporis eveniet soluta aut.
                            Autem quasi ab alias asperiores. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Officiis temporibus fugiat accusamus doloribus soluta laudantium illum, cupiditate alias
                            aliquam repudiandae cum voluptatum! Nostrum autem dolore maxime minima quam iusto quos.
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta ab perspiciatis quasi nam
                            quia. Non enim cupiditate quibusdam modi alias, totam reprehenderit neque vel ipsam? Aut
                            sequi nulla cum eaque?</p>
                    </article>
                </section>
                <aside class="news-details-aside fade-in">
                    <article class="card news-details-card">
                        <img src="../assets/img/img-services.jpg" alt="Imagem da notícia"
                            class="news-details-aside-img">
                        <a href="" class="title">Título da notícia deste lado também pode ser extensa</a>
                        <label for="" class="date-news">12, Abril. 2025 <span class="category">| Actualidade</span><span
                                class="views"><i class="bi bi-eye"></i> 1234</span></label>
                    </article>
                    <article class="card news-details-card">
                        <img src="../assets/img/galeria/academy013.jpg" alt="Imagem da notícia"
                            class="news-details-aside-img">
                        <a href="" class="title">Título da notícia deste lado também pode ser extensa</a>
                        <label for="" class="date-news">12, Abril. 2025 <span class="category">| Actualidade</span><span
                                class="views"><i class="bi bi-eye"></i> 1234</span></label>
                    </article>
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