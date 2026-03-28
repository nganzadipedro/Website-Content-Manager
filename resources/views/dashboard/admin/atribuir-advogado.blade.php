<div>


    <style>
        .detalhes {
            font-size: 14px;
            line-height: 1.75;
        }

        .table-responsive {
            max-height: 500px;
            overflow: auto;
        }

        .btn-outro {
            cursor: pointer;
            color: black;
            text-decoration: underline;
        }

        .link-advogado {
            cursor: pointer;
            color: black;
            text-decoration: underline;
        }

        .link-advogado:hover {
            color: blue;
            text-decoration: none;
        }
    </style>


    <div class="page-wrapper">

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Formulário de Atribuição de Advogados para Assistências
                                    Judiciárias</h3>

                                <input type="hidden" id="registo_id" name="registo_id" value="{{ $registo->id }}">
                            </div>
                            <div class="card-body">

                                <div class="alert alert-primary">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                            <p class="detalhes">
                                                Nº do Processo: {{ $registo->codigo }} <br>
                                                <strong>Requerente: {{ $registo->proveniencia }}</strong> <br>
                                                Assunto: {{ $registo->assunto }} <br>
                                                Endereço do Requerente: {{ $registo->endereco_requerente }} <br>
                                                Município do Requerente:
                                                {{ $registo->municipio_requerente == null ? '' : $registo->getmunicipio->descricao }}
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                            <p class="detalhes">
                                                Data de Entrada: {{ $registo->data_entrada }} <br>
                                                Data de Registo na Secretaria:
                                                {{ $registo->created_at }} <br>
                                                Nota de encaminhamento: {{ $registo->nota_encaminhamento }} <br>
                                                Contactos: {{ $registo->telefone }}/{{ $registo->telefone2 }} <br>

                                                <a href="#" class="btn btn-info mt-3" style="cursor: pointer;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-advogados-atribuidos">Ver
                                                    advogados atribuídos ({{ count($advogados_atribuidos) }})</a>
                                                <a wire:click="confirmar_atribuicao" class="btn btn-success mt-3"
                                                    style="cursor: pointer;">
                                                    Confirmar</a>

                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3"></div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
                                        <div wire:ignore class="table-responsive">
                                            <table id="myTable2"
                                                class="table card-table table-vcenter text-nowrap datatable"
                                                wire:ignore>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cédula</th>
                                                        <th>Nome Completo</th>
                                                        <th>Categoria</th>
                                                        <th>Tipo de Processo</th>
                                                        <th>Município</th>
                                                        <th>Endereço</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lista_advogados as $item)
                                                        <tr>

                                                            @php

                                                                $cedula = '';
                                                                if ($item->advogado_id == null) {
                                                                    $cedula = $item->num_cedula;
                                                                } else {
                                                                    $cedula = $item->getadvogado->categoria == 'Estagiario' ? $item->getadvogado->num_estagiario : $item->getadvogado->num_associado;
                                                                }

                                                                $nome = $item->advogado_id == null ? $item->nome : $item->getadvogado->getpessoa->nome;
                                                                $municipio = $item->advogado_id == null ? $item->getmunicipio->descricao : $item->getadvogado->getmunicipio->descricao;
                                                                $endereco = $item->advogado_id == null ? $item->endereco_escritorio : $item->getadvogado->endereco_escritorio;

                                                            @endphp

                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $cedula }}
                                                            </td>
                                                            <td>
                                                                {{$nome}}
                                                            </td>
                                                            <td>{{ $item->advogado_id == null ? $item->categoria : $item->getadvogado->categoria }}
                                                            </td>
                                                            <td>{{ $item->tipo_processo }}</td>
                                                            <td>{{ $municipio }}</td>
                                                            <td>{{ $endereco }}</td>

                                                            <td>
                                                                <a title="Adicionar" data-id="{{ $item->advogado_id }}"
                                                                    class="btn-adicionar badge bg-blue-lt"
                                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-adicionar">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M12 5l0 14" />
                                                                        <path d="M5 12l14 0" />
                                                                    </svg>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <a href="#" class="btn btn-info mt-5" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#modal-lista-advogados">Lista
                                            geral de advogados</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-lista-advogados" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lista geral dos advogados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div wire:ignore class="table-responsive">
                        <table id="myTable" class="table card-table table-vcenter text-nowrap datatable" wire:ignore>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cédula</th>
                                    <th>Nome Completo</th>
                                    <th>Categoria</th>
                                    <th>Município</th>
                                    <th>Endereço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lista_advogados_geral as $item)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$item->num_associado}}</td>
                                        <td>
                                            <a data-id="{{ $item->id }}" class="link-advogado btn-adicionar">
                                                {{$item->getpessoa->nome}}
                                            </a>
                                        </td>
                                        <td>{{$item->categoria}}</td>
                                        <td>{{ $item->municipio_id == null ? '' : $item->getmunicipio->descricao }}</td>
                                        <td>{{ $item->endereco_escritorio }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-advogados-atribuidos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advogados atribuidos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div wire:ignore class="table-responsive">
                        <table id="myTable" class="table card-table table-vcenter text-nowrap datatable" wire:ignore>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cédula</th>
                                    <th>Nome Completo</th>
                                    <th>Categoria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advogados_atribuidos as $item)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{ $item->getadvogado->categoria == 'Estagiario' ? $item->getadvogado->num_estagiario : $item->getadvogado->num_associado }}
                                        </td>
                                        <td>
                                            <a data-id="{{ $item->id }}" class="">
                                                {{$item->getadvogado->getpessoa->nome}}
                                            </a>
                                        </td>
                                        <td>{{$item->getadvogado->categoria}}</td>
                                        <td>
                                            <a title="remover" data-id="{{ $item->id }}" style="cursor: pointer;"
                                                class="btn-remover badge bg-red-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </td>
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
    <script src="{{ asset('assets/system/js/atribuir-advogado.js') }}"></script>
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true // Habilita a barra de pesquisa
            });

            $('#myTable2').DataTable({
                paging: false, // Desabilita a paginação
                searching: true // Habilita a barra de pesquisa
            });
        });
    </script>
@endsection