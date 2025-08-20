<!-- start page title -->
@section('css-aux')
    <link href="{{ asset('assets/template/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

<style>
    .hero-page {
        margin-top: 20px;

    }

    .hero-page .card {
        border-radius: 20px;
    }
</style>

<div class="row hero-page">
    <div class="col-lg-12">
        <div class="card bg-soft-primary">
            <div class="px-4">
                <div class="row">
                    <div class="col-xxl-12 align-self-center text-center">
                        <div class="py-4">
                            <script src="https://cdn.lordicon.com/lordicon.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/abwrkdvl.json" trigger="loop" stroke="regular"
                                state="loop-all" colors="primary:#4030e8,secondary:#4030e8"
                                style="width:100px;height:100px">
                            </lord-icon>
                            <h5 class="display-6">CEFOnline | PAINEL DO CANDIDATO</h5>
                            <h4>Bem-vindo de volta, {{ Auth::user()->getpessoa->nome }}</h4>

                            <div class="text-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!--end col-->.
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xxl-7">
        <div class="d-flex flex-column h-100">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="alert alert-success border-0 rounded-0 m-0 d-flex align-items-center"
                                role="alert">

                                <div class="flex-grow-1 text-truncate">
                                    Bem-vindo ao CEFOnline | Área de acesso rápido
                                </div>

                            </div>

                            <div class="row align-items-end">
                                <div class="col-sm-12">
                                    <div class="p-3">
                                        <p class="fs-16 lh-base">Clique nos botões que se seguem para ir à página que desejas.
                                        </p>
                                        <div class="mt-3">
                                            <a href="{{ route('candidato.formacoes') }}"
                                                class="btn btn-success">Formações CEF</a>
                                            <a href="{{ route('candidato.minhasformacoes') }}"
                                                class="btn btn-primary">Minhas Formações</a>
                                            <a href="{{ route('candidato.provas') }}"
                                                class="btn btn-warning">Minhas Provas</a><br><br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div>
    </div> <!-- end col-->
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h6 class="card-title flex-grow-1 mb-0">Informações CEF</h6>
                <!-- <a href="apps-nft-collections.html" type="button" class="btn btn-soft-primary btn-sm flex-shrink-0">
                    See All <i class="ri-arrow-right-line align-bottom"></i>
                </a> -->
            </div>
            <div class="card-body">
                <div class="swiper collection-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dash-collection position-relative">
                                <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}" alt=""
                                    height="500" class="" />
                                <!-- <div
                                    class="content position-absolute bottom-0 m-2 p-2 start-0 end-0 rounded d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="#!">
                                            <h5 class="text-white fs-16 mb-1">Saiba +</h5>
                                        </a>
                                        <p class="text-white-75 mb-0">Ver detalhes</p>
                                    </div>
                                    <div class="avatar-xxs">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <a href="#!" class="link-success"><i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dash-collection position-relative">
                                <img src="{{ asset('assets/template/images/demos/cartaz_fio_2025.jpg') }}" alt=""
                                    height="500" class="" />
                                <!-- <div
                                    class="content position-absolute bottom-0 m-2 p-2 start-0 end-0 rounded d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="#!">
                                            <h5 class="text-white fs-16 mb-1">Saiba +</h5>
                                        </a>
                                        <p class="text-white-75 mb-0">Ver detalhes</p>
                                    </div>
                                    <div class="avatar-xxs">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <a href="#!" class="link-success"><i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dash-collection position-relative">
                                <img src="{{ asset('assets/template/images/demos/postfio.jpg') }}" alt="" height="500"
                                    class="" />
                                <!-- <div
                                    class="content position-absolute bottom-0 m-2 p-2 start-0 end-0 rounded d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="#!">
                                            <h5 class="text-white fs-16 mb-1">Saiba +</h5>
                                        </a>
                                        <p class="text-white-75 mb-0">Ver detalhes</p>
                                    </div>
                                    <div class="avatar-xxs">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <a href="#!" class="link-success"><i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dash-collection position-relative">
                                <img src="{{ asset('assets/template/images/demos/postfio.jpg') }}" alt="" height="500"
                                    class="" />
                                <!-- <div
                                    class="content position-absolute bottom-0 m-2 p-2 start-0 end-0 rounded d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <a href="#!">
                                            <h5 class="text-white fs-16 mb-1">Saiba +</h5>
                                        </a>
                                        <p class="text-white-75 mb-0">Ver detalhes</p>
                                    </div>
                                    <div class="avatar-xxs">
                                        <div class="avatar-title bg-white rounded-circle">
                                            <a href="#!" class="link-success"><i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end swiper-->
            </div>
        </div>
    </div>
</div> <!-- end row-->

@section('script-aux')
    <!-- apexcharts -->
    <script src="{{ asset('assets/template/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/template/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/template/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/template/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Countdown js -->
    <script src="{{ asset('assets/template/js/pages/coming-soon.init.js') }}"></script>

    <!-- Marketplace init -->
    <script src="{{ asset('assets/template/js/pages/dashboard-nft.init.js') }}"></script>
@endsection