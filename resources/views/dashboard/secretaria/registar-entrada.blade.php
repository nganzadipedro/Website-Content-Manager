<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Registo de Entrada
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
                                <h4 class="card-title">Registo de Entrada</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-12 col-12">
                                                <div class="form-group">
                                                    <label for="assunto">Assunto</label>
                                                    <input type="text" wire:model="assunto" name="assunto"
                                                        class="form-control" id="assunto" value="">
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

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="destinatario">Destinatário</label>
                                                    <select clang="form-control" wire:model="destinatario"
                                                        name="destinatario" id="destinatario" class="form-control">
                                                        <option value="CPL-OAA" selected>CPL-OAA</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-9 col-xl-9 col-md-9 col-12">
                                                <div class="form-group">
                                                    <label for="observacao">Observação</label>
                                                    <input type="text" wire:model="observacao" name="observacao"
                                                        class="form-control" id="observacao" value="">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row mt-3">

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


@section('script-aux')
    <script src="{{ asset('assets/system/js/cadastrar-galeria.js') }}"></script>
@endsection