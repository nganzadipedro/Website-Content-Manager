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
    <title>Lista Advogados Estagiários</title>
    <link rel="icon" href="{{ asset('assets/website/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/list-trainee.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
</head>

<body class="list-trainee-page">

    <section class="section-pub">
        <img src="{{ asset('assets/website/img/banner-top.jpg') }}" alt="">
    </section>

    @include('website.menu')

    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center">
                    <h3>Lista de Advogados Estagiários</h3>
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
                            <caption>Lista actualizada dos advogados estagiários</caption>

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
                                        <td>{{ $item->num_estagiario }}</td>
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