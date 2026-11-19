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
            background-color: var(--bg);
            color: var(--t1);
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
                                    Formulário de edição de dados dos associados (Advogados e Advogados Estagiários)
                                </h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" value="{{ $advogado->id }}" name="advogado_id" id="advogado_id">
                                <input type="hidden" value="{{ $advogado->categoria }}" name="categoria_field"
                                    id="categoria_field">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <div class="row">
                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nome_completo">Nome completo <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="200" name="nome_completo"
                                                        class="form-control" id="nome_completo"
                                                        value="{{ $pessoa->nome }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="nome_profissional">Nome profissional <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="200" name="nome_profissional"
                                                        class="form-control" id="nome_profissional"
                                                        value="{{ $advogado->nome_profissional }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_bi">Nº Bilhete <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="15" name="num_bi" class="form-control"
                                                        id="num_bi" value="{{ $pessoa->num_documento }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone1">Telefone principal <span
                                                            class="obrigatorio">*</span></label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1"
                                                        value="{{ $pessoa->telefone1 }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="telefone2">Telefone alternativo</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2"
                                                        value="{{ $pessoa->telefone2 }}">
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="sexo">Género <span
                                                            class="obrigatorio">*</span></label>
                                                    <select name="sexo" id="sexo" class="form-select">
                                                        <option value="">Selecione...</option>
                                                        <option {{ $pessoa->genero == 'Masculino' ? 'selected' : '' }}
                                                            value="Masculino">Masculino</option>
                                                        <option {{ $pessoa->genero == 'Feminino' ? 'selected' : '' }}
                                                            value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_associado">Nº Associado (Nº Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_associado"
                                                        class="form-control" id="num_associado"
                                                        value="{{ $advogado->num_associado }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="num_estagiario">Nº Estagiário (Nº Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_estagiario"
                                                        class="form-control" id="num_estagiario"
                                                        value="{{ $advogado->num_estagiario }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" maxlength="200" name="email"
                                                        class="form-control" id="email" value="{{ $pessoa->email }}">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="data_inscricao_oaa">Data de Inscrição Advogado</label>
                                                    <input type="date" name="data_inscricao_oaa" class="form-control"
                                                        id="data_inscricao_oaa"
                                                        value="{{ $advogado->data_inscricao_oaa }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="data_inscricao_estagiario">Data de Inscrição
                                                        Estagiário</label>
                                                    <input type="date" name="data_inscricao_estagiario"
                                                        class="form-control" id="data_inscricao_estagiario"
                                                        value="{{ $advogado->data_inscricao_estagiario }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="categoria">Categoria <span
                                                            class="obrigatorio">*</span></label>
                                                    <select disabled name="categoria" id="categoria" class="form-select">
                                                        <option value="">Selecione...</option>
                                                        <option {{ $advogado->categoria == 'Advogado' ? 'selected' : '' }}
                                                            value="Advogado">Advogado</option>
                                                        <option {{ $advogado->categoria == 'Estagiario' ? 'selected' : '' }}
                                                            value="Estagiario">Estagiario</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="estado">Estado <span
                                                            class="obrigatorio">*</span></label>
                                                    <select disabled name="estado" id="estado" class="form-select">
                                                        <option value="">Selecione...</option>
                                                        <option {{ $advogado->estado == 'Registado' ? 'selected' : '' }} value="Registado">Registado</option>
                                                        <option {{ $advogado->estado == 'Aguarda Cerimónia' ? 'selected' : '' }} value="Aguarda Cerimónia">Aguarda
                                                            Cerimónia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="end-advogado">
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="endereco_profissional_adv">Endereço
                                                            Profissional <span
                                                            class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_profissional_adv"
                                                            name="endereco_profissional_adv"
                                                            value="{{ $advogado->endereco_escritorio }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="municipio_id_adv">Município <span
                                                            class="obrigatorio">*</span></label>
                                                        <select name="municipio_id_adv" id="municipio_id_adv"
                                                            class="form-select">
                                                            <option value="">Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option {{ $muni->id == $advogado->municipio_id ? 'selected' : '' }} value="{{$muni->id}}">{{$muni->descricao}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="patronoactual_id" value="{{ $patrono != null ? $patrono->id : '' }}">
                                        <input type="hidden" id="patronoactual_nome" value="{{ $patrono != null ? $patrono->getadvogado->getpessoa->nome : '' }}">
                                        <input type="hidden" id="patronoactual_telefone" value="{{ $patrono != null ? $patrono->getadvogado->getpessoa->telefone1 : '' }}">
                                        <input type="hidden" id="patronoactual_cedula" value="{{ $patrono != null ? $patrono->getadvogado->num_associado : '' }}">
                                        <input type="hidden" id="patronoactual_email" value="{{ $patrono != null ? $patrono->getadvogado->getpessoa->email : '' }}">
                                        <input type="hidden" id="patronoactual_endereco" value="{{ $patrono != null ? $patrono->getadvogado->endereco_escritorio : '' }}">
                                        <input type="hidden" id="patronoactual_municipio_id" value="{{ $patrono != null ? $patrono->getadvogado->municipio_id : '' }}">
                                        <input type="hidden" id="patronoactual_escritorio" value="{{ $patrono != null ? $patrono->getadvogado->nome_escritorio : '' }}">

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
                                    

                                     
                                            <div id="end-estagiario">

                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nome_patrono">Nome do
                                                            patrono <span class="obrigatorio">*</span></label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_patrono" value="{{ $patrono != null ? $patrono->getadvogado->getpessoa->nome : '' }}" name="nome_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="tel_patrono">Telefone do
                                                            patrono</label>
                                                        <input type="text" class="form-control" maxlength="9"
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
                                                        <label class="form-label" for="cedula_patrono">Número da Cédula</label>
                                                        <input type="text" class="form-control" maxlength="7"
                                                            id="cedula_patrono" name="cedula_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="municipio_id_est">Município (Onde está o Escritório) <span
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
    <script src="{{ asset('assets/system/js/editar-associado-sec.js') }}"></script>
@endsection