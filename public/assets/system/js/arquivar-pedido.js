document.addEventListener("DOMContentLoaded", () => {

    $(document).on('click', '#btn-registar-informacoes', function () {

        var e_substituicao = false;
        const tipo_situacao = document.getElementById('tipo_situacao').value;
        const pedido_referencia_id = document.getElementById('pedido_referencia_id').value;
        const observacao = document.getElementById('observacao2').value;
        const registo_id = document.getElementById('registo_id').value;
        const pedido_id = document.getElementById('pedido_id').value;

        var localizacao;
        var sexo;
        var natureza;

        sexo = document.getElementById('sexo').value;

        if (tipo_situacao == 'Substituição de Advogado' && (pedido_referencia_id != '' && pedido_referencia_id != null)) {

            e_substituicao = true;

        }


        if (e_substituicao == false) {

            localizacao = document.getElementById('localizacao').value;
            natureza = document.getElementById('natureza').value;

        }


        if ((sexo == '' || sexo == null)) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe o género/sexo",
                timer: 4000
            });
        }
        else if ((natureza == '' || natureza == null) && e_substituicao == false) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a natureza do processo",
                timer: 4000
            });
        }
        else if ((localizacao == '' || localizacao == null) && e_substituicao == false) {
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
            formData.append('tipo_situacao', tipo_situacao);
            formData.append('pedido_referencia_id', pedido_referencia_id);

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
                        url: "/system/arquivar-pedido/post",
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

                                window.location.href = "/system/areatecnica/list/assistance";

                            }
                            else if (res == 'pedido-referencia') {
                                sweetAlert({
                                    type: "warning",
                                    title: "Aviso",
                                    text: 'Esta assistência de substituição não tem uma referência.',
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