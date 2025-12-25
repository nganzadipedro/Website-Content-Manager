

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
