<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">

                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Processos de Inscrição Para Advogado Remetidos à Comissão de Ética</h3>
                            <a id="btn-registar-devolucao-modal" class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up-double">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M13 14l-4 -4l4 -4" />
                                    <path d="M8 14l-4 -4l4 -4" />
                                    <path d="M9 10h7a4 4 0 1 1 0 8h-1" />
                                </svg> Registar Devolução da Comissão de Ética</a>
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

                        <div class="table-responsive" style="max-height: 550px; overflow: auto; padding: 5px;">
                            <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <input type="checkbox" id="checkAll">
                                        </th>
                                        <th>Nº Processo</th>
                                        <th>Requerente</th>
                                        <th>Estado</th>
                                        <th>Data de Remessa à CE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>
                                                @if ($item->estado == 'análise comissão de ética')
                                                    <input type="checkbox" class="checkItem" value="{{$item->id}}">
                                                @endif
                                            </td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->getregistoentrada->proveniencia}}</td>
                                            <td>{{$item->estado}}</td>
                                            <td>{{$item->data_levantamento_comissao_etica}}
                                            </td>
                                            <td>
                                                <a style="cursor: pointer;" title="Editar Dados do Processo"
                                                    href="{{ route('system.areatecnica.editar_inscricao', $item->getregistoentrada->hash) }}"
                                                    class="badge bg-yellow-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>
                                                <a style="cursor:pointer;" class="badge bg-red-lt registar-indeferido"
                                                    data-nome="{{ $item->getregistoentrada->proveniencia }}"
                                                    title="Registar Como Indeferido" data-id="{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 9v4" />
                                                            <path
                                                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />
                                                            <path d="M12 16h.01" />
                                                        </svg>
                                                </a>
                                                <a data-id="{{ $item->id }}" class="badge bg-blue-lt btn-detalhes"
                                                    title="Detalhes do processo" style="cursor: pointer;"
                                                    data-bs-toggle="modal" data-bs-target="#modal-detalhes">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-align-box-left-middle">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14" />
                                                        <path d="M9 15h-2" />
                                                        <path d="M13 12h-6" />
                                                        <path d="M11 9h-4" />
                                                    </svg>
                                                </a>
                                                <a data-id="{{ $item->registo_entrada_id }}"
                                                    class="btn-historico badge bg-yellow-lt" title="Histórico do processo"
                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-historico">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-history">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 8l0 4l2 2" />
                                                        <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
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

    <div class="modal modal-blur fade" id="modal-alterar-despacho" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registar Indeferimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="inscricao_id" id="inscricao_id" value="">
                    <div class="mb-3">
                        <label class="form-label">Nome do Requerente</label>
                        <input type="text" class="form-control" name="nome_requerente" id="nome_requerente" disabled
                            value="">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                                <label class="form-label">Data de Entrega</label>
                                <input type="date" class="form-control" name="data_entrega_comissao_etica2"
                                    id="data_entrega_comissao_etica2">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem do Despacho</label>
                        <textarea rows="5" name="texto_despacho" id="texto_despacho" class="form-control"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-indeferimento" class="btn btn-success mt-4">Salvar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-registar-devolucao" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registar Devolução da Comissão de Ética (Deferidos)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <h4 class="alert alert-info text-center mb-4">
                        Este formulário é destinado apenas para aqueles processos que foram analisados e serão remetidos
                        à mesa do Sr. Presidente.
                    </h4>

                    <div class="row mt-5">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label">Data de Entrega</label>
                            <input type="date" class="form-control" name="data_entrega_comissao_etica"
                                id="data_entrega_comissao_etica">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label" for="encaminhar_mesa">Encaminhar à Mesa do Presidente?</label>
                            <select name="encaminhar_mesa" id="encaminhar_mesa" class="form-control">
                                <option selected value="Sim">Sim, Encaminhar</option>
                                <option value="Não">Não Encaminhar</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-devolucao" class="btn btn-success mt-4">Salvar</a>
                        <a id="btn-cancelar-devolucao" class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-historico" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Histórico do Processo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush list-group-hoverable" id="list-group-item">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-detalhes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes do Processo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class=" alert alert-primary" id="dv-detalhes"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/remetidos-comissao-etica.js') }}"></script>
    <script>
        window.avatarUrl = "{{ asset('images/user-icon.png') }}";
        $(document).ready(function () {
            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true, // Habilita a barra de pesquisa
                ordering: false
            });
        });
    </script>
@endsection