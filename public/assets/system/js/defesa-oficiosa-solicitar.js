
$('#campos-finais').hide();
$('#dados-patrono').hide();
$('#pg-sucesso').hide();
$('#pg-aviso').hide();

$(document).on('click', '#btn-verificar', function () {

    $('#campos-finais').hide();
    $('#dados-patrono').hide();
    $('#pg-sucesso').hide();
    $('#pg-aviso').hide();

    let tipo_pesquisa = $('#tipo_pesquisa').val();
    let num_verificar = $('#num_verificar').val();
    let categoria = $('#categoria_verificar').val();

    let apenasNumeros = /^[0-9]+$/;

    if ((num_verificar == '' || num_verificar == null) && tipo_pesquisa == 'bilhete') {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite o número do bilhete",
            timer: 3000
        });
    }
    if ((num_verificar == '' || num_verificar == null) && tipo_pesquisa == 'cedula') {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite o número da cédula",
            timer: 3000
        });
    }
    else if (categoria == '' || categoria == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Selecione a categoria",
            timer: 3000
        });
    }
    else if (apenasNumeros.test(num_verificar) == false && tipo_pesquisa == 'cedula') {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Informe um número de cédula válido",
            timer: 3000
        });
    }
    else {

        // rotina para pesquisar o advogado
        buscarDados(tipo_pesquisa, num_verificar, categoria);

    }

});

function buscarDados(tipo, numero, categoria) {

    fetch(`/system/getAdvogadoByData/${tipo}/${numero}/${categoria}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            if (Object.keys(data).length === 0) {
                console.log("Objeto vazio ❌");

                limpaCampos();
                $('#pg-aviso').show();

                if (categoria == 'Estagiario') {
                    $('#dados-patrono').show();
                }

                $('#categoria').val(categoria);
                $("#categoria").prop("disabled", true);


            } else {

                $('#pg-sucesso').show();
                $('#campos-finais').show();
                console.log("Tem dados ✅", data);

                $('#advogado_id').val(data.id);
                $('#nome_completo').val(data.getpessoa.nome);
                $('#categoria').val(data.categoria);
                $('#num_bilhete').val(data.getpessoa.num_documento);
                $('#num_cedula').val(data.categoria == 'Advogado' ? data.num_associado : data.num_estagiario);
                $('#email').val(data.getpessoa.email);
                $('#telefone1').val(data.getpessoa.telefone1);
                $('#telefone2').val(data.getpessoa.telefone2);
                $('#nome_escritorio').val(data.nome_escritorio);
                $('#endereco_escritorio').val(data.endereco_escritorio);
                $('#genero').val(data.getpessoa.genero);
                $('#municipio_id').val(data.municipio_id).trigger('change');

                selecionarCategoria(data.getpessoa.genero);

                $("#nome_completo").prop("disabled", true);
                $("#num_bilhete").prop("disabled", true);
                $("#num_cedula").prop("disabled", true);
                $("#categoria").prop("disabled", true);

                if (data.categoria == 'Estagiario') {
                    $('#dados-patrono').show();
                }

            }

        })
        .catch(error => {
            console.log('Erro:', error);
        });
}

$(document).on('change', '#tipo_pesquisa', function () {

    const tipo_pesquisa = $(this).val();
    if (tipo_pesquisa == 'bilhete') {
        $('#lbl_num_verificar').text("Nº Bilhete");
        $('#num_verificar').attr("placeholder", "Digite o nº do bilhete");
    }
    else {
        $('#lbl_num_verificar').text("Nº Cédula");
        $("#num_verificar").attr("placeholder", "Digite o nº da cédula");
    }

    $('#campos-finais').hide();
    $('#dados-patrono').hide();
    $('#pg-sucesso').hide();
    $('#pg-aviso').hide();

    limpaCampos();

});

$(document).on('change', '#categoria_verificar', function () {

    const categoria = $(this).val();
    if (categoria == 'Estagiario') {
        $('#dados-patrono').show();
    }

    $('#campos-finais').hide();
    $('#dados-patrono').hide();
    $('#pg-sucesso').hide();
    $('#pg-aviso').hide();

    limpaCampos();

});

$(document).on('click', '#preencher-formulario', function () {

    $('#campos-finais').show();
    $('#pg-aviso').hide();

});

function limpaCampos() {

    $('#advogado_id').val("");
    $('#categoria').val("");
    $('#num_bilhete').val("");
    $('#num_cedula').val("");
    $('#nome_completo').val("");
    $('#email').val("");
    $('#telefone1').val("");
    $('#telefone2').val("");
    $('#nome_escritorio').val("");
    $('#endereco_escritorio').val("");
    $('#municipio_id').val("").trigger('change');

    $("#nome_completo").prop("disabled", false);
    $("#num_bilhete").prop("disabled", false);
    $("#num_cedula").prop("disabled", false);
    $("#categoria").prop("disabled", false);

}


function selecionarCategoria(genero) {
    $('#genero').val(genero).trigger('change');
}

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    let tiposPermitidos = ["application/pdf"];

    const nome_completo = document.getElementById('nome_completo').value;
    const num_bilhete = document.getElementById('num_bilhete').value;
    const num_cedula = document.getElementById('num_cedula').value;
    const categoria = document.getElementById('categoria').value;
    const email = document.getElementById('email').value;
    const telefone1 = document.getElementById('telefone1').value;
    const genero = document.getElementById('genero').value;
    const telefone2 = document.getElementById('telefone2').value;
    const nome_escritorio = document.getElementById('nome_escritorio').value;
    const endereco_escritorio = document.getElementById('endereco_escritorio').value;
    const municipio_id = document.getElementById('municipio_id').value;
    const tipo_processo = document.getElementById('tipo_processo').value;
    const documento = document.getElementById('documento').files[0];

    nome_patrono;
    cedula_patrono;
    telefone_patrono;
    email_patrono;

    if (categoria == 'Estagiario') {
        nome_patrono = document.getElementById('nome_patrono').value;
        cedula_patrono = document.getElementById('cedula_patrono').value;
        telefone_patrono = document.getElementById('telefone_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
    }


    if (nome_completo == '' || nome_completo == null) {
        msgErro = "Digite o nome completo";
        tem = false;
    }
    else if (num_bilhete == '' || num_bilhete == null) {
        msgErro = "Digite o número do bilhete";
        tem = false;
    }
    else if (num_cedula == '' || num_cedula == null) {
        msgErro = "Digite o número da cédula";
        tem = false;
    }
    else if (email == '' || email == null) {
        msgErro = "Digite o email";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (genero == '' || genero == null) {
        msgErro = "Especifique o género";
        tem = false;
    }
    else if (endereco_escritorio == '' || endereco_escritorio == null) {
        msgErro = "Informe o endereço do escritório/endereço profissional";
        tem = false;
    }
    else if (municipio_id == '' || municipio_id == null) {
        msgErro = "Informe o município referente ao escritório/endereço profissional";
        tem = false;
    }
    else if (tipo_processo == '' || tipo_processo == null) {
        msgErro = "Informe os tipos de processo onde pretende intervir";
        tem = false;
    }
    else if (categoria == 'Estagiario') {
        if (nome_escritorio == '' || nome_escritorio == null) {
            msgErro = "Digite o nome do escritório";
            tem = false;
        }
        else if (nome_patrono == '' || nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (cedula_patrono == '' || cedula_patrono == null) {
            msgErro = "Digite a cédula do patrono";
            tem = false;
        }
        else if (telefone_patrono == '' || telefone_patrono == null) {
            msgErro = "Digite a cédula do patrono";
            tem = false;
        }
        else if (email_patrono == '' || email_patrono == null) {
            msgErro = "Digite o email do patrono";
            tem = false;
        }
    }
    else if (!documento) {
        msgErro = "Carregue o documento da solicitação da defesa oficiosa";
        tem = false;
    }
    else if (!tiposPermitidos.includes(documento.type)) {
        msgErro = "Apenas documentos em pfd são permitidos";
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

document.getElementById('btn-submeter').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const advogado_id = document.getElementById('advogado_id').value;
        const nome_completo = document.getElementById('nome_completo').value;
        const num_bilhete = document.getElementById('num_bilhete').value;
        const num_cedula = document.getElementById('num_cedula').value;
        const categoria = document.getElementById('categoria').value;
        const email = document.getElementById('email').value;
        const telefone1 = document.getElementById('telefone1').value;
        const genero = document.getElementById('genero').value;
        const telefone2 = document.getElementById('telefone2').value;
        const nome_escritorio = document.getElementById('nome_escritorio').value;
        const endereco_escritorio = document.getElementById('endereco_escritorio').value;
        const municipio_id = document.getElementById('municipio_id').value;
        const tipo_processo = document.getElementById('tipo_processo').value;
        const documento = document.getElementById('documento').files[0];

        nome_patrono = null;
        cedula_patrono = null;
        telefone_patrono = null;
        email_patrono = null;

        if (categoria == 'Estagiario') {
            nome_patrono = document.getElementById('nome_patrono').value;
            cedula_patrono = document.getElementById('cedula_patrono').value;
            telefone_patrono = document.getElementById('telefone_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
        }

        formData.append('advogado_id', advogado_id);
        formData.append('nome_completo', nome_completo);
        formData.append('num_bilhete', num_bilhete);
        formData.append('num_cedula', num_cedula);
        formData.append('categoria', categoria);
        formData.append('email', email);
        formData.append('telefone1', telefone1);
        formData.append('genero', genero);
        formData.append('telefone2', telefone2);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('endereco_escritorio', endereco_escritorio);
        formData.append('municipio_id', municipio_id);
        formData.append('tipo_processo', tipo_processo);
        formData.append('documento', documento);
        formData.append('nome_patrono', nome_patrono);
        formData.append('cedula_patrono', cedula_patrono);
        formData.append('telefone_patrono', telefone_patrono);
        formData.append('email_patrono', email_patrono);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja submeter a sua solicitação? Em caso afirmativo, clique em Submeter e aguarde a conclusão da operação.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/defesa-oficiosa/post",
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
                                text: 'A sua solicitação de defesa oficiosa foi submetida com sucesso.',
                                timer: 4000
                            });

                            window.location.reload();

                        }
                        else if (res == 'duplicado') {

                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Já existe na nossa base de dados a sua solicitação de defesa oficiosa.',
                                timer: 6000
                            });

                            window.location.reload();
                        }
                        else if (res == 'cedula') {

                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número de cédula fornecido já existe na base de dados.',
                                timer: 5000
                            });

                        }
                        else if (res == 'bilhete') {

                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número do Bilhete fornecido já existe na base de dados.',
                                timer: 5000
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

