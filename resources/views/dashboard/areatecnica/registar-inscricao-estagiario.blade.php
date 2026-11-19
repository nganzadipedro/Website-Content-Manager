<div>

    <style>
        .obs {
            background-color: red;
            color: white;
            display: block;
            padding: 3px;
            border-radius: 5px;
            margin-top: 3px;
        }

        .obrigatorio {
            color: red;
            font-weight: bold;
        }

        .custom-dropdown {
            position: relative;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--surface);
            border: .5px solid var(--border-md);
            border-top: none;
            border-radius: 0 0 var(--r) var(--r);
            max-height: 220px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: var(--shadow-md);
            display: block;
        }

        .custom-dropdown-item {
            padding: 9px 12px;
            cursor: pointer;
            font-size: 12px;
            color: var(--t2);
            border-bottom: .5px solid var(--border);
            transition: background 0.15s ease, color 0.15s ease;
        }

        .custom-dropdown-item:last-child {
            border-bottom: none;
        }

        .custom-dropdown-item:hover {
            background-color: #ebeb32;
            color: #000;
        }

        .custom-dropdown-empty {
            padding: 10px 12px;
            color: var(--t3);
            font-size: 12px;
            text-align: center;
        }
    </style>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ $registo->tipo_processo_id == 2 ? 'Registar Inscrição de Advogados' : 'Registar Inscrição de Advogados Estagiários' }}
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
                                <h4 class="card-title">
                                    {{ $registo->tipo_processo_id == 2 ? 'Registar Inscrição de Advogados' : 'Registar Inscrição de Advogados Estagiários' }}
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" value="" id="patrono_id">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <!-- <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                                                <button class="btn">Nº Processo <span
                                                        class="badge bg-azure text-azure-fg ms-2">{{ $registo->codigo }}</span></button>
                                            </div>
                                        </div> -->

                                        <div class="alert alert-primary mt-3">
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p>
                                                        Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                        Requerente: {{ $registo->proveniencia }}<br>
                                                        <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                        Data de Entrada: {{ $registo->data_entrada }}<br>
                                                        Data de Registo na Secretaria: {{ $registo->created_at }}<br>
                                                        Tipo de Processo:
                                                        {{ $registo->tipo_processo_id == 9 ? $registo->outro_tipo_processo : $registo->gettipoprocesso->descricao }}
                                                        <br>
                                                    </p>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p>
                                                        Tipo de documento: {{ $registo->tipo_documento }}<br>
                                                        Estado: {{ $registo->estado }}<br>
                                                        Destinatário: {{ $registo->destinatario }}<br>
                                                        Encaminhado: {{ $registo->encaminhado }}<br>
                                                        @if($registo->observacao != null && $registo->observacao != '')
                                                            <span class="obs">{{ $registo->observacao }}</span>
                                                        @endif
                                                        <br>
                                                        Nº Estagiários: <span id="num_estagiarios"></span><br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <input type="hidden" value="{{ $registo->tipo_processo_id }}"
                                                id="tipo_processo_id" name="tipo_processo_id">
                                            <input type="hidden" value="{{ $registo->id }}" id="registo_entrada_id"
                                                name="registo_entrada_i">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_bilhete">Nº Bilhete <span class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="20" name="num_bilhete"
                                                        class="form-control" id="num_bilhete" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="sexo">Género <span class="obrigatorio">*</span></label>
                                                    <select name="sexo" id="sexo" class="form-select">
                                                        <option value="" selected>Selecione...</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone1">Telefone 1 <span class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1"
                                                        value="{{ $registo->telefone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone2">Telefone 2</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2"
                                                        value="{{ $registo->telefone2 }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" maxlength="255" name="email"
                                                        class="form-control" id="email" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="acto_pretendido">Acto
                                                        Pretendido <span class="obrigatorio">*</span></label>
                                                    <select name="acto_pretendido" id="acto_pretendido" class="form-select">
                                                        <option selected value="">Selecione...</option>
                                                        <option value="Inscrição">Inscrição</option>
                                                        <option value="Reinscrição">Reinscrição</option>
                                                        <option value="Indicação de Patrono">Indicação de Patrono
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group" id="dvescolher_patrono">
                                                    <label class="form-label" for="escolher_patrono">Escolher
                                                        Patrono <span class="obrigatorio">*</span></label>
                                                    <select name="escolher_patrono" id="escolher_patrono"
                                                        class="form-select">
                                                        <option value="existe" selected>Patrono Existente</option>
                                                        <option value="novo">Novo Patrono</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-lg-6 col-12 col-md-6 col-sm-12 col-xl-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="observacao2">Observação (Indeferimento)</label>
                                                    <input type="text" name="observacao2" class="form-control"
                                                        id="observacao2" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group" id="dvnomepatronoexiste">
                                                    <label class="form-label" for="nome_patrono_existe">Pesquisar Nome
                                                        do
                                                        Patrono <span class="obrigatorio">*</span></label>
                                                    <input type="text" class="form-control" maxlength="200"
                                                        id="nome_patrono_existe" name="nome_patrono_existe">
                                                    <div id="patrono_dropdown" class="custom-dropdown"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="end-estagiario">

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nome_patrono">Nome do
                                                            patrono <span class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_patrono" name="nome_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tel_patrono">Telefone do
                                                            patrono</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="tel_patrono" name="tel_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email_patrono">Email do
                                                            patrono</label>
                                                        <input type="email" class="form-control" maxlength="200"
                                                            id="email_patrono" name="email_patrono">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nome_escritorio">Nome do
                                                            Escritório</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_escritorio" name="nome_escritorio">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="cedula_patrono">Número da
                                                            Cédula</label>
                                                        <input type="text" class="form-control" maxlength="7"
                                                            id="cedula_patrono" name="cedula_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="municipio_id_est">Município <span
                                                                class="obrigatorio">*</span></label>
                                                        <select name="municipio_id_est" id="municipio_id_est"
                                                            class="form-select">
                                                            <option value="" selected>Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">

                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="endereco_escritorio_est">Endereço
                                                            do
                                                            Escritório <span class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_escritorio_est" name="endereco_escritorio_est">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>




                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a id="btn-registar-inscricao" class="btn btn-success mt-4">Salvar</a>
                                                <a href="{{ route('system.areatecnica.listar_advogados_pendentes') }}"
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
</div>


@section('script-aux')
    <script>
        // Carrega os 1000+ produtos em memória no JavaScript
        let nome = @json($lista_patronos);
        console.log(nome);
        const listaPatronosGlobal = [
            @foreach ($lista_patronos as $pro)
                                                                                                                                {
                    id: "{{ $pro[0] }}",
                    advogado_id: "{{ $pro[1] }}",
                    nome: "{{ $pro[2] }}"
                },
            @endforeach
                                                                ];
    </script>
    <script src="{{ asset('assets/template/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/system/js/registar-inscricao-estagiario.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection