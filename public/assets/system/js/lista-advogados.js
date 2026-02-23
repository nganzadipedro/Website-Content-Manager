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
            if(data.municipio_id != null){
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
