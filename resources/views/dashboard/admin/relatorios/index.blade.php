
@extends('layouts.app')

@section('conteudo')
<div>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Relatórios</a></li>
            <li class="breadcrumb-item active">Gerar relatórios</li>
        </ol>
    </div>

    <div class="row mt-5">

        <div class="col-xl-12" id="card-none2">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-0">Configurações</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body collapse show" id="collapseExample2" style="">

                    <ul class="nav nav-pills nav-primary mb-3" role="tablist">
                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link active" wire:ignore.self data-bs-toggle="tab" href="#dashborad"
                                role="tab" aria-selected="true">Candidaturas</a>
                        </li>

                        <li class="nav-item waves-effect waves-light" role="presentation">
                            <a class="nav-link" wire:ignore.self data-bs-toggle="tab" href="#editardados" role="tab"
                                aria-selected="false" tabindex="-1">Resultado dos exames</a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted">

                        <div class="tab-pane active" id="dashborad" role="tabpanel" wire:ignore.self>

                            <form onsubmit="return validacao1();" id="demo-form2"
                                class="form-horizontal form-label-left" method="POST" action="{{ route('admin.relatorios.relatorio') }}">

                                @csrf

                                <div class="row mt-5">
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12 ">
                                        <label>Tipo de Relatório <span class="required">*</span></label>
                                        <br>
                                        <br>
                                        <div class="radio">
                                            <label for="tipo1">
                                                <input value="aprovadas" type="radio" class="iradio_flat-green"
                                                    name="tipo" id="tipo1" checked> Todas Candidaturas Aprovadas
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <label for="tipo2">
                                                <input value="pagas" type="radio" class="iradio_flat-green"
                                                    name="tipo" id="tipo2">
                                                Todas Candidaturas Pagas
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <label for="tipo3">
                                                <input value="suspensas" type="radio" class="iradio_flat-green"
                                                    name="tipo" id="tipo3">
                                                Todas Candidaturas Suspensas
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <label for="tipo4">
                                                <input value="pendentes" type="radio" class="iradio_flat-green"
                                                    name="tipo" id="tipo4">
                                                Todas Candidaturas Pendentes
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <label for="tipo5">
                                                <input value="todas" type="radio" class="iradio_flat-green"
                                                    name="tipo" id="tipo5">
                                                Todas Candidaturas
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12 ">
                                        <label>Tipo de Filtro</label>
                                        <br>
                                        <br>
                                        <div class="radio">
                                            <label for="filtro1">
                                                <input value="provincia" wire:model.defer="provincia_filtro.provincia"
                                                    type="checkbox" class="iradio_flat-green" name="filtro_provincia"
                                                    id="filtro1">
                                                Província Exame
                                            </label>
                                        </div>

                                        <br>
                                        <div class="radio">
                                            <label for="filtro2">
                                                <input value="necessidade" type="checkbox" class="iradio_flat-green"
                                                    name="filtro_necessidade" id="filtro2">
                                                Com necessidade Especial
                                            </label>
                                        </div>


                                        <div id="dv-provincia" style="display: none">
                                            <br>
                                            <label for="provincia_exame">
                                                Província
                                            </label>
                                            <select name="provincia_exame" wire:model="provincia_id"
                                                id="provincia_exame" class="form-control">
                                                <option value="0">Selecione...</option>
                                                @foreach ($provincias as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->descricao }}</option>
                                                @endforeach
                                            </select>

                                        </div>



                                    </div>
                                </div>

                                <br>
                                <br>

                                <input onclick="return validacao1();" type="submit" class="btn btn-success"
                                    value="Gerar Relatório">
                            </form>

                        </div>

                        <div class="tab-pane" id="editardados" role="tabpanel" wire:ignore.self>

                            <form onsubmit="return validacao();" id="demo-form2"
                                class="form-horizontal form-label-left" method="POST" action="">

                                @csrf

                                <div class="row mt-5">
                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xs-12 ">
                                        <label>Tipo de Relatório <span class="required">*</span></label>
                                        <br>
                                        <br>
                                        <div class="radio">
                                            <label for="exame1">
                                                <input value="provincia" type="radio" class="iradio_flat-green"
                                                    name="exame" id="exame1" checked> Resultados por província
                                            </label>
                                        </div>
                                        <br>
                                        <div class="radio">
                                            <label for="exame2">
                                                <input value="geral" type="radio" class="iradio_flat-green"
                                                    name="exame" id="exame2"> Todos Resultados
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xs-12 ">
                                        <label>Tipo de Ficheiro <span class="required">*</span></label>
                                        <br>
                                        <br>
                                        <div class="radio">
                                            <label for="ficheiro1">
                                                <input value="pdf" type="radio" class="iradio_flat-green"
                                                    name="ficheiro" id="ficheiro1" checked> PDF
                                            </label>
                                        </div>
                                        <br>

                                        <div class="radio">
                                            <label for="ficheiro2">
                                                <input value="excel" type="radio" class="iradio_flat-green"
                                                    name="ficheiro" id="ficheiro2"> EXCEL
                                            </label>
                                        </div>
                                        <br>

                                    </div>

                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xs-12">
                                        <div id="dv-provincia-2">
                                            <label for="provincia_exame_id">
                                                Província do exame
                                            </label>
                                            <select name="provincia_exame_id" id="provincia_exame_id"
                                                class="form-control">
                                                <option value="0">Selecione...</option>
                                                @foreach ($provincias as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>

                                {{-- <input onclick="return validacao();" type="submit" class="btn btn-success"
                                    name="" id="" value="Gerar Relatório"> --}}
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('script-aux')
    <script src="{{ URL::asset('assets/system/js/relatorios/index.js') }} "></script>
@endsection
