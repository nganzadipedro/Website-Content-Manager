@section('css-aux')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/template/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/template/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/template/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

<div>

    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <!--  BEGIN BREADCRUMBS  -->
            <div class="secondary-nav">
                <div class="breadcrumbs-container" data-page-heading="Analytics">
                    <header class="header navbar navbar-expand-sm">
                        <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-menu">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                        <div class="d-flex breadcrumb-content">
                            <div class="page-header">

                                <div class="page-title">
                                    <h3>Dashboard de Resumo</h3>
                                </div>

                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                                    </ol>
                                </nav>

                            </div>
                        </div>
                    </header>
                </div>
            </div>
            <!--  END BREADCRUMBS  -->

            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">Advogados</h6>
                                </div>
                                <div class="task-action">

                                </div>
                            </div>

                            <div class="w-content">

                                <div class="w-info">
                                    <p class="value">{{ $vetor_dados[0] }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">Advogados Estagiários</h6>
                                </div>
                                <div class="task-action">

                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                    <p class="value">{{ $vetor_dados[1] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-header">
                                <div class="w-info">
                                    <h6 class="value">Usuários</h6>
                                </div>
                                <div class="task-action">

                                </div>
                            </div>
                            <div class="w-content">
                                <div class="w-info">
                                  <p class="value">{{ $vetor_dados[2] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@section('script-aux')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/template/src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/template/src/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endsection