@extends('layouts.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('layouts.navbar')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Turmas</h6>
                            </div>
                        </div>
                        <div class="card-body card card-plain h-100">

                            <form role="form">

                                @csrf

                                <div class="row form-group">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="descricao">Descrição</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input name="descricao" id="descricao" type="text" class="form-control"
                                                placeholder="Descrição da Turma">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="sala_exame">Sala do Exame</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input name="sala_exame" id="sala_exame" type="text" class="form-control"
                                                placeholder="Sala para o exame">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="">Data do Exame</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input name="data_exame" id="data_exame" type="date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label for="">Hora do Exame</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input name="hora_exame" id="hora_exame" type="time" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="descricao">Curso</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select name="curso_id" id="curso_id" class="form-control">
                                                <option value="0">Selecione...</option>
                                                @foreach ($cursos as $item)
                                                    <option value="{{ $item->id }}">{{ $item->descricao }} ({{ $item->unidade->descricao }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <a id="btn-salvar" class="btn btn-lg bg-gradient-success btn-lg mt-4 mb-0">Salvar</a>
                                </div>
                                <br>
                            </form>

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="tb-data-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                #</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Descrição</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Sala</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Data e Hora</th>
                                                <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Curso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($turmas as $item)
                                            <tr>
                                                <td>

                                                    <div class="text-center">
                                                        <h6 class="mb-0 text-sm">{{ $loop->index + 1 }}</h6>
                                                    </div>

                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->id }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->descricao }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->sala_exame }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->data_exame . ' ' . $item->hora_exame }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $item->getCurso->descricao }}</p>
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

    </main>
@endsection

@section('script-aux')
    <script src="{{ URL::asset('assets/js/system/admin-sistema/turmas/cadastrar.js') }}"></script>
@endsection
