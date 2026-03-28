let pedido_intervencao_id = 0;
let nome_requerente = '';


$(document).on('click', '#btn-confirmar-rejeicao', function () {

    const motivo_rejeicao = document.getElementById('motivo_rejeicao').value;

    if (motivo_rejeicao == '' || motivo_rejeicao == null) {
        sweetAlert({
            type: "warning",
            title: "Aviso",
            text: 'Digite o motivo da rejeição',
            timer: 3000
        });
    }
    else {

        const formData = new FormData();

        formData.append('pedido_id', pedido_intervencao_id);
        formData.append('motivo_rejeicao', motivo_rejeicao);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja rejeitar esta solicitação?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Confirmar!",
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
                                text: 'Operação realizada com sucesso!',
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

    }

});

$(document).on('click', '#btn-autorizar', function () {

    const formData = new FormData();

    formData.append('pedido_id', pedido_intervencao_id);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja autorizar esta solicitação?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/pedido-intervencao/post",
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
                            text: 'Operação realizada com sucesso!',
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


$(document).on('click', '.btn-visualizardoc', function () {

    // Pega o data-id do <a> clicado
    let url_documento = $(this).data('url');
    let id = $(this).data('id');

    pedido_intervencao_id = id;

    console.log(url_documento);

    let iframe = document.getElementById('pdfViewer');
    iframe.src = url_documento;

    buscarItemDetalhes(id);

    let modal = new bootstrap.Modal(document.getElementById('modal-visualizardoc'));
    modal.show();

});

$(document).on('click', '#btn-rejeitar', function () {

    // Pega o data-id do <a> clicado
    // let pedido_id = $(this).data('id');
    // let nome = $(this).data('nome');

    $("#pedido_id").val(pedido_intervencao_id);
    $("#nome_requerente").val(nome_requerente);

    let modal = new bootstrap.Modal(document.getElementById('modal-rejeitar-solicitacao'));
    modal.show();

});

function buscarItemDetalhes(id) {

    fetch(`/system/getPedidoIntervencaoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes").html("");

            if (data[0].advogado_id == null) {

                nome_requerente = data[0].nome;

                html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome: ${data[0].nome} <br>
                            Nº Cédula: ${data[0].num_cedula} <br>
                            Nº Bilhete: ${data[0].num_documento} <br><br>
                            Contactos: ${data[0].telefone1}/${data[0].telefone2} <br>
                            Email: ${data[0].email} <br>
                            Categoria: ${data[0].categoria} <br><br>
                            Tipos de processo a intervir: ${data[0].tipo_processo} <br>
                            Nome do escritório: ${data[0].nome_escritorio} <br>
                            Endereço do escritório/Endereço profissional: ${data[0].endereco_escritorio} <br>
                            Município: ${data[0].getmunicipio.descricao}<br><br>
                            Estado da solicitação: ${data[0].estado}<br><br>
                        </div>`

                        if(data[0].categoria == 'Estagiario'){
                            html += `Nome do patrono: ${data[0].nome_patrono}<br>
                            Cédula do patrono: ${data[0].cedula_patrono}<br>
                            Telefone do patrono: ${data[0].telefone_patrono} <br>
                            Email do patrono: ${data[0].email_patrono}<br><br>`;
                        }
            }
            else if (data[0].advogado_id != null) {

                nome_requerente = data[1].nome;
                cedula = data[0].getadvogado.categoria == 'Estagiario' ? data[0].getadvogado.num_estagiario : data[0].getadvogado.num_associado;

                html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome: ${data[1].nome} <br>
                            Nº Cédula: ${cedula} <br>
                            Nº Bilhete: ${data[1].num_documento} <br><br>
                            Contactos: ${data[1].telefone1}/${data[1].telefone2 == null ? '' : data[1].telefone2} <br>
                            Email: ${data[1].email} <br>
                            Categoria: ${data[0].getadvogado.categoria} <br><br>
                            Tipos de processo a intervir: ${data[0].tipo_processo} <br>
                            Nome do escritório: ${data[0].getadvogado.nome_escritorio == null ? '' : data[0].getadvogado.nome_escritorio} <br>
                            Endereço do escritório/Endereço profissional: ${data[0].getadvogado.endereco_escritorio} <br>
                            Município: ${data[2].descricao}<br><br>
                            Estado da solicitação: ${data[0].estado}<br><br>
                        </div>`

                        if(data[0].getadvogado.categoria == 'Estagiario'){
                            html += `Nome do patrono: ${data[0].getadvogado.nome_patrono}<br>
                            Cédula do patrono: ${data[0].getadvogado.cedula_patrono}<br>
                            Telefone do patrono: ${data[0].getadvogado.telefone_patrono} <br>
                            Email do patrono: ${data[0].getadvogado.email_patrono}<br><br>`;
                        }
            }

            $('#btn-autorizar').show();
            $('#btn-rejeitar').show();
            $('#dv-motivo').hide();

            if (data[0].estado != 'pendente') {
                $('#btn-autorizar').hide();
                $('#btn-rejeitar').hide();
            }

            if (data[0].estado == 'cancelado') {
                $('#dv-motivo').show();
                $('#dv-motivo').html(data[0].motivo_rejeicao);
            }


            $("#dv-detalhes").html(html);


        })
        .catch(error => {
            console.error('Erro:', error);
        });
}
