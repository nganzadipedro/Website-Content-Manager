document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");

    // botões de chamar modal
    const btnRegistarDevolucao = document.getElementById("btn-registar-devolucao");
    const btnRemeterComissao = document.getElementById("btn-remeter-comissao");
    const btnRegistarEntrega = document.getElementById("btn-registar-dataentrega");


    // botões de salvar e cancelar
    const btnRegistarDevolucaoDistribuicao = document.getElementById("btn-registar-devolucao-distribuicao");
    const btnCancelarDevolucao = document.getElementById("btn-cancelar-devolucao-distribuicao");
    const btnRegistarRemessaComissao = document.getElementById("btn-registar-remessa-comissao");
    const btnCancelarRemessaComissao = document.getElementById("btn-cancelar-remessa-comissao");
    const btnRegistarDataEntrega = document.getElementById("btn-salvar-dataentrega");
    const btnCancelarDataEntrega = document.getElementById("btn-cancelar-dataentrega");


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
    btnRegistarDevolucao.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-registar-devolucao-conselheiro'));
            modal.show();

        }
    });

    btnRemeterComissao.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-remeter-comissao-etica'));
            modal.show();

        }
    });

    btnRegistarEntrega.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-registar-dataentrega'));
            modal.show();

        }
    });

    btnRegistarDataEntrega.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        data_levantamento_distribuicao = document.getElementById('data_levantamento_distribuicao').value;

        if (data_levantamento_distribuicao == '' || data_levantamento_distribuicao == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de entrega dos processos ao Conselheiro",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('data_levantamento_distribuicao', data_levantamento_distribuicao);

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
                        url: "/system/levantamento-conselheiro-grupo/post",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (resultado) {

                            console.log(resultado);

                            if (resultado.type == 'sucesso') {

                                sweetAlert({
                                    type: "success",
                                    title: "Sucesso",
                                    text: resultado['data'],
                                    timer: 5000
                                });

                                const modalElement = document.getElementById('modal-registar-dataentrega');
                                const modal = bootstrap.Modal.getInstance(modalElement);
                                $('#data_levantamento_distribuicao').val(null);
                                modal.hide();

                                // rotina para gerar o pdf
                                const form = document.createElement("form");
                                form.method = "POST";
                                form.action = "/system/areatecnica/exportpdf-lawyers/entregaconselheiro";
                                form.target = "_blank";

                                // CSRF
                                const csrf = document.createElement("input");
                                csrf.type = "hidden";
                                csrf.name = "_token";
                                csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                                form.appendChild(csrf);

                                // Dados que quer enviar
                                const campo_conselheiro_id = document.createElement("input");
                                campo_conselheiro_id.type = "hidden";
                                campo_conselheiro_id.name = "conselheiro_id";
                                campo_conselheiro_id.value = resultado['conselheiro_id'];
                                form.appendChild(campo_conselheiro_id);

                                const campo_data_entrega = document.createElement("input");
                                campo_data_entrega.type = "hidden";
                                campo_data_entrega.name = "data_entrega";
                                campo_data_entrega.value = data_levantamento_distribuicao;
                                form.appendChild(campo_data_entrega);

                                document.body.appendChild(form);

                                form.submit();
                                document.body.removeChild(form);

                            }
                            else {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso",
                                    text: resultado['data'],
                                    timer: 6000
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

    btnRegistarDevolucaoDistribuicao.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        data_entrega_distribuicao = document.getElementById('data_entrega_distribuicao').value;

        if (data_entrega_distribuicao == '' || data_entrega_distribuicao == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de devolução dos processos pelo Conselheiro",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('data_entrega_distribuicao', data_entrega_distribuicao);

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
                        url: "/system/entrega-conselheiro-grupo/post",
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

                                window.location.href = "/system/areatecnica/list/map-distribution/stage-two";
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

    btnRegistarRemessaComissao.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        remeter_comissao = document.getElementById('remeter_comissao').value;
        data_remessa_comissao = document.getElementById('data_remessa_comissao').value;

        if (remeter_comissao == '' || remeter_comissao == null || remeter_comissao == 'Não') {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe que vai remeter os processos à comissão de ética",
                timer: 4000
            });
        }
        else if (data_remessa_comissao == '' || data_remessa_comissao == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data que vai remter à comissão de ética",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('data_remessa_comissao', data_remessa_comissao);
            formData.append('remeter_comissao', remeter_comissao);

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
                        url: "/system/remessa-comissaoetica-grupo/post",
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

                                window.location.href = "/system/areatecnica/list/map-distribution/stage-two";
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

    btnCancelarDevolucao.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-registar-devolucao-conselheiro');
        const modal = bootstrap.Modal.getInstance(modalElement);
        $('#data_entrega_distribuicao').val(null);
        modal.hide();

    });

    btnCancelarRemessaComissao.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-remeter-comissao-etica');
        const modal = bootstrap.Modal.getInstance(modalElement);
        $('#data_remessa_comissao').val(null);
        $('#remeter_comissao').val(null);
        modal.hide();

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
                                            | ${formatada} </a>
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
                            Estado: ${data.getregistoentrada.estado} <br><br>
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