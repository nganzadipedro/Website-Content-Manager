<div>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Editar Pedido de Assistência
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
                                <h4 class="card-title">Editar Pedido de Assistência</h4>
                            </div>
                            <div class="card-body">

                                @csrf

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xl-12 col-12">

                                        <input type="hidden" id="registo_id" value="{{ $registo->id }}">
                                        <input type="hidden" id="pedido_id" value="{{ $pedido->id }}">

                                        <div class="alert alert-primary mt-3">
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <p>
                                                        Nº do Processo Secretaria: {{ $registo->codigo }} <br>
                                                        Nº do Processo Área Técnica: {{ $pedido->codigo }} <br>
                                                        Requerente: {{ $registo->proveniencia }}<br>
                                                        <strong> Assunto: {{ $registo->assunto }}</strong><br>
                                                        Data de Entrada: {{ $registo->data_entrada }}<br>
                                                        Data de Registo na Secretaria: {{ $registo->created_at }}<br>
                                                        Tipo de documento: {{ $registo->tipo_documento }}<br>
                                                        Estado: {{ $registo->estado }}<br>
                                                        Destinatário: {{ $registo->destinatario }}<br>
                                                        Encaminhado: {{ $registo->encaminhado }}<br>
                                                    </p>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                                                    <h4>Advogados/Advogados Estagiários Indicados</h4>
                                                    @foreach ($advogados as $advs)
                                                        <p class="detalhes mb-3">
                                                            Nome: {{ $advs->getadvogado->getpessoa->nome }}<br>
                                                            Telefone:
                                                            {{ $advs->getadvogado->getpessoa->telefone1 }}/{{ $advs->getadvogado->getpessoa->telefone2 }}<br>
                                                            Categoria: {{ $advs->getadvogado->categoria }}<br>
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">

                                            @csrf

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo">Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-select">
                                                        <option value="" selected>Selecione...</option>
                                                        <option {{ $pedido->sexo == 'Não Definido' ? 'selected' : '' }} value="Não Definido">Não Definido</option>
                                                        <option {{ $pedido->sexo == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                                        <option {{ $pedido->sexo == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="natureza">Natureza</label>
                                                    <select name="natureza" id="natureza" class="form-select">
                                                        <option value="" selected>Selecione...</option>
                                                        <option {{ $pedido->natureza == 'Não Definido' ? 'selected' : '' }} value="Não Definido">Não Definido</option>
                                                        <option {{ $pedido->natureza == 'Crime' ? 'selected' : '' }} value="Crime">Crime</option>
                                                        <option {{ $pedido->natureza == 'Laboral' ? 'selected' : '' }} value="Laboral">Laboral</option>
                                                        <option {{ $pedido->natureza == 'Família' ? 'selected' : '' }} value="Família">Família</option>
                                                        <option {{ $pedido->natureza == 'Cível' ? 'selected' : '' }} value="Cível">Cível</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="localizacao">Pasta de Arquivo</label>
                                                    <input type="text" name="localizacao" class="form-control"
                                                        id="localizacao" value="{{ $pedido->localizacao }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-12 col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="observacao2">Observação</label>
                                                    <input type="text" name="observacao2" class="form-control"
                                                        id="observacao2" value="{{ $pedido->observacao }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-12 col-12">
                                                <a id="btn-registar-informacoes" class="btn btn-success mt-4">Salvar</a>
                                                <a href="{{ route('system.areatecnica.listar_pedidos_pendentes') }}"
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
    <script src="{{ asset('assets/system/js/editar-pedido.js') }}"></script>
@endsection