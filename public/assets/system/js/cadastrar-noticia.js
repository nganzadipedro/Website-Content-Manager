document.getElementById('imagem').addEventListener('change', function (event) {
    const arquivo = event.target.files[0];
    const preview = document.getElementById('imagemExibida');

    if (arquivo) {
        const leitor = new FileReader();

        leitor.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // mostra a imagem
        };

        leitor.readAsDataURL(arquivo); // lê o arquivo como base64
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
});

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const titulo = document.getElementById('titulo').value;
    const texto_resumo = document.getElementById('texto_resumo').value;
    const texto_completo = document.getElementById('texto_completo').value;
    const imagem = document.getElementById('imagem').files[0];
    const tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

    if (titulo == '' || titulo == null) {
        msgErro = "Digite o título da Notícia";
        tem = false;
    }
    else if (texto_resumo == '' || texto_resumo == null) {
        msgErro = "Digite o resumo da Notícia";
        tem = false;
    }
    else if (texto_completo == '' || texto_completo == null) {
        msgErro = "Digite o conteúdo da Notícia";
        tem = false;
    }
    else if (!imagem) {
        msgErro = 'Por favor, selecione uma imagem para a notícia.';
        tem = false;
    }
    else if (!tiposPermitidos.includes(imagem.type)) {
        msgErro = 'Formato de imagem inválido. Use JPG, PNG ou GIF.';
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

        const titulo = document.getElementById('titulo').value;
        const texto_resumo = document.getElementById('texto_resumo').value;
        const texto_completo = document.getElementById('texto_completo').value;
        const imagem = document.getElementById('imagem').files[0];
        const e_destaque = document.getElementById('e_destaque').value;

        formData.append('titulo', titulo);
        formData.append('texto_resumo', texto_resumo);
        formData.append('texto_completo', texto_completo);
        formData.append('e_destaque', e_destaque);
        formData.append('imagem', imagem);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja cadastrar esta notícia? Em caso afirmativo, clique em Submeter e aguarde a conclusão do processo de cadastro",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/admin/newslater/post",
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
                            const preview = document.getElementById('imagemExibida');
                            preview.src = '/assets/template/img/logo_horizontal.png';
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'A notícia foi cadastrada com sucesso',
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
