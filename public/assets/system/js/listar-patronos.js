
$(document).on('click', '.btn-detalhes', function (e) {

    e.preventDefault(); // se for link, evita redirecionamento
    const id = $(this).data('id'); // forma jQuery de pegar data-id

    fetch(`/system/getEstagiariosPatrono/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(dados => {

            console.log('Resposta do servidor:', dados);

            const tbody = document.getElementById('tabela-dados');

            // limpa antes (importante)
            tbody.innerHTML = '';

            dados.forEach(item => {

                linha = '';

                if (item.estado == 'frequenta') {
                    
                    fetch(`/system/getLinhaEstagiariosPatrono/${item.id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro na requisição');
                            }
                            return response.json();
                        })
                        .then(data2 => {

                            console.log('Resposta do servidor:', data2);

                            linha = `
                            <tr>
                                <td>${data2.nome + ' (' + data2.categoria + ')'}</td>
                                <td>${data2.cedula}</td>
                                <td>${item.estado}</td>
                                <td><a title="remover" data-id="${item.id}" style="cursor: pointer;"
                                                class="btn-remover badge bg-red-lt">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </a></td>
                            </tr>`;
                            tbody.innerHTML += linha;

                        })
                        .catch(error => {
                            console.error('Erro:', error);
                        });

                }

            });
        })
        .catch(error => {
            console.error('Erro:', error);
        });

});

$(document).on('click', '.btn-remover', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');

    const formData = new FormData();

    formData.append('id', id);

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja eliminar este estagiário?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#34c38f",
        cancelButtonColor: "#f46a6a",
        confirmButtonText: "Eliminar!",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return $.ajax({
                url: "/system/estagiario-patrono/delete",
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
                            text: 'Advogado eliminado com sucesso!',
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
                        timer: 6000
                    });
                    console.log("Error: " + error.responseJSON.message);
                }
            });
        }
    });


});
