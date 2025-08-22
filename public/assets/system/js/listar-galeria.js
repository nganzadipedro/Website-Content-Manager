
$(document).on('click', '.delete-image', function (e) {

    e.preventDefault(); // se for link, evita redirecionamento
    const id = $(this).data('id'); // forma jQuery de pegar data-id
    console.log('ID para eliminar:', id);

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar esta imagem? Em caso afirmativo, clique em Eliminar e aguarde a conclusão da operação",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/admin/gallery/delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    'id_news': id
                },
                success: function (res) {

                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "Sucesso",
                            text: 'A imagem foi eliminada com sucesso',
                            timer: 6000
                        });
                        location.reload();
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
