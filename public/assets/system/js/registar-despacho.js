function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const registo_entrada_id = document.getElementById('registo_entrada_id').value;
    const inscricao_advogado_id = document.getElementById('inscricao_advogado_id').value;
    const despacho = document.getElementById('despacho').value;

    if (despacho == '' || despacho == null) {
        msgErro = "Preencha o campo Encaminhar Para";
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
        const tipoprocesso_id = document.getElementById('tipoprocesso_id').value;
        const despacho = document.getElementById('despacho').value;

        formData.append('inscricao_advogado_id', inscricao_advogado_id);
        formData.append('despacho', despacho);
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

                            if (tipoprocesso_id == 2) {
                                window.location.href = '/system/areatecnica/list/subscription/registed/Deferido';
                            }
                            else if (tipoprocesso_id == 3) {
                                window.location.href = '/system/areatecnica/list/subscription-trainee/registed/Deferido';
                            } else {
                                window.location.reload();
                            }
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