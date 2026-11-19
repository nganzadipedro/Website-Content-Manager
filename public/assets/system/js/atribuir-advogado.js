let dropdown;
let id_advogado_filtrado;

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
                    adicionar_advogado(item.id);
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


function adicionar_advogado(id) {

    // Pega o data-id do <a> clicado
    let advogado_id = id;
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('advogado_id', advogado_id);
    formData.append('registo_id', registo_id);

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
                url: "/system/atribuir-advogado/post",
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
                        sweetAlert({
                            type: "success",
                            title: "Sucesso",
                            text: 'Advogado adicionado com sucesso!',
                            timer: 3000
                        });
                    }
                    else if (res == 'duplicado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Este advogado já foi atribuido neste processo!',
                            timer: 4000
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
                            text: 'Não é possível atribuir advogados/estagiários sem informação do município!',
                            timer: 4000
                        });
                    }
                    else if (res == 'endereco') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Não é possível atribuir advogados/estagiários sem informação do endereço!',
                            timer: 4000
                        });
                    }
                    else if (res == 'telefone') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Não é possível atribuir advogados/estagiários sem o contacto telefónico!',
                            timer: 4000
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

$(document).on('click', '.btn-adicionar', function () {

    // Pega o data-id do <a> clicado
    let advogado_id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('advogado_id', advogado_id);
    formData.append('registo_id', registo_id);

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
                url: "/system/atribuir-advogado/post",
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
                        sweetAlert({
                            type: "success",
                            title: "Sucesso",
                            text: 'Advogado adicionado com sucesso!',
                            timer: 3000
                        });
                    }
                    else if (res == 'duplicado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Este advogado já foi atribuido neste processo!',
                            timer: 4000
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

});

$(document).on('click', '.btn-remover', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('id', id);
    formData.append('registo_id', registo_id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este advogado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/atribuir-advogado/delete",
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
                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "Sucesso",
                            text: 'Advogado eliminado com sucesso!',
                            timer: 3000
                        });

                        ver_advogados();
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


});

document.getElementById('btn-confirmar').addEventListener('click', function () {

    const formData = new FormData();
    registo_id = $('#registo_id').val();
    formData.append('registo_id', registo_id);

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
                url: "/system/confirmar-atribuicao/post",
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
                        window.location.href = '/system/admin/assistance/list/solved';
                    }
                    else if (res == 'sem-advogado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Não foi atribuído nenhum advogado!',
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
});

function ver_advogados() {
    const id_registo = $("#registo_id").val();

    fetch(`/system/getAdvogadosAtribuidos/${id_registo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(dados => {

            console.log('Resposta do servidor:', dados);
            const tbody = document.getElementById('tabela-advogados-atribuidos');
            tbody.innerHTML = '';

            dados.forEach(item => {

                linha = '';

                fetch(`/system/getAdvogadoAtribuido/${item.advogado_id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição');
                        }
                        return response.json();
                    })
                    .then(data2 => {

                        console.log('Resposta do servidor:', data2);

                        linha = `
                            <tr>
                                <td>${data2.nome}</td>
                                <td>${data2.cedula}</td>
                                <td>${data2.categoria}</td>
                                <td><a title="remover" data-id="${item.id}" style="cursor: pointer;"
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
                                            </a></td>
                            </tr>`;
                        tbody.innerHTML += linha;

                    })
                    .catch(error => {
                        console.error('Erro:', error);
                    });

            });
        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

$(document).on('click', '#btn-ver-advogados', function (e) {

    e.preventDefault(); // se for link, evita redirecionamento
    ver_advogados();

});