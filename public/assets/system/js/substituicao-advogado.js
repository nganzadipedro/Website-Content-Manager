let dropdown;
let id_advogado_filtrado;
let assunto_processo;
let num_processo;
let id_registo;
let lista_advogados_adtribuidos = [];

document.addEventListener('DOMContentLoaded', function () {

    dropdown = document.getElementById('dropdown_search_advogado');
    if (listaAdvogadosGlobal === 'undefined') return;

    // Função para filtrar e renderizar a lista
    function filtrarAdvogados(texto) {

        console.log('Filtrando advogados com o texto:', texto);
        const query = texto.trim().toLowerCase();
        dropdown = document.getElementById('dropdown_search_advogado');

        if (query === '') {
            dropdown.style.display = 'none';
            dropdown.innerHTML = '';
            return;
        }

        // Filtra até 20 resultados para manter a renderização ultra-rápida
        const resultados = listaAdvogadosGlobal.filter(p =>
            p.nome.toLowerCase().includes(query)
        ).slice(0, 10);

        dropdown.innerHTML = '';

        if (resultados.length > 0) {
            resultados.forEach(item => {
                const div = document.createElement('div');
                div.className = 'custom-dropdown-item';
                div.textContent = item.nome;

                // Evento de seleção do item
                div.addEventListener('click', function () {
                    adicionar_advogado(item.id, item.nome, item.cedula, item.categoria);
                    dropdown.style.display = 'none';
                });

                dropdown.appendChild(div);
            });
        } else {
            dropdown.innerHTML = '<div class="custom-dropdown-empty">Nenhum advogado encontrado</div>';
        }

        dropdown.style.display = 'block';
    }

    // Eventos de digitação e foco
    $(document).on('input', '#search_advogado_indicado', function () {
        filtrarAdvogados(this.value);
        id_advogado_filtrado = 0;
    });

    // Fecha a lista se clicar fora do campo
    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
});


function adicionar_advogado(advogado_id, nome, cedula, categoria) {

    // verificar se a lista de objectos já tem o advogado
    existe = lista_advogados_adtribuidos.some(function (advogado) {
        return advogado.id === Number(advogado_id);
    });

    if (existe) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Este advogado já foi atribuído neste processo',
            timer: 4000
        });
        $('#search_advogado_indicado').val('');
    }
    else if (id_registo == 0 || id_registo == null || id_registo == '') {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Não foi indicado nenhum processo',
            timer: 3000
        });
        $('#search_advogado_indicado').val('');
    }
    else if (assunto_processo == '' || assunto_processo == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Não foi indicado nenhum processo',
            timer: 3000
        });
        $('#search_advogado_indicado').val('');
    }
    else {

        const formData = new FormData();
        formData.append('advogado_id', advogado_id);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja atribuir este advogado?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Adicionar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/verificar-atribuicao-advogado/post",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (res) {

                        if (res == 'sucesso') {
                            lista_advogados_adtribuidos.push({
                                id: Number(advogado_id),
                                nome: nome,
                                cedula: cedula,
                                categoria: categoria
                            });
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'Advogado atribuído com sucesso!',
                                timer: 2000
                            });
                        }
                        else if (res == 'sem cédula') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não é possível atribuir advogados sem número de cédula!',
                                timer: 4000
                            });
                        }
                        else if (res == 'telefone') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não é possível atribuir advogados sem número de telefone!',
                                timer: 4000
                            });
                        }
                        else if (res == 'sem patrono') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não é possível atribuir advogados estagiários sem patrono!',
                                timer: 4000
                            });
                        }
                        else if (res == 'municipio') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não é possível atribuir advogados sem informação do município!',
                                timer: 4000
                            });
                        }
                        else if (res == 'endereco') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não é possível atribuir advogados sem informação do endereço!',
                                timer: 4000
                            });
                        }
                        $('#search_advogado_indicado').val('');
                    },
                    error: function (error) {

                        sweetAlert({
                            type: "warning",
                            title: "Erro " + error.status,
                            text: 'Erro: ' + error.responseJSON.message,
                            timer: 9000
                        });
                        console.log("Error: " + error.responseJSON.message);
                    }
                });
            }
        });

    }

}

$(document).on('click', '#btn-verificar', function () {

    num_processo = $('#num_processo').val();
    if (num_processo == '' || num_processo == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Digite o número do Processo',
            timer: 4000
        });
    }
    else {
        const formData = new FormData();

        formData.append('num_processo', num_processo);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/system/getRegistoByCode/post",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (res) {

                console.log(res);
                if (res == 'codigo-errado') {
                    sweetAlert({
                        type: "warning",
                        title: "Aviso",
                        text: 'O número de processo informado está errado!',
                        timer: 4000
                    });
                    assunto_processo = '';
                    id_registo = 0;
                    $("#assunto_processo").val('');
                }
                else if (res == 'nao-encontrado') {
                    sweetAlert({
                        type: "warning",
                        title: "Aviso",
                        text: 'O processo referenciado não foi encontrado',
                        timer: 4000
                    });
                    assunto_processo = '';
                    id_registo = 0;
                    $("#assunto_processo").val('');
                } else {
                    sweetAlert({
                        type: "success",
                        title: "Sucesso",
                        text: 'O processo foi encontrado com sucesso',
                        timer: 2000
                    });
                    assunto_processo = res.assunto;
                    id_registo = res.id;
                    $("#assunto_processo").val(assunto_processo);
                }
            },
            error: function (error) {

                sweetAlert({
                    type: "warning",
                    title: "Erro " + error.status,
                    text: 'Erro: ' + error.responseJSON.message,
                    timer: 6000
                });
                console.log("Error: " + error.responseJSON.message);
            }
        });

    }

});

$(document).on('click', '#btn-cancelar', function () {

    id_advogado_filtrado = 0;
    id_registo = 0;
    assunto_processo = '';
    num_processo = '';
    lista_advogados_adtribuidos = [];
    $("#assunto_processo").val('');
    $("#num_processo").val('');
    $("#advogado_substituido").val('');
    $("#nome_requerente").val('');
    $("#search_advogado_indicado").val('');

});

document.getElementById('btn-confirmar').addEventListener('click', function () {

    nome_requerente = $('#nome_requerente').val();
    advogado_substituido = $('#advogado_substituido').val();
    insitituicao_copia = $('#insitituicao_copia').val();
    tipo_indicacao = $('#tipo_indicacao').val();
    referencia_assist_inicial = $('#referencia_assist_inicial').val();

    if (nome_requerente == '' || nome_requerente == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Informe o nome do requerente!',
            timer: 3000
        });
    }
    else if (advogado_substituido == '' || advogado_substituido == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Informe o advogado que será substituído!',
            timer: 3000
        });
    }
    else if (tipo_indicacao == '' || tipo_indicacao == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Selecione o tipo de indicação!',
            timer: 3000
        });
    }
    else if (lista_advogados_adtribuidos.length === 0) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Não foi atribuído nenhum advogado para este processo",
            timer: 4000
        });
    }
    else {

        const formData = new FormData();
        formData.append('registo_id', id_registo);
        formData.append('nome_requerente', nome_requerente);
        formData.append('advogado_substituido', advogado_substituido);
        formData.append('insitituicao_copia', insitituicao_copia);
        formData.append('tipo_indicacao', tipo_indicacao);
        formData.append('referencia_assist_inicial', referencia_assist_inicial);
        Array.from(lista_advogados_adtribuidos).forEach(p => {
            formData.append('lista_advogados_adtribuidos[]', p.id);
        });

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja confirmar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Confirmar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/emitir-documento-substituicao/post",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (res) {
                        if (res == 'sucesso') {
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'Dados registados com sucesso!',
                                timer: 3000
                            });
                            window.location.href = '/system/secretaria/assistance/list/documents';
                        }
                        else if (res == 'ref-inicial') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Referência da assistência inicial inválida.',
                                timer: 3000
                            });
                        }
                    },
                    error: function (error) {

                        sweetAlert({
                            type: "warning",
                            title: "Erro " + error.status,
                            text: 'Erro: ' + error.responseJSON.message,
                            timer: 9000
                        });
                        console.log("Error: " + error.responseJSON.message);
                    }
                });
            }
        });
    }


});

$(document).on('click', '#btn-ver-advogados', function (e) {

    renderizarAdvogadosAtribuidos();

});

function renderizarAdvogadosAtribuidos() {
    let tbody = document.getElementById("tabela-advogados-atribuidos");

    tbody.innerHTML = "";

    lista_advogados_adtribuidos.forEach(function (advogado) {
        tbody.innerHTML += `
            <tr>
                <td>${advogado.nome}</td>
                <td>${advogado.cedula}</td>
                <td>${advogado.categoria}</td>
                <td>
                                            <a title="remover" onclick="removerAdvogado(${advogado.id})" style="cursor: pointer;"
                                                class="btn-remover badge bg-red-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a>
                                        </td>
            </tr>
        `;
    });
}

function removerAdvogado(id) {
    console.log(id);
    lista_advogados_adtribuidos = lista_advogados_adtribuidos.filter(p => p.id !== id);
    console.log(lista_advogados_adtribuidos);
    renderizarAdvogadosAtribuidos();
}