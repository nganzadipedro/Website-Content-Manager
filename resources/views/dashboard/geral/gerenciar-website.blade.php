<div class="page-wrapper">

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="h1">Gerenciar Website</h3>
                            <div class="markdown text-secondary">
                                Apresentamos nese formulário as opções disponíveis para gerir o conteúdo do website
                            </div>
                            <div class="mt-3">
                                <a href="https://tabler-icons.io" class="btn btn-info" target="_blank"
                                    rel="noopener">Voltar à Tela Inicial</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
                    <div class="card bg-primary text-primary-fg">
                        
                        <div class="card-body">
                            <h3 class="card-title">Gerenciar Notícias</h3>
                            <p>Adiconar, Editar, Listar, Remover e Ver detalhes de notícias do website</p>
                            <a href="{{ route('cadnoticia') }}" class="btn btn-warning">+ Nova Notícia +</a>
                            <a href="{{ route('listnoticia') }}" class="btn btn-warning">Listar Notícias</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
                    <div class="card bg-success text-primary-fg">
                       
                        <div class="card-body">
                            <h3 class="card-title">Gerenciar Galeria</h3>
                            <p>Adiconar, Editar, Listar, Remover e Ver detalhes de eventos do website</p>
                            <a href="{{route('cadgaleria')}}" class="btn btn-secondary">+ Adicionar Imagem
                                +</a>
                            <a href="{{route('listgaleria')}}" class="btn btn-secondary">Listar Imagens</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12">
                    <div class="card bg-info text-primary-fg">
                        <div class="card-body">
                            <h3 class="card-title">Gerenciar Carrossel</h3>
                            <p>Adiconar e remover imagens do carrossel</p>
                            <a href="{{route('cadimagemcarrossel')}}" class="btn btn-secondary">+ Adicionar Imagem
                                +</a>
                            <a href="{{route('listcarrossel')}}" class="btn btn-secondary">Listar Imagens</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>