document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");
    const btnRemeterCn = document.getElementById("btn-remeter-cn");
    const btnRegistarDataDespacho = document.getElementById("btn-registar-datadespacho");
    const btnCancelar = document.getElementById("btn-cancelar");
    btnCancelarDataDespacho = document.getElementById("btn-cancelar-datadespacho");

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

                                window.location.href = "/system/areatecnica/list/subscription-trainee/registed/Deferido";

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

    $(document).on('click', '.mudar-despacho', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");

        $("#nome_requerente").val(nome);
        $("#inscricao_id").val(id);

        const modal = new bootstrap.Modal(document.getElementById('modal-alterar-despacho'));
        modal.show();

    });

    $(document).on('click', '#btn-alterar-despacho', function () {

        inscricao_id = $("#inscricao_id").val();
        data_despacho = $('#data_despacho').val();
        encaminhar_para = $('#encaminhar_para').val();
        mensagem_despacho = $('#texto_despacho').val();

        if (encaminhar_para =='indeferido' && (data_despacho == '' || data_despacho == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data do despacho",
                timer: 4000
            });
        }
        else if (encaminhar_para =='indeferido' && (mensagem_despacho == '' || mensagem_despacho == null)) {
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
            formData.append('encaminhar_para', encaminhar_para);
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

    btnCancelar.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-remeter-cn');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    btnCancelarDataDespacho.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-registar-datadespacho');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    $(document).on('click', '.btn-historico', function () {

        // Pega o data-id do <a> clicado
        let id = $(this).data('id');
        buscarHistorico(id);

    });

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
                                        <div class="text-secondary mt-n1">
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


    $(document).on('click', '.btn-detalhes', function () {

        // Pega o data-id do <a> clicado
        let id = $(this).data('id');
        buscarItemDetalhes(id);

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
                            Despacho: ${data.despacho == null ? 'Sem Despacho' : data.despacho} <br><br>
                            Mensagem do despacho: ${data.despacho == 'Indeferido' ? data.observacao : ''} <br><br>
                            Acto Pretendido: ${data.acto_pretendido}<br><br>
                            Data de remessa ao CN: ${data.data_remessa_cn == null ? '' : data.data_remessa_cn}
                        </div>`
                $("#dv-detalhes").html(html);


            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }


  


});