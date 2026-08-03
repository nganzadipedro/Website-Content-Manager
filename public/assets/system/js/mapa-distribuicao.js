document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");
    const btnRemeterConelheiro = document.getElementById("btn-remeter-conselheiro");
    const btnCancelar = document.getElementById("btn-cancelar-remeter-conselheiro");
    const btnRegistarConselheiro = document.getElementById("btn-registar-remeter-conselheiro");

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
    btnRemeterConelheiro.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        if (selecionados.length === 0) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Não foi selecionado nenhum processo na tabela de dados",
                timer: 4000
            });
        }
        else {

            console.log("IDs selecionados:", selecionados);
            const modal = new bootstrap.Modal(document.getElementById('modal-remeter-conselheiro'));
            modal.show();

        }
    });

    btnRegistarConselheiro.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        conselheiro_id_grupo = document.getElementById('conselheiro_id_grupo').value;
        observacao_distribuicao_grupo = document.getElementById('observacao_distribuicao_grupo').value;

        if (conselheiro_id_grupo == null || conselheiro_id_grupo == '') {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Selecione o conselheiro",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('conselheiro_id', conselheiro_id_grupo);
            formData.append('observacao_distribuicao', observacao_distribuicao_grupo);

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
                        url: "/system/distribuicao-grupo/post",
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

                                window.location.href = "/system/areatecnica/list/map-distribution/stage-one";

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

    btnCancelar.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-remeter-conselheiro');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

});


$(document).on('click', '.btn-distribuir', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let requerente = $(this).data('requerente');
    let data_entrada = $(this).data('entrada');
    console.log('ID selecionado:', id);
    $('#inscricao_id').val(id);
    $('#requerente').val(requerente);
    $('#data_entrada').val(data_entrada);

    // rotina para carregar os dados do registo, se necessário
    buscarItem(id);

});

$(document).on('click', '.btn-historico', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarHistorico(id);

});

$(document).on('click', '.btn-detalhes', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarItemDetalhes(id);

});

function selecionarCategoria(id) {
    $('#conselheiro_id').val(id).trigger('change');
}

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const data_levantamento_distribuicao = document.getElementById('data_levantamento_distribuicao').value;
    const conselheiro_id = document.getElementById('conselheiro_id').value;
    const data_entrega_distribuicao = document.getElementById('data_entrega_distribuicao').value;
    const observacao_distribuicao = document.getElementById('observacao_distribuicao').value;

    if (data_levantamento_distribuicao == '' || data_levantamento_distribuicao == null) {
        msgErro = "Digite a data de levantamento";
        tem = false;
    }
    else if (conselheiro_id == '' || conselheiro_id == null) {
        msgErro = "Escolha o conselheiro";
        tem = false;
    }

    if (tem == false) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: msgErro,
            timer: 4000
        });

    }

    return tem;
}

document.getElementById('btn-registar-distribuicao').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const data_levantamento_distribuicao = document.getElementById('data_levantamento_distribuicao').value;
        const conselheiro_id = document.getElementById('conselheiro_id').value;
        const data_entrega_distribuicao = document.getElementById('data_entrega_distribuicao').value;
        const observacao_distribuicao = document.getElementById('observacao_distribuicao').value;
        const inscricao_id = document.getElementById('inscricao_id').value;

        formData.append('data_levantamento_distribuicao', data_levantamento_distribuicao);
        formData.append('conselheiro_id', conselheiro_id);
        formData.append('data_entrega_distribuicao', data_entrega_distribuicao);
        formData.append('observacao_distribuicao', observacao_distribuicao);
        formData.append('inscricao_id', inscricao_id);

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
                    url: "/system/distribuicao/post",
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

function buscarItem(id) {

    fetch(`/system/getDataInscricaoAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $('#data_levantamento_distribuicao').val(data.data_levantamento_distribuicao);
            $('#data_entrega_distribuicao').val(data.data_entrega_distribuicao);
            $('#observacao_distribuicao').val(data.observacao_distribuicao);
            selecionarCategoria(data.conselheiro_id);

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

function buscarItemDetalhes(id) {

    fetch(`/system/getDetalhesProcesso/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes").html("");

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nº Processo Secretaria: ${data[0].codigo} <br><br>
                            Nº Processo Área Técnica: ${data[1].codigo} <br><br>
                            Requerente: ${data[0].proveniencia} <br><br>
                            Contactos: ${data[1].telefone1}/${data[1].telefone2 == null ? '' : data[1].telefone2} <br><br>
                            Email: ${data[1].email} <br><br>
                            Assunto: ${data[0].assunto} <br><br>
                            Data de Entrada: ${data[0].data_entrada} <br><br>
                            Estado: ${data[1].estado} <br><br>
                            Conselheiro (Análise do Processo): ${data[2] == null ? '' : data[2].nome} <br><br>
                            Despacho: ${data[1].despacho == null ? '' : data[1].despacho}<br><br>
                            Mensagem do despacho: ${data[1].texto_despacho == null ? '' : data[1].texto_despacho}<br><br>
                            Data de despacho: ${data[1].data_despacho == null ? '' : data[1].data_despacho} <br><br>
                            Data de remessa ao CN: ${data[1].data_remessa_cn == null ? '' : data[1].data_remessa_cn}
                        </div>`
            $("#dv-detalhes").html(html);


        })
        .catch(error => {
            console.error('Erro:', error);
        });
}