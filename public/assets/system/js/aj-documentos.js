
$(document).on('click', '.btn-preview', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "/system/imprimirpdf-assistencia";
    form.target = "_blank";

    // CSRF
    const csrf = document.createElement("input");
    csrf.type = "hidden";
    csrf.name = "_token";
    csrf.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrf);

    // Dados que quer enviar
    const dados = document.createElement("input");
    dados.type = "hidden";
    dados.name = "hash_registo";
    dados.value = id;
    form.appendChild(dados);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);

});

$(document).on('click', '.btn-delete', function () {

    const hash_id = $(this).data("id");
    const formData = new FormData();
    formData.append('hash_id', hash_id);
    csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja excluir este registo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/delete-assistencia/post",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
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





    }

});
