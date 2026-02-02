<div>

    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Permissão</th>
                                    <th class="no-content">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lista_usuarios as $item)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->getpessoa->nome}}</td>
                                        <td>{{$item->getpessoa->email}}</td>
                                        <td>{{$item->getpermissao->descricao}}</td>
                                        <td>

                                            <a href="{{ route('system.admin.edit_user', $item->id) }}">

                                                <i data-feather="edit"></i>


                                            </a>

                                            <a href="{{ route('system.admin.detalhes_user', $item->id) }}">

                                                <i data-feather="eye"></i>


                                            </a>

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


</div>