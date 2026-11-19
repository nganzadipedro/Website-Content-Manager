
// $("#btn-registar-inscricao").hide();
$("#valerr").hide();
$("#vals").hide();

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const sexo = document.getElementById('sexo').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const num_bilhete = document.getElementById('num_bilhete').value;
    const codigo_validacao = document.getElementById('codigo_validacao').value;
    const email = document.getElementById('email').value;
    const observacao2 = document.getElementById('observacao2').value;
    const tipo_processo_id = document.getElementById('tipo_processo_id').value;

    if (sexo == '' || sexo == null) {
        msgErro = "Escolha o sexo";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    // else if (codigo_validacao == '' || codigo_validacao == null) {
    //     msgErro = "Digite o código de validação";
    //     tem = false;
    // }
    else if (num_bilhete == '' || num_bilhete == null) {
        msgErro = "Digite o número do bilhete";
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

        const sexo = document.getElementById('sexo').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const num_bilhete = document.getElementById('num_bilhete').value;
        const email = document.getElementById('email').value;
        const observacao2 = document.getElementById('observacao2').value;
        const tipo_processo_id = document.getElementById('tipo_processo_id').value;
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const codigo_validacao = document.getElementById('codigo_validacao').value;

        formData.append('sexo', sexo);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('num_bilhete', num_bilhete);
        formData.append('email', email);
        formData.append('observacao2', observacao2);
        formData.append('tipo_processo_id', tipo_processo_id);
        formData.append('registo_entrada_id', registo_entrada_id);
        formData.append('codigo_validacao', codigo_validacao);

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

                            window.location.href = "/system/areatecnica/list/subscription";

                        }
                        else {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso!",
                                text: res,
                                timer: 5000
                            });

                            $("#valerr").show();
                            $("#valerr").text(res);
                            $("#vals").hide();
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

document.getElementById('btn-validar-declaracao').addEventListener('click', function () {

    if (valida_formulario() === true) {

        const formData = new FormData();

        const num_bilhete = document.getElementById('num_bilhete').value;
        const codigo_validacao = document.getElementById('codigo_validacao').value;
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;

        formData.append('num_bilhete', num_bilhete);
        formData.append('codigo_validacao', codigo_validacao);
        formData.append('registo_entrada_id', registo_entrada_id);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja validar estes dados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Confirmar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/validar-declaracao/post",
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
                        if (res.status == 'repetido') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso!",
                                text: res.msg,
                                timer: 5000
                            });

                            $("#btn-registar-inscricao").hide();
                            $("#valerr").show();
                            $("#valerr").text(res.msg);
                            $("#vals").hide();
                        }
                        else if (res.status == 'success') {
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'Declaração validada com sucesso!',
                                timer: 3000
                            });

                            $("#btn-registar-inscricao").show();
                            $("#vals").show();
                            $("#vals").text(res.msg);
                            $("#valerr").hide();

                        }
                        else if (res.status == 'error') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso!",
                                text: res.msg,
                                timer: 5000
                            });

                            $("#btn-registar-inscricao").hide();
                            $("#valerr").show();
                            $("#valerr").text(res.msg);
                            $("#vals").hide();

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