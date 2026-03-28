<div>

    <div class="page-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row text-center">
                            <h2>Pedidos de defesa oficiosa {{$categoria_p}}s</h2>
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
                                            <th>Nome Completo</th>
                                            <th>Categoria</th>
                                            <th>Nº Cédula</th>
                                            <th>Nº Bilhete</th>
                                            <th>Estado</th>
                                            <th>Tipo de Processo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedidos as $item)
                                            <tr>

                                                @php

                                                    $cedula = '';
                                                    if ($item->advogado_id == null) {
                                                        $cedula = $item->num_cedula;
                                                    } else {
                                                        $cedula = $item->getadvogado->categoria == 'Estagiario' ? $item->getadvogado->num_estagiario : $item->getadvogado->num_associado;
                                                    }

                                                    $nome = $item->advogado_id == null ? $item->nome : $item->getadvogado->getpessoa->nome;

                                                @endphp

                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$nome}}
                                                </td>
                                                <td>{{$item->advogado_id == null ? $item->categoria : $item->getadvogado->categoria}}
                                                </td>
                                                <td>{{$cedula}}</td>
                                                <td>{{$item->advogado_id == null ? $item->num_documento : $item->getadvogado->getpessoa->num_documento}}
                                                </td>
                                                <td>{{$item->estado}}</td>
                                                <td>{{$item->tipo_processo}}</td>
                                                <td>
                                                    <a title="Visualizar Documento"
                                                        data-url="{{ asset('storage/' . $item->documento_anexo) }}"
                                                        style="cursor: pointer;" data-id="{{ $item->id }}"
                                                        class="btn-visualizardoc badge bg-blue-lt">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
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


    <div class="modal modal-blur fade" id="modal-visualizardoc" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitação de defesa oficiosa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-12 col-xs-12">
                            <div class="alert alert-primary" id="dv-detalhes">

                            </div>
                            <div class="alert alert-danger" id="dv-motivo">

                            </div>

                            <a id="btn-autorizar" class="btn btn-success">Aprovar Pedido</a>
                            <a id="btn-rejeitar" class="btn btn-danger">Rejeitar Pedido</a>
                        </div>
                        <div class="col-md-8 col-lg-8 col-12 col-xs-12">
                            <iframe id="pdfViewer" width="100%" height="520px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-rejeitar-solicitacao" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="border: solid 1px #000 !important;">
                <div class="modal-header">
                    <h5 class="modal-title">Rejeitar solcitação de desefa oficiosa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="pedido_id" id="pedido_id" value="">

                    <div class="mb-3">
                        <label class="form-label">Nome do Requerente</label>
                        <input type="text" class="form-control" name="nome_requerente" id="nome_requerente" disabled
                            value="">
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                            <label class="form-label">Motivo da rejeição</label>
                            <textarea rows="5" name="motivo_rejeicao" id="motivo_rejeicao"
                                class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <a id="btn-confirmar-rejeicao" class="btn btn-success mt-4">Confirmar Rejeição</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/pedido-intervencao-listar.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection