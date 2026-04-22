document.addEventListener("DOMContentLoaded", () => {

    const checkAll = document.getElementById("checkAll");
    const checkItems = document.querySelectorAll(".checkItem");
    const btnEncaminharProcesso = document.getElementById("btn-encaminhar-processo");
    const btnSalvarEncaminhar = document.getElementById("btn-salvar-encaminhar");

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

        encaminhar_para = document.getElementById('encaminhar_para').value;
        conselheiro_id = document.getElementById('conselheiro_id').value;
        data_entrega_conselheiro = document.getElementById('data_entrega_conselheiro').value;
        data_entrega_comissao = document.getElementById('data_entrega_comissao').value;
        data_remessacn = document.getElementById('data_remessacn').value;
        mensagem_despacho = document.getElementById('mensagem_despacho').value;

        if (encaminhar_para == 'conselheiro' && (conselheiro_id == '' || conselheiro_id == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Selecione o conselheiro",
                timer: 4000
            });
        }
        else if(encaminhar_para == 'conselheiro' && (data_entrega_conselheiro == '' || data_entrega_conselheiro == null)){
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data que foi entregue ao conselheiro",
                timer: 4000
            });
        }
        else if(encaminhar_para == 'comissao' && (data_entrega_comissao == '' || data_entrega_comissao == null)){
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data que foi entregue à comissão de ética",
                timer: 4000
            });
        }
        else if(encaminhar_para == 'indeferido' && (mensagem_despacho == '' || mensagem_despacho == null)){
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a mensagem do despacho",
                timer: 4000
            });
        }
        else if(encaminhar_para == 'cnacional' && (data_remessacn == '' || data_remessacn == null)){
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data de remessa ao CN",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();

            Array.from(selecionados).forEach(id => {
                formData.append('selecionados[]', id);
            });

            formData.append('encaminhar_para', encaminhar_para);
            formData.append('conselheiro_id', conselheiro_id);
            formData.append('data_entrega_conselheiro', data_entrega_conselheiro);
            formData.append('data_entrega_comissao', data_entrega_comissao);
            formData.append('data_remessacn', data_remessacn);
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
                                    timer: 3000
                                });

                                window.location.href = "/system/areatecnica/list/subscription";

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