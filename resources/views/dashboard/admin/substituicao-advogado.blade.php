<div>

    <style>
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

        .obrigatorio {
            color: red;
            font-weight: bold;
        }
    </style>


    <div class="page-wrapper">

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Formulário de Atribuição de Advogados para Substituições de
                                    Assistências Judiciais</h3>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row mt-3 mb-5">
                                    <div class="col-lg-3 col-12 col-md-3">
                                        <label class="form-label" for="num_processo">Nº Processo <span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" class="form-control" maxlength="20" id="num_processo"
                                            name="num_processo">
                                    </div>
                                    <div class="col-lg-3 col-12 col-md-3">
                                        <a id="btn-verificar" class="btn btn-success mt-4" style="cursor: pointer;">
                                            Verificar</a>
                                    </div>
                                </div>

                                <div class="row mt-3 mb-5">
                                    <div class="col-lg-12 col-12 col-md-6">
                                        <label class="form-label" for="assunto_processo">Assunto do Processo</label>
                                        <input type="text" class="form-control" disabled maxlength="200"
                                            id="assunto_processo" name="assunto_processo">
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

                                <div class="row mt-3">
                                    <div class="col-lg-6 col-12 col-md-6">
                                        <label class="form-label" for="advogado_substituido">Nome do
                                            Advogado a ser substituído <span class="obrigatorio">*</span></label>
                                        <input type="text" class="form-control" maxlength="200"
                                            id="advogado_substituido" name="advogado_substituido">
                                    </div>
                                    <div class="col-lg-6 col-12 col-md-6">
                                        <label class="form-label" for="nome_requerente">Nome do
                                            Requerente <span class="obrigatorio">*</span></label>
                                        <input type="text" class="form-control" maxlength="200" id="nome_requerente"
                                            name="nome_requerente">
                                    </div>
                                </div>
                                <div class="row mt-3 mb-5">
                                    <div class="col-lg-3 col-12 col-md-3">
                                        <label for="tipo_indicacao" class="form-label">Tipo de
                                            Indicação <span class="obrigatorio">*</span></label>
                                        <select class="form-select" name="tipo_indicacao" id="tipo_indicacao">
                                            <option value="" selected>Selecione...</option>
                                            <option value="Auto-Indicação">Auto-Indicação</option>
                                            <option value="Indicação-Conselheiro">Indicação-Conselheiro
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3 col-12 col-md-3">
                                        <label for="insitituicao_copia" class="form-label">Instituição em
                                            cópia</label>
                                        <input type="text" id="insitituicao_copia" name="insitituicao_copia"
                                            class="form-control">
                                    </div>

                                    <div class="col-lg-3 col-12 col-md-3">
                                        <label for="referencia_assist_inicial" class="form-label">Nº Referência da Assistência Inicial <span class="obrigatorio">*</span></label>
                                        <input type="text" id="referencia_assist_inicial" name="referencia_assist_inicial"
                                            class="form-control">
                                    </div>
                                </div>

                                <a id="btn-ver-advogados" class="btn btn-info mt-3" style="cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#modal-advogados-atribuidos">Ver
                                    advogados atribuídos</a>
                                <a id="btn-confirmar" class="btn btn-success mt-3" style="cursor: pointer;">
                                    Confirmar</a>
                                <a id="btn-cancelar" class="btn btn-danger mt-3" style="cursor: pointer;">
                                    Cancelar</a>
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
    <script src="{{ asset('assets/system/js/substituicao-advogado.js') }}"></script>
@endsection