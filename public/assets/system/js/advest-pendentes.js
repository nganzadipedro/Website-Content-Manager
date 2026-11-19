
$(document).on('click', '#btn-excluir-processos', function () {

    const selecionados = [];
    const user_id = $('#user_id').val();

    document.querySelectorAll(".checkItem:checked").forEach(item => {
        selecionados.push(item.value);
    });

    if (user_id != 1 && user_id != 4054) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Não tem permissão para excluir registos",
            timer: 4000
        });
    }
    else if (selecionados.length === 0) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Não foi selecionado nenhum processo na tabela de dados",
            timer: 4000
        });
    }
    else {

        const formData = new FormData();

        Array.from(selecionados).forEach(id => {
            formData.append('selecionados[]', id);
        });
        csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja excluir os processos selecionados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/registo-delete-grupo/post",
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
                                text: 'Dados excluídos com sucesso!',
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
                            timer: 9000
                        });
                        console.log("Error: " + error.responseJSON.message);
                    }
                });
            }
        });

    }

});