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
                        <h5 class="card-title flex-grow-1 mb-0">VALIDAÇÃO DE DECLARAÇÃO</h5>
                        <div class="flex-shrink-0">
                            {{-- <a href="#" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i> Descarregar Referencia</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">

                        <label for="">Token de validação</label>
                        <input type="text" style="text-align: center" name="codigo" wire:model="codigo" id="codigo"
                            class="form-control">
                        <br>
                        <button class="btn btn-primary" wire:click="verificar()">Verificar</button>

                    </div>

                    @if ($tem == 'true')
                        <hr>
                        <div class="text-left alert alert-success">
                            <h3> {{ $nome }}</h3>
                            <h4>
                                Nº documento de Identificação: {{ $bilhete }} <br>
                                Nº Cédula: {{ $cedula }} <br>
                                Formação: {{ $formacao }} <br>
                                Turma: {{ $turma }}<br>
                                Nota final: {{ $notafinal }}<br>
                                Código da declaração: {{ $codigo_declaracao }}<br>
                                Ano: {{ $ano }}<br>
                                TOKEN: {{ $token }}<br>
                            </h4>
                        </div>
                    @endif
                    @if($tem == 'false')
                        <hr>
                        <div class="text-center alert alert-danger">
                            <h3> Não foi encontrado nenhum registo. Código de validação incorrecto.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
</div>