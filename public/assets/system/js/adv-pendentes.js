document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");
    const btnEncaminharProcesso = document.getElementById("btn-encaminhar-processo");
    const btnSalvarEncaminhar = document.getElementById("btn-salvar-encaminhar");

    $("#camposcedula").show();
    $("#campossemcedula").hide();

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
    btnEncaminharProcesso.addEventListener("click", () => {

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
            const modal = new bootstrap.Modal(document.getElementById('modal-report'));
            modal.show();

        }
    });

    btnSalvarEncaminhar.addEventListener("click", () => {

        const selecionados = [];

        document.querySelectorAll(".checkItem:checked").forEach(item => {
            selecionados.push(item.value);
        });

        if (valida_formulario() == true) {

            situacao_cedula = document.getElementById('situacao_cedula').value;

            telefone_principal = document.getElementById('telefone_principal').value;
            telefone_alternativo = document.getElementById('telefone_alternativo').value;
            email = document.getElementById('email').value;
            num_bilhete = document.getElementById('num_bilhete').value;

            var data_despacho = '';
            var encaminhar_para = '';
            var conselheiro_id = '';
            var data_entrega_conselheiro = '';
            var data_entrega_comissao = '';
            var data_remessacn = '';
            var mensagem_despacho = '';

            var num_cedula = '';
            var data_emissao_cedula = '';
            var aguarda_cerimonia = '';

            if (situacao_cedula == 'Não') {

                data_despacho = document.getElementById('data_despacho').value;
                encaminhar_para = document.getElementById('encaminhar_para').value;
                conselheiro_id = document.getElementById('conselheiro_id').value;
                data_entrega_conselheiro = document.getElementById('data_entrega_conselheiro').value;
                data_entrega_comissao = document.getElementById('data_entrega_comissao').value;
                data_remessacn = document.getElementById('data_remessacn').value;
                mensagem_despacho = document.getElementById('mensagem_despacho').value;

            }
            else {
                sexo = document.getElementById('sexo').value;
                num_cedula = document.getElementById('num_cedula').value;
                data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
                aguarda_cerimonia = document.getElementById('aguarda_cerimonia').value;
            }

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('situacao_cedula', situacao_cedula);
            formData.append('telefone_principal', telefone_principal);
            formData.append('telefone_alternativo', telefone_alternativo);
            formData.append('email', email);
            formData.append('data_despacho', data_despacho);
            formData.append('num_bilhete', num_bilhete);
            formData.append('encaminhar_para', encaminhar_para);
            formData.append('conselheiro_id', conselheiro_id);
            formData.append('data_entrega_conselheiro', data_entrega_conselheiro);
            formData.append('data_entrega_comissao', data_entrega_comissao);
            formData.append('data_remessacn', data_remessacn);
            formData.append('mensagem_despacho', mensagem_despacho);
            formData.append('num_cedula', num_cedula);
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
                        url: "/system/encaminharprocesso-grupo/post",
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
                            else if (res == 'duplicado') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso",
                                    text: 'O número da cédula já existe. Deve reportar a situação ao Engenheiro!',
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

    $(document).on('change', '#situacao_cedula', function () {

        valor = $(this).val();

        $("#camposcedula").hide();
        $("#campossemcedula").hide();

        if (valor == 'Sim') {
            $("#camposcedula").show();
        }
        else {
            $("#campossemcedula").show();
        }

    });

    function valida_formulario() {

        var valida = true;
        var msg_erro = '';

        situacao_cedula = document.getElementById('situacao_cedula').value;

        telefone_principal = document.getElementById('telefone_principal').value;
        telefone_alternativo = document.getElementById('telefone_alternativo').value;
        email = document.getElementById('email').value;
        num_bilhete = document.getElementById('num_bilhete').value;

        if (telefone_principal == '' || telefone_principal == null) {
            msg_erro = "Digite o telefone principal";
            valida = false;
        }
        else if (isNaN(telefone_principal) == true || telefone_principal.length < 9) {
            msg_erro = "Digite um número de telefone válido";
            valida = false;
        }
        else if(telefone_alternativo != '' && telefone_alternativo != null && isNaN(telefone_alternativo) == true){
            msg_erro = "Digite um número de telefone alternativo válido";
            valida = false;
        }
        else if(telefone_alternativo != '' && telefone_alternativo != null && telefone_alternativo.length < 9){
            msg_erro = "Digite um número de telefone alternativo válido";
            valida = false;
        }
        else if (email == '' || email == null) {
            msg_erro = "Informe o email";
            valida = false;
        }
        else if (num_bilhete == '' || num_bilhete == null) {
            msg_erro = "Digite o número do bilhete";
            valida = false;
        }

        if (situacao_cedula == 'Não' && valida == true) {

            data_despacho = document.getElementById('data_despacho').value;
            encaminhar_para = document.getElementById('encaminhar_para').value;
            conselheiro_id = document.getElementById('conselheiro_id').value;
            data_entrega_conselheiro = document.getElementById('data_entrega_conselheiro').value;
            data_entrega_comissao = document.getElementById('data_entrega_comissao').value;
            data_remessacn = document.getElementById('data_remessacn').value;
            mensagem_despacho = document.getElementById('mensagem_despacho').value;

            if (encaminhar_para == 'conselheiro' && (conselheiro_id == '' || conselheiro_id == null)) {
                msg_erro = "Selecione o conselheiro";
                valida = false;
            }
            else if (encaminhar_para == 'conselheiro' && (data_entrega_conselheiro == '' || data_entrega_conselheiro == null)) {
                msg_erro = "Informe a data que foi entregue ao conselheiro";
                valida = false;
            }
            else if (encaminhar_para == 'comissao' && (data_entrega_comissao == '' || data_entrega_comissao == null)) {
                msg_erro = "Informe a data que foi entregue à comissão de ética";
                valida = false;
            }
            else if (encaminhar_para == 'indeferido' && (data_despacho == '' || data_despacho == null)) {
                msg_erro = "Informe a data do despacho";
                valida = false;
            }
            else if (encaminhar_para == 'indeferido' && (mensagem_despacho == '' || mensagem_despacho == null)) {
                msg_erro = "Digite a mensagem do despacho";
                valida = false;
            }
            else if (encaminhar_para == 'cnacional' && (data_remessacn == '' || data_remessacn == null)) {
                msg_erro = "Digite a data de remessa ao CN";
                valida = false;
            }

        }
        else if (situacao_cedula == 'Sim' && valida == true) {

            num_cedula = document.getElementById('num_cedula').value;
            data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
            sexo = document.getElementById('sexo').value;

            if (num_cedula == '' || num_cedula == null) {
                msg_erro = "Digite o número da cédula";
                valida = false;
            }
            else if (data_emissao_cedula == '' || data_emissao_cedula == null) {
                msg_erro = "Digite a data de emissão da cédula";
                valida = false;
            }
            else if (sexo == '' || sexo == null) {
                msg_erro = "Selecione o género";
                valida = false;
            }
        }

        if (valida == false) {

            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: msg_erro,
                timer: 4000
            });

        }

        return valida;

    }

});