

$("#div_msg").hide();
$("#dv-botao-submeter").hide();
$("#row-vagas").hide();
$("#div_form").show();


function sucesso() {
    $("#div_msg").show();
    $("#div_form").hide();
}

function inscricaoCandidato() {

    var nome = $("#nome_completo").val();
    var email = $("#email").val();
    var tel1 = $("#telefone1").val();
    var tel2 = $("#telefone2").val();
    var num_cedula = $("#num_cedula").val();
    var masculino = document.getElementById('genero_m');
    var genero = '';
    if (masculino.checked)
        genero = 'Masculino';
    else
        genero = 'Feminino';

    var nome_patrono = $("#nome_patrono").val();
    var email_patrono = $("#email_patrono").val();
    var telefone_patrono = $("#telefone_patrono").val();
    var nome_escritorio = $("#nome_escritorio").val();
    var endereco_escritorio = $("#endereco_escritorio").val();

    var formacao = $("#formacao_id").val();
    var turma = $("#turma_id").val();
    var cedula_advogado = $("#cedula_advogado")[0].files[0];
    var bilhete_identidade = $("#bilhete_identidade")[0].files[0];

    var form = new FormData();

    form.append('nome_completo', nome);
    form.append('email', email);
    form.append('tel1', tel1);
    form.append('tel2', tel2);
    form.append('num_cedula', num_cedula);
    form.append('genero', genero);
    form.append('nome_patrono', nome_patrono);
    form.append('email_patrono', email_patrono);
    form.append('telefone_patrono', telefone_patrono);
    form.append('nome_escritorio', nome_escritorio);
    form.append('endereco_escritorio', endereco_escritorio);
    form.append('formacao', formacao);
    form.append('turma', turma);
    form.append('cedula_advogado', cedula_advogado);
    form.append('bilhete_identidade', bilhete_identidade);

    Swal.fire({
        title: "Tem certeza que quer submeter a sua inscrição? Em caso afirmativo, clique em Submeter e aguarde a conclusão do processo de inscrição",
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
                url: "registerCandidato",
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
                            text: 'Parabéns! A sua inscrição foi submetida com sucesso.',
                            timer: 6000
                        });
                        sucesso();
                    }
                    else if (res == 'documento') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número de identificação já foi utilizado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'email') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'Este email já foi utilizado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'telefone1') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número de telefone principal já foi utilizado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'telefone2') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número de telefone alternativo já foi utilizado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'cedula') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número da cédula já foi utilizado.',
                            timer: 4000
                        });
                    }
                    else if (res == 'espaco') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'As vagas esgotaram, já não é possível submeter a inscrição.',
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

$("#formacao_id").change(function () {

    var formacao = $(this).val();
    if (formacao != 0) {
        getTurmasByFormacao(formacao)
            .then(function (turmas) {

                $("#turma_id").empty();
                $("#row-vagas").hide();
                $("#turma_id").append(
                    `<option value="0" selected>Selecione...</option>`
                );
                turmas.map(function (turma) {
                    $("#turma_id").append(
                        `<option value="` + turma.id + `">` + turma.descricao + `</option>`
                    );
                });
            })
    }
    else {

        $("#dv-botao-submeter").hide();
        $("#turma_id").empty();
        $("#row-vagas").hide();
        $("#turma_id").append(
            `<option value="0" selected>Selecione...</option>`
        );

    }

});

$("#turma_id").change(function () {

    var turma = $(this).val();
    if (turma != 0) {
        getVagasByTurma(turma)
            .then(function (resultado) {

                $("#row-vagas").show();
                $("#total_vagas").text(resultado);

                if (resultado > 0) {
                    $("#dv-botao-submeter").show();
                }
                else {
                    $("#dv-botao-submeter").hide();
                }

            })
    }
    else {
        $("#row-vagas").hide();
        $("#dv-botao-submeter").hide();
    }

});

function getVagasByTurma(id) {
    return new Promise(function (resolve, reject) {

        $.ajax({
            url: "/getVagasByTurma/" + id,
            method: "GET",
            success: function (result) {
                resolve(result);
            },
            error: function (error) {
                reject(error.message);
            }
        });
    });
}

function getTurmasByFormacao(id) {
    return new Promise(function (resolve, reject) {

        $.ajax({
            url: "/getTurmasByFormacao/" + id,
            method: "GET",
            success: function (result) {
                resolve(result);
            },
            error: function (error) {
                reject(error.message);
            }
        });
    });
}

$("#btn-submeter").click(function () {

    // valida o formulário
    if (validaForm1() == true) {
        inscricaoCandidato();
    }

});

// função para validar email
function validarEmail(email) {
    // Verifica se o email contém espaços
    if (email.includes(" ")) {
        return false; // Email inválido devido a espaços
    }

    // Expressão regular para verificar o formato do email
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    // Verifica se o email corresponde ao formato válido
    return regex.test(email);
}


// validação de formulário

function validaForm1() {

    var nome = document.getElementById('nome_completo').value;
    var email = document.getElementById('email').value;
    var telefone1 = document.getElementById('telefone1').value;
    var telefone2 = document.getElementById('telefone2').value;

    var num_cedula = document.getElementById('num_cedula').value;
    var masculino = document.getElementById('genero_m');
    var femenino = document.getElementById('genero_f');

    var nome_patrono = document.getElementById('nome_patrono').value;
    var email_patrono = document.getElementById('email_patrono').value;
    var telefone_patrono = document.getElementById('telefone_patrono').value;
    var nome_escritorio = document.getElementById('nome_escritorio').value;
    var endereco_escritorio = document.getElementById('endereco_escritorio').value;

    var formacao_id = document.getElementById('formacao_id').selectedIndex;
    var turma_id = document.getElementById('turma_id').selectedIndex;

    var cedula_advogado = document.getElementById('cedula_advogado').value;
    var bilhete_identidade = document.getElementById('bilhete_identidade').value;
    var autorizacao = document.getElementById('autorizacao');

    var msgErro = '';
    var tem = true;

    if (nome == '' || nome == null) {
        tem = false;
        msgErro = 'Informe o nome completo';
    }
    else if (email == '' || email == null) {
        tem = false;
        msgErro = 'Informe o email';
    }
    else if (validarEmail(email) == false) {
        tem = false;
        msgErro = 'Informe um email válido. Não pode ter espaços ou caracteres inválidos.';
    }
    else if (telefone1 == '' || telefone1 == null) {
        tem = false;
        msgErro = 'Informe o telefone principal';
    }
    else if (telefone1.length < 9 || telefone1.length > 9) {
        tem = false;
        msgErro = 'O número de telefone deve ter 9 dígitos';
    }
    else if (isNaN(telefone1) == true) {
        tem = false;
        msgErro = 'Informe um número de telefone válido';
    }
    else if (telefone2 == '' || telefone2 == null) {
        tem = false;
        msgErro = 'Informe o telefone alternativo';
    }
    else if (telefone2.length < 9 || telefone2.length > 9) {
        tem = false;
        msgErro = 'O número de telefone deve ter 9 dígitos';
    }
    else if (isNaN(telefone2) == true) {
        tem = false;
        msgErro = 'Informe um número de telefone válido';
    }
    else if (num_cedula == '' || num_cedula == null) {
        tem = false;
        msgErro = 'Digite o número da cédula de advogado';
    }
    else if (isNaN(num_cedula) == true) {
        tem = false;
        msgErro = 'O número da cédula deve ter apenas números';
    }
    else if (num_cedula.length > 6) {
        tem = false;
        msgErro = 'Informe um número de cédula válido';
    }
    else if (!masculino.checked && !femenino.checked) {
        tem = false;
        msgErro = 'Especifique o género';
    }

    else if (nome_patrono == '' || nome_patrono == null) {
        tem = false;
        msgErro = 'Informe o nome completo do Patrono';
    }
    else if (email_patrono == '' || email_patrono == null) {
        tem = false;
        msgErro = 'Informe o email do Patrono';
    }
    else if (validarEmail(email_patrono) == false) {
        tem = false;
        msgErro = 'Informe um email do patrono válido. Não pode ter espaços ou caracteres inválidos.';
    }
    else if (telefone_patrono == '' || telefone_patrono == null) {
        tem = false;
        msgErro = 'Informe o número de telefone do Patrono';
    }
    else if (telefone_patrono.length < 9 || telefone_patrono.length > 9) {
        tem = false;
        msgErro = 'O número de telefone do patrono deve ter 9 dígitos';
    }
    else if (isNaN(telefone_patrono) == true) {
        tem = false;
        msgErro = 'Informe um número de telefone do patrono válido';
    }
    else if (nome_escritorio == '' || nome_escritorio == null) {
        tem = false;
        msgErro = 'Digite o nome do escritório';
    }
    else if (endereco_escritorio == '' || endereco_escritorio == null) {
        tem = false;
        msgErro = 'Digite o endereço do escritório';
    }
    else if (formacao_id == 0 || formacao_id == null) {
        tem = false;
        msgErro = 'Escolha a formação em que pretende inscrever-se';
    }
    else if (turma_id == 0 || turma_id == null) {
        tem = false;
        msgErro = 'Escolha a turma em que pretende inscrever-se';
    }
    else if (cedula_advogado == '' || cedula_advogado == null) {
        tem = false;
        msgErro = 'Carregue a sua cédula de advogado estagiário';
    }
    else if (bilhete_identidade == '' || bilhete_identidade == null) {
        tem = false;
        msgErro = 'Carregue a cópia do bilhete de identidade';
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