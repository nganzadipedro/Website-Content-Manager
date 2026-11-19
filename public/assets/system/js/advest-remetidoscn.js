document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");

    const btnCancelar = document.getElementById("btn-cancelar");
    const btnRegistarDataRemessa = document.getElementById("btn-registar-dataremessa");
    const btnSalvarDataRemessa = document.getElementById("btn-salvar-remessacn");

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

    $(document).on('click', '.dados-pessoais', function () {

        $("#inscricao_id").val("");
        $("#nomedp").val("Buscando dados...");
        $("#numbilhetedp").val("Buscando dados...");
        $("#telefone1dp").val("Buscando dados...");
        $("#telefone2dp").val("Buscando dados...");
        $("#emaildp").val("Buscando dados...");
        $("#sexodp").val("");

        id = $(this).data("id");
        nome = $(this).data("nome");
        bilhete = $(this).data("bilhete");
        telefone1 = $(this).data("tel1");
        telefone2 = $(this).data("tel2");
        email = $(this).data("email");
        sexo = $(this).data("sexo");

        const modal = new bootstrap.Modal(document.getElementById('modal-dados-pessoais'));
        modal.show();

        setTimeout(function () {
            $("#inscricao_id").val(id);
            $("#nomedp").val(nome);
            $("#numbilhetedp").val(bilhete);
            $("#telefone1dp").val(telefone1);
            $("#telefone2dp").val(telefone2);
            $("#emaildp").val(email);
            $("#sexodp").val(sexo);
        }, 1500);

    });

    $(document).on('click', '#btn-cancelar-dados-pessoais', function () {

        $("#inscricao_id").val("");
        $("#nomedp").val("");
        $("#numbilhetedp").val("");
        $("#telefone1dp").val("");
        $("#telefone2dp").val("");
        $("#emaildp").val("");
        $("#sexodp").val("");

        const modalElement = document.getElementById('modal-dados-pessoais');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    $(document).on('click', '#btn-salvar-dados-pessoais', function () {

        const nome = document.getElementById('nomedp').value;
        const email = document.getElementById('emaildp').value;
        const num_bilhete = document.getElementById('numbilhetedp').value;
        const telefone1 = document.getElementById('telefone1dp').value;
        const telefone2 = document.getElementById('telefone2dp').value;
        const sexo = document.getElementById('sexodp').value;

        if (num_bilhete == '' || num_bilhete == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o número do bilhete",
                timer: 4000
            });
        }
        else if (nome == '' || nome == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o nome",
                timer: 4000
            });
        }
        else if (sexo == '' || sexo == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Escolha o género/sexo",
                timer: 4000
            });
        }
        else if ((telefone1 == '' || telefone1 == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o número de telefone principal",
                timer: 4000
            });
        }
        else if (isNaN(telefone1) == true) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite um número de telefone válido",
                timer: 4000
            });
        }
        else {

            const inscricao_id = document.getElementById('inscricao_id').value;

            const formData = new FormData();
            formData.append('inscricao_id', inscricao_id);
            formData.append('nome', nome);
            formData.append('email', email);
            formData.append('num_bilhete', num_bilhete);
            formData.append('telefone1', telefone1);
            formData.append('telefone2', telefone2);
            formData.append('sexo', sexo);

            Swal.fire({
                title: "Confirmação",
                text: "Tem certeza que deseja actualizar esta informação?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Salvar!",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return $.ajax({
                        url: "/system/dadospessoais-candidato/update",
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
                                    text: 'Dados actualizados com sucesso!',
                                    timer: 3000
                                });

                                window.location.reload();

                            }
                            else if (res == 'bilhete') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O número do bilhete digitado já existe na base de dados",
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

    $(document).on('click', '.registar-informacoes', function () {

        $("#inscricao_id").val("");
        $("#nome").val("Buscando dados...");
        $("#num_bilhete").val("Buscando dados...");
        $("#sexo").val("");
        $("#numero_cedula").val("");
        $("#data_emissao_cedula").val("");

        id = $(this).data("id");
        nome = $(this).data("nome");
        bilhete = $(this).data("bilhete");
        sexo = $(this).data("sexo");

        const modal = new bootstrap.Modal(document.getElementById('modal-registar-informacoes'));
        modal.show();

        setTimeout(function () {
            $("#inscricao_id").val(id);
            $("#nome").val(nome);
            $("#num_bilhete").val(bilhete);
            $("#sexo").val(sexo);
        }, 1500);

    });

    btnCancelar.addEventListener("click", () => {

        $("#inscricao_id").val("");
        $("#nome").val("");
        $("#num_bilhete").val("");
        $("#sexo").val("");
        $("#numero_cedula").val("");
        $("#data_emissao_cedula").val("");

        const modalElement = document.getElementById('modal-registar-informacoes');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });



    $(document).on('click', '#btn-registar-informacoes', function () {

        const cedula_disponivel = document.getElementById('cedula_disponivel').value;
        const numero_cedula = document.getElementById('numero_cedula').value;
        const num_bilhete = document.getElementById('num_bilhete').value;
        const data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
        const aguarda_cerimonia = document.getElementById('aguarda_cerimonia').value;
        const sexo = document.getElementById('sexo').value;

        if (num_bilhete == '' || num_bilhete == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o número do bilhete",
                timer: 4000
            });
        }
        else if ((numero_cedula == '' || numero_cedula == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o número da cédula",
                timer: 4000
            });
        }
        else if (isNaN(numero_cedula) == true) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite um número de cédula válido",
                timer: 4000
            });
        }
        else if (data_emissao_cedula == '' || data_emissao_cedula == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data de emissão da cédula",
                timer: 4000
            });
        }
        else if (sexo == '' || sexo == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Escolha o género",
                timer: 4000
            });
        }
        else {

            const inscricao_id = document.getElementById('inscricao_id').value;

            const formData = new FormData();
            formData.append('inscricao_id', inscricao_id);
            formData.append('cedula_disponivel', cedula_disponivel);
            formData.append('numero_cedula', numero_cedula);
            formData.append('num_bilhete', num_bilhete);
            formData.append('data_emissao_cedula', data_emissao_cedula);
            formData.append('aguarda_cerimonia', aguarda_cerimonia);
            formData.append('sexo', sexo);

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
                        url: "/system/registoadicional-ceduladisponivel/update",
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
                            else if (res == 'duplicado') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O número de cédula digitado já existe na base de dados",
                                    timer: 4000
                                });
                            }
                            else if (res == 'bilhete') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O número do bilhete de identidade é obrigatório",
                                    timer: 4000
                                });
                            }
                            else if (res == 'sem patrono') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O registo foi efectuado, mas o advogado estagiário não tem patrono registado.",
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

    // document.getElementById('data_emissao_cedula').addEventListener('input', function () {

    //     let valor = this.value.replace(/\D/g, '');

    //     valor = valor.substring(0, 8);

    //     let dia = '';
    //     let mes = '';
    //     let ano = '';

    //     if (valor.length >= 1) {

    //         dia = valor.substring(0, 2);

    //         if (parseInt(dia) > 31) {
    //             dia = '31';
    //         }

    //         if (dia === '00') {
    //             dia = '01';
    //         }
    //     }

    //     if (valor.length >= 3) {

    //         mes = valor.substring(2, 4);

    //         if (parseInt(mes) > 12) {
    //             mes = '12';
    //         }

    //         if (mes === '00') {
    //             mes = '01';
    //         }
    //     }

    //     if (valor.length >= 5) {
    //         ano = valor.substring(4, 8);
    //     }

    //     let resultado = '';

    //     if (dia) {
    //         resultado += dia;
    //     }

    //     if (mes) {
    //         resultado += '/' + mes;
    //     }

    //     if (ano) {
    //         resultado += '/' + ano;
    //     }

    //     this.value = resultado;
    // });

    $(document).on('click', '#btn-gerar-pdf', function () {

        const data_remessa_cn = document.getElementById('data_remessa_cn_filtro').value;

        if (data_remessa_cn == '' || data_remessa_cn == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de remessa ao Conselho Nacional",
                timer: 4000
            });
        }
        else {

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "/system/areatecnica/exportpdf-trainee-post/remessacn";
            form.target = "_blank";

            // CSRF
            const csrf = document.createElement("input");
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrf);

            // Dados que quer enviar
            const dados = document.createElement("input");
            dados.type = "hidden";
            dados.name = "data_remessa_cn";
            dados.value = data_remessa_cn;
            form.appendChild(dados);

            const tipo_processo = document.createElement("input");
            tipo_processo.type = "hidden";
            tipo_processo.name = "tipo_processo";
            tipo_processo.value = 3;
            form.appendChild(tipo_processo);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);

        }

    });

    $(document).on('click', '#btn-gerar-excel', function () {

        const data_remessa_cn = document.getElementById('data_remessa_cn_filtro').value;

        if (data_remessa_cn == '' || data_remessa_cn == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de remessa ao Conselho Nacional",
                timer: 4000
            });
        }
        else {

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "/system/areatecnica/exportxls-trainee/remessacn";
            form.target = "_blank";

            // CSRF
            const csrf = document.createElement("input");
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrf);

            // Dados que quer enviar
            const dados = document.createElement("input");
            dados.type = "hidden";
            dados.name = "data_remessa_cn";
            dados.value = data_remessa_cn;
            form.appendChild(dados);

            const tipo_processo = document.createElement("input");
            tipo_processo.type = "hidden";
            tipo_processo.name = "tipo_processo";
            tipo_processo.value = 3;
            form.appendChild(tipo_processo);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);

        }

    });

    $(document).on('click', '#btn-excel-selecionados', function () {

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

            // const formData = new FormData();

            // Array.from(selecionados).forEach(id => {
            //     formData.append('selecionados[]', id);
            // });

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "/system/areatecnica/exportxls-selecionados";
            form.target = "_blank";

            // CSRF
            const csrf = document.createElement("input");
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrf);

            // Dados que quer enviar
            const dados = document.createElement("input");
            dados.type = "hidden";
            dados.name = "selecionados";
            dados.value = JSON.stringify(selecionados);
            form.appendChild(dados);

            const tipo_processo = document.createElement("input");
            tipo_processo.type = "hidden";
            tipo_processo.name = "tipo_processo";
            tipo_processo.value = 3;
            form.appendChild(tipo_processo);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);

        }

    });

    btnRegistarDataRemessa.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-remeter-cn'));
            modal.show();

        }
    });

    btnSalvarDataRemessa.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        data_remessa_cn = document.getElementById('data_remessa_cn').value;

        if (data_remessa_cn == '' || data_remessa_cn == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data de remessa ao Conselho Nacional",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('data_remessa_cn', data_remessa_cn);

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
                        url: "/system/dataremessacn/update",
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

                            if (resultado == 'sucesso') {
                                sweetAlert({
                                    type: "success",
                                    title: "Sucesso",
                                    text: 'Dados registados com sucesso',
                                    timer: 6000
                                });

                                window.location.href = "/system/areatecnica/list/subscription-trainee/remetidoscn";

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

    $(document).on('click', '#btn-retornar', function () {

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

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });
            csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            Swal.fire({
                title: "Confirmação",
                text: "Tem certeza que deseja retornar os processos à mesa do Presidente?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Sim, retornar!",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return $.ajax({
                        url: "/system/registo-retornarmesa/update",
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
                                    text: 'Dados registados com sucesso!',
                                    timer: 3000
                                });

                                window.location.href = "/system/areatecnica/list/subscription-trainee/remetidoscn";

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

    $(document).on('click', '#btn-gerar-pdf-completo', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportpdf-full-post/remessacn";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        const tipo_processo = document.createElement("input");
        tipo_processo.type = "hidden";
        tipo_processo.name = "tipo_processo";
        tipo_processo.value = 3;
        form.appendChild(tipo_processo);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

    });

    $(document).on('click', '#btn-gerar-excel-completo', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportxls-full-post/remessacn";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        const tipo_processo = document.createElement("input");
        tipo_processo.type = "hidden";
        tipo_processo.name = "tipo_processo";
        tipo_processo.value = 3;
        form.appendChild(tipo_processo);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

    });

});