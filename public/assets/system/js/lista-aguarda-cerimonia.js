$(document).on('click', '.btn-detalhes', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarItem(id);

});

$(document).on('click', '#btn-cancelar', function () {

    const modalElement = document.getElementById('modal-cerimonia');
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();

});

$(document).on('click', '.btn-cerimonia', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');

    fetch(`/system/getAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes-2").html("");

            municipio = '';
            cedula = '';
            if (data.municipio_id != null) {
                municipio = data.getmunicipio.descricao;
            }

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data.getpessoa.nome} <br><br>
                            Nome profissional: ${data.nome_profissional} <br><br>
                            Género: ${data.getpessoa.genero} <br><br>
                            Nº BI: ${data.getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data.categoria} </strong> <br><br>
                            Nº Cédula: ${data.categoria == 'Advogado' ? data.num_associado : data.num_estagiario} <br><br>
                        </div>`
            $("#dv-detalhes-2").html(html);
            $('#advogado_id').val(data.id);

        })
        .catch(error => {
            console.error('Erro:', error);
        });

});

function buscarItem(id) {

    fetch(`/system/getAdvogadoById/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);
            $("#dv-detalhes").html("");

            municipio = '';
            if (data.municipio_id != null) {
                municipio = data.getmunicipio.descricao;
            }

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data.getpessoa.nome} <br><br>
                            Nome profissional: ${data.nome_profissional} <br><br>
                            Género: ${data.getpessoa.genero} <br><br>
                            Nº BI: ${data.getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data.categoria} </strong> <br><br>
                            Nº Cédula Advogado: ${data.num_associado} <br><br>
                            Nº Cédula Estagiário: ${data.num_estagiario} <br><br>
                            Email: ${data.getpessoa.email}<br><br>
                            Contactos: ${data.getpessoa.telefone1}/${data.getpessoa.telefone2}<br><br>
                            Endereço: ${data.endereco_escritorio}<br><br>
                            Município: ${municipio} <br><br>
                            Data de Inscrição Advogado: ${data.data_inscricao_oaa} <br><br>
                            Data de Inscrição Estagiário: ${data.data_inscricao_estagiario}
                        </div>`
            $("#dv-detalhes").html(html);


        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

document.getElementById('btn-registar-cerimonia').addEventListener('click', function () {

    data_cerimonia = document.getElementById('data_cerimonia').value;
    if (data_cerimonia == '' || data_cerimonia == null) {
        Swal.fire({
            title: "Aviso",
            text: "Por favor, selecione uma data de cerimónia.",
            icon: "warning",
            confirmButtonColor: "#34c38f",
        });
        return false;
    }
    else {

        const formData = new FormData();

        const data_cerimonia = document.getElementById('data_cerimonia').value;
        const advogado_id = document.getElementById('advogado_id').value;

        formData.append('data_cerimonia', data_cerimonia);
        formData.append('advogado_id', advogado_id);


        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja registar estes dados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Salvar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/data-cerimonia/update",
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
