$(document).on('click', '.btn-detalhes', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarItem(id);

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
            if (data[0].municipio_id != null) {
                municipio = data[0].getmunicipio.descricao;
            }

            contactos = '';
            contactos = data[0].getpessoa.telefone1 == null ? '' : data[0].getpessoa.telefone1;
            contactos += data[0].getpessoa.telefone2 == null ? '' : '/' + data[0].getpessoa.telefone2;

            nomePatrono = '';
            telefonePatrono = '';
            emailPatrono = '';
            nomeEscritorio = '';
            enderecoEscritorio = '';

            if (data[2] != null) {
                nomePatrono = data[2].getpessoa.nome == null ? '' : data[2].getpessoa.nome;
                telefonePatrono = data[2].getpessoa.telefone1 == null ? '' : data[2].getpessoa.telefone1;
                emailPatrono = data[2].getpessoa.email == null ? '' : data[2].getpessoa.email;
                nomeEscritorio = data[2].nome_escritorio == null ? '' : data[2].nome_escritorio;
                if (data[2].municipio_id != null) {
                    enderecoEscritorio = data[2].getmunicipio.descricao;
                }
                enderecoEscritorio += ', ' + data[2].endereco_escritorio == null ? '' : data[2].endereco_escritorio;

                if (data[2].getpessoa.telefone2 != null) {
                    telefonePatrono += '/' + data[2].getpessoa.telefone2;
                }
            }

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data[0].getpessoa.nome} <br><br>
                            Nome profissional: ${data[0].nome_profissional == null ? '' : data[0].nome_profissional} <br><br>
                            Género: ${data[0].getpessoa.genero == null ? '' : data[0].getpessoa.genero} <br><br>
                            Nº BI: ${data[0].getpessoa.num_documento == null ? '' : data[0].getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data[0].categoria} </strong> <br><br>
                            Nº Cédula Estagiário: ${data[0].num_estagiario} <br><br>
                            Email: ${data[0].getpessoa.email}<br><br>
                            Contactos: ${contactos}<br><br>
                            Município: ${municipio} <br><br>
                            Data de Inscrição Estagiário: ${data[0].data_inscricao_estagiario == null ? '' : data[0].data_inscricao_estagiario} <br><br>
                            Nome do patrono: ${nomePatrono} <br><br>
                            Telefone do patrono: ${telefonePatrono} <br><br>
                            Email do patrono: ${emailPatrono} <br><br>
                            Nome do escritório: ${nomeEscritorio} <br><br>
                            Endereço do escritório: ${enderecoEscritorio}<br><br>
                            Data da Cerimónia de Entrega de Cédula: ${data[0].data_cerimonia_estagiario == null ? '' : data[0].data_cerimonia_estagiario}
                        </div>`
            $("#dv-detalhes").html(html);

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}
