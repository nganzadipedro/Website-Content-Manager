<div>

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
                                                    <label for="nome_completo">Nome completo</label>
                                                    <input type="text" maxlength="200" name="nome_completo"
                                                        class="form-control" id="nome_completo" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_profissional">Nome profissional</label>
                                                    <input type="text" maxlength="200" name="nome_profissional"
                                                        class="form-control" id="nome_profissional" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_bi">Nº Bilhete</label>
                                                    <input type="text" maxlength="15" name="num_bi" class="form-control"
                                                        id="num_bi" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone1">Telefone principal</label>
                                                    <input type="text" maxlength="9" name="telefone1"
                                                        class="form-control" id="telefone1" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="telefone2">Telefone alternativo</label>
                                                    <input type="text" maxlength="9" name="telefone2"
                                                        class="form-control" id="telefone2" value="">
                                                </div>
                                            </div>


                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo">Género</label>
                                                    <select name="sexo" id="sexo" class="form-control">
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
                                                    <label for="num_associado">Nº Associado (Nº Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_associado"
                                                        class="form-control" id="num_associado" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="num_estagiario">Nº Estagiário (Nº Cédula)</label>
                                                    <input type="text" maxlength="9" name="num_estagiario"
                                                        class="form-control" id="num_estagiario" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" maxlength="200" name="email" class="form-control"
                                                        id="email" value="">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label for="data_inscricao_oaa">Data de Inscrição Advogado</label>
                                                    <input type="date" name="data_inscricao_oaa" class="form-control"
                                                        id="data_inscricao_oaa" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3 col-sm-12 col-xl-3">
                                                <div class="form-group">
                                                    <label for="data_inscricao_estagiario">Data de Inscrição
                                                        Estagiário</label>
                                                    <input type="date" name="data_inscricao_estagiario"
                                                        class="form-control" id="data_inscricao_estagiario" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 col-md-3">
                                                <div class="form-group">
                                                    <label for="categoria">Categoria</label>
                                                    <select name="categoria" id="categoria" class="form-control">
                                                        <option value="" selected>Selecione...</option>
                                                        <option value="Advogado">Advogado</option>
                                                        <option value="Estagiario">Estagiario</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="end-advogado">
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="endereco_profissional_adv">Endereço Profissional</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_profissional_adv" name="endereco_profissional_adv">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="municipio_id_adv">Município</label>
                                                        <select name="municipio_id_adv" id="municipio_id_adv"
                                                            class="form-control">
                                                            <option value="" selected>Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="end-estagiario">
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="nome_patrono">Nome do patrono</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_patrono" name="nome_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="tel_patrono">Telefone do patrono</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="tel_patrono" name="tel_patrono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="email_patrono">Email do patrono</label>
                                                        <input type="email" class="form-control" maxlength="200"
                                                            id="email_patrono" name="email_patrono">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="nome_escritorio">Nome do Escritório</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="nome_escritorio" name="nome_escritorio">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="endereco_escritorio_est">Endereço do Escritório</label>
                                                        <input type="text" class="form-control" maxlength="200"
                                                            id="endereco_escritorio_est" name="endereco_escritorio_est">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="municipio_id_est">Município</label>
                                                        <select name="municipio_id_est" id="municipio_id_est"
                                                            class="form-control">
                                                            <option value="" selected>Selecione...</option>
                                                            @foreach ($municipios as $muni)
                                                                <option value="{{$muni->id}}">{{$muni->descricao}}</option>
                                                            @endforeach
                                                        </select>
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
    <script src="{{ asset('assets/system/js/registar-associado.js') }}"></script>
@endsection