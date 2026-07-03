

$(document).on('click', '#btn-verificar', function () {

    let patrono_eliminar = $('#patrono_eliminar').val();
    let patrono_ficar = $('#patrono_ficar').val();

    if ((patrono_eliminar == '' || patrono_eliminar == null)) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite os Ids dos patronos que serão eliminados",
            timer: 3000
        });
    }
    else if (patrono_ficar == '' || patrono_ficar == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite o Id do patrono que vai permanecer",
            timer: 3000
        });
    }
    else {

        const formData = new FormData();
        formData.append('patrono_eliminar', patrono_eliminar);
        formData.append('patrono_ficar', patrono_ficar);

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja submeter a sua solicitação? Em caso afirmativo, clique em Submeter e aguarde a conclusão da operação.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Submeter!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/corrigirpatrono/post",
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
                                text: 'Operação realizada com sucesso.',
                                timer: 4000
                            });

                            window.location.reload();

                        }
                        else{

                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: res,
                                timer: 5000
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