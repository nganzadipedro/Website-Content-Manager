<div>

@php

    $total1 = 0;
    $total2 = 0;
    $total3 = 0;

    if(count($this->res) > 0){
        $total1 = $this->res[0];
        $total2 = $this->res[1];
        $total3 = $this->res[2];
    }

@endphp

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Gerar Relatórios
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
                        <form class="card">
                            <div class="card-header">
                                <h4 class="card-title">Gerar Relatórios</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                                        <label for="data_inicial">Data Inicial</label>
                                        <input type="date" wire:model="data_inicial" name="data_inicial"
                                            id="data_inicial" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
                                        <label for="data_final">Data Final</label>
                                        <input type="date" wire:model="data_final" name="data_final" id="data_final"
                                            class="form-control">
                                    </div>
                                </div>

                                
                                <br>
                                <br>
                                <br>
                                <div class="row mt-5 text-center">
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-12 col-sm-12">
                                        <h1>{{ $total1 }}</h1>
                                        <label for="data_inicial">Pedidos de Assistência Judiciária</label>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-12 col-sm-12">
                                        <h1>{{ $total2 }}</h1>
                                        <label for="data_inicial">Inscrições para Advogado</label>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-xl-4 col-12 col-sm-12">
                                        <h1>{{ $total3 }}</h1>
                                        <label for="data_inicial">Inscrições para Advogado Estagiário</label>
                                    </div>
                                </div>
                             

                                <div class="row mt-3">
                                    <div class="col-lg-12 col-12">
                                        <a wire:click="get_data_report" class="btn btn-success mt-4">Buscar
                                            Informações</a>
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