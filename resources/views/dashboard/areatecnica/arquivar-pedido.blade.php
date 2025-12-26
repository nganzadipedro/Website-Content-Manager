<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Arquivar Pedido de Assistência
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
                                <h4 class="card-title">Arquivar Pedido de Assistência</h4>
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
                                            <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                <div class="alert alert-primary">
                                                    Nº do Processo: {{ $registo->codigo }} <br><br>
                                                    Requerente: {{ $registo->proveniencia }} <br><br>
                                                    <strong> Assunto: {{ $registo->assunto }}</strong> <br><br>
                                                    Data de Entrada: {{ $registo->data_entrada }} <br><br>
                                                    Data de Registo na Secretaria: {{ $registo->created_at }} <br><br>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                <div class="alert alert-primary">
                                                    Tipo de documento: {{ $registo->tipo_documento }} <br><br>
                                                    Estado: {{ $registo->estado }} <br><br>
                                                    Destinatário: {{ $registo->destinatario }} <br><br>
                                                    Encaminhado: {{ $registo->encaminhado }} <br><br>
                                                    Nota de Encaminhamento: {{ $registo->nota_encaminhamento }} <br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Sexo</label>
                                                    <select wire:model="sexo" name="sexo" id="sexo"
                                                        class="form-control">
                                                        <option value="Não Definido" selected>Não Definido</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="natureza">Natureza</label>
                                                    <select wire:model="natureza" name="natureza" id="natureza"
                                                        class="form-control">
                                                        <option value="Não Definido" selected>Não Definido</option>
                                                        <option value="Crime">Crime</option>
                                                        <option value="Laboral">Laboral</option>
                                                        <option value="Família">Família</option>
                                                        <option value="Cível">Cível</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="localizacao">Localização</label>
                                                    <input type="text" wire:model="localizacao" name="localizacao"
                                                        class="form-control" id="localizacao" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-12 col-12 col-md-12">
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
                                                <a href="{{ route('system.areatecnica.listar_pedidos_pendentes') }}"
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


@section('script-aux')
    <script src="{{ asset('assets/system/js/cadastrar-galeria.js') }}"></script>
@endsection