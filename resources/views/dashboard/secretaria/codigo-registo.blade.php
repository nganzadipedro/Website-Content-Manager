<div>

    <div class="container-xl mt-5">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">Último registo</h3>
                        <a href="{{ route('system.secretaria.registar_entrada') }}" class="btn btn-primary d-inline-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Novo registo
                        </a>
                    </div>

                    <div class="card-body text-center py-5">
                        <div class="text-secondary mb-2">Código do registo</div>
                        <div class="codigo-destaque">
                            {{ $registo->codigo ?? '—' }}
                        </div>
                    </div>

                    <!-- Zona de detalhes do registo -->
                    <div class="card-body border-top">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-secondary mb-1">Nome</div>
                                <div class="fw-semibold fs-4">
                                    {{ $registo->proveniencia ?? '—' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-secondary mb-1">Assunto</div>
                                <div class="fw-semibold fs-4">
                                    {{ $registo->assunto ?? '—' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-secondary mb-1">Tipo de processo</div>
                                <div class="fw-semibold fs-4">
                                    {{ $registo->gettipoprocesso->descricao ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-secondary text-center">
                        Registado em: {{ $registo->created_at ? $registo->created_at->format('d/m/Y H:i:s') : '—' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .codigo-destaque {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.2;
            color: var(--tblr-primary, #206bc4);
            letter-spacing: 1px;
            word-break: break-all;
        }

        @media (max-width: 576px) {
            .codigo-destaque {
                font-size: 2.5rem;
            }
        }
    </style>


</div>