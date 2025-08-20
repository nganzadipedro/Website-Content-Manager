<div>
    <div class="row">
        <div class="col-xl-12" id="card-none2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-0">LISTA DE ACTIVIDADES</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show" id="collapseExample2" style="">

                    <div class="" id="tabela-dados">

                        <table class="table table-nowrap" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Operação</th>
                                    <th scope="col">Origem</th>
                                    <th scope="col">Destinatário</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lista_actividades as $actividade)
                                                            <tr>
                                                                <td>{{ $actividade->user_id == null ? 'Sistema' : $actividade->getUser->getPessoa->nome }}
                                                                </td>
                                                                <td>{{ $actividade->operacao }}</td>
                                                                <td>{{ $actividade->origem }}</td>
                                                                <td>
                                                                    @if ($actividade->destino == 'candidatura')
                                                                                                        @php
                                                                                                            $candidatura = \App\Models\Fio\Candidaturaformacao::find(
                                                                                                                $actividade->destino_id,
                                                                                                            );
                                                                                                        @endphp

                                                                                                        @if ($candidatura)
                                                                                                            <a
                                                                                                                href="{{ route('vercandidatura', $candidatura->hash) }}">{{ $actividade->destino }}</a>
                                                                                                        @else
                                                                                                        -----
                                                                                                        @endif

                                                                    @else
                                                                        {{ $actividade->destino }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $actividade->created_at }}</td>
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

@section('script-aux')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection