<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Advogados</title>
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/list-lawyers.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
</head>

<body class="list-lawyers-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')


    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Lista de Advogados</h3>
                    <h4>Conheça os nossos associados</h4>
                </div>
            </div>
        </section>

        <!-- secção de estatística -->
        <section class="section-table">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <table class="minha-tabela" role="table" aria-label="Lista de PDFs">
                            <!-- título curto e acessível -->
                            <caption>Lista actualizada dos advogados</caption>

                            <!-- cabeçalho -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome completo</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Cédula</th>
                                </tr>
                            </thead>

                            <!-- corpo com as linhas de dados -->
                            <tbody>
                                @foreach ($lista as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->telefone1 }}</td>
                                        <td>{{ $item->num_associado }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('website.footer')

    <script src="{{ asset('assets/website/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>