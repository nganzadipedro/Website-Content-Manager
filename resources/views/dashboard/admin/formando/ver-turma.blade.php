<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $turma->descricao }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CEF-OAA</a></li>
                        <li class="breadcrumb-item active">Turmas</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row text-bolt">
        <div class="col-12">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card rounded-5">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h3 class="card-title mb-0">Detalhes da {{ $turma->descricao }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-2">
                                        <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class=" ri-user-follow-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Capacidade :</p>
                                                        <h5 class="mb-0">{{ $turma->capacidade }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class="ri-community-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Formação:</p>
                                                        <h5 class="mb-0">{{ $turma->getFormacao->nome }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class="ri-account-circle-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Nº Inscritos:</p>
                                                        <h5 class="mb-0">{{ count($turma->getAlunos) }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class="ri-account-circle-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Nº Homens:</p>
                                                        <h5 class="mb-0 bol">{{ $homens }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class="ri-account-circle-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Nº Mulheres:</p>
                                                        <h5 class="mb-0">{{ $mulheres }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-4 mt-2">
                                            <div class="p-2 border border-dashed rounded bg-marketplace">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        <div
                                                            class="avatar-title rounded bg-transparent text-primary fs-24">
                                                            <i class="ri-calendar-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted mb-1">Total de Indexes:</p>
                                                        <h5 class="mb-0"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <hr class="m-1 mt-1">

                                        <h5 class="mt-3">Mais opções</h5>
                                        <div class="row text-center mt-2">

                                            <div class="col-sm-3">
                                                <a class="btn btn-lg btn-primary"
                                                    href="{{ route('exportarlista', $turma->id) }}">Exportar Lista Excel
                                                </a>
                                            </div>

                                            <!-- <div class="col-sm-3">
                                                    <button  class="btn btn-lg btn-success">Ver Lista de Presença <i
                                                            class="ri-checkbox-circle-line"></i></button>
                                                </div> -->

                                            @if(Auth::user()->permission_id != 2)
                                                <div class="col-sm-3">
                                                    <a href="{{ route('formador.lancarnota', $turma->id) }}"
                                                        class="btn btn-lg btn-warning">Lançar Notas <i
                                                            class="ri-edit-box-line"></i></a>
                                                </div>

                                                <div class="col-sm-3">
                                                    <a href="{{ route('formador.editarnota', $turma->id) }}"
                                                        class="btn btn-lg btn-warning">Editar Notas <i
                                                            class="ri-edit-box-line"></i></a>
                                                </div>
                                            @endif

                                            <div class="col-sm-3">
                                                <a target="_blank" href="{{ route('mini_pauta_turma', $turma->id) }}"
                                                    class="btn btn-lg btn-info">Mini Pauta Geral</a>
                                            </div>


                                        </div>
                                        <!-- end col -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- end card -->
                </div>

            </div>
        </div>
        <div class="live-preview">
            <div class="accordion custom-accordionwithicon accordion-secondary" id="accordionWithicon">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="accordionwithiconExample1">
                        <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#accor_iconExamplecollapse1" aria-expanded="false"
                            aria-controls="accor_iconExamplecollapse1">
                            <i class="ri-edit-2-line me-2"></i> Lista dos formandos
                        </button>
                    </h2>
                    <div id="accor_iconExamplecollapse1" class="accordion-collapse collapse"
                        aria-labelledby="accordionwithiconExample1" data-bs-parent="#accordionWithicon" style="">
                        <div class="accordion-body">


                            <div class="table-responsive mt-4 mt-xl-0">
                                <table class="table table-info table-striped table-nowrap align-middle mb-0"
                                    id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Código</th>
                                            <th scope="col">Nº Cédula</th>
                                            <th scope="col">Turma</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alunos_turma as $item)
                                            <tr>
                                                <td scope="col">{{ $loop->index + 1 }}</td>
                                                <td scope="col">{{ $item->id }}</td>
                                                <td scope="col">{{ $item->getAluno->getPessoa->nome }}</td>
                                                <td scope="col">{{ $item->getAluno->codigo }}</td>
                                                <td scope="col">{{ $item->getAluno->num_cedula_advogado }}</td>
                                                <td scope="col">{{ $turma->descricao }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @section('script-aux')
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>
    @endsection