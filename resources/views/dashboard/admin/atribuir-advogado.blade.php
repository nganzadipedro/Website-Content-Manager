<div>

    <style>
        .detalhes {
            font-size: 14px;
            line-height: 1.75;
        }

        .obrigatorio {
            color: red;
            font-weight: bold;
        }

        .custom-dropdown {
            position: relative;
            left: 0;
            right: 0;
            background: var(--surface);
            border: .5px solid var(--border-md);
            border-top: none;
            border-radius: 0 0 var(--r) var(--r);
            max-height: 220px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--shadow-md);
            display: block;
        }

        .custom-dropdown-item {
            padding: 9px 12px;
            cursor: pointer;
            font-size: 12px;
            color: var(--t2);
            border-bottom: .5px solid var(--border);
            transition: background 0.15s ease, color 0.15s ease;
        }

        .custom-dropdown-item:last-child {
            border-bottom: none;
        }

        .custom-dropdown-item:hover {
            background-color: #ebeb32;
            color: #000;
        }

        .custom-dropdown-empty {
            padding: 10px 12px;
            color: var(--t3);
            font-size: 12px;
            text-align: center;
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

                                                <a id="btn-ver-advogados" class="btn btn-info mt-3"
                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-advogados-atribuidos">Ver
                                                    advogados atribuídos</a>
                                                <a id="btn-confirmar" class="btn btn-success mt-3"
                                                    style="cursor: pointer;">
                                                    Confirmar</a>

                                            </p>
                                        </div>
                                    </div>


                                </div>

                                <div class="row mt-3 mb-5">
                                    <div class="col-lg-12 col-12 col-md-6">
                                        <label class="form-label" for="search_advogado_indicado">Pesquisar
                                            Advogado/Advogado Estagiário a ser indicado <span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" class="form-control" maxlength="200"
                                            id="search_advogado_indicado" name="search_advogado_indicado">
                                        <div id="dropdown_search_advogado" class="custom-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <table class="table card-table table-vcenter text-nowrap datatable" wire:ignore>
                            <thead>
                                <tr>
                                    <th>Nome Completo</th>
                                    <th>Cédula</th>
                                    <th>Categoria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tabela-advogados-atribuidos">
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
    <script>
        // Carrega os 1000+ produtos em memória no JavaScript
        let nome = @json($lista_advogados_geral);
        const listaAdvogadosGlobal = [
            @foreach ($lista_advogados_geral as $pro)
                                                                                                                                                                                                                        {
                    id: "{{ $pro->id }}",
                    advogado_id: "{{ $pro->id }}",
                    nome: "{{ $pro->getpessoa->nome }}",
                    cedula: "{{ $pro->categoria == 'Advogado' ? $pro->num_associado : $pro->num_estagiario }}",
                    categoria: "{{ $pro->categoria }}"
                },
            @endforeach
                                                                                    ];
    </script>
    <script src="{{ asset('assets/system/js/atribuir-advogado.js') }}"></script>
@endsection