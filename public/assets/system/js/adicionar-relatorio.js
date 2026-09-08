
function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const descricao = document.getElementById('descricao').value;
    const ano = document.getElementById('ano').value;
    const trimestre = document.getElementById('trimestre').value;
    const categoria = document.getElementById('categoria').value;
    const documento_anexo = document.getElementById('documento_anexo').files[0];
    const tiposPermitidos = ['application/pdf'];

    if (descricao == '' || descricao == null) {
        msgErro = "Digite a descrição do Relatório";
        tem = false;
    }
    else if (ano == '' || ano == null) {
        msgErro = "Digite o ano do Relatório";
        tem = false;
    }
    else if (trimestre == '' || trimestre == null) {
        msgErro = "Digite o trimestre do Relatório";
        tem = false;
    }
    else if (categoria == '' || categoria == null) {
        msgErro = "Selecione a categoria do Relatório";
        tem = false;
    }
    else if (!documento_anexo) {
        msgErro = 'Por favor, selecione um documento PDF para o relatório.';
        tem = false;
    }
    else if (!tiposPermitidos.includes(documento_anexo.type)) {
        msgErro = 'Formato de documento inválido. Use apenas arquivos PDF.';
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

document.getElementById('btn-salvar').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const descricao = document.getElementById('descricao').value;
        const ano = document.getElementById('ano').value;
          const trimestre = document.getElementById('trimestre').value;
        const categoria = document.getElementById('categoria').value;
        const documento_anexo = document.getElementById('documento_anexo').files[0];

        formData.append('descricao', descricao);
        formData.append('ano', ano);
        formData.append('trimestre', trimestre);
        formData.append('categoria', categoria);
        formData.append('documento_anexo', documento_anexo);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja cadastrar este relatório? Em caso afirmativo, clique em Submeter e aguarde a conclusão do processo de cadastro",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/financial-report/post",
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
                                text: 'O relatório foi cadastrado com sucesso',
                                timer: 6000
                            });

                            window.location.href = '/financial-report/list';

                        }
                        else if (res == 'documento') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso!",
                                text: 'O número de identificação já foi utilizado.',
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
