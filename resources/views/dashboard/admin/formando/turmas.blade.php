<style>
    .title-page {
        margin-top: 10px;
        display: block;
        text-align: center;
        background-color: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .title-page:hover {
        transform: translateY(-10px);
        /* Levita a div para cima */
        box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.3);
        /* Aumenta a sombra */
    }


    .title-page h5 {
        font-weight: bold;
        font-size: 24px;
    }

    .dv-turmas .card-body {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        border: solid 1px #000000;
    }
</style>


<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">TURMAS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CEF-OAA</a></li>
                        <li class="breadcrumb-item active">Turmas</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="title-page">
                <h5 class="">Visualize aqui todas as turmas disponíveis no sistema
                </h5>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row mt-5 dv-turmas">
        @foreach ($turmas as $item)
            <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="card card-body text-center">
                    <!-- <div class="avatar-sm mx-auto mb-3">
                                    <div class="avatar-title bg-soft-success text-success fs-17 rounded">
                                        <i class="ri-add-line"></i>
                                    </div>
                                </div> -->
                    <h5>{{ $item->getFormacao->nome }}</h5>
                    <h4 class="card-title">{{ $item->descricao }}</h4>
                    <h4 class="card-title">Capacidade: {{ $item->capacidade }}</h4>
                    <h4 class="card-title">Nº de Inscritos: {{ $this->inscritos($item->id) }}</h4>
                    <h4 class="card-title">Inscrições Pagas: {{ count($item->getAlunos) }}</h4>
                    <br>

                    @if (Auth::user()->permission_id == 2)
                        <a href="{{ route('revisor.formandos.verturma', $item->id) }}" class="btn btn-success">Ver Turma
                            (Inscrições Pagas)</a>
                    @endif

                    @if (Auth::user()->permission_id == 1)
                        <a href="{{ route('admin.formandos.verturma', $item->id) }}" class="btn btn-success">Ver Turma
                            (Inscrições Pagas)</a>
                    @endif



                </div>
            </div><!-- end col -->
        @endforeach
    </div><!-- end row -->


</div>