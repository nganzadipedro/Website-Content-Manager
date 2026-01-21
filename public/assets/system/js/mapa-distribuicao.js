$(document).on('click', '.btn-distribuir', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let requerente = $(this).data('requerente');
    let data_entrada = $(this).data('entrada');
    console.log('ID selecionado:', id);
    $('#inscricao_id').val(id);
    $('#requerente').val(requerente);
    $('#data_entrada').val(data_entrada);

    // rotina para carregar os dados do registo, se necessário
    buscarItem(id);

});

function selecionarCategoria(id) {
    $('#conselheiro_id').val(id).trigger('change');
}

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const data_levantamento_distribuicao = document.getElementById('data_levantamento_distribuicao').value;
    const conselheiro_id = document.getElementById('conselheiro_id').value;
    const data_entrega_distribuicao = document.getElementById('data_entrega_distribuicao').value;
    const observacao_distribuicao = document.getElementById('observacao_distribuicao').value;

    if (data_levantamento_distribuicao == '' || data_levantamento_distribuicao == null) {
        msgErro = "Digite a data de levantamento";
        tem = false;
    }
    else if (conselheiro_id == '' || conselheiro_id == null) {
        msgErro = "Escolha o conselheiro";
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

document.getElementById('btn-registar-distribuicao').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const data_levantamento_distribuicao = document.getElementById('data_levantamento_distribuicao').value;
        const conselheiro_id = document.getElementById('conselheiro_id').value;
        const data_entrega_distribuicao = document.getElementById('data_entrega_distribuicao').value;
        const observacao_distribuicao = document.getElementById('observacao_distribuicao').value;
        const inscricao_id = document.getElementById('inscricao_id').value;

        formData.append('data_levantamento_distribuicao', data_levantamento_distribuicao);
        formData.append('conselheiro_id', conselheiro_id);
        formData.append('data_entrega_distribuicao', data_entrega_distribuicao);
        formData.append('observacao_distribuicao', observacao_distribuicao);
        formData.append('inscricao_id', inscricao_id);

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
                    url: "/system/distribuicao/post",
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

    fetch(`/system/getDataInscricaoAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $('#data_levantamento_distribuicao').val(data.data_levantamento_distribuicao);
            $('#data_entrega_distribuicao').val(data.data_entrega_distribuicao);
            $('#observacao_distribuicao').val(data.observacao_distribuicao);
            selecionarCategoria(data.conselheiro_id);

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}
