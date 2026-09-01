$(document).on('click', '.btn-adicionar', function () {

    // Pega o data-id do <a> clicado
    let advogado_id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('advogado_id', advogado_id);
    formData.append('registo_id', registo_id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja atribuir este advogado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Adicionar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/atribuir-advogado/post",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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
                            text: 'Advogado adicionado com sucesso!',
                            timer: 3000
                        });

                        window.location.reload();
                    }
                    else if (res == 'duplicado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Este advogado já foi atribuido neste processo!',
                            timer: 4000
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


});

$(document).on('click', '.btn-remover', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('id', id);
    formData.append('registo_id', registo_id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este advogado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/atribuir-advogado/delete",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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
                            text: 'Advogado eliminado com sucesso!',
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
                        timer: 6000
                    });
                    console.log("Error: " + error.responseJSON.message);
                }
            });
        }
    });


});

$('#end-estagiario').hide();
$('#end-advogado').hide();
$('#field-num-associado').hide();
$('#field-data-inscricao-advogado').hide();

$(document).on('change', '#categoria', function () {

    // Pega o data-id do <a> clicado
    let categoria = $(this).val();

    if (categoria == 'Advogado') {
        $('#end-estagiario').hide();
        $('#end-advogado').show();
        $('#field-num-associado').show();
        $('#field-data-inscricao-advogado').show();
    }
    else if (categoria == 'Estagiario') {
        $('#end-estagiario').show();
        $('#end-advogado').hide();
        $('#field-num-associado').hide();
        $('#field-data-inscricao-advogado').hide();
    }
    else {
        $('#end-estagiario').hide();
        $('#end-advogado').hide();
        $('#field-num-associado').hide();
        $('#field-data-inscricao-advogado').hide();
    }

});

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const nome_completo = document.getElementById('nome_completo').value;
    const nome_profissional = document.getElementById('nome_profissional').value;
    const num_bi = document.getElementById('num_bi').value;
    const telefone1 = document.getElementById('telefone1').value;
    const sexo = document.getElementById('sexo').value;
    const email = document.getElementById('email').value;
    const categoria = document.getElementById('categoria').value;

    var endereco_profissional_adv;
    var municipio_id_adv;
    var nome_patrono;
    var tel_patrono;
    var email_patrono;
    var num_cedula_patrono;
    var nome_escritorio;
    var endereco_escritorio_est;
    var municipio_id_est;
    var num_associado;
    var num_estagiario;
    var data_inscricao_oaa;
    var data_inscricao_estagiario;

    if (categoria == 'Advogado') {
        num_associado = document.getElementById('num_associado').value;
        endereco_profissional_adv = document.getElementById('endereco_profissional_adv').value;
        municipio_id_adv = document.getElementById('municipio_id_adv').value;
    }
    else if (categoria == 'Estagiario') {
        num_estagiario = document.getElementById('num_estagiario_est').value;
        nome_patrono = document.getElementById('nome_patrono').value;
        num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
        tel_patrono = document.getElementById('tel_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
        nome_escritorio = document.getElementById('nome_escritorio_est').value;
        endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
        municipio_id_est = document.getElementById('municipio_id_est').value;
    }

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
    else if (categoria == '' || categoria == null) {
        msgErro = "Escolha a categoria";
        tem = false;
    }
    else if (categoria == 'Advogado') {
        if (num_associado == '' || num_associado == null) {
            msgErro = "Digite o número da cédula de advogado";
            tem = false;
        }
        else if (endereco_profissional_adv == '' || endereco_profissional_adv == null) {
            msgErro = "Digite o endereço profissional do advogado";
            tem = false;
        }
        else if (municipio_id_adv == '' || municipio_id_adv == null) {
            msgErro = "Escolha o município referente ao endereço profissional do advogado";
            tem = false;
        }
    }
    else if (categoria == 'Estagiario') {
        if (num_estagiario == '' || num_estagiario == null) {
            msgErro = "Digite o número da cédula de advogado estagiário";
            tem = false;
        }
        else if (nome_patrono == '' || nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (num_cedula_patrono == '' || num_cedula_patrono == null) {
            msgErro = "Digite o número da cédula do patrono";
            tem = false;
        }
        else if (tel_patrono == '' || tel_patrono == null) {
            msgErro = "Digite o número de telefone do patrono";
            tem = false;
        }
        else if (email_patrono == '' || email_patrono == null) {
            msgErro = "Digite o email do patrono";
            tem = false;
        }
        else if (nome_escritorio == '' || nome_escritorio == null) {
            msgErro = "Digite o nome do escritório";
            tem = false;
        }
        else if (municipio_id_est == '' || municipio_id_est == null) {
            msgErro = "Escolha o município referente ao endereço do escritório";
            tem = false;
        }
        else if (endereco_escritorio_est == '' || endereco_escritorio_est == null) {
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

document.getElementById('btn-registar-advogado').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        registo_id = $('#registo_id').val();

        const nome_completo = document.getElementById('nome_completo').value;
        const nome_profissional = document.getElementById('nome_profissional').value;
        const num_bi = document.getElementById('num_bi').value;
        const telefone1 = document.getElementById('telefone1').value;
        const sexo = document.getElementById('sexo').value;
        const email = document.getElementById('email').value;
        const categoria = document.getElementById('categoria').value;
        const telefone2 = document.getElementById('telefone2').value;


        num_associado = '';
        num_estagiario = '';
        num_cedula_patrono = '';
        data_inscricao_oaa = '';
        data_inscricao_estagiario = '';
        endereco_profissional_adv = '';
        municipio_id_adv = '';
        nome_patrono = '';
        tel_patrono = '';
        email_patrono = '';
        nome_escritorio_adv = '';
        nome_escritorio_est = '';
        endereco_escritorio_est = '';
        municipio_id_est = '';

        if (categoria == 'Advogado') {
            endereco_profissional_adv = document.getElementById('endereco_profissional_adv').value;
            municipio_id_adv = document.getElementById('municipio_id_adv').value;
            num_associado = document.getElementById('num_associado').value;
            num_estagiario = document.getElementById('num_estagiario_adv').value;
            data_inscricao_estagiario = document.getElementById('data_inscricao_estagiario_adv').value;
            data_inscricao_advogado = document.getElementById('data_inscricao_oaa');
            nome_escritorio_adv = document.getElementById('nome_escritorio_adv').value;
        }
        else if (categoria == 'Estagiario') {
            num_estagiario = document.getElementById('num_estagiario_est').value;
            num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
            data_inscricao_estagiario = document.getElementById('data_inscricao_estagiario_est').value;
            nome_patrono = document.getElementById('nome_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio_est = document.getElementById('nome_escritorio_est').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
        }

        formData.append('nome_completo', nome_completo);
        formData.append('nome_profissional', nome_profissional);
        formData.append('num_bi', num_bi);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('sexo', sexo);
        formData.append('num_associado', num_associado);
        formData.append('num_estagiario', num_estagiario);
        formData.append('email', email);
        formData.append('data_inscricao_oaa', data_inscricao_oaa);
        formData.append('data_inscricao_estagiario', data_inscricao_estagiario);
        formData.append('categoria', categoria);
        formData.append('endereco_profissional_adv', endereco_profissional_adv);
        formData.append('municipio_id_adv', municipio_id_adv);
        formData.append('nome_patrono', nome_patrono);
        formData.append('num_cedula_patrono', num_cedula_patrono);
        formData.append('tel_patrono', tel_patrono);
        formData.append('email_patrono', email_patrono);
        formData.append('nome_escritorio_est', nome_escritorio_est);
        formData.append('nome_escritorio_adv', nome_escritorio_adv);
        formData.append('endereco_escritorio_est', endereco_escritorio_est);
        formData.append('municipio_id_est', municipio_id_est);
        formData.append('registo_id', registo_id);

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
                    url: "/system/registo-associado-atribuir-advogado/post",
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

document.getElementById('btn-confirmar').addEventListener('click', function () {

    const formData = new FormData();
    registo_id = $('#registo_id').val();
    formData.append('registo_id', registo_id);

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja confirmar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/confirmar-atribuicao/post",
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
                            text: 'Dados registados com sucesso!',
                            timer: 3000
                        });
                        window.location.href = '/system/admin/assistance/list/solved';
                    }
                    else if (res == 'sem-advogado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Não foi atribuído nenhum advogado!',
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
});
