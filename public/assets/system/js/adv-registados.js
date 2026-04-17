document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");

    // botões de chamar modal
    const btnRegistarDevolucaoModal = document.getElementById("btn-registar-devolucao-modal");

    // botões de salvar e cancelar
    const btnRegistarDevolucao = document.getElementById("btn-registar-devolucao");
    const btnCancelarDevolucao = document.getElementById("btn-cancelar-devolucao");


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

    // botão de abrir a modal de devolução
    btnRegistarDevolucaoModal.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-registar-devolucao'));
            modal.show();

        }
    });


    btnRegistarDevolucao.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        data_entrega_comissao_etica = document.getElementById('data_entrega_comissao_etica').value;
        encaminhar_mesa = document.getElementById('encaminhar_mesa').value;

        if (data_entrega_comissao_etica == '' || data_entrega_comissao_etica == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de entrega dos processos",
                timer: 4000
            });
        }
        else if (encaminhar_mesa == '' || encaminhar_mesa == null || encaminhar_mesa == 'Não') {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe que vai remeter os processos à Mesa do Presidente",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('data_entrega_comissao_etica', data_entrega_comissao_etica);
            formData.append('encaminhar_mesa', encaminhar_mesa);

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
                        url: "/system/entrega-comissaoetica-grupo/post",
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

                                window.location.href = "/system/areatecnica/list/map-distribution/stage-three";
                            }
                            else if (res != 'sucesso') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso",
                                    text: res,
                                    timer: 5000
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


    // botão de fechar a modal de devolução
    btnCancelarDevolucao.addEventListener("click", () => {

        $('#data_entrega_comissao_etica').val("");
        const modalElement = document.getElementById('modal-registar-devolucao');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    $(document).on('click', '.registar-indeferido', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");

        $("#nome_requerente").val(nome);
        $("#inscricao_id").val(id);

        const modal = new bootstrap.Modal(document.getElementById('modal-alterar-despacho'));
        modal.show();

    });

    $(document).on('click', '#btn-registar-indeferimento', function () {

        inscricao_id = $("#inscricao_id").val();
        data_entrega_comissao_etica2 = $('#data_entrega_comissao_etica2').val();
        texto_despacho = $('#texto_despacho').val();

        if (data_entrega_comissao_etica2 == '' || data_entrega_comissao_etica2 == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data de entrega do processo",
                timer: 4000
            });
        }
        else if (texto_despacho == '' || texto_despacho == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a mensagem do despacho",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();
            formData.append('inscricao_id', inscricao_id);
            formData.append('data_entrega_comissao_etica', data_entrega_comissao_etica2);
            formData.append('texto_despacho', texto_despacho);


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
                        url: "/system/entrega-comissaoetica-indeferido/post",
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

                                window.location.href = "/system/areatecnica/list/map-distribution/stage-three";

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
                let data = new Date(item.created_at);
                let dataFormatada = data.toLocaleDateString('pt-PT');
                let horaFormatada = data.toLocaleTimeString('pt-PT');

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
                                            | ${dataFormatada} ${horaFormatada}</a>
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

    fetch(`/system/getDataInscricaoAdvogadoById/${id}`)
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
                            Nº Processo Secretaria: ${data.getregistoentrada.codigo} <br><br>
                            Nº Processo Área Técnica: ${data.codigo} <br><br>
                            Requerente: ${data.getregistoentrada.proveniencia} <br><br>
                            Contactos: ${data.telefone1}/${data.telefone2 == null ? '' : data.telefone2} <br><br>
                            Email: ${data.email} <br><br>
                            Assunto: ${data.getregistoentrada.assunto} <br><br>
                            Data de Entrada: ${data.getregistoentrada.data_entrada} <br><br>
                            Estado: ${data.estado} <br><br>
                            Conselheiro (Análise do Processo): <br><br>
                            Despacho: ${data.despacho == null ? '' : data.despacho}<br><br>
                            Mensagem do despacho: ${data.texto_despacho == null ? '' : data.texto_despacho}<br><br>
                            Data de despacho: ${data.data_despacho == null ? '' : data.data_despacho} <br><br>
                            Data de remessa ao CN: ${data.data_remessa_cn == null ? '' : data.data_remessa_cn}
                        </div>`
            $("#dv-detalhes").html(html);


        })
        .catch(error => {
            console.error('Erro:', error);
        });
}