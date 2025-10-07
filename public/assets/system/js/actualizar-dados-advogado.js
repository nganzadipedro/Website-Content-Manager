
function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const documento = document.getElementById('documento').value;
    const num_documento = document.getElementById('num_documento').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const genero = document.getElementById('genero').value;
    const categoria = document.getElementById('categoria').value;
    const num_associado = document.getElementById('num_associado').value;
    const num_estagiario = document.getElementById('num_estagiario').value;
    const nome_patrono = document.getElementById('nome_patrono').value;
    const email_patrono = document.getElementById('email_patrono').value;
    const telefone_patrono = document.getElementById('telefone_patrono').value;
    const nome_escritorio = document.getElementById('nome_escritorio').value;
    const endereco_escritorio = document.getElementById('endereco_escritorio').value;

    if (nome == '' || nome == null) {
        msgErro = "Digite o nome do associado";
        tem = false;
    }
    else if (email == '' || email == null) {
        msgErro = "Digite o email do associado";
        tem = false;
    }
    else if (documento == '' || documento == null) {
        msgErro = "Informe o documento de identificação";
        tem = false;
    }
    else if (num_documento == '' || num_documento == null) {
        msgErro = "Digite o número do documento de identificação";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (isNaN(telefone1)) {
        msgErro = "Digite um número de telefone válido";
        tem = false;
    }
    else if (genero == '' || genero == null) {
        msgErro = "Escolha o género";
        tem = false;
    }
    else if (categoria == '' || categoria == null) {
        msgErro = "Escolha a categoria";
        tem = false;
    }
    else if (categoria == 'Estagiario' && (num_estagiario == '' || num_estagiario == null)) {
        msgErro = "Digite o número da cédula de estagiário";
        tem = false;
    }
    else if (categoria == 'Advogado' && (num_associado == '' || num_associado == null)) {
        msgErro = "Digite o número da cédula";
        tem = false;
    }
    else if (categoria == 'Estagiario') {

        if (nome_patrono == '' || nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (email_patrono == '' || email_patrono == null) {
            msgErro = "Digite o email do patrono";
            tem = false;
        }
        else if (telefone_patrono == '' || telefone_patrono == null) {
            msgErro = "Digite o número de telefone do patrono";
            tem = false;
        }
        else if (isNaN(telefone_patrono)) {
            msgErro = "O número de telefone do patrono digitado é inválido";
            tem = false;
        }
        else if (nome_escritorio == '' || nome_escritorio == null) {
            msgErro = "Digite o nome do escritório";
            tem = false;
        }
        else if (endereco_escritorio == '' || endereco_escritorio == null) {
            msgErro = "Digite o endereço do escritório";
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

document.getElementById('btn-salvar').addEventListener('click', function () {

    if (valida_formulario() === true) {

        const formData = new FormData();

        const advogado_id = document.getElementById('advogado_id').value;
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const documento = document.getElementById('documento').value;
        const num_documento = document.getElementById('num_documento').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const genero = document.getElementById('genero').value;
        const categoria = document.getElementById('categoria').value;
        const num_associado = document.getElementById('num_associado').value;
        const num_estagiario = document.getElementById('num_estagiario').value;
        const nome_patrono = document.getElementById('nome_patrono').value;
        const email_patrono = document.getElementById('email_patrono').value;
        const telefone_patrono = document.getElementById('telefone_patrono').value;
        const nome_escritorio = document.getElementById('nome_escritorio').value;
        const endereco_escritorio = document.getElementById('endereco_escritorio').value;

        formData.append('advogado_id', advogado_id);
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('documento', documento);
        formData.append('num_documento', num_documento);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('genero', genero);
        formData.append('categoria', categoria);
        formData.append('num_associado', num_associado);
        formData.append('num_estagiario', num_estagiario);
        formData.append('nome_patrono', nome_patrono);
        formData.append('email_patrono', email_patrono);
        formData.append('telefone_patrono', telefone_patrono);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('endereco_escritorio', endereco_escritorio);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja actualizar estas informações? Em caso afirmativo, clique em Actualizar e aguarde a conclusão do processo",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Actualizar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/admin/lawyier/update_data",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (res) {

                        if (res == 'sucesso') {

                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'Informações actualizadas com sucesso',
                                timer: 6000
                            });
                            window.location.reload();

                        }
                        else if (res == 'email') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O email digitado já existe na base de dados',
                                timer: 6000
                            });
                        }
                        else if (res == 'num_documento') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número de identificação digitado já existe',
                                timer: 6000
                            });
                        }
                        else if (res == 'num_associado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número da cédula de advogado digitado já existe',
                                timer: 6000
                            });
                        }
                        else if (res == 'num_estagiario') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número da cédula de advogado estagiário digitado já existe',
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
