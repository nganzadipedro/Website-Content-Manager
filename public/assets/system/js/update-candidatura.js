
function inscricaoCandidato() {

    var nome = $("#nome_completo").val();
    var email = $("#email").val();
    var tel1 = $("#telefone1").val();
    var tel2 = $("#telefone2").val();
    var num_cedula = $("#num_cedula").val();
    var num_documento2 = $("#num_documento2").val();
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

    var cedula_advogado = $("#cedula_advogado")[0].files[0];
    var bilhete_identidade = $("#bilhete_identidade")[0].files[0];
    var id_pessoa = $("#pessoa_id").val();
    var id_candidatura = $("#candidatura_id").val();

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
    form.append('cedula_advogado', cedula_advogado);
    form.append('bilhete_identidade', bilhete_identidade);
    form.append('num_documento2', num_documento2);
    form.append('pessoa_id', id_pessoa);
    form.append('candidatura_id', id_candidatura);


    Swal.fire({
        title: "Tem certeza que pretende actualizar estas informações?",
        text: "",
        icon: "warning",
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Actualizar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $(".swal2-cancel").hide();
            return $.ajax({
                url: "/updateCandidatura",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (res) {

                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "",
                            text: 'Os dados foram actualizados com sucesso',
                            timer: 6000
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 6000);
                    }
                    else if (res == 'documento') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número do bilhete de identidade já foi utilizado',
                            timer: 4000
                        });
                    }
                    else if (res == 'email') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O email já foi utilizado',
                            timer: 4000
                        });
                    }
                    else if (res == 'telefone1') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número de telefone principal já foi utilizado',
                            timer: 4000
                        });
                    }
                    else if (res == 'telefone2') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso!",
                            text: 'O número de telefone alternativo já foi utilizado',
                            timer: 4000
                        });
                    }
                },
                error: function (error) {
                    sweetAlert({
                        type: "warning",
                        title: "Aviso!",
                        text: 'Verifique se os documentos anexados estão no formato .PDF',
                        timer: 6000
                    });
                    console.log("Error: " + error);

                }
            });
        }
    });


}


$("#btn-submeter").click(function () {

    // valida o formulário
    if (validaForm2() == true) {

        // faz a inscrição
        inscricaoCandidato();

    }

});

// validação de formulário

function validaForm2() {

    var nome = document.getElementById('nome_completo').value;
    var email = document.getElementById('email').value;
    var telefone1 = document.getElementById('telefone1').value;
    var telefone2 = document.getElementById('telefone2').value;

    var num_cedula = document.getElementById('num_cedula').value;
    var num_documento2 = document.getElementById('num_documento2').value;
    var masculino = document.getElementById('genero_m');
    var femenino = document.getElementById('genero_f');

    var nome_patrono = document.getElementById('nome_patrono').value;
    var email_patrono = document.getElementById('email_patrono').value;
    var telefone_patrono = document.getElementById('telefone_patrono').value;
    var nome_escritorio = document.getElementById('nome_escritorio').value;
    var endereco_escritorio = document.getElementById('endereco_escritorio').value;

    var cedula_advogado = document.getElementById('cedula_advogado').value;
    var bilhete_identidade = document.getElementById('bilhete_identidade').value;

    var msgErro = '';
    var tem = true;

    var re = /\S+@\S+\.\S+/;

    if (nome == '' || nome == null) {
        tem = false;
        msgErro = 'Informe o nome completo';
    }
    else if (email == '' || email == null) {
        tem = false;
        msgErro = 'Informe o email';
    }
    else if (re.test(email) == false) {
        tem = false;
        msgErro = 'Informe um email válido';
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
    else if(num_cedula == '' || num_cedula == null){
        tem = false;
        msgErro = 'Digite o número da cédula de advogado';
    }
    else if(num_documento2 == '' || num_documento2 == null){
        tem = false;
        msgErro = 'Digite o número do Bilhete de Identidade';
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
    else if (re.test(email_patrono) == false) {
        tem = false;
        msgErro = 'Informe um email do patrono válido';
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

    // else if (formacao_id == 0 || formacao_id == null) {
    //     tem = false;
    //     msgErro = 'Escolha a formação em que pretende inscrever-se';
    // }
    // else if (turma_id == 0 || turma_id == null) {
    //     tem = false;
    //     msgErro = 'Escolha a turma em que pretende inscrever-se';
    // }
    // else if (cedula_advogado == '' || cedula_advogado == null) {
    //     tem = false;
    //     msgErro = 'Carregue a sua cédula de advogado estagiário';
    // }
    // else if (bilhete_identidade == '' || bilhete_identidade == null) {
    //     tem = false;
    //     msgErro = 'Carregue a cópia do bilhete de identidade';
    // }
    // else if (!autorizacao.checked) {
    //     tem = false;
    //     msgErro = 'Não pode fazer a inscrição sem concordar com os termos de proteção de dados';
    // }


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


