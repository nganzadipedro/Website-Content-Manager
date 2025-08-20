$("#div_msg").hide();
$("#div_validacao").hide();
$("#div_form").show();


function sucesso() {
    $("#div_msg").hide();
    $("#div_validacao").show();
    $("#div_form").hide();
}

function sucesso2() {
    $("#div_msg").show();
    $("#div_validacao").hide();
    $("#div_form").hide();
}

function validacaoCandidato() {


    var codigo = $("#codigo_validacao").val();
    var form = new FormData();

    form.append('codigo_validacao', codigo);

    Swal.fire({
        title: "Tem certeza que pretende validar a sua inscrição?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Submeter!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/validacaoCandidatoEnoaa",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (res) {

                    console.log(res);
                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "Inscrição",
                            text: 'A sua inscrição foi validada com sucesso.',
                            timer: 4000
                        });
                        sucesso2();
                    }
                    else if (res == 'erro') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Código de validação incorrecto',
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

function inscricaoCandidato() {

  
    var num_documento = $("#num_documento").val();
    var codigo = $("#codigo-enoaa").val();
    var formacao = $("#formacao_id").val();
    var email = $("#email").val();
    var cedula_advogado = $("#cedula_advogado")[0].files[0];

    var form = new FormData();

    form.append('num_documento', num_documento);
    form.append('codigo', codigo);
    form.append('email', email);
    form.append('formacao', formacao);
    form.append('cedula_advogado', cedula_advogado);

    Swal.fire({
        title: "Tem certeza que quer submeter a sua inscrição?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Submeter!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/registerCandidatoEnoaa",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (res) {

                    console.log(res);
                    if (res == 'sucesso') {
                        // sweetAlert({
                        //     type: "success",
                        //     title: "Inscrição",
                        //     text: 'A sua inscrição foi submetida com sucesso. Enviamos-lhe um email com as suas credenciais de acesso',
                        //     timer: 4000
                        // });
                        sucesso();
                    }
                    else if (res == 'não existe') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Não econtramos os seus dados na base de dados.',
                            timer: 4000
                        });
                    }
                    else if (res == 'conta existe') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Já existe uma conta na plataforma das formações com estes dados.',
                            timer: 4000
                        });
                    }
                    else if (res == 'documento inválido') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número do documento de identificação não corresponde ao email informado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'não é candidato') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Verificamos que não fizeste nenhuma candidatura no ENOAA.',
                            timer: 4000
                        });
                    }
                    else if (res == 'código inválido') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O código do ENOAA que digitou não corresponde ao email e ao documento de identificação.',
                            timer: 4000
                        });
                    }
                    else if (res == 'reprovou') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Verificamos que não foi aprovado no ENOAA',
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


$("#btn-submeter").click(function () {

    // valida o formulário
    if (validaForm1() == true) {
        inscricaoCandidato();
    }

});

$("#btn-conf-codigo").click(function () {

    // valida o formulário
    if (validaForm2() == true) {
        validacaoCandidato();
    }

});




// validação de formulário



function validaForm1() {

    var num_bi = document.getElementById('num_documento').value;
    var codigo = document.getElementById('codigo-enoaa').value;
    var email = document.getElementById('email').value;
    var formacao_id = document.getElementById('formacao_id').selectedIndex;

    var cedula_advogado = document.getElementById('cedula_advogado').value;

    var msgErro = '';
    var tem = true;

    var re = /\S+@\S+\.\S+/;

    if (email == '' || email == null) {
        tem = false;
        msgErro = 'Informe o email';
    }
    else if (re.test(email) == false) {
        tem = false;
        msgErro = 'Informe um email válido';
    }
    else if (codigo == '' || codigo == null) {
        tem = false;
        msgErro = 'Informe o código do ENOAA';
    }
    else if (num_bi == '' || num_bi == null) {
        tem = false;
        msgErro = 'Informe o Nº do documento de identificação';
    }
    else if (formacao_id == 0 || formacao_id == null) {
        tem = false;
        msgErro = 'Escolha a formação em que pretende inscrever-se';
    }
    else if (cedula_advogado == '' || cedula_advogado == null) {
        tem = false;
        msgErro = 'Carregue a sua cédula de advogado estagiário';
    }
    else if (!autorizacao.checked) {
        tem = false;
        msgErro = 'Não pode fazer a inscrição sem concordar com os termos de proteção de dados';
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

function validaForm2() {

    var codigo = document.getElementById('codigo_validacao').value;

    var msgErro = '';
    var tem = true;

    var re = /\S+@\S+\.\S+/;

    if (codigo == '' || codigo == null) {
        tem = false;
        msgErro = 'Informe o código de validação';
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