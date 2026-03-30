
$(document).on('click', '.btn-historico', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarHistorico(id);

});

$(document).on('click', '.btn-detalhes', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');
    buscarItemDetalhes(id);

});

function buscarHistorico(id) {

    fetch(`/system/getHistoricoProcesso/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(dados => {

            const div = document.getElementById('list-group-item');
            div.innerHTML = '';

            dados.forEach(item => {

                let avatar = window.avatarUrl;
                let data = new Date(item.created_at);
                let dataFormatada = data.toLocaleDateString('pt-PT');
                let horaFormatada = data.toLocaleTimeString('pt-PT');

                linha = `<div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="badge bg-green"></span></div>
                                    <div class="col-auto">
                                        <a href="#">
                                            <span class="avatar"
                                                style="background-image: url(${avatar})"></span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="text-reset d-block">${item.nome}
                                            | ${dataFormatada} ${horaFormatada}</a>
                                        <div class="d-block text-secondary mt-n1">
                                            ${item.operacao}
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                div.innerHTML += linha;

            });

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

function buscarItemDetalhes(id) {

    fetch(`/system/getDetalhesProcesso/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            console.log('Resposta do servidor:', data);

            html = ``;
            $("#dv-detalhes1").html(html);
            $("#dv-detalhes2").html(html);

            html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nº Processo Secretaria: ${data[0].codigo} <br>
                            Requerente: ${data[0].proveniencia} <br>
                            Contactos: ${data[0].telefone == null ? '' : data[0].telefone}/${data[0].telefone2 == null ? '' : data[0].telefone2} <br>
                            Assunto: ${data[0].assunto} <br><br>
                            Data de Entrada: ${data[0].data_entrada} <br>
                            Estado: ${data[0].estado} <br>
                            Tipo de processo: ${data[0].gettipoprocesso.descricao}<br>
                            Título/Função: ${data[0].titulo == null ? '' : data[0].titulo}<br><br>
                            Endereço do Requerente: ${data[0].endereco_requerente == null ? '' : data[0].endereco_requerente}<br>
                            Município do Requerente: ${data[0].municipio_requerente == null ? '' : data[0].getmunicipio.descricao}<br>
                            Observação: ${data[0].observacao == null ? '' : data[0].observacao} <br>
                            Encaminhado: ${data[0].encaminhado == null ? '' : data[0].encaminhado} <br>
                            Nota de Encaminhamento: ${data[0].nota_encaminhamento == null ? '' : data[0].nota_encaminhamento}
                        </div>`
            $("#dv-detalhes1").html(html);


            html = ``;
            html = `<h3 class="text-center">
                           Sem outras Informações para apresentar.
                        </h3>`
            if (data[1] == null && (data[0].tipo_processo_id == 2 || data[0].tipo_processo_id == 3)) {

                html = `<h3 class="text-center">
                            O processo ainda não foi registado na área técnica.
                        </h3>`
            }
            else if (data[0].tipo_processo_id != 2 && data[0].tipo_processo_id != 3) {

            }
            else if (data[1] != null && (data[0].tipo_processo_id == 2 || data[0].tipo_processo_id == 3)) {

                html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nº Processo Área Técnica: ${data[1].codigo} <br>
                            Estado: ${data[1].estado} <br>
                            Email do Requerente: ${data[1].email} <br>
                            Nº Bilhete: ${data[1].num_bilhete} <br>
                            Género: ${data[1].sexo} <br><br>
                            Despacho: ${data[1].despacho == null ? '' : data[1].despacho}<br>
                            Data de despacho: ${data[1].data_despacho == null ? '' : data[1].data_despacho} <br>
                            Mensagem do despacho: ${data[1].texto_despacho == null ? '' : data[1].texto_despacho}<br>
                            Data de remessa ao CN: ${data[1].data_remessa_cn == null ? '' : data[1].data_remessa_cn}<br><br>`

                if (data[0].tipo_processo_id == 3) {

                    escritorio = data[3].advogado_id == null ? data[3].nome_escritorio : data[4].nome_escritorio;

                    html += `Acto pretendido: ${data[1].acto_pretendido} <br>
                    Nome do patrono: ${data[3].advogado_id == null ? data[3].nome : data[4].getpessoa.nome} <br>
                    Escritório do patrono: ${escritorio == null ? '' : escritorio} <br>
                    Endereço do patrono: ${data[3].advogado_id == null ? data[3].endereco_escritorio : data[4].endereco_escritorio} <br>
                    Município: ${data[3].advogado_id == null ? data[3].getmunicipio.descricao : data[4].getmunicipio.descricao} <br><br>
                    Cédula disponível: ${data[1].cedula_disponivel} <br>
                    Data de emissão da cédula: ${data[1].data_emissao_cedula == null ? '' : data[1].data_emissao_cedula}`
                }

                if (data[0].tipo_processo_id == 2) {

                    html += `Estado distribuição (aos Conselheiros): ${data[1].estado_distribuicao} <br>
                    Análise do processo (Conselheiro): ${data[2].nome == null ? '' : data[2].nome} <br>
                    Data de entrega ao Conselheiro: ${data[1].data_levantamento_distribuicao == null ? '' : data[1].data_levantamento_distribuicao} <br>
                    Data de devolução do Conselheiro: ${data[1].data_entrega_distribuicao == null ? '' : data[1].data_entrega_distribuicao} <br><br>
                    Data de entrega à Comissão de Ética: ${data[1].data_levantamento_comissao_etica == null ? '' : data[1].data_levantamento_comissao_etica} <br>
                    Data de devolução da Comissão de Ética: ${data[1].data_entrega_comissao_etica == null ? '' : data[1].data_entrega_comissao_etica}`
                }

                html += `</div>`

            }

            $("#dv-detalhes2").html(html);

        })
        .catch(error => {
            console.error('Erro:', error);
        });
}