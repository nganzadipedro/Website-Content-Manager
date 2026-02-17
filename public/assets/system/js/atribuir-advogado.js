$(document).on('click', '.btn-adicionar', function () {

    // Pega o data-id do <a> clicado
    let advogado_id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('advogado_id', advogado_id);
    formData.append('registo_id', registo_id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja atribuir este advogado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Adicionar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/atribuir-advogado/post",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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
                            text: 'Advogado adicionado com sucesso!',
                            timer: 3000
                        });

                        window.location.reload();
                    }
                    else if (res == 'duplicado') {
                        sweetAlert({
                            type: "warning",
                            title: "Aviso",
                            text: 'Este advogado já foi atribuido neste processo!',
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


});

$(document).on('click', '.btn-remover', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    let registo_id = $('#registo_id').val();

    const formData = new FormData();

    formData.append('id', id);
    formData.append('registo_id', registo_id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este advogado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/atribuir-advogado/delete",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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
                            text: 'Advogado eliminado com sucesso!',
                            timer: 3000
                        });

                        window.location.reload();
                    }
                },
                error: function (error) {

                    sweetAlert({
                        type: "warning",
                        title: "Erro " + error.status,
                        text: 'Erro: ' + error.responseJSON.message,
                        timer: 6000
                    });
                    console.log("Error: " + error.responseJSON.message);
                }
            });
        }
    });


});
