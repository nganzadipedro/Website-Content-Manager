function valida_formulario_actualizacao() {

    var msgErro = '';
    var tem = true;

    const field_data_remessa_cn = document.getElementById('field_data_remessa_cn').value;

    data_remessa_cn = '';
    cedula_disponivel = '';
    numero_cedula = '';
    data_emissao_cedula = '';
    data_cerimonia = '';

    if (field_data_remessa_cn == null || field_data_remessa_cn == '') {
        data_remessa_cn = document.getElementById('data_remessa_cn').value;
    }
    else {
        cedula_disponivel = document.getElementById('cedula_disponivel').value;
        numero_cedula = document.getElementById('numero_cedula').value;
        data_cerimonia = document.getElementById('data_cerimonia').value;
        data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
    }

    if (field_data_remessa_cn == '' || field_data_remessa_cn == null) {
        if (data_remessa_cn == '' || data_remessa_cn == null) {
            msgErro = "Digite a data de remessa para a CN";
            tem = false;
        }
    }
    else {
        if (cedula_disponivel == '' || cedula_disponivel == null) {
            msgErro = "Preencha o campo de cedula disponível";
            tem = false;
        }
        else if (cedula_disponivel == 'Sim' && (numero_cedula == '' || numero_cedula == null)) {
            msgErro = "Digite o número da cedula";
            tem = false;
        }
        else if (cedula_disponivel == 'Sim' && (data_emissao_cedula == '' || data_emissao_cedula == null)) {
            msgErro = "Digite a data de emissão da cedula";
            tem = false;
        }
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

document.getElementById('btn-actualizar-dados').addEventListener('click', function () {


    if (valida_formulario_actualizacao() === true) {

        const formData = new FormData();
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const inscricao_advogado_id = document.getElementById('inscricao_advogado_id').value;

        const field_data_remessa_cn = document.getElementById('field_data_remessa_cn').value;

        data_remessa_cn = '';
        cedula_disponivel = '';
        numero_cedula = '';
        data_emissao_cedula = '';
        data_cerimonia = '';

        if (field_data_remessa_cn == null || field_data_remessa_cn == '') {
            data_remessa_cn = document.getElementById('data_remessa_cn').value;
        }
        else {
            cedula_disponivel = document.getElementById('cedula_disponivel').value;
            numero_cedula = document.getElementById('numero_cedula').value;
            data_cerimonia = document.getElementById('data_cerimonia').value;
            data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
        }


        formData.append('inscricao_advogado_id', inscricao_advogado_id);
        formData.append('data_remessa_cn', data_remessa_cn);
        formData.append('cedula_disponivel', cedula_disponivel);
        formData.append('numero_cedula', numero_cedula);
        formData.append('data_emissao_cedula', data_emissao_cedula);
        formData.append('data_cerimonia', data_cerimonia);
        formData.append('registo_entrada_id', registo_entrada_id);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja actualizar estes dados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Salvar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/actualizar-despacho/post",
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