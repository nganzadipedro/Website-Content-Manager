$(document).on('click', '.btn-remover', function () {

    // Pega o data-id do <a> clicado
    let pedido_id = $(this).data('id');

    const formData = new FormData();

    formData.append('pedido_id', pedido_id);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este registo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/pedido-intervencao/delete",
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
                            text: 'Dados eliminados com sucesso!',
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


});
