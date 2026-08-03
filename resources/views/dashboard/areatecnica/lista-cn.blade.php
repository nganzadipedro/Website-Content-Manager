<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">


                    <h3 class="h1">Processos de Inscrição de Advogados Remetidos ao Conselho Nacional</h3>
                    <div class="row mt-5">
                        <div class="col-7">

                            <a id="btn-registar-dataremessa" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                    <path d="M16 3v4" />
                                    <path d="M8 3v4" />
                                    <path d="M4 11h16" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg> Registar Data de Remessa</a>
                            <a id="btn-gerar-excel" class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-spreadsheet">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                                    <path d="M8 11h8v7h-8l0 -7" />
                                    <path d="M8 15h8" />
                                    <path d="M11 11v7" />
                                </svg>Exportar em Excel</a>
                            <a id="btn-gerar-pdf" class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                    <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                    <path d="M17 18h2" />
                                    <path d="M20 15h-3v6" />
                                    <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1" />
                                </svg>Exportar em PDF</a>

                        </div>
                        <div class="col-3">
                            <label for="">Data de Remessa</label>
                            <input type="date" name="data_remessa_cn_filtro" id="data_remessa_cn_filtro"
                                class="form-control form-control-sm">
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
                                        <th>Contactos</th>
                                        <th>Estado</th>
                                        <th>Data Entrada</th>
                                        <th>Data Despacho</th>
                                        <th>Data Remessa CN</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>
                                                @if ($item->data_remessa_cn == null)
                                                    <input type="checkbox" class="checkItem" value="{{$item->id}}">
                                                @endif
                                            </td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->getregistoentrada->proveniencia}}</td>
                                            <td>{{$item->telefone1}}/{{$item->telefone2}}</td>
                                            <td>{{$item->estado}}</td>
                                            <td>{{$item->getregistoentrada->data_entrada}}</td>
                                            <td>{{$item->data_despacho}}</td>
                                            <td>{{$item->data_remessa_cn}}</td>
                                            <td>
                                                <a style="cursor: pointer;" data-bilhete="{{$item->num_bilhete}}"
                                                    data-nome="{{$item->getregistoentrada->proveniencia}}"
                                                    class="badge bg-green-lt registar-informacoes"
                                                    data-id="{{ $item->id }}" data-sexo="{{ $item->sexo }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                        <path d="M16 19h6" />
                                                        <path d="M19 16v6" />
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

    <div class="modal modal-blur fade" id="modal-registar-informacoes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registar Informações</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <input type="hidden" id="inscricao_id" value="">

                    <div class="row mb-3">
                        <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                            <label for="">Nome</label>
                            <input type="text" disabled maxlength="200" value="" class="form-control" id="nome">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label for="">Nº Bilhete</label>
                            <input type="text" maxlength="15" value="" class="form-control" id="num_bilhete">
                        </div>
                        <div class="col-lg-6 col-12 col-md-6">
                            
                                <label for="sexo">Género</label>
                                <select name="sexo" id="sexo" class="form-select">
                                    <option value="" selected>Não Definido</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class=" col-md-6 col-lg-6 col-12 col-xs-12">
                            <div class="form-group">
                                <label for="cedula_disponivel">Cédula Disponível</label>
                                <select name="cedula_disponivel" id="cedula_disponivel" class="form-select">
                                    <option value="Sim" selected>Sim</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-md-6 col-lg-6 col-12 col-xs-12">
                            <div class="form-group">
                                <label for="num_cedula">Nº Cédula</label>
                                <input type="text" maxlength="7" name="numero_cedula" class="form-control"
                                    id="numero_cedula" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <div class="form-group">
                                <label for="data_emissao_cedula">Data de Emissão da Cédula</label>
                                <input type="date" name="data_emissao_cedula" class="form-control"
                                    id="data_emissao_cedula" value="">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <div class="form-group">
                                <label for="aguarda_cerimonia">Aguarda Cerimónia</label>
                                <select name="aguarda_cerimonia" id="aguarda_cerimonia" class="form-select">
                                    <option value="Sim">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-registar-informacoes" class="btn btn-success mt-4">Salvar</a>
                        <a id="btn-cancelar" class="btn btn-danger mt-4">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-remeter-cn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data de remessa ao Conselho Nacional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row"">
                        <div class=" col-md-12 col-lg-12 col-12 col-xs-12">
                        <label for="data_remessa_cn" class="form-label">Data de Remessa ao CN</label>
                        <input type="date" class="form-control" name="data_remessa_cn" id="data_remessa_cn">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 col-12">
                    <a id="btn-salvar-remessacn" class="btn btn-success mt-4">Salvar</a>
                    <a id="btn-cancelar-remessacn" class="btn btn-danger mt-4">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/adv-remetidoscn.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true // Habilita a barra de pesquisa
            });
        });
    </script>
@endsection