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
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{
    Auth::user()->getPessoa->email }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Emissão de Declaração</h5>
                        <div class="flex-shrink-0">
                            {{-- <a href="#" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i> Descarregar Referencia</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label for="formacao_id">Formação</label>
                            <select wire:change="pega_turmas()" class="form-control" name="formacao_id" id="formacao_id"
                                wire:model="formacao_id">
                                <option value="">Selecione...</option>
                                @foreach($formacoes as $for)
                                    <option value="{{$for->id}}">{{$for->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label for="turma_id">Turma</label>
                            <select class="form-control" name="turma_id" id="turma_id" wire:model="turma_id">
                                <option value="">Selecione...</option>
                                @foreach($turmas as $tur)
                                    <option value="{{$tur->id}}">{{$tur->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <label for="">Código do candidato</label>
                            <input type="text" style="text-align: center" name="codigo" wire:model="codigo" id="codigo"
                                class="form-control">
                        </div>
                    </div>

                    <div class="text-center mt-4">

                        <button class="btn btn-primary" wire:click="verificar()">Verificar</button>
                    </div>


                    @if ($tem == true)
                        <hr>
                        <div class="text-left alert alert-info">
                            <h3> {{ $nome_candidato }}</h3>
                            <h4>
                                Nº documento de Identificação: {{ $num_documento }} <br>
                                Nº Cédula: {{ $cedula }} <br>
                                Formação: {{ $formacao }} <br>
                                Turma: {{ $turma }}
                            </h4>
                        </div>
                        @if($tem_aviso == true)
                            <div class="alert alert-warning mt-3">
                                <h4 class="text-center">!! AVISOS !!</h4>
                                <ul>
                                    @foreach ($avisos as $av)
                                        @if($av != null)
                                            <li>{{$av}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($tem_aviso == false)
                            <div class="alert alert-info text-center mt-3">
                                <h5>
                                    Nota Final: {{ $nota_final }} <br>
                                </h5>
                                <br>
                                <!-- se já soliictou uma referência -->
                                @if($solicitacao != null)
                                    @if($solicitacao->estado == 'pendente' && ($dia_actual <= $solicitacao->validade_referencia))
                                        Ainda não efectuou o pagamento da referência solicitada. Efectue o pagamento.
                                    @endif
                                    @if($solicitacao->estado == 'pendente' && ($dia_actual > $solicitacao->validade_referencia))
                                        <a wire:click="solicitar_ref_declaracao()" class="btn btn-success">Solicitar
                                            Nova Referência de Pagamento</a>
                                    @endif
                                    @if($solicitacao->estado == 'aprovado')
                                        <a target="_blank" href="{{ route('emitirdec', [$candidatura->hash, $aluno->hash]) }}"
                                            class="btn btn-success">Clique aqui para emitir a sua declaração</a>
                                    @endif
                                @endif

                                <!-- se ainda não soliictou uma referência -->
                                @if ($solicitacao == null)
                                    @if(count($avaliacao_aluno) >= 5 && $nota_final >= 9.5 && $pessoa->id != 6173 && $pessoa->id != 5553)
                                        <a target="_blank" href="{{ route('emitirdec', [$candidatura->hash, $aluno->hash]) }}"
                                            class="btn btn-success">Clique aqui para emitir a sua declaração</a>
                                    @else
                                        @if(count($avaliacao_aluno) == 0)
                                            Caro candidato, as suas notas ainda não foram lançadas no sistema.
                                        @endif
                                        @if(count($avaliacao_aluno) > 0 && $nota_final < 9.5)
                                            Caro candidato, a sua classificação não permite emitir a declaração.
                                        @endif
                                    @endif
                                @endif

                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
</div>