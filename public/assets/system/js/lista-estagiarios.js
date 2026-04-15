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
            if (data.municipio_id != null) {
                municipio = data.getmunicipio.descricao;
            }

             contactos = '';
            contactos = data.getpessoa.telefone1 == null ? '' : data.getpessoa.telefone1;
            contactos += data.getpessoa.telefone2 == null ? '' : '/' + data.getpessoa.telefone1;

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nome completo: ${data.getpessoa.nome} <br><br>
                            Nome profissional: ${data.nome_profissional == null ? '' : data.nome_profissional} <br><br>
                            Género: ${data.getpessoa.genero == null ? '' : data.getpessoa.genero} <br><br>
                            Nº BI: ${data.getpessoa.num_documento == null ? '' : data.getpessoa.num_documento} <br><br>
                            <strong> Categoria: ${data.categoria} </strong> <br><br>
                            Nº Cédula Estagiário: ${data.num_estagiario} <br><br>
                            Email: ${data.getpessoa.email}<br><br>
                            Contactos: ${contactos}<br><br>
                            Município: ${municipio} <br><br>
                            Data de Inscrição Estagiário: ${data.data_inscricao_estagiario == null ? '' : data.data_inscricao_estagiario} <br><br>
                            Nome do patrono: ${data.nome_patrono == null ? '' : data.nome_patrono} <br><br>
                            Telefone do patrono: ${data.telefone_patrono == null ? '' : data.telefone_patrono} <br><br>
                            Email do patrono: ${data.email_patrono == null ? '' : data.email_patrono} <br><br>
                            Nome do escritório: ${data.nome_escritorio == null ? '' : data.nome_escritorio} <br><br>
                            Endereço do escritório: ${data.endereco_escritorio == null ? '' : data.endereco_escritorio}<br><br>
                            Data da Cerimónia de Entrega de Cédula: ${data.data_cerimonia_estagiario == null ? '' : data.data_cerimonia_estagiario}
                        </div>`
            $("#dv-detalhes").html(html);

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}
