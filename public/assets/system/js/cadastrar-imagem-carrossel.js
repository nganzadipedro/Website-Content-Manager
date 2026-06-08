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
    const imagem = document.getElementById('imagem').files[0];
    const tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

    if (!imagem) {
        msgErro = 'Por favor, selecione uma imagem para o carrossel.';
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
        const imagem = document.getElementById('imagem').files[0];

        formData.append('titulo', titulo);
        formData.append('imagem', imagem);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja adicionar esta imagem ao carrossel? Em caso afirmativo, clique em Submeter e aguarde a conclusão do processo de cadastro",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/carrossel/post",
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
                            preview.src = 'https://placehold.net/default.png';
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'A imagem foi adicionada ao carrossel com sucesso',
                                timer: 6000
                            });

                            window.location.href = '/carrossel/list';

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
