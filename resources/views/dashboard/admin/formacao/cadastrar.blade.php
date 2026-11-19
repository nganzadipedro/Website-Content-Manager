<div class="row">

    <div class="col-xl-12" id="card-none2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-0">CADASTRAR FORMAÇÃO</h6>
                    </div>
                    <div class="flex-shrink-0">
                        <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                            <li class="list-inline-item">
                                <a class="align-middle" href="javascript:void(0);" data-toggle="growing-reload">
                                    <i class="mdi mdi-refresh align-middle"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="align-middle minimize-card" data-bs-toggle="collapse" href="#collapseExample2"
                                    role="button" aria-expanded="true" aria-controls="collapseExample2">
                                    <i class="mdi mdi-plus align-middle plus"></i>
                                    <i class="mdi mdi-minus align-middle minus"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" onclick="delthis('card-none2')"
                                    class="btn-close fs-10 align-middle"></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body collapse show" id="collapseExample2" style="">
                <form method="POST" wire:submit.prevent="cadastrar">
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameinput" class="form-label">Nome</label>
                                <input wire:model="nome" type="text" class="form-control" id="firstNameinput"
                                    required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="ForminputState" class="form-label">Descrição</label>
                                <input wire:model="descricao" type="text" class="form-control" id="descricao"
                                    required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="lastNameinput" class="form-label">Data de início</label>
                                <input wire:model="data_inicio" type="date" class="form-control" id="data_inicio"
                                    required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="lastNameinput" class="form-label">Data de término</label>
                                <input wire:model="data_fim" type="date" class="form-control" id="data_fim"
                                    required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="lastNameinput" class="form-label">Custo da formação</label>
                                <input wire:model="custo" type="text" class="form-control" id="data_fim" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="tipo_formacao_id" class="form-label">Tipo de formação</label>
                                <select wire:model="tipo_formacao_id" required id="tipo_formacao_id" class="form-select">
                                    <option value="">Vazio</option>
                                    @foreach ($tipos_formacao as $item)
                                        <option value="{{ $item->id }}">{{ $item->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h6 class="card-title mb-0 flex-grow-1">Listagem geral das formações</h6>
            </div>
            <div class="card-body">
                <div class="tableFixHead">
                    <table class="table table-hover align-middle table-nowrap mb-0 mt-4 text-center" id="myTable">
                        <thead class="">
                            <tr>
                                <th scope="col"># / ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Custo</th>

                                <th scope="col">Data de registo</th>
                                <th scope="col sticky-col first-col"></th>
                            </tr>
                        </thead>
                        <tbody style="height:200px;overflow:auto;">
                            @foreach ($lista as $item)
                                <tr>
                                    <td scope="col">{{ $loop->index + 1 . '/' . $item->id }}</td>
                                    <td scope="col">{{ $item->nome }}</td>
                                    <td scope="col">{{ $item->descricao }}</td>
                                    <td scope="col">{{ $item->getTipoformacao->descricao }}</td>
                                    <td scope="col">{{ $item->valor_custo }}</td>

                                    <td scope="col">{{ $item->created_at }}</td>
                                    <td class="">
                                        <a wire:click="selecionar({{ $item->id }})" class="btn btn-primary"><i class="bx bx-edit-alt"></i></a>
                                    
                                        <a class="btn btn-warning" href="{{ route('admin.formacoes.gerenciar', $item->hash) }}">Gerenciar</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-aux')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
