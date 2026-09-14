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
    <title>Informações Financeiras</title>
    <link rel="icon" href="{{ asset('assets/website/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/website/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/financial-report.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style-responsive.css') }}">
</head>

<body class="financial-report-page">

    @include('website.menu')

    <div class="container">

        <section class="title-page">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 text-center" style="margin-top: 100px;">
                    <h3>Informação Financeira</h3>
                    <h4>Relatórios financeiros, Balancetes e Demonstrações financeiras</h4>
                </div>
            </div>
        </section>

        <!-- secção de estatística -->
        <section class="section-table">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                    <div class="content">
                        <table class="minha-tabela" role="table" aria-label="Lista de PDFs">
                            <!-- cabeçalho -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Ano</th>
                                    <th>Categoria</th>
                                    <th>Trimestre</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <!-- corpo com as linhas de dados -->
                            <tbody>
                                @foreach ($lista as $item)

                                    @php

                                        $ficheiro = explode('/', $item->documento_anexo);

                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->descricao }}</td>
                                        <td>{{ $item->ano }}</td>
                                        <td>{{ $item->categoria }}</td>
                                        <td>{{ $item->trimestre }}</td>
                                        <td><a class="btn btn-warning"
                                                href="{{ route('open_doc_attach', $ficheiro[1]) }}"
                                                target="_blank"><i class="bi bi-file-earmark-pdf"></i> </a></td>
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