<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">

                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Inscrições Para Advogados Pendentes</h3>
                            <a id="btn-encaminhar-processo" class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-forward-up-double">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11 14l4 -4l-4 -4" />
                                    <path d="M16 14l4 -4l-4 -4" />
                                    <path d="M15 10h-7a4 4 0 1 0 0 8h1" />
                                </svg> Encaminhar Processo</a>
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
                                        <th>Nº Proc. Secretaria</th>
                                        <th>Assunto</th>
                                        <th>Data de Entrada</th>
                                        <th>Requerente</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>

                                                <input type="checkbox" class="checkItem" value="{{$item->id}}">

                                            </td>
                                            <td>{{$item->codigo}}</td>
                                            <td>{{$item->assunto}}</td>
                                            <td>{{$item->data_entrada}}</td>
                                            <td>{{$item->proveniencia}}</td>
                                            <td>
                                                <a title="Registar" class="badge bg-green-lt"
                                                    href="{{ route('system.areatecnica.registar_inscricao', $item->hash) }}">
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
                                            <td>
                                                <a title="Detalhes do Registo"
                                                    href="{{ route('system.areatecnica.detalhes_registo', $item->hash) }}"
                                                    class="badge bg-blue-lt">
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

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Encaminhar Processo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                                <label class="form-label">Situação da Cédula</label>
                                <select name="situacao_cedula" id="situacao_cedula" class="form-select">
                                    <option value="Sim" selected>Cédula Disponível</option>
                                    <option value="Não">Cédula Não Disponível</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label">Telefone principal</label>
                            <input type="text" maxlength="9" class="form-control" name="telefone_principal"
                                id="telefone_principal">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label">Telefone alternativo</label>
                            <input type="text" maxlength="9" class="form-control" name="telefone_alternativo"
                                id="telefone_alternativo">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label">Email</label>
                            <input type="text" maxlength="200" class="form-control" name="email" id="email">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                            <label class="form-label">Nº Bilhete</label>
                            <input type="text" maxlength="15" class="form-control" name="num_bilhete" id="num_bilhete">
                        </div>
                    </div>

                    <div id="campossemcedula">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                                    <label class="form-label">Encaminhar para</label>
                                    <select name="encaminhar_para" id="encaminhar_para" class="form-select">
                                        <option value="conselheiro" selected>Conselheiro</option>
                                        <option value="comissao">Comissão de Ética</option>
                                        <option value="presidente">Sobre a Mesa do Presidente</option>
                                        <option value="indeferido">Indeferidos</option>
                                        <option value="cnacional">Conselho Nacional</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label for="conselheiro_id" class="form-label">Conselheiro</label>
                                <select name="conselheiro_id" id="conselheiro_id" class="form-select">
                                    <option value="" selected>---- Selecione -----</option>
                                    @foreach ($lista_conselheiros as $conselheiro)
                                        <option value="{{ $conselheiro->id }}">{{ $conselheiro->getpessoa->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de entrega ao conselheiro</label>
                                <input type="date" class="form-control" name="data_entrega_conselheiro"
                                    id="data_entrega_conselheiro">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de entrega à comissão de ética</label>
                                <input type="date" class="form-control" name="data_entrega_comissao"
                                    id="data_entrega_comissao">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de remessa ao CN</label>
                                <input type="date" class="form-control" name="data_remessacn" id="data_remessacn">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de Despacho (Indeferido)</label>
                                <input type="date" class="form-control" name="data_despacho" id="data_despacho">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 col-12 col-xs-12">
                                <label class="form-label">Mensagem do despacho</label>
                                <textarea name="mensagem_despacho" id="mensagem_despacho" rows="3"
                                    class="form-control"></textarea>
                            </div>
                        </div>

                    </div>

                    <div id="camposcedula">

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Nº Cédula</label>
                                <input type="text" maxlength="7" class="form-control" name="num_cedula" id="num_cedula">
                            </div>
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <label class="form-label">Data de Emissão da Cédula</label>
                                <input type="date" class="form-control" name="data_emissao_cedula"
                                    id="data_emissao_cedula">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-6 col-12 col-xs-12">
                                <div class="form-group">
                                    <label for="aguarda_cerimonia" class="form-label">Aguarda Cerimónia</label>
                                    <select name="aguarda_cerimonia" id="aguarda_cerimonia" class="form-select">
                                        <option value="Sim">Sim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6">
                                <div class="form-group">
                                    <label for="sexo" class="form-label">Género</label>
                                    <select name="sexo" id="sexo" class="form-select">
                                        <option value="" selected>Não Definido</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-12">
                        <a id="btn-salvar-encaminhar" class="btn btn-success mt-4">Salvar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('script-aux')
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/adv-pendentes.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true, // Habilita a barra de pesquisa
                ordering: false
            });
        });
    </script>
@endsection