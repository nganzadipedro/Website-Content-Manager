
$(document).on('click', '.btn-adicionar', function () {

    // Pega o data-id do <a> clicado

    id = $(this).data("id");

    fetch(`/system/getPatronoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);

            municipio = '';
            if (data.municipio_id != null) {
                municipio = data.getmunicipio.descricao;
            }

            nome = data.nome;

            if (data.advogado_id != null) {

                fetch(`/system/getAdvogadoById/${data.advogado_id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição');
                        }
                        return response.json();
                    })
                    .then(data2 => {

                        console.log('Resposta do servidor:', data2);
                        ;
                        $("#nome_patrono").val(data2.getpessoa.nome);
                        $("#num_cedula_patrono").val(data2.num_associado);
                        $("#tel_patrono").val(data2.getpessoa.telefone1);
                        $("#email_patrono").val(data2.getpessoa.email);
                        $("#nome_escritorio").val(data2.nome_escritorio);
                        $("#endereco_escritorio_est").val(data2.endereco_escritorio);
                        $("#municipio_id_est").val(data2.municipio_id);
                        $("#patrono_id").val(id);

                        $("#nome_patrono").prop("disabled", true);

                    })
                    .catch(error => {
                        console.error('Erro:', error);
                    });

            }
            else {
                $("#nome_patrono").val(nome);
                $("#nome_patrono").prop("disabled", true);
            }

            fetch(`/system/getEstagiariosPatrono/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição');
                    }
                    return response.json();
                })
                .then(dados => {

                    console.log('Resposta do servidor:', dados);
                    contador = 0;
                    dados.forEach(item => {
                        if (item.estado == 'frequenta') {
                            contador += 1;
                        }
                    });

                    $("#num_estagiarios").val(contador);
                    $("#num_estagiarios").prop("disabled", true);

                })
                .catch(error => {
                    console.error('Erro:', error);
                });


        })
        .catch(error => {
            console.error('Erro:', error);
        });

    const modalElement = document.getElementById('modal-patronos');
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();

});

$(document).on('click', '#btn-novo-patrono', function () {

    $("#tel_patrono").val("");
    $("#email_patrono").val("");
    $("#nome_escritorio").val("");
    $("#endereco_escritorio_est").val("");
    $("#municipio_id_est").val("");
    $("#nome_patrono").val("");
    $("#nome_patrono").prop("disabled", false);
    $("#patrono_id").val("");
    $("#num_estagiarios").val("");
    $("#num_estagiarios").prop("disabled", true);
    $("#num_cedula_patrono").val("");

});


function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const num_bilhete = document.getElementById('num_bilhete').value;
    const sexo = document.getElementById('sexo').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const email = document.getElementById('email').value;
    const acto_pretendido = document.getElementById('acto_pretendido').value;
    const nome_patrono = document.getElementById('nome_patrono').value;
    const num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
    const tel_patrono = document.getElementById('tel_patrono').value;
    const email_patrono = document.getElementById('email_patrono').value;
    const nome_escritorio = document.getElementById('nome_escritorio').value;
    const endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
    const municipio_id_est = document.getElementById('municipio_id_est').value;
    const observacao2 = document.getElementById('observacao2').value;


    if (num_bilhete == '' || num_bilhete == null) {
        msgErro = "Digite o número do bilhete de identidade";
        tem = false;
    }
    else if (sexo == '' || sexo == null) {
        msgErro = "Escolha o género";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (acto_pretendido == '' || acto_pretendido == null) {
        msgErro = "Especifique o acto pretendido";
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

document.getElementById('btn-registar-inscricao').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const num_bilhete = document.getElementById('num_bilhete').value;
        const sexo = document.getElementById('sexo').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const email = document.getElementById('email').value;
        const acto_pretendido = document.getElementById('acto_pretendido').value;
        const nome_patrono = document.getElementById('nome_patrono').value;
        const num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
        const tel_patrono = document.getElementById('tel_patrono').value;
        const email_patrono = document.getElementById('email_patrono').value;
        const nome_escritorio = document.getElementById('nome_escritorio').value;
        const endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
        const municipio_id_est = document.getElementById('municipio_id_est').value;
        const observacao2 = document.getElementById('observacao2').value;
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const tipo_processo_id = document.getElementById('tipo_processo_id').value;
        const patrono_id = document.getElementById('patrono_id').value;

        formData.append('num_bilhete', num_bilhete);
        formData.append('genero', sexo);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('email', email);
        formData.append('acto_pretendido', acto_pretendido);
        formData.append('nome_patrono', nome_patrono);
        formData.append('num_cedula_patrono', num_cedula_patrono);
        formData.append('tel_patrono', tel_patrono);
        formData.append('email_patrono', email_patrono);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('endereco_escritorio', endereco_escritorio_est);
        formData.append('municipio_id', municipio_id_est);
        formData.append('observacao', observacao2);
        formData.append('registo_entrada_id', registo_entrada_id);
        formData.append('tipo_processo_id', tipo_processo_id);
        formData.append('patrono_id', patrono_id);

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
                    url: "/system/registo-inscricao/post",
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

                            window.location.href = "/system/areatecnica/list/subscription-trainee";

                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número de cédula do patrono está duplicado na base de dados!',
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