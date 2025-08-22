@section('css-aux')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/template/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/template/src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
@endsection

<style>
    .card-title-page {
        width: 100%;
        background-color: rgb(229, 229, 229);
        margin: 20px 0px;
        padding: 20px;
        text-align: center;
        border-radius: 20px;
        border: solid 1px rgb(165, 165, 165);
    }

    .card-title-page h3 {
        font-weight: bold;
        color: #000;
    }
</style>

<div>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="card-title-page">
                        <h3>Listagem das imagens da galeria</h3>
                    </div>
                </div>
            </div>

            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">

                        <div class="row mt-4 mb-4" style="padding: 10px;">

                            @if (count($lista_galeria) == 0)

                                <div class="alert alert-light-warning text-center"
                                    role="alert">
                                    Não existe nenhuma imagem adicionada na galeria</button>
                                </div>

                            @else

                                @foreach ($lista_galeria as $imagem)
                                    <div class="col-lg-3 col-md-3 col-12">
                                        <div class="card style-2 mb-md-0 mb-4">
                                            <img src="{{ asset('assets/template/src/assets/img/grid-blog-style-2.jpg') }}"
                                                class="card-img-top" alt="{{ $imagem->titulo }}">
                                            <div class="card-body px-0 pb-0">
                                                <h6 class="card-title">{{ $imagem->titulo }}</h6>
                                                <div class="media mt-2 mb-0 pt-1">
                                                    <div class="media-body">
                                                        <h4 class="media-heading mb-2">{{$imagem->categoria}} |
                                                            {{ $imagem->views }} Visualizações
                                                        </h4>
                                                        <a class="btn btn-danger delete-image"
                                                            data-id="{{ $imagem->id }}">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @endif


                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/listar-galeria.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
        });
    </script>
@endsection