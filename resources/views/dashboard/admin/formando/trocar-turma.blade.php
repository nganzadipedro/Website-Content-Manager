<div>
    <div class="row">
        <!--end col-->
        <div class="col-xl-3">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Meus dados</h5>
                        <!-- <div class="flex-shrink-0">
                            <a href="{{ route('perfil') }}" class="link-secondary">Ver Perfil</a>
                        </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-user-2-fill ri-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ Auth::user()->getPessoa->nome }}</h6>
                                    <p class="text-muted mb-0">{{ Auth::user()->getPermissao->descricao }}</p>
                                </div>
                            </div>
                        </li>
                        <li><i
                                class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ Auth::user()->getPessoa->email }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Mudança de turma</h5>
                        <div class="flex-shrink-0">
                            {{-- <a href="#" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Descarregar Referencia</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">

                        <label for="">Código do candidato</label>
                        <input type="text" style="text-align: center" name="codigo" wire:model="codigo"
                            id="codigo" class="form-control">
                        <br>
                        <button class="btn btn-primary" wire:click="verificar()">Verificar</button>
                    </div>

                    @if ($tem == true)
                        <hr>
                        <div class="text-left alert alert-info">
                            <h3> {{ $nome_candidato }}</h3>
                            <h4>
                                Nº documento de Identificação: {{ $num_documento }} <br>
                                Estado da candidatura: {{ $estado }} <br>
                                Pagamento feito: {{ $candidatura->pago }} <br><br>
                                Turma actual: {{ $turma_actual }}<br>
                                Formação: {{ $formacao }}
                            </h4>
                        </div>
                    @endif

                    <br>
                    <form action="">

                        <label for="">Escolha a nova turma</label>
                        <select class="form-control" name="" id="" wire:model="turma_id">
                            <option value="">Selecione...</option>
                            @foreach ($turmas as $item)
                            @if ($item->id >= 13)
                             <option value="{{ $item->id }}">{{ $item->descricao }} ({{ $item->getFormacao->nome }})</option>
                            @endif 
                            @endforeach
                        </select>

                        <br>
                        <a class="btn btn-success" wire:click="confirmar()">Confirmar</a>

                    </form>


                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
</div>
