<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Lista de imagens do Carrossel
                    </h2>

                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('manage_website') }}" class="btn btn-warning">
                            Gerenciar Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="row mt-3">
                        @foreach ($lista_carrossel as $item)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <!-- Photo -->
                                    <div class="img-responsive img-responsive-21x9 card-img-top"
                                        style="background-image: url({{ asset('application/storage/app/public/' . $item->imagem) }})">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{$item->titulo}}</h3>
                                        <h4 class="media-heading mb-2">
                                            {{$item->titulo}}
                                        </h4>
                                        <a class="btn btn-danger delete-image mt-3" data-id="{{ $item->id }}">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <script src="{{ asset('assets/system/js/listar-carrossel.js') }}"></script>
@endsection