function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const registo_entrada_id = document.getElementById('registo_entrada_id').value;
    const inscricao_advogado_id = document.getElementById('inscricao_advogado_id').value;
    const despacho = document.getElementById('despacho').value;
    const data_despacho = document.getElementById('data_despacho').value;
    const mensagem_despacho = document.getElementById('mensagem_despacho').value;

    if (despacho == '' || despacho == null) {
        msgErro = "Preencha o campo despacho";
        tem = false;
    }
    else if (data_despacho == '' || data_despacho == null) {
        msgErro = "Digite a data do despacho";
        tem = false;
    }
    else if (despacho == 'Indeferido' && (mensagem_despacho == '' || mensagem_despacho == null)) {
        msgErro = "Digite a mensagem do despacho";
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

document.getElementById('btn-registar-despacho').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const inscricao_advogado_id = document.getElementById('inscricao_advogado_id').value;
        const despacho = document.getElementById('despacho').value;
        const data_despacho = document.getElementById('data_despacho').value;
        const mensagem_despacho = document.getElementById('mensagem_despacho').value;

        formData.append('inscricao_advogado_id', inscricao_advogado_id);
        formData.append('despacho', despacho);
        formData.append('data_despacho', data_despacho);
        formData.append('mensagem_despacho', mensagem_despacho);
        formData.append('registo_entrada_id', registo_entrada_id);

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
                    url: "/system/registo-despacho/post",
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

                            window.location.href = "/system/areatecnica/list/subscription/registed";

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