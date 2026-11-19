document.addEventListener("DOMContentLoaded", () => {

    $(document).on('click', '#btn-registar-informacoes', function () {

        const pedido_id = document.getElementById('pedido_id').value;
        const localizacao = document.getElementById('localizacao').value;
        const sexo = document.getElementById('sexo').value;
        const natureza = document.getElementById('natureza').value;
        const observacao = document.getElementById('observacao2').value;
        const registo_id = document.getElementById('registo_id').value;


        if (sexo == '' || sexo == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe o género/sexo",
                timer: 4000
            });
        }
        else if ((natureza == '' || natureza == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a natureza do processo",
                timer: 4000
            });
        }
        else if (localizacao == '' || localizacao == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a localização do processo",
                timer: 4000
            });
        }
        else {

            const formData = new FormData();
            formData.append('localizacao', localizacao);
            formData.append('sexo', sexo);
            formData.append('natureza', natureza);
            formData.append('observacao', observacao);
            formData.append('registo_id', registo_id);
            formData.append('pedido_id', pedido_id);

            Swal.fire({
                title: "Confirmação",
                text: "Tem certeza que deseja registar esta informação?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Salvar!",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return $.ajax({
                        url: "/system/editar-pedido/post",
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

                                window.location.href = "/system/areatecnica/list/assistance/archived";

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

});