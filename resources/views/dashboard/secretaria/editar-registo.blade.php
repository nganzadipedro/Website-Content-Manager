<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Editar Registo de Entrada
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
                                <h4 class="card-title">Editar Registo de Entrada</h4>

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

                                        <div class="row mt-4">
                                            <div class="col-lg-9 col-md-9 col-12">
                                                <div class="form-group">
                                                    <label for="assunto">Assunto</label>
                                                    <input type="text" wire:model="assunto" name="assunto"
                                                        class="form-control" id="assunto" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_processo_id">Tipo de Processo</label>
                                                    <select wire:model="tipo_processo_id" clang="form-control"
                                                        name="tipo_processo_id" id="tipo_processo_id"
                                                        class="form-control">
                                                        @foreach ($tipos_processo as $tipo)
                                                            <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="proveniencia">Proveniência</label>
                                                    <input type="text" wire:model="proveniencia" name="proveniencia"
                                                        class="form-control" id="proveniencia" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="titulo">Título/Função</label>
                                                    <select wire:model="titulo" clang="form-control" name="titulo"
                                                        id="titulo" class="form-control">
                                                        <option selected>Selecione...</option>
                                                        <option value="Cidadão">Cidadão Comum</option>
                                                        <option value="Advogado">Advogado</option>
                                                        <option value="Provedoria">Provedoria</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @if ($this->titulo == 'Outro')
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="tipo_documento">Título/Função</label>
                                                        <input type="text" class="form-control" maxlength="100"
                                                            wire:model="outro_titulo">
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo de Documento</label>
                                                    <select wire:model="tipo_documento" clang="form-control"
                                                        name="tipo_documento" id="tipo_documento" class="form-control">
                                                        <option value="Requerimento" selected>Requerimento</option>
                                                        <option value="Ofício">Ofício</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-xl-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="data_entrada">Data de Entrada</label>
                                                    <input type="date" wire:model="data_entrada" name="data_entrada"
                                                        id="data_entrada" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="destinatario">Destinatário</label>
                                                    <select clang="form-control" wire:model="destinatario"
                                                        name="destinatario" id="destinatario" class="form-control">
                                                        <option value="CPL-OAA" selected>CPL-OAA</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone">Telefone</label>
                                                    <input class="form-control" wire:model="telefone" maxlength="9"
                                                        type="text" name="telefone" id="telefone" value="">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row mt-3">

                                            <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="observacao">Observação</label>
                                                    <input type="text" wire:model="observacao" name="observacao"
                                                        class="form-control" id="observacao" value="">
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