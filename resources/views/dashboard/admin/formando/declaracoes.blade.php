<div>

    <style>
        .pintado {
            color: white;
            background-color: rgb(185, 86, 86);
        }

        .hero-page {
            margin-top: 20px;

        }

        .hero-page .card {
            border-radius: 20px;
        }
    </style>

    <div class="row hero-page">
        <div class="col-lg-12">
            <div class="card bg-soft-success">
                <div class="px-2">
                    <div class="row">
                        <div class="col-xxl-12 align-self-center text-center">
                            <div class="py-4">
                                <h5 class="display-6">LISTA DAS DECLARAÇÕES EMITIDAS</h5>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary rounded-pill">
                                        {{ count($lista) }} Declarações </button>
                                    <button type="button" class="btn btn-info rounded-pill">
                                        {{ $homens }} Homens </button>
                                    <button type="button" class="btn btn-warning rounded-pill">
                                        {{ $mulheres }} Mulheres </button>
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

    <div class="card">
        <div class="card-header">
            {{-- <h6 class="card-title mb-0 flex-grow-1">Lista das candidaturas aprovadas </h6> --}}
        </div>
        <div class="card-body">
            <div class="tableFixHead">
                <table class="table table-hover align-middle table-nowrap mb-0 mt-4 text-center" id="myTable">
                    <thead class="">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Formação</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Data de emissão</th>
                            @if (Auth::user()->permission_id != 3)
                                <th scope="col sticky-col first-col"></th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista as $item)
                            <tr>
                                <td scope="col">{{ $item->id }}</td>
                                <td scope="col">{{ $item->getAluno->getPessoa->nome }}</td>
                                <td scope="col">{{ $item->getAluno->num_cedula_advogado }}</td>

                                @if($item->getAluno->e_antigo == 'sim')
                                    <td scope="col">
                                        <span class="badge text-bg-primary">{{ $item->getAluno->formacao }}</span>
                                    </td>
                                    <td scope="col">{{ $item->getAluno->turma }}</td>
                                @else
                                    <td scope="col">
                                        <span class="badge text-bg-primary">{{ $item->getFormacao->nome }}</span>
                                    </td>
                                    <td scope="col">{{ $item->getTurma->descricao }}</td>
                                @endif

                                <td scope="col">{{ $item->created_at }}</td>

                                @php
                                    $hash = $this->getHashes($item->id);
                                @endphp

                                @if (Auth::user()->permission_id != 3)

                                    @if ($item->getAluno->e_antigo == 'sim')
                                        <td class="">
                                            <a target="_blank" href="{{ route('revisor.emitirdec_antigo', $hash[0]) }}"
                                                class="btn btn-info">Imprimir</a>
                                        </td>
                                    @else
                                        <td class="">
                                            <a target="_blank" href="{{ route('emitirdec', [$hash[0], $hash[1]]) }}"
                                                class="btn btn-info">Imprimir</a>
                                        </td>
                                    @endif

                                @endif

                            </tr>
                        @endforeach

                    </tbody>
                </table>
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