

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const titulo = document.getElementById('titulo').value;
    const observacao = document.getElementById('observacao').value;
    const tipo_anexo = document.getElementById('tipo_anexo').value;
    const anexo = document.getElementById('anexo').files[0];

    if (titulo == '' || titulo == null) {
        msgErro = "Digite um título ou descrição para o anexo";
        tem = false;
    }
    else if (tipo_anexo == '' || tipo_anexo == null) {
        msgErro = "Escolha o tipo de anexo";
        tem = false;
    }
    else if (!anexo) {
        msgErro = 'Por favor, selecione um anexo.';
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

function valida_formulario_2() {

    var msgErro = '';
    var tem = true;

    const nota = document.getElementById('nota').value;
    const tipo_processo_id = document.getElementById('tipo_processo_id').value;
    const permissao_user_id = document.getElementById('permissao_user_id').value;
    const encaminhar_para = document.getElementById('encaminhar_para').value;
    
    if (encaminhar_para == '' || encaminhar_para == null) {
        msgErro = "Escolha o destino onde pretende encaminhar o processo";
        tem = false;
    }
    else if (encaminhar_para != 'Presidente' && tipo_processo_id == 1 && permissao_user_id == 2) {
        msgErro = "Este tipo de processo deve ser encaminhado para o Presidente";
        tem = false;
    }
    else if (encaminhar_para != 'Área Técnica' && (tipo_processo_id == 2 || tipo_processo_id == 3) && permissao_user_id == 2) {
        msgErro = "Este tipo de processo deve ser encaminhado para a Área Técnica";
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

document.getElementById('btn-salvar-anexo').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const registo_id = document.getElementById('registo_id').value;
        const titulo = document.getElementById('titulo').value;
        const observacao = document.getElementById('observacao').value;
        const tipo_anexo = document.getElementById('tipo_anexo').value;
        const anexo = document.getElementById('anexo').files[0];

        formData.append('registo_id', registo_id);
        formData.append('titulo', titulo);
        formData.append('observacao', observacao);
        formData.append('tipo_anexo', tipo_anexo);
        formData.append('anexo', anexo);
        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja adicionar este anexo? Em caso afirmativo, clique em Submeter e aguarde a conclusão da operação.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/anexos/post",
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
                                text: 'O anexo foi adicionado com sucesso',
                                timer: 4000
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


document.getElementById('btn-confirmar').addEventListener('click', function () {


    if (valida_formulario_2() === true) {

        const formData = new FormData();

        const nota = document.getElementById('nota').value;
        const encaminhar_para = document.getElementById('encaminhar_para').value;
        const registo_id = document.getElementById('registo_id').value;

        formData.append('nota', nota);
        formData.append('encaminhar_para', encaminhar_para);
        formData.append('registo_id', registo_id);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja encaminhar este processo? Em caso afirmativo, clique em Submeter e aguarde a conclusão da operação.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/encaminhar/post",
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
                                text: 'O processo foi encaminhado com sucesso',
                                timer: 4000
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
