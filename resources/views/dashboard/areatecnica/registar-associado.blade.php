<div>

    <style>
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

        .obrigatorio {
            color: red;
            font-weight: bold;
        }
    </style>

    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Formulário de Registo de Associados (Advogados e Advogados Estagiários)
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nome_completo">Nome completo <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="200" name="nome_completo"
                                                        class="form-control" id="nome_completo" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nome_profissional">Nome
                                                        profissional <span class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="200" name="nome_profissional"
                                                        class="form-control" id="nome_profissional" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_bi">Nº Bilhete <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="15" name="num_bi" class="form-control"
                                                        id="num_bi" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone1">Telefone principal <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone2">Telefone
                                                        alternativo</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2" value="">
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="sexo">Género <span
                                                            class="obrigatorio">*</span></label>
                                                    <select name="sexo" id="sexo" class="form-select">
                                                        <option value="" selected>Selecione...</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_associado">Nº Associado (Nº
                                                        Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_associado"
                                                        class="form-control" id="num_associado" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_estagiario">Nº Estagiário (Nº
                                                        Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_estagiario"
                                                        class="form-control" id="num_estagiario" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" maxlength="200" name="email"
                                                        class="form-control" id="email" value="">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="data_inscricao_oaa">Data de Inscrição
                                                        Advogado</label>
                                                    <input type="date" name="data_inscricao_oaa" class="form-control"
                                                        id="data_inscricao_oaa" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="data_inscricao_estagiario">Data de
                                                        Inscrição
                                                        Estagiário</label>
                                                    <input type="date" name="data_inscricao_estagiario"
                                                        class="form-control" id="data_inscricao_estagiario" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="categoria">Categoria <span
                                                            class="obrigatorio">*</span></label>
                                                    <select name="categoria" id="categoria" class="form-select">
                                                        <option value="" selected>Selecione...</option>
                                                        <option value="Advogado">Advogado</option>
                                                        <option value="Estagiario">Estagiario</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="estado">Estado <span
                                                            class="obrigatorio">*</span></label>
                                                    <select name="estado" id="estado" class="form-select">
                                                        <option value="">Selecione...</option>
                                                        <option value="Registado" selected>Registado</option>
                                                        <option value="Aguarda Cerimónia">Aguarda Cerimónia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="end-advogado">
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="endereco_profissional_adv">Endereço
                                                            Profissional <span class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_profissional_adv"
                                                            name="endereco_profissional_adv">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="municipio_id_adv">Município <span
                                                                class="obrigatorio">*</span></label>
                                                        <select name="municipio_id_adv" id="municipio_id_adv"
                                                            class="form-select">
                                                            <option value="" selected>Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="dvescolher-patrono">
                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="escolher_patrono">Escolher
                                                            Patrono <span class="obrigatorio">*</span></label>
                                                        <select name="escolher_patrono" id="escolher_patrono"
                                                            class="form-select">
                                                            <option value="existe" selected>Patrono Existente</option>
                                                            <option value="novo">Novo Patrono</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group" id="dvnomepatronoexiste">
                                                        <label class="form-label" for="nome_patrono_existe">Nome do
                                                            Patrono <span class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_patrono_existe" name="nome_patrono_existe">
                                                        <div id="patrono_dropdown" class="custom-dropdown"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="pat-existente">

                                            <div class="row mt-3">

                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tel_patrono_existe">Telefone do
                                                            patrono</label>
                                                        <input type="text" class="form-control" maxlength="9"
                                                            id="tel_patrono_existe" name="tel_patrono_existe">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email_patrono_existe">Email do
                                                            patrono</label>
                                                        <input type="email" class="form-control" maxlength="200"
                                                            id="email_patrono_existe" name="email_patrono_existe">
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nome_escritorio_existe">Nome do
                                                            Escritório</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_escritorio_existe" name="nome_escritorio_existe">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="cedula_patrono_existe">Número da
                                                            Cédula</label>
                                                        <input type="text" class="form-control" maxlength="7"
                                                            id="cedula_patrono_existe" name="cedula_patrono_existe">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-3">

                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="municipio_id_est_existe">Município</label>
                                                        <select name="municipio_id_est_existe" id="municipio_id_est_existe"
                                                            class="form-select">
                                                            <option value="" selected>Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="endereco_escritorio_est_existe">Endereço
                                                            do
                                                            Escritório</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_escritorio_est_existe" name="endereco_escritorio_est_existe">
                                                    </div>
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
                                                <a href="{{ route('system.areatecnica.regist_lawyer') }}"
                                                    class="btn btn-danger mt-4">Cancelar</a>
                                            </div>
                                        </div>

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

@section('script-aux')
    <script>
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
    <script src="{{ asset('assets/system/js/registar-associado.js') }}"></script>
@endsection