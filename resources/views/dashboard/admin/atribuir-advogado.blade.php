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
                                                <a id="btn-confirmar" class="btn btn-success mt-3"
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
                                                        <th>Código</th>
                                                        <th>Cédula</th>
                                                        <th></th>
                                                        <th>Nome Completo</th>
                                                        <th>Categoria</th>
                                                        <th>Município</th>
                                                        <th>Endereço</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lista_advogados_geral as $item)

                                                        @if ($item->getpessoa->nome != null && $item->getpessoa->nome != '')

                                                            <tr>

                                                                @php

                                                                    $cedula = '';
                                                                    $cedula = $item->categoria == 'Estagiario' ? $item->num_estagiario : $item->num_associado;

                                                                    $nome = $item->getpessoa->nome;

                                                                    $municipio = $item->municipio_id != null ? $item->getmunicipio->descricao : '';
                                                                    $endereco = $item->endereco_escritorio;

                                                                @endphp

                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $item->id }}
                                                                <td>{{ $cedula }}
                                                                </td>
                                                                <td>
                                                                    <a title="Adicionar" data-id="{{ $item->id }}"
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
                                                                <td>
                                                                    {{$nome}}
                                                                </td>
                                                                <td>{{ $item->categoria }}
                                                                </td>
                                                                <td>{{ $municipio }}</td>
                                                                <td>{{ $endereco }}</td>



                                                            </tr>

                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <a href="#" class="btn btn-info mt-5" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#modal-lista-advogados">Lista
                                            geral de advogados</a> -->
                                        <a href="#" class="btn btn-primary mt-5" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#modal-registar-advogado">Registar
                                            Advogado/Estagiario</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal modal-blur fade" id="modal-lista-advogados" tabindex="-1" role="dialog" aria-hidden="true">
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
    </div> -->

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

    <div class="modal modal-blur fade" id="modal-registar-advogado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registar Advogado/Estagiário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12 col-12 col-md-12">
                            <div class="form-group">
                                <label for="nome_completo">Nome completo</label>
                                <input type="text" maxlength="200" name="nome_completo" class="form-control"
                                    id="nome_completo" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 col-12 col-md-12">
                            <div class="form-group">
                                <label for="nome_profissional">Nome profissional</label>
                                <input type="text" maxlength="200" name="nome_profissional" class="form-control"
                                    id="nome_profissional" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-lg-6 col-12 col-md-6">
                            <div class="form-group">
                                <label for="num_bi">Nº Bilhete</label>
                                <input type="text" maxlength="15" name="num_bi" class="form-control" id="num_bi"
                                    value="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 col-md-6">
                            <div class="form-group">
                                <label for="telefone1">Telefone principal</label>
                                <input type="text" maxlength="9" name="telefone1" class="form-control" id="telefone1"
                                    value="">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6 col-12 col-md-6">
                            <div class="form-group">
                                <label for="telefone2">Telefone alternativo</label>
                                <input type="text" maxlength="9" name="telefone2" class="form-control" id="telefone2"
                                    value="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 col-md-6">
                            <div class="form-group">
                                <label for="sexo">Género</label>
                                <select name="sexo" id="sexo" class="form-select">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12 col-12 col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" maxlength="200" name="email" class="form-control" id="email"
                                    value="">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-6 col-12 col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select name="categoria" id="categoria" class="form-select">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Advogado">Advogado</option>
                                    <option value="Estagiario">Estagiario</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="end-advogado">

                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="num_associado">Nº Associado (Nº Cédula)</label>
                                    <input type="text" maxlength="9" name="num_associado" class="form-control"
                                        id="num_associado" value="">
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="num_estagiario_adv">Nº Estagiário (Nº Cédula)</label>
                                    <input type="text" maxlength="9" name="num_estagiario_adv" class="form-control"
                                        id="num_estagiario_adv" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">

                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="data_inscricao_oaa">Data de Inscrição Advogado</label>
                                    <input type="date" name="data_inscricao_oaa" class="form-control"
                                        id="data_inscricao_oaa" value="">
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="data_inscricao_estagiario_adv">Data de Inscrição
                                        Estagiário</label>
                                    <input type="date" name="data_inscricao_estagiario_adv" class="form-control"
                                        id="data_inscricao_estagiario_adv" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="endereco_profissional_adv">Endereço Profissional</label>
                                    <input type="text" class="form-control" maxlength="200"
                                        id="endereco_profissional_adv" name="endereco_profissional_adv">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="municipio_id_adv">Município</label>
                                    <select name="municipio_id_adv" id="municipio_id_adv" class="form-select">
                                        <option value="" selected>Selecione...</option>
                                        @foreach ($municipios as $muni)
                                            <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nome_escritorio_adv">Nome do Escritório</label>
                                    <input type="text" class="form-control" maxlength="200" id="nome_escritorio_adv"
                                        name="nome_escritorio_adv">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="end-estagiario">
                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="num_estagiario_est">Nº Estagiário (Nº Cédula)</label>
                                    <input type="text" maxlength="9" name="num_estagiario_est" class="form-control"
                                        id="num_estagiario_est" value="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="data_inscricao_estagiario_est">Data de Inscrição
                                        Estagiário</label>
                                    <input type="date" name="data_inscricao_estagiario_est" class="form-control"
                                        id="data_inscricao_estagiario_est" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nome_patrono">Nome do patrono</label>
                                    <input type="text" class="form-control" maxlength="200" id="nome_patrono"
                                        name="nome_patrono">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="num_cedula_patrono">Nº Cédula Patrono</label>
                                    <input type="text" maxlength="9" name="num_cedula_patrono" class="form-control"
                                        id="num_cedula_patrono" value="">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tel_patrono">Telefone do patrono</label>
                                    <input type="text" maxlength="9" class="form-control" maxlength="200"
                                        id="tel_patrono" name="tel_patrono">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="email_patrono">Email do patrono</label>
                                    <input type="email" class="form-control" maxlength="200" id="email_patrono"
                                        name="email_patrono">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">

                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nome_escritorio_est">Nome do Escritório</label>
                                    <input type="text" class="form-control" maxlength="200" id="nome_escritorio_est"
                                        name="nome_escritorio_est">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="municipio_id_est">Município (Escritório)</label>
                                    <select name="municipio_id_est" id="municipio_id_est" class="form-select">
                                        <option value="" selected>Selecione...</option>
                                        @foreach ($municipios as $muni)
                                            <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12 col-12 col-md-12">
                                <div class="form-group">
                                    <label for="endereco_escritorio_est">Endereço do Escritório</label>
                                    <input type="text" class="form-control" maxlength="200" id="endereco_escritorio_est"
                                        name="endereco_escritorio_est">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12 col-12">
                            <a id="btn-registar-advogado" class="btn btn-success mt-4">Salvar</a>
                            <a href="#" class="btn btn-danger mt-4">Cancelar</a>
                        </div>
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