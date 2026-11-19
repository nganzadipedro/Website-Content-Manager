
$('#end-estagiario').hide();
$('#dvnomepatronoexiste').show();

let dropdown;
let id_patrono_filtrado;

document.addEventListener('DOMContentLoaded', function () {

    dropdown = document.getElementById('patrono_dropdown');
    if (listaPatronosGlobal === 'undefined') return;

    // Função para filtrar e renderizar a lista
    function filtrarPatronos(texto) {

        console.log('Filtrando patronos com o texto:', texto);
        const query = texto.trim().toLowerCase();
        dropdown = document.getElementById('patrono_dropdown');

        if (query === '') {
            dropdown.style.display = 'none';
            dropdown.innerHTML = '';
            return;
        }

        // Filtra até 20 resultados para manter a renderização ultra-rápida
        const resultados = listaPatronosGlobal.filter(p =>
            p.nome.toLowerCase().includes(query)
        ).slice(0, 10);

        dropdown.innerHTML = '';

        if (resultados.length > 0) {
            resultados.forEach(item => {
                const div = document.createElement('div');
                div.className = 'custom-dropdown-item';
                div.textContent = item.nome;

                // Evento de seleção do item
                div.addEventListener('click', function () {
                    id_patrono_filtrado = item.id;
                    getNumEstagiarios(id_patrono_filtrado);
                    // alert('patrono selecionado');
                    document.getElementById('nome_patrono_existe').value = item.nome;
                    dropdown.style.display = 'none';
                });

                dropdown.appendChild(div);
            });
        } else {
            dropdown.innerHTML = '<div class="custom-dropdown-empty">Nenhum patrono encontrado</div>';
        }

        dropdown.style.display = 'block';
    }

    // Eventos de digitação e foco
    $(document).on('input', '#nome_patrono_existe', function () {
        filtrarPatronos(this.value);
        id_patrono_filtrado = 0;
    });

    // $(document).on('focus', '#nome_patrono_existe', function () {
    //     if (this.value.trim() !== '') {
    //         filtrarPatronos(this.value);
    //         id_patrono_filtrado = 0;
    //     }
    // });

    // Fecha a lista se clicar fora do campo
    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
});

acto_pretendido = document.getElementById('acto_pretendido').value;

if (acto_pretendido == 'Indicação de Patrono' || acto_pretendido == '') {
    $('#end-estagiario').hide();
    $('#dvnomepatronoexiste').hide();
    $("#dvescolher_patrono").hide();
    limpaCamposPatrono();
    id_patrono_filtrado = 0;
}
else {
    $('#end-estagiario').show();
    $('#dvnomepatronoexiste').show();
    $("#dvescolher_patrono").show();
    limpaCamposPatrono();
    id_patrono_filtrado = 0;
    avalia_escolhapatrono();
}

$(document).on('change', '#acto_pretendido', function () {

    const tipo = $(this).val();

    if (tipo == 'Indicação de Patrono' || tipo == '') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').hide();
        $("#dvescolher_patrono").hide();
        limpaCamposPatrono();
        id_patrono_filtrado = 0;
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').show();
        $("#dvescolher_patrono").show();
        limpaCamposPatrono();
        id_patrono_filtrado = 0;
        avalia_escolhapatrono();
    }

});

$(document).on('change', '#escolher_patrono', function () {

    const tipo = $(this).val();

    if (tipo == 'existe') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').show();
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        id_patrono_filtrado = 0;
        limpaCamposPatrono();
    }

});

function avalia_escolhapatrono() {
    tipo = $('#escolher_patrono').val();
    if (tipo == 'existe') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').show();
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        id_patrono_filtrado = 0;
        limpaCamposPatrono();
    }
}

function getNumEstagiarios(id) {

    fetch(`/system/getEstagiariosPatrono/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(dados => {

            console.log('Resposta do servidor:', dados);
            contador = 0;
            dados.forEach(item => {
                if (item.estado == 'frequenta') {
                    contador += 1;
                }
            });

            $("#num_estagiarios").text(contador);
        })
        .catch(error => {
            console.error('Erro:', error);
        });

}

function limpaCamposPatrono() {
    $("#tel_patrono").val("");
    $("#email_patrono").val("");
    $("#nome_escritorio").val("");
    $("#endereco_escritorio_est").val("");
    $("#municipio_id_est").val("");
    $("#nome_patrono").val("");
    $("#num_estagiarios").text("");
    $("#cedula_patrono").val("");
}

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const num_bilhete = document.getElementById('num_bilhete').value;
    const sexo = document.getElementById('sexo').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const email = document.getElementById('email').value;
    const acto_pretendido = document.getElementById('acto_pretendido').value;
    const escolher_patrono = document.getElementById('escolher_patrono').value;
    const observacao2 = document.getElementById('observacao2').value;

    var nome_patrono;
    var cedula_patrono;
    var tel_patrono;
    var email_patrono;
    var nome_escritorio;
    var endereco_escritorio_est;
    var municipio_id_est;

    if (escolher_patrono == 'novo') {
        nome_patrono = document.getElementById('nome_patrono').value;
        cedula_patrono = document.getElementById('cedula_patrono').value;
        tel_patrono = document.getElementById('tel_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
        nome_escritorio = document.getElementById('nome_escritorio').value;
        endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
        municipio_id_est = document.getElementById('municipio_id_est').value;
    }

    if (num_bilhete == '' || num_bilhete == null) {
        msgErro = "Digite o número do bilhete de identidade";
        tem = false;
    }
    else if (sexo == '' || sexo == null) {
        msgErro = "Escolha o género";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (acto_pretendido == '' || acto_pretendido == null) {
        msgErro = "Especifique o acto pretendido";
        tem = false;
    }
    else if (acto_pretendido != 'Indicação de Patrono' && escolher_patrono == 'existe' && id_patrono_filtrado == 0) {
        msgErro = "Especifique o patrono para este processo";
        tem = false;
    }
    else if (acto_pretendido != 'Indicação de Patrono' && escolher_patrono == 'novo' && (nome_patrono == '' || nome_patrono == null)) {
        msgErro = "Digite o nome do patrono";
        tem = false;
    }
    else if (acto_pretendido != 'Indicação de Patrono' && escolher_patrono == 'novo' && (municipio_id_est == '' || municipio_id_est == null)) {
        msgErro = "Escolha o município";
        tem = false;
    }
    else if (acto_pretendido != 'Indicação de Patrono' && escolher_patrono == 'novo' && (endereco_escritorio_est == '' || endereco_escritorio_est == null)) {
        msgErro = "Digite o endereço do escritório";
        tem = false;
    }

    if (tem == false) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: msgErro,
            timer: 4000
        });

    }

    return tem;
}

document.getElementById('btn-registar-inscricao').addEventListener('click', function () {


    if (valida_formulario() === true) {

        const formData = new FormData();

        const num_bilhete = document.getElementById('num_bilhete').value;
        const sexo = document.getElementById('sexo').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const email = document.getElementById('email').value;
        const acto_pretendido = document.getElementById('acto_pretendido').value;
        const observacao2 = document.getElementById('observacao2').value;
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const tipo_processo_id = document.getElementById('tipo_processo_id').value;
        const escolher_patrono = document.getElementById('escolher_patrono').value;
        const patrono_id = id_patrono_filtrado;

        var nome_patrono;
        var cedula_patrono;
        var tel_patrono;
        var email_patrono;
        var nome_escritorio;
        var endereco_escritorio_est;
        var municipio_id_est;

        if (escolher_patrono == 'novo' && acto_pretendido != 'Indicação de Patrono') {
            nome_patrono = document.getElementById('nome_patrono').value;
            cedula_patrono = document.getElementById('cedula_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio = document.getElementById('nome_escritorio').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
        }

        formData.append('num_bilhete', num_bilhete);
        formData.append('genero', sexo);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('email', email);
        formData.append('acto_pretendido', acto_pretendido);
        formData.append('observacao', observacao2);
        formData.append('registo_entrada_id', registo_entrada_id);
        formData.append('tipo_processo_id', tipo_processo_id);
        formData.append('patrono_id', patrono_id);
        formData.append('escolher_patrono', escolher_patrono);

        if (escolher_patrono == 'novo' && acto_pretendido != 'Indicação de Patrono') {
            formData.append('nome_patrono', nome_patrono);
            formData.append('cedula_patrono', cedula_patrono);
            formData.append('tel_patrono', tel_patrono);
            formData.append('email_patrono', email_patrono);
            formData.append('nome_escritorio', nome_escritorio);
            formData.append('endereco_escritorio', endereco_escritorio_est);
            formData.append('municipio_id', municipio_id_est);
        }

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
                    url: "/system/registo-inscricao/post",
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

                            if (acto_pretendido == 'Indicação de Patrono') {
                                window.location.href = "/system/areatecnica/list/subscription-trainee/registed/Indicacao-Patrono";
                            }
                            else if (observacao2 != '' && observacao2 != null) {
                                window.location.href = "/system/areatecnica/list/subscription-trainee/registed/Indeferido";
                            }
                            else {
                                window.location.href = "/system/areatecnica/list/subscription-trainee/registed/Deferido";
                            }

                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número de cédula do patrono está duplicado na base de dados!',
                                timer: 3000
                            });

                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número do bilhete está duplicado na base de dados!',
                                timer: 4000
                            });
                        }
                        else if (res == 'sem patrono') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Não foi atribuído nenhum patrono para este processo',
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