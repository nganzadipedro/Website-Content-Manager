
function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const nome_completo = document.getElementById('nome_completo').value;
    const nome_profissional = document.getElementById('nome_profissional').value;
    const num_bi = document.getElementById('num_bi').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const sexo = document.getElementById('sexo').value;
    const num_associado = document.getElementById('num_associado').value;
    const email = document.getElementById('email').value;
    const data_inscricao_oaa = document.getElementById('data_inscricao_oaa').value;
    const nome_escritorio = document.getElementById('nome_escritorio').value;
    const endereco_escritorio = document.getElementById('endereco_escritorio').value;
    const municipio_id = document.getElementById('municipio_id').value;


    if (nome_completo == '' || nome_completo == null) {
        msgErro = "Digite o nome completo";
        tem = false;
    }
    else if (nome_profissional == '' || nome_profissional == null) {
        msgErro = "Digite o nome profissional";
        tem = false;
    }
    else if (num_bi == '' || num_bi == null) {
        msgErro = "Digite o número do bilhete";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (sexo == '' || sexo == null) {
        msgErro = "Escolha o género";
        tem = false;
    }
    else if (num_associado == '' || num_associado == null) {
        msgErro = "Digite o número da cédula";
        tem = false;
    }
    else if (email == '' || email == null) {
        msgErro = "Digite o endereço de email";
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

document.getElementById('btn-registar').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const nome_completo = document.getElementById('nome_completo').value;
        const nome_profissional = document.getElementById('nome_profissional').value;
        const num_bi = document.getElementById('num_bi').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const sexo = document.getElementById('sexo').value;
        const num_associado = document.getElementById('num_associado').value;
        const email = document.getElementById('email').value;
        const data_inscricao_oaa = document.getElementById('data_inscricao_oaa').value;
        const nome_escritorio = document.getElementById('nome_escritorio').value;
        const endereco_escritorio = document.getElementById('endereco_escritorio').value;
        const municipio_id = document.getElementById('municipio_id').value;
        const patrono_id = document.getElementById('patrono_id').value;

        formData.append('nome_completo', nome_completo);
        formData.append('nome_profissional', nome_profissional);
        formData.append('num_bi', num_bi);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('genero', sexo);
        formData.append('num_associado', num_associado);
        formData.append('email', email);
        formData.append('data_inscricao_oaa', data_inscricao_oaa);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('endereco_escritorio', endereco_escritorio);
        formData.append('municipio_id', municipio_id);
        formData.append('patrono_id', patrono_id);

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
                    url: "/system/registo-patrono/update",
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
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número de cédula duplicado na base de dados!',
                                timer: 3000
                            });
                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número do BI duplicado na base de dados!',
                                timer: 3000
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