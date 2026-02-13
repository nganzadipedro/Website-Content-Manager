$(document).on('click', '.btn-adicionar', function () {

    $('#dados-patrono').hide();

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    let cedula = $(this).data('cedula');
    let categoria = $(this).data('categoria');
    let email = $(this).data('email');
    let tel1 = $(this).data('tel1');
    let tel2 = $(this).data('tel2');
    let municipio_id = $(this).data('municipio_id');
    console.log('ID selecionado:', id);
    $('#advogado_id').val(id);
    $('#nome_advogado').val(nome);
    $('#num_cedula').val(cedula);
    $('#email').val(email);
    $('#telefone1').val(tel1);
    $('#telefone2').val(tel2);
    selecionarCategoria(categoria, municipio_id);

    if (categoria == 'Estagiario') {
        $('#dados-patrono').show();
    }

    // rotina para carregar os dados do registo, se necessário
    buscarItem(id);

});

$(document).on('change', '#new_categoria', function () {

    const categoria = $(this).val();
    $('#dados-patrono-new').hide();
    if (categoria == 'Estagiario') {
        $('#dados-patrono-new').show();
    }

});

function selecionarCategoria(categoria, municipio) {
    $('#categoria').val(categoria).trigger('change');
}

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const num_cedula = document.getElementById('num_cedula').value;
    const categoria = document.getElementById('categoria').value;
    const endereco_escritorio = document.getElementById('endereco_escritorio').value;
    const municipio_id = document.getElementById('municipio_id').value;
    const tipo_processo = document.getElementById('tipo_processo').value;

    if (num_cedula == '' || num_cedula == null) {
        msgErro = "Digite o número da cédula";
        tem = false;
    }
    else if (categoria == '' || categoria == null) {
        msgErro = "Especifique a categoria";
        tem = false;
    }
    else if (endereco_escritorio == '' || endereco_escritorio == null) {
        msgErro = "Digite o endereço do escritório/profissional";
        tem = false;
    }
    else if (municipio_id == '' || municipio_id == null) {
        msgErro = "Escolha o município onde está localizado";
        tem = false;
    }
    else if (tipo_processo == '' || tipo_processo == null) {
        msgErro = "Escolha o tipo de processo onde pretende intervir";
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

function valida_formulario_novo() {

    var msgErro = '';
    var tem = true;

    const new_nome_advogado = document.getElementById('new_nome_advogado').value;
    const new_num_cedula = document.getElementById('new_num_cedula').value;
    const new_categoria = document.getElementById('new_categoria').value;
    const new_email = document.getElementById('new_email').value;
    const new_telefone1 = document.getElementById('new_telefone1').value;
    const genero = document.getElementById('genero').value;
    const num_documento = document.getElementById('num_documento').value;
    const new_telefone2 = document.getElementById('new_telefone2').value;
    const new_nome_escritorio = document.getElementById('new_nome_escritorio').value;
    const new_endereco_escritorio = document.getElementById('new_endereco_escritorio').value;
    const new_municipio_id = document.getElementById('new_municipio_id').value;
    const new_tipo_processo = document.getElementById('new_tipo_processo').value;

    new_nome_patrono;
    new_telefone_patrono;
    new_email_patrono;

    if (new_categoria == 'Estagiario') {
        new_nome_patrono = document.getElementById('new_nome_patrono').value;
        new_telefone_patrono = document.getElementById('new_telefone_patrono').value;
        new_email_patrono = document.getElementById('new_email_patrono').value;
    }


    if (new_nome_advogado == '' || new_nome_advogado == null) {
        msgErro = "Digite o nome do advogado";
        tem = false;
    }
    else if (new_num_cedula == '' || new_num_cedula == null) {
        msgErro = "Digite o número da cédula";
        tem = false;
    }
    else if (new_categoria == '' || new_categoria == null) {
        msgErro = "DEspecifique a categoria";
        tem = false;
    }
    else if (new_email == '' || new_email == null) {
        msgErro = "Digite o email";
        tem = false;
    }
    else if (new_telefone1 == '' || new_telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (num_documento == '' || num_documento == null) {
        msgErro = "Digite o número do bilhete";
        tem = false;
    }
    else if (genero == '' || genero == null) {
        msgErro = "Especifique o género";
        tem = false;
    }
    else if (new_endereco_escritorio == '' || new_endereco_escritorio == null) {
        msgErro = "Digite o endereço do escritório/profissional";
        tem = false;
    }
    else if (new_municipio_id == '' || new_municipio_id == null) {
        msgErro = "Escolha o município onde está localizado";
        tem = false;
    }
    else if (new_tipo_processo == '' || new_tipo_processo == null) {
        msgErro = "Escolha o tipo de processo onde pretende intervir";
        tem = false;
    }
    else if (new_tipo_processo == '' || new_tipo_processo == null) {
        msgErro = "Escolha o tipo de processo onde pretende intervir";
        tem = false;
    }
    else if (new_categoria == 'Estagiario') {
        if (new_nome_patrono == '' || new_nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (new_telefone_patrono == '' || new_telefone_patrono == null) {
            msgErro = "Digite o telefone do patrono";
            tem = false;
        }
        else if (new_email_patrono == '' || new_email_patrono == null) {
            msgErro = "Digite o email do patrono";
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

document.getElementById('btn-registar-pedido').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const num_cedula = document.getElementById('num_cedula').value;
        const categoria = document.getElementById('categoria').value;
        const endereco_escritorio = document.getElementById('endereco_escritorio').value;
        const municipio_id = document.getElementById('municipio_id').value;
        const tipo_processo = document.getElementById('tipo_processo').value;
        const email = document.getElementById('email').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const nome_escritorio = document.getElementById('nome_escritorio').value;
        const nome_patrono = document.getElementById('nome_patrono').value;
        const telefone_patrono = document.getElementById('telefone_patrono').value;
        const email_patrono = document.getElementById('email_patrono').value;
        const advogado_id = document.getElementById('advogado_id').value;

        formData.append('num_cedula', num_cedula);
        formData.append('categoria', categoria);
        formData.append('endereco_escritorio', endereco_escritorio);
        formData.append('municipio_id', municipio_id);
        formData.append('tipo_processo', tipo_processo);
        formData.append('email', email);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('nome_patrono', nome_patrono);
        formData.append('telefone_patrono', telefone_patrono);
        formData.append('email_patrono', email_patrono);
        formData.append('advogado_id', advogado_id);

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
                    url: "/system/pedido-intervencao/post",
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
                                timer: 4000
                            });

                            window.location.reload();
                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Este advogado já está registado para intervir neste tipo de caso',
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

    }

});

document.getElementById('btn-registar-novo-advogado').addEventListener('click', function () {


    if (valida_formulario_novo() === true) {

        const formData = new FormData();

        const new_nome_advogado = document.getElementById('new_nome_advogado').value;
        const new_num_cedula = document.getElementById('new_num_cedula').value;
        const new_categoria = document.getElementById('new_categoria').value;
        const new_email = document.getElementById('new_email').value;
        const new_telefone1 = document.getElementById('new_telefone1').value;
        const new_telefone2 = document.getElementById('new_telefone2').value;
        const num_documento = document.getElementById('num_documento').value;
        const genero = document.getElementById('genero').value;
        const new_nome_escritorio = document.getElementById('new_nome_escritorio').value;
        const new_endereco_escritorio = document.getElementById('new_endereco_escritorio').value;
        const new_municipio_id = document.getElementById('new_municipio_id').value;
        const new_tipo_processo = document.getElementById('new_tipo_processo').value;

        new_nome_patrono = null;
        new_telefone_patrono = null;
        new_email_patrono = null;

        if (new_categoria == 'Estagiario') {
            new_nome_patrono = document.getElementById('new_nome_patrono').value;
            new_telefone_patrono = document.getElementById('new_telefone_patrono').value;
            new_email_patrono = document.getElementById('new_email_patrono').value;
        }

        formData.append('nome_advogado', new_nome_advogado);
        formData.append('num_cedula', new_num_cedula);
        formData.append('categoria', new_categoria);
        formData.append('email', new_email);
        formData.append('telefone1', new_telefone1);
        formData.append('telefone2', new_telefone1);
        formData.append('telefone2', new_telefone2);
        formData.append('num_documento', num_documento);
        formData.append('genero', genero);
        formData.append('nome_escritorio', new_nome_escritorio);
        formData.append('endereco_escritorio', new_endereco_escritorio);
        formData.append('municipio_id', new_municipio_id);
        formData.append('tipo_processo', new_tipo_processo);
        formData.append('nome_patrono', new_nome_patrono);
        formData.append('telefone_patrono', new_telefone_patrono);
        formData.append('email_patrono', new_email_patrono);

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
                    url: "/system/pedido-intervencao-novo/post",
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
                                timer: 4000
                            });

                            window.location.reload();
                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Este número de cédula já existe na base de dados!',
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

    }

});

function buscarItem(id) {

    fetch(`/system/getAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $('#municipio_id').val(data.municipio_id).trigger('change');
            $('#nome_patrono').val(data.nome_patrono);
            $('#email_patrono').val(data.email_patrono);
            $('#telefone_patrono').val(data.telefone_patrono);
            $('#nome_escritorio').val(data.nome_escritorio);
            $('#endereco_escritorio').val(data.endereco_escritorio);

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}
