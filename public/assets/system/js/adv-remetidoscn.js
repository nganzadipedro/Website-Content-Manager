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

    $(document).on('click', '.registar-informacoes', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");
        bilhete = $(this).data("bilhete");
        sexo = $(this).data("sexo");

        $("#inscricao_id").val(id);
        $("#nome").val(nome);
        $("#num_bilhete").val(bilhete);
        $("#sexo").val(sexo);

        const modal = new bootstrap.Modal(document.getElementById('modal-registar-informacoes'));
        modal.show();

    });

    btnCancelar.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-registar-informacoes');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    $(document).on('click', '#btn-registar-informacoes', function () {

        const cedula_disponivel = document.getElementById('cedula_disponivel').value;
        const numero_cedula = document.getElementById('numero_cedula').value;
        const data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
        const aguarda_cerimonia = document.getElementById('aguarda_cerimonia').value;
        const sexo = document.getElementById('sexo').value;
        const num_bilhete = document.getElementById('num_bilhete').value;

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
            formData.append('data_emissao_cedula', data_emissao_cedula);
            formData.append('aguarda_cerimonia', aguarda_cerimonia);
            formData.append('num_bilhete', num_bilhete);
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

                                window.location.href = "/system/areatecnica/list/lawyers-cn";

                            }
                            else if (res == 'duplicado') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O número de cédula digitado já existe na base de dados",
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
            tipo_processo.value = 2;
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
            tipo_processo.value = 2;
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

                                window.location.href = "/system/areatecnica/list/lawyers-cn";

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