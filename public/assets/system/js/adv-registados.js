document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");

    // botões de chamar modal
    const btnRemeterCn = document.getElementById("btn-remeter-cn");
    const btnRegistarDataDespacho = document.getElementById("btn-registar-datadespacho");
    const btnCancelar = document.getElementById("btn-cancelar");
    const btnCancelarDataDespacho = document.getElementById("btn-cancelar-datadespacho");


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

    btnRemeterCn.addEventListener("click", () => {

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

            csrf = document.querySelector('meta[name="csrf-token"]').content;
            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            Swal.fire({
                title: "Confirmação",
                text: "Tem certeza que deseja remeter os processos ao conselho nacional?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Salvar!",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return $.ajax({
                        url: "/system/registo-remetercn/update",
                        headers: {
                            'X-CSRF-TOKEN': csrf
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

                                window.location.href = "/system/areatecnica/list/subscription/registed/Deferido";

                            }
                            else if (res != 'sucesso') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso",
                                    text: res,
                                    timer: 6000
                                });
                            }

                            setTimeout(() => {
                                window.location.reload();
                            }, 6000);

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

    btnRegistarDataDespacho.addEventListener("click", () => {

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

            const modal = new bootstrap.Modal(document.getElementById('modal-registar-datadespacho'));
            modal.show();

        }
    });

    $(document).on('click', '#btn-salvar-datadespacho', function () {

        data_despacho = $('#data_despacho_presidente').val();

        if (data_despacho == '' || data_despacho == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data do despacho",
                timer: 4000
            });
        }
        else {

            const selecionados = [];

            document.querySelectorAll(".checkItem:checked").forEach(item => {
                selecionados.push(item.value);
            });

            csrf = document.querySelector('meta[name="csrf-token"]').content;
            const formData = new FormData();

            formData.append('data_despacho', data_despacho);
            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });


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
                        url: "/system/datadespacho-presidente/update",
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

                                window.location.href = "/system/areatecnica/list/subscription/registed/Deferido";

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

    $(document).on('click', '.mudar-despacho', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");

        $("#nome_requerente").val(nome);
        $("#inscricao_id").val(id);

        const modal = new bootstrap.Modal(document.getElementById('modal-alterar-despacho'));
        modal.show();

    });

    $(document).on('click', '.encaminhar-processo', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");

        $("#nome_requerente_encaminhar").val(nome);
        $("#inscricao_id_encaminhar").val(id);

        const modal = new bootstrap.Modal(document.getElementById('modal-encaminhar-processo'));
        modal.show();

    });

    $(document).on('click', '#btn-salvar-encaminhar', function () {

        inscricao_id = $("#inscricao_id_encaminhar").val();
        encaminhar_para = document.getElementById('encaminhar_para').value;
        conselheiro_id = document.getElementById('conselheiro_id').value;
        data_entrega_conselheiro = document.getElementById('data_entrega_conselheiro').value;
        data_entrega_comissao = document.getElementById('data_entrega_comissao').value;


        if (encaminhar_para == 'conselheiro' && (conselheiro_id == '' || conselheiro_id == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Selecione o conselheiro",
                timer: 4000
            });
        }
        else if (encaminhar_para == 'comissao' && (data_entrega_comissao == '' || data_entrega_comissao == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data que foi entregue à comissão de ética",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            formData.append('encaminhar_para', encaminhar_para);
            formData.append('conselheiro_id', conselheiro_id);
            formData.append('data_entrega_conselheiro', data_entrega_conselheiro);
            formData.append('data_entrega_comissao', data_entrega_comissao);
            formData.append('inscricao_id', inscricao_id);

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
                        url: "/system/encaminharprocesso-individual/post",
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

                                window.location.href = "/system/areatecnica/list/subscription/registed/Indeferido";

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

    $(document).on('click', '#btn-alterar-despacho', function () {

        inscricao_id = $("#inscricao_id").val();
        data_despacho = $('#data_despacho').val();
        mensagem_despacho = $('#texto_despacho').val();

        if (data_despacho == '' || data_despacho == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data do despacho",
                timer: 4000
            });
        }
        else if (mensagem_despacho == '' || mensagem_despacho == null) {
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
            formData.append('data_despacho', data_despacho);
            formData.append('mensagem_despacho', mensagem_despacho);


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
                        url: "/system/registo-mudarindeferido/update",
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

                                window.location.href = "/system/areatecnica/list/subscription/registed/Deferido";

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