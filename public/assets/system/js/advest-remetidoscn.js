document.addEventListener("DOMContentLoaded", () => {

    const btnCancelar = document.getElementById("btn-cancelar");

    $(document).on('click', '.registar-informacoes', function () {

        id = $(this).data("id");
        nome = $(this).data("nome");
        bilhete = $(this).data("bilhete");

        $("#inscricao_id").val(id);
        $("#nome").val(nome);
        $("#num_bilhete").val(bilhete);

        const modal = new bootstrap.Modal(document.getElementById('modal-registar-informacoes'));
        modal.show();

    });

    btnCancelar.addEventListener("click", () => {

        const modalElement = document.getElementById('modal-registar-informacoes');
        const modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();

    });

    $(document).on('click', '#btn-registar-informacoes', function () {

        const cedula_disponivel = document.getElementById('cedula_disponivel').value;
        const numero_cedula = document.getElementById('numero_cedula').value;
        const data_emissao_cedula = document.getElementById('data_emissao_cedula').value;
        const aguarda_cerimonia = document.getElementById('aguarda_cerimonia').value;


        if (cedula_disponivel == '' || cedula_disponivel == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe se a cédula já está disponível",
                timer: 4000
            });
        }
        else if ((numero_cedula == '' || numero_cedula == null) && (cedula_disponivel == 'Sim')) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite o número da cédula",
                timer: 4000
            });
        }
        else if (isNaN(numero_cedula) == true) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite um número de cédula válido",
                timer: 4000
            });
        }
        else if ((numero_cedula != '' && numero_cedula != null) && (cedula_disponivel == 'Não')) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Se já tem número da cédula, a cédula deve estar disponível",
                timer: 4000
            });
        }
        else if (data_emissao_cedula == '' || data_emissao_cedula == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Digite a data de emissão da cédula",
                timer: 4000
            });
        }
        else {

            const inscricao_id = document.getElementById('inscricao_id').value;

            const formData = new FormData();
            formData.append('inscricao_id', inscricao_id);
            formData.append('cedula_disponivel', cedula_disponivel);
            formData.append('numero_cedula', numero_cedula);
            formData.append('data_emissao_cedula', data_emissao_cedula);
            formData.append('aguarda_cerimonia', aguarda_cerimonia);

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
                        url: "/system/registoadicional-ceduladisponivel/update",
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
                                    text: 'Dados registados com sucesso!',
                                    timer: 3000
                                });

                                window.location.href = "/system/areatecnica/list/subscription-trainee/remetidoscn";

                            }
                            else if (res == 'duplicado') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso!",
                                    text: "O número de cédula digitado já existe na base de dados",
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

});