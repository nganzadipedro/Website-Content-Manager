<div class="page-wrapper">

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="card card-md">
                <div class="card-stamp card-stamp-lg">
                    <div class="card-stamp-icon bg-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                            <path d="M10 10l.01 0" />
                            <path d="M14 10l.01 0" />
                            <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                        </svg>
                    </div>
                </div>
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
                        <div class="card-stamp">
                            <div class="card-stamp-icon bg-white text-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                </svg>
                            </div>
                        </div>
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
                        <div class="card-stamp">
                            <div class="card-stamp-icon bg-white text-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Gerenciar Galeria</h3>
                            <p>Adiconar, Editar, Listar, Remover e Ver detalhes de eventos do website</p>
                            <a href="{{route('cadgaleria')}}" class="btn btn-secondary">+ Adicionar Imagem
                                +</a>
                            <a href="{{route('listgaleria')}}" class="btn btn-secondary">Listar Imagens</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>