<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Visão Geral
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
                <!-- Page title actions -->
                @if (Auth::user()->id == 4054)
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('manage_website') }}" class="btn btn-warning">
                                Gerenciar Website
                            </a>
                        </div>
                    </div>
                @endif
                @if (Auth::user()->permissao_id == 3)
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('system.areatecnica.pesquisa_geral') }}" class="btn btn-warning">
                                Pesquisar Processo de Inscrição
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total de Pedidos de AJ</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">

                                    </div>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $registos_entrada }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pedidos da Semana</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{ $vetor_registos[0] }}</div>

                            </div>
                        </div>
                        <div id="chart-revenue-bg" class="chart-sm"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pedidos do mês</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[1] }}</div>

                            </div>
                            <div id="chart-active-users" class="chart-sm"></div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pedidos do Ano</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[2] }}</div>
                                <div class="me-auto">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-deck row-cards mt-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total de Inscrições de Advogados</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">

                                    </div>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $inscricao_advogados }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições da Semana</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{ $vetor_registos[3] }}</div>

                            </div>
                        </div>
                        <div id="chart-isadv" class="chart-sm"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições do mês</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[4] }}</div>

                            </div>
                            <div id="chart-imadv" class="chart-sm"></div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições do Ano</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[5] }}</div>
                                <div class="me-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-deck row-cards mt-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total de Inscrições de Advogados Estagiários</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">

                                    </div>
                                </div>
                            </div>
                            <div class="h1 mb-3">{{ $inscricao_estagiarios }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições da Semana</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">{{ $vetor_registos[6] }}</div>

                            </div>
                        </div>
                        <div id="chart-isadvest" class="chart-sm"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições do mês</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[7] }}</div>

                            </div>
                            <div id="chart-imadvest" class="chart-sm"></div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Inscrições do Ano</div>
                                <div class="ms-auto lh-1">

                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-3 me-2">{{ $vetor_registos[8] }}</div>
                                <div class="me-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">

                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy; 2025
                            <a href="." class="link-secondary">Conselho Provincial de Luanda da Ordem dos Advogados de
                                Angola</a>.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>


@section('script-aux')

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {

            fetch("{{ route('get_days_week_assistance') }}")
                .then(response => response.json())
                .then(dias => {
                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "area",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: .16,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Pedidos de AJ',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-revenue-bg"),
                        options
                    )).render();


                })
                .catch(error => {
                    console.error('Erro ao buscar dias da semana:', error);
                });

        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {

            fetch("{{ route('get_days_week_inscricao_advogado') }}")
                .then(response => response.json())
                .then(dias => {
                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "area",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: .16,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Inscrições de Advogados',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-isadv"),
                        options
                    )).render();


                })
                .catch(error => {
                    console.error('Erro ao buscar dias da semana:', error);
                });

        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {

            fetch("{{ route('get_days_week_inscricao_estagiario') }}")
                .then(response => response.json())
                .then(dias => {
                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "area",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: .16,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Inscrições de Advogados Estagiários',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-isadvest"),
                        options
                    )).render();


                })
                .catch(error => {
                    console.error('Erro ao buscar dias da semana:', error);
                });

        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {


            fetch("{{ route('get_days_month_assistance') }}")
                .then(response => response.json())
                .then(dias => {

                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "bar",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            }
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Pedidos de AJ',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-active-users"),
                        options
                    )).render();


                })
                .catch(error => {
                    console.error('Erro ao buscar dias do mês:', error);
                });


        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {

            fetch("{{ route('get_days_month_inscricao_advogado') }}")
                .then(response => response.json())
                .then(dias => {

                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "bar",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            }
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Inscrição de Advogados',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-imadv"),
                        options
                    )).render();

                })
                .catch(error => {
                    console.error('Erro ao buscar dias do mês:', error);
                });
        });
        // @formatter:on
    </script>

    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {

            fetch("{{ route('get_days_month_inscricao_estagiario') }}")
                .then(response => response.json())
                .then(dias => {

                    console.log(dias);

                    const serie = dias.map(item => ({
                        x: new Date(item.dia).getTime(),
                        y: item.valor
                    }));

                    const options = {
                        chart: {
                            type: "bar",
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            }
                        },
                        xaxis: {
                            type: 'datetime'
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                            type: 'solid'
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: 'Inscrição de Advogados Estagiários',
                            data: serie
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    };

                    window.ApexCharts && (new ApexCharts(
                        document.getElementById("chart-imadvest"),
                        options
                    )).render();

                })
                .catch(error => {
                    console.error('Erro ao buscar dias do mês:', error);
                });
        });
        // @formatter:on
    </script>


@endsection