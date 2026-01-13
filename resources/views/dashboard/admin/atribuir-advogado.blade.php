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
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordion-example">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-1" aria-expanded="true">
                                                Detalhes do Pedido de Assistência Jurídica
                                            </button>
                                        </h2>
                                        <div id="collapse-1" class="accordion-collapse collapse"
                                            data-bs-parent="#accordion-example">
                                            <div class="accordion-body pt-0">

                                                <div class="alert alert-primary">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">

                                                            <p class="detalhes">
                                                                Nº do Processo: {{ $registo->codigo }} <br>
                                                                Requerente: {{ $registo->proveniencia }} <br>
                                                                <strong> Assunto: {{ $registo->assunto }}</strong> <br>
                                                                Data de Entrada: {{ $registo->data_entrada }} <br>
                                                                Data de Registo na Secretaria:
                                                                {{ $registo->created_at }} <br>
                                                            </p>

                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">

                                                            <p class="detalhes">
                                                                Tipo de documento: {{ $registo->tipo_documento }} <br>
                                                                Estado: {{ $registo->estado }} <br>
                                                                Destinatário: {{ $registo->destinatario }} <br>
                                                                Encaminhado: {{ $registo->encaminhado }} <br>
                                                                Nota de Encaminhamento:
                                                                {{ $registo->nota_encaminhamento }} <br>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="row mt-4">
                                    <div wire:ignore class="col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6">
                                        <h3 class="text-center">Lista de Advogados</h3>
                                        <div wire:ignore class="table-responsive">
                                            <table id="myTable"
                                                class="table card-table table-vcenter text-nowrap datatable"
                                                wire:ignore>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Cédula</th>
                                                        <th>Nome Completo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lista_advogados as $item)
                                                        <tr>
                                                            <td>{{$loop->index + 1}}</td>
                                                            <td>{{$item->num_associado}}</td>
                                                            <td>
                                                                <a class="link-advogado"
                                                                    wire:click="escolherAdvogado({{ $item->id }})">
                                                                    {{$item->getpessoa->nome}}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6">
                                        <h3 class="text-center">Atribuir Advogado</h3>

                                        @if ($registo->estado == 'deferido' || $registo->estado == 'arquivado')
                                            <div class="alert alert-success text-center">
                                                <h4>
                                                    Para este pedido de assistência jurídica já foi atribuído um advogado.
                                                </h4>
                                            </div>
                                        @endif
                                        
@if ($registo->estado != 'deferido' && $registo->estado != 'arquivado')
                                        <div class="alert alert-primary">
                                            @if ($this->advogado_selecionado == null && $this->outro_advogado == false)
                                                <h4 class="alert alert-info text-center">
                                                    Selecione um advogado da base de dados, a partir da lista apresentada à
                                                    esquerda.<br><br>
                                                    Caso deseja atribuir outro advogado <a class="btn-outro"
                                                        wire:click="atribuir_outro()">Clique Aqui</a>
                                                </h4>
                                            @endif
                                            @if ($this->advogado_selecionado != null && $this->outro_advogado == false)
                                                <strong>Cédula: </strong> {{ $advogado_selecionado->num_associado }}
                                                <br><br>
                                                <strong>Nome Completo: </strong>
                                                {{ $advogado_selecionado->getpessoa->nome }}
                                                <br><br>
                                                <strong>Contacto: </strong>
                                                {{ $advogado_selecionado->getpessoa->telefone1 }}
                                                <br><br>
                                                <strong>Email: </strong> {{ $advogado_selecionado->getpessoa->email }}
                                                <br><br>

                                                @if ($this->advogado_selecionado->getpessoa->telefone1 == null)
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12 col-12 col-md-12 col-xl-12">
                                                            <div class="form-group">
                                                                <label for="telefone">Telefone</label>
                                                                <input type="number" wire:model="telefone" name="telefone"
                                                                    class="form-control" maxlength="9" id="telefone" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($this->advogado_selecionado->getpessoa->email == null)
                                                    <div class="row mt-3">
                                                        <div class="col-lg-12 col-12 col-md-12 col-xl-12">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" wire:model="email" name="email"
                                                                    class="form-control" maxlength="255" id="email" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row mt-3">
                                                    <div class="col-lg-12 col-12">
                                                        <a wire:click="confirmar_atribuicao"
                                                            class="btn btn-success mt-4">Confirmar</a>
                                                        <a wire:click="cancelar_selecao"
                                                            class="btn btn-danger mt-4">Cancelar</a>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($this->outro_advogado == true)
                                                <form class="">

                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                                            <div class="row">

                                                                <input type="hidden" id="tipo_processo_id"
                                                                    value="{{ $registo->tipo_processo_id }}">
                                                                <input type="hidden" id="permissao_user_id"
                                                                    value="{{ Auth::user()->permissao_id }}">

                                                                <div class="col-lg-6 col-12 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="num_cedula">Nº Cédula</label>
                                                                        <input type="text" wire:model="cedula"
                                                                            name="num_cedula" class="form-control"
                                                                            id="num_cedula" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-12 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input type="number" wire:model="telefone"
                                                                            name="telefone" class="form-control"
                                                                            maxlength="9" id="telefone" value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12 col-md-12 col-xl-12">
                                                                    <div class="form-group">
                                                                        <label for="nome_completo">Nome Completo</label>
                                                                        <input type="text" wire:model="nome_completo"
                                                                            name="nome_completo" class="form-control"
                                                                            maxlength="255" id="nome_completo" value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12 col-md-12 col-xl-12">
                                                                    <div class="form-group">
                                                                        <label for="email">Email</label>
                                                                        <input type="email" wire:model="email" name="email"
                                                                            class="form-control" maxlength="255" id="email"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" id="registo_id" name="registo_id"
                                                                value="{{ $registo->id }}">

                                                            <div class="row mt-3">
                                                                <div class="col-lg-12 col-12">
                                                                    <a wire:click="confirmar_atribuicao"
                                                                        class="btn btn-success mt-4">Confirmar</a>
                                                                    <a wire:click="$set('outro_advogado', false)"
                                                                        class="btn btn-danger mt-4">Cancelar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <!-- <script src="{{ asset('assets/system/js/adicionar-anexo.js') }}"></script> -->
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $('#myTable').DataTable();

            $('#myTable').DataTable({
                paging: false, // Desabilita a paginação
                searching: true // Habilita a barra de pesquisa
            });
        });
    </script>
@endsection