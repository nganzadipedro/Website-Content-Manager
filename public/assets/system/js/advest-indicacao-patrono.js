document.addEventListener("DOMContentLoaded", () => {

    $(document).on('click', '#btn-gerar-pdf', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportpdf-indicacao-patrono";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        document.body.appendChild(form);

        form.submit();

        document.body.removeChild(form);

    });

    $(document).on('click', '#btn-gerar-excel', function () {

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "/system/areatecnica/exportxls-indicacao-patrono";
        form.target = "_blank";

        // CSRF
        const csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        document.body.appendChild(form);

        form.submit();

        document.body.removeChild(form);

    });

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

    function buscarItemDetalhes(id) {

        fetch(`/system/getDataInscricaoAdvogadoById/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição');
                }
                return response.json();
            })
            .then(data => {

                console.log('Resposta do servidor:', data);
                $("#dv-detalhes").html("");

                html = `<div class="col-md-12 col-lg-12 col-xl-12 col-12">
                            Nº Processo Secretaria: ${data.getregistoentrada.codigo} <br><br>
                            Nº Processo Área Técnica: ${data.codigo} <br><br>
                            Requerente: ${data.getregistoentrada.proveniencia} <br><br>
                            Contactos: ${data.telefone1}/${data.telefone2 == null ? '' : data.telefone2} <br><br>
                            Email: ${data.email == null ? '' : data.email} <br><br>
                            Assunto: ${data.getregistoentrada.assunto} <br><br>
                            Data de Entrada: ${data.getregistoentrada.data_entrada} <br><br>
                            Estado: ${data.getregistoentrada.estado} <br><br>
                            Acto Pretendido: ${data.acto_pretendido}<br><br>
                            Data de remessa ao CN: ${data.data_remessa_cn == null ? '' : data.data_remessa_cn}
                        </div>`
                $("#dv-detalhes").html(html);


            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }

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
                                    <div class="col text-truncate">
                                        <a href="#" class="text-reset d-block">${item.nome}
                                            | ${dataFormatada} ${horaFormatada}</a>
                                        <div class="d-block text-secondary text-truncate mt-n1">
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

});