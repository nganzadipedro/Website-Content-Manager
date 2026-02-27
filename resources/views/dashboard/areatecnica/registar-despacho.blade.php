<div>


    <style>
        .detalhes {
            font-size: 14px;
            line-height: 1.75;
        }
    </style>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Registar Despacho e Outras Informações
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Registar Despacho e Outras Informações</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="registo_entrada_id" id="registo_entrada_id"
                                    value="{{ $registo->id }}">
                                <input type="hidden" name="inscricao_advogado_id" id="inscricao_advogado_id"
                                    value="{{ $inscricao_advogado->id }}">
                                <input type="hidden" name="field_data_remessa_cn" id="field_data_remessa_cn"
                                    value="{{ $inscricao_advogado->data_remessa_cn }}">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="alert alert-primary mt-3">
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p class="detalhes">
                                                        Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                        Nº do Processo Área Técnica: {{ $inscricao_advogado->codigo }}
                                                        <br>
                                                        Requerente: {{ $registo->proveniencia }}<br>
                                                        <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                        Data de Entrada: {{ $registo->data_entrada }}<br>
                                                        Data de Registo na Secretaria: {{ $registo->created_at }}<br>
                                                        Tipo de Processo: {{ $registo->gettipoprocesso->descricao }}<br>
                                                        Observação: {{ $inscricao_advogado->texto_despacho }}<br>
                                                    </p>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p class="detalhes">
                                                        Tipo de documento: {{ $registo->tipo_documento }}<br>
                                                        Estado: {{ $registo->estado }}<br>
                                                        Despacho: {{ $inscricao_advogado->despacho }}<br>
                                                        Data de Despacho: {{ $inscricao_advogado->data_despacho }}<br>
                                                        Data de Remessa ao CN: {{ $inscricao_advogado->data_remessa_cn }}<br>
                                                        Telefone 1: {{ $inscricao_advogado->telefone1 }}<br>
                                                        Telefone 2: {{ $inscricao_advogado->telefone2 }}<br>
                                                        Email: {{ $inscricao_advogado->email }}<br>
                                                        @if($inscricao_advogado->despacho == 'Indeferido')
                                                            <a target="_blank"
                                                                href="{{ route('system.areatecnica.documento_despacho', $inscricao_advogado->hash) }}">[
                                                                Imprimir Documento de Despacho ]</a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        @if($inscricao_advogado->despacho == 'Deferido')

                                            <div class="alert alert-success mt-3 text-center">
                                                <strong>Este processo de inscrição já foi deferido.</strong>
                                            </div>

                                            <div class="row mt-4">
                                                @if ($inscricao_advogado->data_remessa_cn == null)
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="data_remessa_cn">Data de Remessa ao CN</label>
                                                            <input type="date" wire:model="data_remessa_cn"
                                                                name="data_remessa_cn" class="form-control" id="data_remessa_cn"
                                                                value="">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($inscricao_advogado->data_remessa_cn != null)
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="cedula_disponivel">Cédula Disponível</label>
                                                            <select wire:model="cedula_disponivel" name="cedula_disponivel"
                                                                id="cedula_disponivel" class="form-control">
                                                                <option value="" selected>Não definido</option>
                                                                <option value="Sim">Sim</option>
                                                                <option value="Não">Não</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="num_cedula">Nº Cédula</label>
                                                            <input type="text" maxlength="6" wire:model="numero_cedula"
                                                                name="numero_cedula" class="form-control" id="numero_cedula"
                                                                value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="data_emissao_cedula">Data de Emissão</label>
                                                            <input type="date" wire:model="data_emissao_cedula"
                                                                name="data_emissao_cedula" class="form-control"
                                                                id="data_emissao_cedula" value="">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if ($inscricao_advogado->data_remessa_cn != null)
                                                <div class="row mt-4">

                                                    <div class="col-lg-4 col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="data_cerimonia">Data da Cerimónia</label>
                                                            <input type="date" wire:model="data_cerimonia" name="data_cerimonia"
                                                                class="form-control" id="data_cerimonia" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-12">
                                                    <a id="btn-actualizar-dados" class="btn btn-success mt-4">Actualizar
                                                        Dados</a>
                                                </div>
                                            </div>

                                        @else

                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="despacho">Despacho</label>
                                                        <select name="despacho" id="despacho" class="form-control">
                                                            <option value="" selected>Escolha a opção...</option>
                                                            <option value="Deferido">Deferido</option>
                                                            <option value="Indeferido">Indeferido</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="data_despacho">Data do despacho</label>
                                                        <input type="date" name="data_despacho" class="form-control"
                                                            id="data_despacho" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12 col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="mensagem_despacho">Mensagem do despacho</label>
                                                        <input type="text" maxlength="255" name="mensagem_despacho"
                                                            class="form-control" id="mensagem_despacho" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-12">
                                                    <a id="btn-registar-despacho" class="btn btn-success mt-4">Salvar</a>
                                                    <a href="{{ route('system.areatecnica.listar_advogados_pendentes') }}"
                                                        class="btn btn-danger mt-4">Cancelar</a>
                                                </div>
                                            </div>

                                        @endif

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@if ($inscricao_advogado->despacho == 'Deferido')
    @section('script-aux')
        <script src="{{ asset('assets/system/js/actualizar-despacho.js') }}"></script>
    @endsection
@endif

@if ($inscricao_advogado->despacho != 'Deferido')
    @section('script-aux')
        <script src="{{ asset('assets/system/js/registar-despacho.js') }}"></script>
    @endsection
@endif