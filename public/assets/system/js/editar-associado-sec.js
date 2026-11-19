let dropdown;
let id_patrono_filtrado;
let patronoactual_id = $("#patronoactual_id").val();
let patronoactual_nome = $("#patronoactual_nome").val();
let patronoactual_telefone = $("#patronoactual_telefone").val();
let patronoactual_cedula = $("#patronoactual_cedula").val();
let patronoactual_email = $("#patronoactual_email").val();
let patronoactual_endereco = $("#patronoactual_endereco").val();
let patronoactual_municipio_id = $("#patronoactual_municipio_id").val();
let patronoactual_escritorio = $("#patronoactual_escritorio").val();
let escolher_patrono = '';

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
                    // buscarItem(id_patrono_filtrado);
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


categoria_field = $('#categoria_field').val();
$('#end-advogado').hide();
$('#end-estagiario').hide();
$('#dvescolher-patrono').hide();
$('#dvnomepatronoexiste').hide();

if (categoria_field == 'Estagiario' && (patronoactual_id == '' || patronoactual_id == null)) {
    $('#dvescolher-patrono').show();
    $('#dvnomepatronoexiste').show();
    escolher_patrono = $('#escolher_patrono').val();
    $('#end-estagiario').hide();
    $('#end-advogado').hide();
}
else if (categoria_field == 'Estagiario' && (patronoactual_id != '' && patronoactual_id != null)) {
    $('#dvescolher-patrono').hide();
    $('#dvnomepatronoexiste').show();
    $('#end-estagiario').show();
    $('#end-advogado').hide();
    $("#nome_patrono").val(patronoactual_nome);
    $("#nome_patrono").prop("disabled", true);
    $("#tel_patrono").val(patronoactual_telefone);
    $("#email_patrono").val(patronoactual_email);
    $("#nome_escritorio").val(patronoactual_escritorio);
    $("#cedula_patrono").val(patronoactual_cedula);
    $("#municipio_id_est").val(patronoactual_municipio_id);
    $("#endereco_escritorio_est").val(patronoactual_endereco);
}
else if (categoria_field == 'Advogado') {
    $('#end-advogado').show();
    $('#end-estagiario').hide();
    $('#dvescolher-patrono').hide();
    escolher_patrono = '';
    $('#dvnomepatronoexiste').hide();
}

$(document).on('change', '#categoria', function () {

    const categoria = $(this).val();
    if (categoria == 'Estagiario') {
        $('#dvescolher-patrono').show();
        escolher_patrono = $('#escolher_patrono').val();
        $('#dvnomepatronoexiste').show();
        $('#end-estagiario').hide();
        $('#end-advogado').hide();
    }
    else if (categoria == 'Advogado') {
        $('#end-advogado').show();
        $('#end-estagiario').hide();
        $('#dvescolher-patrono').hide();
        escolher_patrono = '';
        $('#dvnomepatronoexiste').hide();
    }
    else {
        $('#end-advogado').hide();
        $('#end-estagiario').hide();
        $('#dvescolher-patrono').hide();
        escolher_patrono = '';
        $('#dvnomepatronoexiste').hide();
    }
});

$(document).on('change', '#escolher_patrono', function () {

    const tipo = $(this).val();
    escolher_patrono = tipo;
    if (tipo == 'existe') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').show();
        $('#nome_patrono_existe').val("");
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        $('#nome_patrono_existe').val("");
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

    var endereco_profissional_adv;
    var municipio_id_adv;
    var nome_patrono;
    var tel_patrono;
    var email_patrono;
    var nome_escritorio;
    var cedula_patrono;
    var endereco_escritorio_est;
    var municipio_id_est;

    if (categoria == 'Advogado') {
        endereco_profissional_adv = document.getElementById('endereco_profissional_adv').value;
        municipio_id_adv = document.getElementById('municipio_id_adv').value;
    }
    else if (categoria == 'Estagiario' && escolher_patrono == 'novo' && (patronoactual_id == '' || patronoactual_id == null)) {
        nome_patrono = document.getElementById('nome_patrono').value;
        tel_patrono = document.getElementById('tel_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
        nome_escritorio = document.getElementById('nome_escritorio').value;
        cedula_patrono = document.getElementById('cedula_patrono').value;
        endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
        municipio_id_est = document.getElementById('municipio_id_est').value;
    }
    else if (categoria == 'Estagiario' && (patronoactual_id != '' && patronoactual_id != null)) {
        nome_patrono = document.getElementById('nome_patrono').value;
        tel_patrono = document.getElementById('tel_patrono').value;
        email_patrono = document.getElementById('email_patrono').value;
        nome_escritorio = document.getElementById('nome_escritorio').value;
        cedula_patrono = document.getElementById('cedula_patrono').value;
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
    else if (num_bi == '' || num_bi == null) {
        msgErro = "Digite o número do bilhete";
        tem = false;
    }
    else if (telefone1 == '' || telefone1 == null) {
        msgErro = "Digite o número de telefone principal";
        tem = false;
    }
    else if (sexo == '' || sexo == null) {
        msgErro = "Escolha o género";
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
    else if (categoria == 'Advogado' && (endereco_profissional_adv == '' || endereco_profissional_adv == null)) {
        msgErro = "Digite o endereço profissional do advogado";
        tem = false;
    }
    else if (categoria == 'Advogado' && (municipio_id_adv == '' || municipio_id_adv == null)) {
        msgErro = "Escolha o município referente ao endereço profissional do advogado";
        tem = false;
    }
    else if (categoria == 'Estagiario' && escolher_patrono == 'existe' && (id_patrono_filtrado == 0 || id_patrono_filtrado == '' || id_patrono_filtrado == null) && (patronoactual_id == '' || patronoactual_id == null)) {
        msgErro = "Selecione o patrono";
        tem = false;
    }
    else if (categoria == 'Estagiario' && escolher_patrono == 'novo' && (patronoactual_id == '' || patronoactual_id == null)) {

        if (nome_patrono == '' || nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (endereco_escritorio_est == '' || endereco_escritorio_est == null) {
            msgErro = "Digite o endereço do escritório";
            tem = false;
        }
        else if (municipio_id_est == '' || municipio_id_est == null) {
            msgErro = "Escolha o município referente ao endereço do escritório";
            tem = false;
        }

    }
    else if (categoria == 'Estagiario' && (patronoactual_id != '' && patronoactual_id != null)) {

        if (nome_patrono == '' || nome_patrono == null) {
            msgErro = "Digite o nome do patrono";
            tem = false;
        }
        else if (endereco_escritorio_est == '' || endereco_escritorio_est == null) {
            msgErro = "Digite o endereço do escritório";
            tem = false;
        }
        else if (municipio_id_est == '' || municipio_id_est == null) {
            msgErro = "Escolha o município referente ao endereço do escritório";
            tem = false;
        }

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
        const advogado_id = document.getElementById('advogado_id').value;

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
        else if (categoria == 'Estagiario' && escolher_patrono == 'novo' && (patronoactual_id == '' || patronoactual_id == null)) {
            nome_patrono = document.getElementById('nome_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio = document.getElementById('nome_escritorio').value;
            cedula_patrono = document.getElementById('cedula_patrono').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
        }
        else if (categoria == 'Estagiario' && (patronoactual_id != '' && patronoactual_id != null)) {
            nome_patrono = document.getElementById('nome_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio = document.getElementById('nome_escritorio').value;
            cedula_patrono = document.getElementById('cedula_patrono').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
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
        formData.append('advogado_id', advogado_id);
        formData.append('escolher_patrono', escolher_patrono);
        formData.append('id_patrono_filtrado', id_patrono_filtrado);
        formData.append('cedula_patrono', cedula_patrono);
        formData.append('patronoactual_id', patronoactual_id);

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
                    url: "/system/registo-associado/update",
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
                                text: 'Dados actualizados com sucesso!',
                                timer: 3000
                            });

                            if (categoria == 'Advogado') {
                                window.location.href = '/system/secretaria/list/lawyers';
                            }
                            else if (categoria == 'Estagiario') {
                                window.location.href = '/system/secretaria/list/trainees';
                            }
                            else {
                                window.location.reload();
                            }
                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Número de cédula duplicado na base de dados!',
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
                        else if (res == 'duplicado-patrono') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'Cédula do Patrono duplicado na base de dados!',
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