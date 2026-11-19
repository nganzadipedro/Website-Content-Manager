
let registo_id = $('#registoentrada_id_p').val();
let tipo_situacao_assistencia = $('#tipo_situacao_assistencia_p').val();
let tipo_indicacao = $('#tipo_indicacao_p').val();
$('#insitituicao_copia_field').hide();

if (tipo_situacao_assistencia == 'Solicitação de Instituição') {
    $('#insitituicao_copia_field').show();
}


$(document).on('change', '#tipo_situacao_assistencia', function () {

    // Pega o data-id do <a> clicado
    var tipo_situacao = $(this).val();

    if (tipo_situacao == 'Solicitação de Instituição') {
        $('#insitituicao_copia_field').show();
    }
    else {
        $('#insitituicao_copia_field').hide();
    }

});

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const tipo_indicacao_p = document.getElementById('tipo_indicacao_p').value;
    const tipo_situacao_assistencia_p = document.getElementById('tipo_situacao_assistencia_p').value;

    var tipo_indicacao;
    var tipo_situacao_assistencia;
    var insitituicao_copia;
    var requerente;

    if (tipo_indicacao_p == null || tipo_indicacao_p == '') {
        tipo_indicacao = document.getElementById('tipo_indicacao').value;
    }

    if (tipo_situacao_assistencia_p == null || tipo_situacao_assistencia_p == '') {
        tipo_situacao_assistencia = document.getElementById('tipo_situacao_assistencia').value;
    }


    if (tipo_indicacao_p == null || tipo_indicacao_p == '') {
        if (tipo_indicacao == null || tipo_indicacao == '') {
            msgErro = "Informe o tipo de indicação";
            tem = false;
        }
    }

    if (tem == true && tipo_indicacao_p == null || tipo_indicacao_p == '') {
        if (tipo_indicacao == 'Auto-Indicação') {
            requerente = document.getElementById('requerente').value;
            if (requerente == '' || requerente == null) {
                msgErro = "Informe o nome do requerente";
                tem = false;
            }
        }
    }

    if (tem == true && (tipo_situacao_assistencia_p == null || tipo_situacao_assistencia_p == '')) {

        if (tipo_situacao_assistencia == null || tipo_situacao_assistencia == '') {
            msgErro = "Informe o tipo de situação";
            tem = false;
        }
    }

    if (tem == true && (tipo_indicacao_p == null || tipo_indicacao_p == '')) {
        if (tipo_indicacao == 'Auto-Indicação' && tipo_situacao_assistencia != 'Advogado Solicita Permissão de Intervenção') {
            msgErro = "O tipo de indicação e o tipo de situação não são compatíveis";
            tem = false;
        }
    }

    if (tem == true && (tipo_situacao_assistencia_p == '' || tipo_situacao_assistencia_p == null)) {
        if (tipo_situacao_assistencia == 'Solicitação de Instituição') {
            insitituicao_copia = document.getElementById('insitituicao_copia').value;
            if (insitituicao_copia == '' || insitituicao_copia == null) {
                msgErro = "Digite a Instituição que estará em cópia";
                tem = false;
            }
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

    if (valida_formulario() == true) {

        const formData = new FormData();

        registo_id = $('#registoentrada_id_p').val();
        registo_hash = $('#registoentrada_hash_p').val();
        var tipo_situacao;
        var tipo_indicacao;
        var insitituicao_copia;
        var requerente;
        const tipo_indicacao_p = document.getElementById('tipo_indicacao_p').value;
        const tipo_situacao_assistencia_p = document.getElementById('tipo_situacao_assistencia_p').value;

        if (tipo_indicacao_p == null || tipo_indicacao_p == '') {
            tipo_indicacao = document.getElementById('tipo_indicacao').value;
        }

        if (tipo_situacao_assistencia_p == null || tipo_situacao_assistencia_p == '') {
            tipo_situacao = document.getElementById('tipo_situacao_assistencia').value;
            if (tipo_situacao == 'Solicitação de Instituição') {
                insitituicao_copia = document.getElementById('insitituicao_copia').value;
            }
        }

        if (tipo_situacao_assistencia_p != null && tipo_situacao_assistencia_p != '') {
            if (tipo_situacao_assistencia_p == 'Solicitação de Instituição') {
                insitituicao_copia = document.getElementById('insitituicao_copia').value;
            }
        }

        if (tipo_indicacao_p != null && tipo_indicacao_p != '') {
            if (tipo_indicacao_p == 'Auto-Indicação') {
                requerente = document.getElementById('requerente').value;
            }
        }

        requerente = document.getElementById('requerente').value;

        formData.append('registo_id', registo_id);
        formData.append('tipo_situacao', tipo_situacao);
        formData.append('tipo_indicacao', tipo_indicacao);
        formData.append('insitituicao_copia', insitituicao_copia);
        formData.append('requerente', requerente);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja emitir o documento de assistência?Se confirmar, terá que aguardar a apresentação do documento no ecrã.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Confirmar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/emitir-documento/post",
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

                            window.location.href = "/system/secretaria/assistance/list/documents";

                            // const form = document.createElement("form");
                            // form.method = "POST";
                            // form.action = "/system/secretaria/imprimirpdf-assistencia";
                            // // form.target = "_blank";

                            // // CSRF
                            // const csrf = document.createElement("input");
                            // csrf.type = "hidden";
                            // csrf.name = "_token";
                            // csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                            // form.appendChild(csrf);

                            // // Dados que quer enviar
                            // const dados = document.createElement("input");
                            // dados.type = "hidden";
                            // dados.name = "hash_registo";
                            // dados.value = registo_hash;
                            // form.appendChild(dados);

                            // document.body.appendChild(form);
                            // form.submit();
                            // document.body.removeChild(form);
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
