
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
                    limpaCamposPatronoExiste();
                    getPatrono(id_patrono_filtrado);
                    // buscarItem(id_patrono_filtrado);
                    // alert('patrono selecionado');
                    document.getElementById('nome_patrono_existe').value = item.nome;
                    dropdown.style.display = 'none';
                    $('#pat-existente').show();
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
        $('#pat-existente').hide();
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

$('#end-advogado').hide();
$('#end-estagiario').hide();
$('#pat-existente').hide();
$('#dvescolher-patrono').hide();
$('#dvnomepatronoexiste').hide();
limpaCamposPatronoExiste();

$(document).on('change', '#categoria', function () {

    const categoria = $(this).val();

    if (categoria == 'Estagiario') {
        $('#dvescolher-patrono').show();
        $('#dvnomepatronoexiste').show();
        $('#end-estagiario').hide();
        $('#end-advogado').hide();
    }
    else if (categoria == 'Advogado') {
        $('#end-advogado').show();
        $('#end-estagiario').hide();
        $('#dvescolher-patrono').hide();
        $('#pat-existente').hide();
        limpaCamposPatronoExiste();
        $('#dvnomepatronoexiste').hide();
    }
    else {
        $('#end-advogado').hide();
        $('#end-estagiario').hide();
        $('#pat-existente').hide();
        $('#dvescolher-patrono').hide();
        $('#dvnomepatronoexiste').hide();
        limpaCamposPatronoExiste();
    }

});

$(document).on('change', '#escolher_patrono', function () {

    const tipo = $(this).val();

    if (tipo == 'existe') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').show();
        $('#pat-existente').hide();
        $('#nome_patrono_existe').val("");
        limpaCamposPatronoExiste();
        id_patrono_filtrado = 0;
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        $('#pat-existente').hide();
        $('#nome_patrono_existe').val("");
        limpaCamposPatronoExiste();
        id_patrono_filtrado = 0;
    }

});



function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const nome_completo = document.getElementById('nome_completo').value;
    const nome_profissional = document.getElementById('nome_profissional').value;
    const num_bi = document.getElementById('num_bi').value;
    const telefone1 = document.getElementById('telefone1').value;
    const telefone2 = document.getElementById('telefone2').value;
    const sexo = document.getElementById('sexo').value;
    const num_associado = document.getElementById('num_associado').value;
    const num_estagiario = document.getElementById('num_estagiario').value;
    const email = document.getElementById('email').value;
    const data_inscricao_oaa = document.getElementById('data_inscricao_oaa').value;
    const data_inscricao_estagiario = document.getElementById('data_inscricao_estagiario').value;
    const categoria = document.getElementById('categoria').value;
    const estado = document.getElementById('estado').value;
    const escolher_patrono = document.getElementById('escolher_patrono').value;

    endereco_profissional_adv;
    municipio_id_adv;
    nome_patrono;
    tel_patrono;
    email_patrono;
    nome_escritorio;
    endereco_escritorio_est;
    municipio_id_est;

    if (categoria == 'Advogado') {
        endereco_profissional_adv = document.getElementById('endereco_profissional_adv').value;
        municipio_id_adv = document.getElementById('municipio_id_adv').value;
    }
    else if (categoria == 'Estagiario') {
        nome_patrono = document.getElementById('nome_patrono').value;
        tel_patrono = document.getElementById('tel_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
        nome_escritorio = document.getElementById('nome_escritorio').value;
        endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
        municipio_id_est = document.getElementById('municipio_id_est').value;
    }

    if (nome_completo == '' || nome_completo == null) {
        msgErro = "Digite o nome completo";
        tem = false;
    }
    else if (nome_profissional == '' || nome_profissional == null) {
        msgErro = "Digite o nome profissional";
        tem = false;
    }
    // else if (num_bi == '' || num_bi == null) {
    //     msgErro = "Digite o número do bilhete";
    //     tem = false;
    // }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (sexo == '' || sexo == null) {
        msgErro = "Escolha o género";
        tem = false;
    }
    else if (categoria == '' || categoria == null) {
        msgErro = "Escolha a categoria";
        tem = false;
    }
    else if (estado == '' || estado == null) {
        msgErro = "Informe se o associado já está registado ou se aguarda cerimónia";
        tem = false;
    }
    else if (categoria == 'Advogado' && (num_associado == '' || num_associado == null)) {
        msgErro = "Digite o número da cédula de advogado";
        tem = false;
    }
    else if (categoria == 'Estagiario' && (num_estagiario == '' || num_estagiario == null)) {
        msgErro = "Digite o número da cédula de advogado estagiário";
        tem = false;
    }
    // else if (email == '' || email == null) {
    //     msgErro = "Digite o endereço de email";
    //     tem = false;
    // }
    else if (categoria == 'Advogado' && (endereco_profissional_adv == '' || endereco_profissional_adv == null)) {
        msgErro = "Digite o endereço profissional do advogado";
        tem = false;
    }
    else if (categoria == 'Advogado' && (municipio_id_adv == '' || municipio_id_adv == null)) {
        msgErro = "Escolha o município referente ao endereço profissional do advogado";
        tem = false;
    }
    else if (escolher_patrono == 'existe' && id_patrono_filtrado == 0) {
        msgErro = "Selecione o patrono";
        tem = false;
    }
    else if (escolher_patrono == 'novo' && categoria == 'Estagiario' && (nome_patrono == '' || nome_patrono == null)) {
        msgErro = "Digite o nome do patrono";
        tem = false;
    }
    else if (escolher_patrono == 'novo' && categoria == 'Estagiario' && (endereco_escritorio_est == '' || endereco_escritorio_est == null)) {
        msgErro = "Digite o endereço do escritório";
        tem = false;
    }
    else if (escolher_patrono == 'novo' && categoria == 'Estagiario' && (municipio_id_est == '' || municipio_id_est == null)) {
        msgErro = "Escolha o município referente ao endereço do escritório";
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

        const nome_completo = document.getElementById('nome_completo').value;
        const nome_profissional = document.getElementById('nome_profissional').value;
        const num_bi = document.getElementById('num_bi').value;
        const telefone1 = document.getElementById('telefone1').value;
        const telefone2 = document.getElementById('telefone2').value;
        const sexo = document.getElementById('sexo').value;
        const num_associado = document.getElementById('num_associado').value;
        const num_estagiario = document.getElementById('num_estagiario').value;
        const email = document.getElementById('email').value;
        const data_inscricao_oaa = document.getElementById('data_inscricao_oaa').value;
        const data_inscricao_estagiario = document.getElementById('data_inscricao_estagiario').value;
        const categoria = document.getElementById('categoria').value;
        const estado = document.getElementById('estado').value;
        const escolher_patrono = document.getElementById('escolher_patrono').value;

        endereco_profissional_adv = '';
        municipio_id_adv = '';
        nome_patrono = '';
        tel_patrono = '';
        email_patrono = '';
        nome_escritorio = '';
        endereco_escritorio_est = '';
        municipio_id_est = '';
        cedula_patrono = '';

        if (categoria == 'Advogado') {
            endereco_profissional_adv = document.getElementById('endereco_profissional_adv').value;
            municipio_id_adv = document.getElementById('municipio_id_adv').value;
        }
        else if (categoria == 'Estagiario' && escolher_patrono == 'novo') {
            nome_patrono = document.getElementById('nome_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio = document.getElementById('nome_escritorio').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
            cedula_patrono = document.getElementById('cedula_patrono').value;
        }
        else if (categoria == 'Estagiario' && escolher_patrono == 'existe') {
            nome_patrono = document.getElementById('nome_patrono_existe').value;
            tel_patrono = document.getElementById('tel_patrono_existe').value;
            email_patrono = document.getElementById('email_patrono_existe').value;
            nome_escritorio = document.getElementById('nome_escritorio_existe').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est_existe').value;
            municipio_id_est = document.getElementById('municipio_id_est_existe').value;
            cedula_patrono = document.getElementById('cedula_patrono_existe').value;
        }

        formData.append('nome_completo', nome_completo);
        formData.append('nome_profissional', nome_profissional);
        formData.append('num_bi', num_bi);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('sexo', sexo);
        formData.append('num_associado', num_associado);
        formData.append('num_estagiario', num_estagiario);
        formData.append('email', email);
        formData.append('data_inscricao_oaa', data_inscricao_oaa);
        formData.append('data_inscricao_estagiario', data_inscricao_estagiario);
        formData.append('categoria', categoria);
        formData.append('estado', estado);
        formData.append('endereco_profissional_adv', endereco_profissional_adv);
        formData.append('municipio_id_adv', municipio_id_adv);
        formData.append('nome_patrono', nome_patrono);
        formData.append('tel_patrono', tel_patrono);
        formData.append('email_patrono', email_patrono);
        formData.append('nome_escritorio', nome_escritorio);
        formData.append('endereco_escritorio_est', endereco_escritorio_est);
        formData.append('municipio_id_est', municipio_id_est);
        formData.append('escolher_patrono', escolher_patrono);
        formData.append('cedula_patrono', cedula_patrono);
        formData.append('id_patrono_filtrado', id_patrono_filtrado);

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
                    url: "/system/registo-associado/post",
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
                            window.location.reload();
                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número de cédula duplicado na base de dados!',
                                timer: 3000
                            });
                        }
                        else if (res == 'duplicado-patrono') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número de cédula do patrono duplicado na base de dados!',
                                timer: 3000
                            });
                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número do BI duplicado na base de dados!',
                                timer: 3000
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

function getPatrono(id) {

    if (id != 0) {


        fetch(`/system/getPatronoById/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição');
                }
                return response.json();
            })
            .then(data => {

                console.log('Resposta do servidor:', data);

                if (data.advogado_id != null) {

                    fetch(`/system/getAdvogadoById/${data.advogado_id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro na requisição');
                            }
                            return response.json();
                        })
                        .then(data2 => {

                            console.log('Resposta do servidor2:', data2);
                            // $("#nome_patrono").val(data2[0].getpessoa.nome);
                            $("#cedula_patrono_existe").val(data2[0].num_associado);
                            $("#tel_patrono_existe").val(data2[0].getpessoa.telefone1);
                            $("#email_patrono_existe").val(data2[0].getpessoa.email);
                            $("#nome_escritorio_existe").val(data2[0].nome_escritorio);
                            $("#endereco_escritorio_est_existe").val(data2[0].endereco_escritorio);
                            $("#municipio_id_est_existe").val(data2[0].municipio_id);

                            // $("#nome_patrono").prop("disabled", true);

                        })
                        .catch(error => {
                            console.error('Erro:', error);
                        });

                }
                else {
                    $("#nome_patrono_existe").val("Nenhum patrono encontrado");
                    $("#nome_patrono_existe").prop("disabled", true);
                    id_patrono_filtrado = 0;
                }

            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }
    else {
        $("#nome_patrono_existe").val("Nenhum patrono adicionado");
        $("#nome_patrono_existe").prop("disabled", true);
        $("#cedula_patrono_existe").prop("disabled", true);
        $("#tel_patrono_existe").prop("disabled", true);
        $("#email_patrono_existe").prop("disabled", true);
        $("#nome_escritorio_existe").prop("disabled", true);
        $("#endereco_escritorio_est_existe").prop("disabled", true);
        $("#municipio_id_est_existe").prop("disabled", true);
        limpaCamposPatronoExiste();
        id_patrono_filtrado = 0;
    }
}

function limpaCamposPatronoExiste() {
    $("#cedula_patrono_existe").val("");
    $("#tel_patrono_existe").val("");
    $("#email_patrono_existe").val("");
    $("#nome_escritorio_existe").val("");
    $("#endereco_escritorio_est_existe").val("");
    $("#municipio_id_est_existe").val("");
}