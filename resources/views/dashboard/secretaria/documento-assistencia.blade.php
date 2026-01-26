<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Emitir Documento de Assistência Jurídica
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
                                <h4 class="card-title">Emitir Documento de Assistência Jurídica</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                <button class="btn">Nº Processo <span
                                                        class="badge bg-azure text-azure-fg ms-2">{{ $registo->codigo }}</span></button>
                                            </div>
                                        </div>

                                        @if ($this->advogado_atribuido != null)
                                            <div class="row mt-3">
                                                <div class="alert alert-primary mt-3">
                                                    <div class="row mt-4">
                                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                            <p class="detalhes">
                                                                Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                                Requerente: {{ $registo->proveniencia }}<br>
                                                                <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                                Data de Entrada: {{ $registo->data_entrada }}<br>
                                                                Data de Registo na Secretaria:
                                                                {{ $registo->created_at }}<br>
                                                                Tipo de Processo:
                                                                {{ $registo->gettipoprocesso->descricao }}<br>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                            <p class="detalhes">
                                                                Advogado Atribuido: {{ $nome_advogado }}<br>
                                                                Telefone: {{ $telefone_advogado }}<br>
                                                                Email: {{ $email_advogado }}<br>
                                                                Categoria: {{ $categoria_advogado }}<br>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mt-3">

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="tipo_situacao">Tipo de Situação</label>
                                                    <select wire:model="tipo_situacao" clang="form-control"
                                                        name="tipo_situacao" id="tipo_situacao" class="form-control">
                                                        <option selected>Selecione...</option>
                                                        <option value="Comum">Cidadão solicita advogado</option>
                                                        <option value="Sub Advogado">Cidadão solicita substituição de
                                                            advogado</option>
                                                        <option value="Advogado">Advogado solicita permissão de
                                                            intervenção</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="endereco_advogado">Endereço Advogado</label>
                                                    <input type="text" maxlength="300" name="endereco_advogado"
                                                        id="endereco_advogado" wire:model="endereco_advogado"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="patrono">Nome do patrono</label>
                                                    <input maxlength="100" type="text" name="patrono" id="patrono"
                                                        wire:model="patrono" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a wire:click="salvar()" class="btn btn-success mt-4">Salvar</a>
                                                <a href="{{ route('system.secretaria.dashboard') }}"
                                                    class="btn btn-danger mt-4">Cancelar</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success ms-auto">Enviar dados</button>
                            </div>
                        </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>