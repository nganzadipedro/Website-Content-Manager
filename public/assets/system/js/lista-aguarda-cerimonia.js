const checkAll = document.getElementById("checkAll");
const checkItems = document.querySelectorAll(".checkItem");
const btnRecepcaoCedula = document.getElementById("btn-recepcao-cedula");
const btnCancelarGrupo = document.getElementById("btn-cancelar-grupo");
const btnRegistarCerimoniaGrupo = document.getElementById("btn-registar-cerimonia-grupo");

// ✅ Selecionar / desselecionar todos
checkAll.addEventListener("change", () => {
    checkItems.forEach(item => {
        item.checked = checkAll.checked;
    });
});

// ✅ Se desmarcar um item, desmarca o "todos"
checkItems.forEach(item => {
    item.addEventListener("change", () => {
        const total = checkItems.length;
        const marcados = document.querySelectorAll(".checkItem:checked").length;

        checkAll.checked = total === marcados;
    });
});

// 🚀 Enviar via AJAX
btnRecepcaoCedula.addEventListener("click", () => {

    const selecionados = [];

    document.querySelectorAll(".checkItem:checked").forEach(item => {
        selecionados.push(item.value);
    });

    if (selecionados.length === 0) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Não foi selecionado nenhum registo na tabela de dados",
            timer: 4000
        });
    }
    else {

        console.log("IDs selecionados:", selecionados);
        const modal = new bootstrap.Modal(document.getElementById('modal-cerimonia-grupo'));
        modal.show();

    }
});


btnCancelarGrupo.addEventListener("click", () => {

    const modalElement = document.getElementById('modal-cerimonia-grupo');
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();

});

btnRegistarCerimoniaGrupo.addEventListener("click", () => {

    const selecionados = [];

    document.querySelectorAll(".checkItem:checked").forEach(item => {
        selecionados.push(item.value);
    });

    data_cerimonia_grupo = document.getElementById('data_cerimonia_grupo').value;
    presente_ausente_grupo = document.getElementById('presente_ausente_grupo').value;

    if (data_cerimonia_grupo == '' || data_cerimonia_grupo == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite a data da cerimónia",
            timer: 4000
        });
    }
    else {

        const formData = new FormData();

        Array.from(selecionados).forEach(id => {
            formData.append('selecionados[]', id);
        });

        formData.append('data_cerimonia', data_cerimonia_grupo);
        formData.append('presente_ausente_grupo', presente_ausente_grupo);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja registar esta informação?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Salvar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/data-cerimonia-grupo/update",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
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
                                text: 'Dados registados com sucesso!',
                                timer: 3000
                            });

                            window.location.reload();

                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Encontrou-se um processo sem o número do bilhete registado.',
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
});


$(document).on('click', '.btn-detalhes', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarItem(id);

});

$(document).on('click', '.btn-historico', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarHistorico(id);

});

$(document).on('click', '#btn-cancelar', function () {

    const modalElement = document.getElementById('modal-cerimonia');
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();

});

$(document).on('click', '.btn-cerimonia', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');

    fetch(`/system/getAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes-2").html("");

            municipio = '';
            cedula = '';
            if (data[0].municipio_id != null) {
                municipio = data[0].getmunicipio.descricao;
            }

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data[0].getpessoa.nome} <br><br>
                            Nome profissional: ${data[0].nome_profissional} <br><br>
                            Género: ${data[0].getpessoa.genero} <br><br>
                            Nº BI: ${data[0].getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data[0].categoria} </strong> <br><br>
                            Nº Cédula: ${data[0].categoria == 'Advogado' ? data[0].num_associado : data[0].num_estagiario} <br><br>
                        </div>`
            $("#dv-detalhes-2").html(html);
            $('#advogado_id').val(data[0].id);

        })
        .catch(error => {
            console.error('Erro:', error);
        });

});

function buscarItem(id) {

    fetch(`/system/getAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes").html("");

            municipio = '';
            if (data[0].municipio_id != null) {
                municipio = data[0].getmunicipio.descricao;
            }

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data[0].getpessoa.nome} <br><br>
                            Nome profissional: ${data[0].nome_profissional} <br><br>
                            Género: ${data[0].getpessoa.genero} <br><br>
                            Nº BI: ${data[0].getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data[0].categoria} </strong> <br><br>
                            Nº Cédula Advogado: ${data[0].num_associado == null ? '' : data[0].num_associado} <br><br>
                            Nº Cédula Estagiário: ${data[0].num_estagiario == null ? '' : data[0].num_estagiario} <br><br>
                            Email: ${data[0].getpessoa.email}<br><br>
                            Contactos: ${data[0].getpessoa.telefone1}/${data[0].getpessoa.telefone2 == null ? '' : data[0].getpessoa.telefone2}<br><br>
                            Endereço: ${data[0].endereco_escritorio == null ? '' : data[0].endereco_escritorio}<br><br>
                            Município: ${municipio} <br><br>
                            Data de Inscrição Advogado: ${data[0].data_inscricao_oaa == null ? '' : data[0].data_inscricao_oaa} <br><br>
                            Data de Inscrição Estagiário: ${data[0].data_inscricao_estagiario == null ? '' : data[0].data_inscricao_estagiario}
                        </div>`
            $("#dv-detalhes").html(html);


        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

function buscarHistorico(id) {

    fetch(`/system/getHistoricoProcesso/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(dados => {

            const div = document.getElementById('list-group-item');
            div.innerHTML = '';

            dados.forEach(item => {

                let avatar = window.avatarUrl;

                const data = item.created_at;
                const [datePart, timePart] = data.split("T");
                const [ano, mes, dia] = datePart.split("-");
                const hora = timePart.substring(0, 8);

                const formatada = `${dia}/${mes}/${ano} ${hora}`;

                linha = `<div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="badge bg-green"></span></div>
                                    <div class="col-auto">
                                        <a href="#">
                                            <span class="avatar"
                                                style="background-image: url(${avatar})"></span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-reset d-block">${item.nome}
                                            | ${formatada}</a>
                                        <div class="d-block text-secondary mt-n1">
                                            ${item.operacao}
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                div.innerHTML += linha;

            });

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

document.getElementById('btn-registar-cerimonia').addEventListener('click', function () {

    data_cerimonia = document.getElementById('data_cerimonia').value;
    if (data_cerimonia == '' || data_cerimonia == null) {
        Swal.fire({
            title: "Aviso",
            text: "Por favor, selecione uma data de cerimónia.",
            icon: "warning",
            confirmButtonColor: "#34c38f",
        });
        return false;
    }
    else {

        const formData = new FormData();

        const data_cerimonia = document.getElementById('data_cerimonia').value;
        const advogado_id = document.getElementById('advogado_id').value;

        formData.append('data_cerimonia', data_cerimonia);
        formData.append('advogado_id', advogado_id);


        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja registar estes dados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Salvar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/data-cerimonia/update",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
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
                                text: 'Dados registados com sucesso!',
                                timer: 4000
                            });

                            window.location.reload();

                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Por favor, registre o número do bilhete.',
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
});

$(document).on('click', '.btn-excluir', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    const formData = new FormData();
    formData.append('advogado_id', id);

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja excluir este registo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Excluir!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/delete-advogado/post",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
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
                            text: 'Dados excluídos com sucesso!',
                            timer: 4000
                        });
                        window.location.reload();
                    }
                    else if (res == 'tecnico') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Não pode excluir este registo, contacte o técnico do sistema',
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
