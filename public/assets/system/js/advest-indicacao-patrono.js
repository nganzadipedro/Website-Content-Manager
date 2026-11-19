document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");

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


    $(document).on('click', '#btn-gerar-pdf', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportpdf-indicacao-patrono";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        document.body.appendChild(form);

        form.submit();

        document.body.removeChild(form);

    });

    $(document).on('click', '#btn-gerar-excel', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportxls-indicacao-patrono";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        document.body.appendChild(form);

        form.submit();

        document.body.removeChild(form);

    });

    $(document).on('click', '.btn-historico', function () {

        // Pega o data-id do <a> clicado
        let id = $(this).data('id');
        buscarHistorico(id);

    });

    $(document).on('click', '.btn-indeferir', function () {

        // Pega o data-id do <a> clicado
        let id = $(this).data('id');
        let requerente = $(this).data('requerente');
        let data_entrada = $(this).data('entrada');
        console.log('ID selecionado:', id);
        $('#inscricao_id').val(id);
        $('#requerente').val(requerente);

    });

     $(document).on('click', '#btn-registar-indeferimento', function () {

        inscricao_id = $("#inscricao_id").val();
        mensagem_despacho = $('#mensagem_indeferimento').val();
        data_despacho = $('#data_indeferimento').val();

        if (mensagem_despacho == '' || mensagem_despacho == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a mensagem de despacho",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();
            formData.append('inscricao_id', inscricao_id);
            formData.append('mensagem_despacho', mensagem_despacho);
            formData.append('data_despacho', data_despacho);

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
                        url: "/system/indicacao-patrono-mudarindeferido/update",
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

                                window.location.href = "/system/areatecnica/list/subscription-trainee/registed/Deferido";

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
        buscarItemDetalhes(id);

    });

    $(document).on('click', '#btn-excluir-processos', function () {

        const selecionados = [];
        const user_id = $('#user_id').val();

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        if (user_id != 1 && user_id != 4054) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Não tem permissão para excluir registos",
                timer: 4000
            });
        }
        else if (selecionados.length === 0) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Não foi selecionado nenhum processo na tabela de dados",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });
            csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            Swal.fire({
                title: "Confirmação",
                text: "Tem certeza que deseja excluir os processos selecionados?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return $.ajax({
                        url: "/system/inscricao-delete-grupo/post",
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
                                    text: 'Dados excluídos com sucesso!',
                                    timer: 3000
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
                            Email: ${data.email == null ? '' : data.email} <br><br>
                            Assunto: ${data.getregistoentrada.assunto} <br><br>
                            Data de Entrada: ${data.getregistoentrada.data_entrada} <br><br>
                            Estado: ${data.estado} <br><br>
                            Acto Pretendido: ${data.acto_pretendido}<br><br>
                            Data de remessa ao CN: ${data.data_remessa_cn == null ? '' : data.data_remessa_cn}
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
                                    <div class="col text-truncate">
                                        <a href="#" class="text-reset d-block">${item.nome}
                                            | ${dataFormatada} ${horaFormatada}</a>
                                        <div class="d-block text-secondary text-truncate mt-n1">
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

});