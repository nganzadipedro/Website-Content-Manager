
$(document).on('click', '.delete-news', function (e) {

    e.preventDefault(); // se for link, evita redirecionamento
    const id = $(this).data('id'); // forma jQuery de pegar data-id

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este relatório? Em caso afirmativo, clique em Eliminar e aguarde a conclusão do processo de exclusão",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/financial-report/delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    'id_financial_report': id
                },
                success: function (res) {

                    if (res == 'sucesso') {
                        sweetAlert({
                            type: "success",
                            title: "Sucesso",
                            text: 'O relatório foi eliminado com sucesso',
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
