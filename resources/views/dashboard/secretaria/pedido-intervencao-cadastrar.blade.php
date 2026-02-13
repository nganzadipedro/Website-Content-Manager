<div>

    <div class="page-wrapper">

        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="card card-md">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <div class="mt-3">
                                    <h3>Pedido de Intervenção</h3>
                                    <a href="#" class="btn btn-info" style="cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#modal-novo-advogado">+ Adicionar Advogado/Advogado
                                        Estagiário +</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nº Cédula</th>
                                            <th>Nome Completo</th>
                                            <th>Categoria</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista_advogados as $item)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$item->categoria == 'Advogado' ? $item->num_associado : $item->num_estagiario}}
                                                </td>
                                                <td>{{ $item->getpessoa->nome }}</td>
                                                <td>{{$item->categoria}}</td>
                                                <td>
                                                    <a title="Adicionar" data-id="{{ $item->id }}"
                                                        data-nome="{{ $item->getpessoa->nome }}"
                                                        data-cedula="{{ $item->categoria == 'Advogado' ? $item->num_associado : $item->num_estagiario }}"
                                                        data-email="{{ $item->getpessoa->email }}"
                                                        data-categoria="{{ $item->categoria }}"
                                                        data-municipio_id="{{ $item->municipio_id }}"
                                                        data-tel1="{{ $item->getpessoa->telefone1 }}"
                                                        data-tel2="{{ $item->getpessoa->telefone2 }}" class="btn-adicionar"
                                                        style="cursor: pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#modal-adicionar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-adicionar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados do Advogado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="advogado_id" id="advogado_id" value="">
                    <div class="mb-3">
                        <label class="form-label">Nome do Advogado</label>
                        <input type="text" maxlength="200" class="form-control" name="nome_advogado" id="nome_advogado"
                            disabled value="">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nº Cédula</label>
                                <input type="text" maxlength="7" class="form-control" name="num_cedula" id="num_cedula">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Advogado">Advogado</option>
                                    <option value="Estagiario">Estagiario</option>
                                    <option value="Por especificar">Por especificar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" maxlength="150" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Telefone principal</label>
                                <input type="text" maxlength="9" class="form-control" name="telefone1" id="telefone1">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Telefone alternativo</label>
                                <input type="text" maxlength="9" class="form-control" name="telefone2" id="telefone2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nome do Escritório</label>
                                <input type="text" maxlength="200" class="form-control" name="nome_escritorio"
                                    id="nome_escritorio">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Endereço do Escritório/Profissional</label>
                                <input type="text" maxlength="200" class="form-control" name="endereco_escritorio"
                                    id="endereco_escritorio">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="municipio_id" class="form-label">Município</label>
                                <select name="municipio_id" id="municipio_id" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    @foreach ($municipios as $mun)
                                        <option value="{{$mun->id}}">{{$mun->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="tipo_processo" class="form-label">Tipo de Processo a Intervir</label>
                                <select name="tipo_processo" id="tipo_processo" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Civil">Civil</option>
                                    <option value="Penal">Penal</option>
                                    <option value="Laboral">Laboral</option>
                                    <option value="Familiar">Familiar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dados-patrono">
                        <div class="mb-3">
                            <label class="form-label">Nome do Patrono</label>
                            <input type="text" maxlength="200" class="form-control" name="nome_patrono"
                                id="nome_patrono" value="">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                    <label class="form-label">Telefone do patrono</label>
                                    <input type="text" maxlength="9" class="form-control" name="telefone_patrono"
                                        id="telefone_patrono">
                                </div>
                                <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                    <label class="form-label">Email do patrono</label>
                                    <input type="email" maxlength="150" class="form-control" name="email_patrono"
                                        id="email_patrono">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-pedido" class="btn btn-success mt-4">Salvar</a>
                        <a href="{{ route('system.areatecnica.listar_advogados_registados') }}"
                            class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-novo-advogado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dados do Advogado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome do Advogado</label>
                        <input type="text" maxlength="200" class="form-control" name="new_nome_advogado"
                            id="new_nome_advogado" value="">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nº Cédula</label>
                                <input type="text" maxlength="7" class="form-control" name="new_num_cedula"
                                    id="new_num_cedula">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="new_categoria" class="form-label">Categoria</label>
                                <select name="new_categoria" id="new_categoria" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Advogado">Advogado</option>
                                    <option value="Estagiario">Estagiario</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_email">Email</label>
                        <input type="email" maxlength="150" class="form-control" name="new_email" id="new_email">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Telefone principal</label>
                                <input type="text" maxlength="9" class="form-control" name="new_telefone1"
                                    id="new_telefone1">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Telefone alternativo</label>
                                <input type="text" maxlength="9" class="form-control" name="new_telefone2"
                                    id="new_telefone2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nº Bilhete</label>
                                <input type="text" maxlength="15" class="form-control" name="num_documento"
                                    id="num_documento">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="genero" class="form-label">Género</label>
                                <select name="genero" id="genero" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nome do Escritório</label>
                                <input type="text" maxlength="200" class="form-control" name="new_nome_escritorio"
                                    id="new_nome_escritorio">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Endereço do Escritório/Profissional</label>
                                <input type="text" maxlength="200" class="form-control" name="new_endereco_escritorio"
                                    id="new_endereco_escritorio">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="new_municipio_id" class="form-label">Município</label>
                                <select name="new_municipio_id" id="new_municipio_id" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    @foreach ($municipios as $mun)
                                        <option value="{{$mun->id}}">{{$mun->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="new_tipo_processo" class="form-label">Tipo de Processo a Intervir</label>
                                <select name="new_tipo_processo" id="new_tipo_processo" class="form-control">
                                    <option value="" selected>Selecione...</option>
                                    <option value="Civil">Civil</option>
                                    <option value="Penal">Penal</option>
                                    <option value="Laboral">Laboral</option>
                                    <option value="Familiar">Familiar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dados-patrono-new">
                        <div class="mb-3">
                            <label class="form-label">Nome do Patrono</label>
                            <input type="text" maxlength="200" class="form-control" name="new_nome_patrono"
                                id="new_nome_patrono" value="">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                    <label class="form-label">Telefone do patrono</label>
                                    <input type="text" maxlength="9" class="form-control" name="new_telefone_patrono"
                                        id="new_telefone_patrono">
                                </div>
                                <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                    <label class="form-label">Email do patrono</label>
                                    <input type="email" maxlength="150" class="form-control" name="new_email_patrono"
                                        id="new_email_patrono">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-novo-advogado" class="btn btn-success mt-4">Salvar</a>
                        <a href="{{ route('system.areatecnica.listar_advogados_registados') }}"
                            class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/pedido-intervencao.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection