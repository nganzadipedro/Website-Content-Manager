
let dropdown;
let id_patrono_filtrado;

escolher_patrono = document.getElementById('escolher_patrono');
acto_pretendido = document.getElementById('acto_pretendido').value;

if (acto_pretendido == 'Indicação de Patrono') {
    $('#end-estagiario').hide();
    $('#dvnomepatronoexiste').hide();
    $("#nome_patrono_existe").hide();
    $("#dvescolher_patrono").hide();
    limpaCamposPatrono();
    id_patrono_filtrado = 0;
}
else {
    $('#end-estagiario').show();
    $('#dvnomepatronoexiste').show();
    $("#nome_patrono_existe").show();
    $("#dvescolher_patrono").show();
    limpaCamposPatrono();
    id_patrono_filtrado = 0;
}

$('#end-estagiario').hide();
$('#dvnomepatronoexiste').show();
escolher_patrono.selectedIndex = 0;

patrono_id = $('#patrono_id').val();

if (patrono_id != '' && patrono_id != null && patrono_id != 0) {
    $('#end-estagiario').show();
    $('#dvnomepatronoexiste').hide();
    escolher_patrono.selectedIndex = 0;
    id_patrono_filtrado = patrono_id;
    $("#nome_patrono").prop("disabled", true);
    limpaCamposPatrono();
    getPatronoActual(id_patrono_filtrado);
}
else {
    $('#end-estagiario').show();
    $('#dvnomepatronoexiste').hide();
    escolher_patrono.selectedIndex = 0;
    $("#nome_patrono").val("Nenhum patrono adicionado");
    $("#nome_patrono").prop("disabled", true);
    $("#num_cedula_patrono").prop("disabled", true);
    $("#tel_patrono").prop("disabled", true);
    $("#email_patrono").prop("disabled", true);
    $("#nome_escritorio").prop("disabled", true);
    $("#endereco_escritorio_est").prop("disabled", true);
    $("#municipio_id_est").prop("disabled", true);
    id_patrono_filtrado = 0;
}

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

$(document).on('change', '#acto_pretendido', function () {

    const tipo = $(this).val();

    if (tipo == 'Indicação de Patrono') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').hide();
        $("#nome_patrono_existe").hide();
        $("#dvescolher_patrono").hide();
        limpaCamposPatrono();
        id_patrono_filtrado = 0;
    }
    else {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').show();
        $("#nome_patrono_existe").show();
        $("#dvescolher_patrono").show();
        limpaCamposPatrono();
        id_patrono_filtrado = 0;
    }

});

$(document).on('change', '#escolher_patrono', function () {

    const tipo = $(this).val();

    if (tipo == 'existe') {
        $('#end-estagiario').hide();
        $('#dvnomepatronoexiste').show();
        $("#nome_patrono_existe").val("");
        limpaCamposPatrono();
        id_patrono_filtrado = 0;
    }
    else if (tipo == 'novo') {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        id_patrono_filtrado = 0;
        limpaCamposPatrono();
        $("#nome_patrono").prop("disabled", false);
        $("#num_cedula_patrono").prop("disabled", false);
        $("#tel_patrono").prop("disabled", false);
        $("#email_patrono").prop("disabled", false);
        $("#nome_escritorio").prop("disabled", false);
        $("#endereco_escritorio_est").prop("disabled", false);
        $("#municipio_id_est").prop("disabled", false);
    }
    else if (tipo == 'actual') {
        $('#end-estagiario').show();
        $('#dvnomepatronoexiste').hide();
        id_patrono_filtrado = $('#patrono_id').val();
        limpaCamposPatrono();
        getPatronoActual(id_patrono_filtrado);
    }

});

function limpaCamposPatrono() {
    $("#tel_patrono").val("");
    $("#email_patrono").val("");
    $("#nome_escritorio").val("");
    $("#endereco_escritorio_est").val("");
    $("#municipio_id_est").val("");
    $("#nome_patrono").val("");
    $("#num_estagiarios").text("");
    $("#num_cedula_patrono").val("");
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

function getPatronoActual(id) {

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

                            console.log('Resposta do servidor:', data2);
                            $("#nome_patrono").val(data2[0].getpessoa.nome);
                            $("#num_cedula_patrono").val(data2[0].num_associado);
                            $("#tel_patrono").val(data2[0].getpessoa.telefone1);
                            $("#email_patrono").val(data2[0].getpessoa.email);
                            $("#nome_escritorio").val(data2[0].nome_escritorio);
                            $("#endereco_escritorio_est").val(data2[0].endereco_escritorio);
                            $("#municipio_id_est").val(data2[0].municipio_id);

                            $("#nome_patrono").prop("disabled", true);

                        })
                        .catch(error => {
                            console.error('Erro:', error);
                        });

                    getNumEstagiarios(id);

                }
                else {
                    $("#nome_patrono").val("Nenhum patrono encontrado");
                    $("#nome_patrono").prop("disabled", true);
                    id_patrono_filtrado = 0;
                }

            })
            .catch(error => {
                console.error('Erro:', error);
            });
    }
    else {
        $("#nome_patrono").val("Nenhum patrono adicionado");
        $("#nome_patrono").prop("disabled", true);
        $("#num_cedula_patrono").prop("disabled", true);
        $("#tel_patrono").prop("disabled", true);
        $("#email_patrono").prop("disabled", true);
        $("#nome_escritorio").prop("disabled", true);
        $("#endereco_escritorio_est").prop("disabled", true);
        $("#municipio_id_est").prop("disabled", true);
        id_patrono_filtrado = 0;
    }
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
    const observacao2 = document.getElementById('observacao2').value;
    escolher_patrono = document.getElementById('escolher_patrono').value;

    var nome_patrono;
    var num_cedula_patrono;
    var tel_patrono;
    var email_patrono;
    var nome_escritorio;
    var endereco_escritorio_est;
    var municipio_id_est;

    if (escolher_patrono == 'novo' || escolher_patrono == 'actual' && acto_pretendido != 'Indicação de Patrono') {
        nome_patrono = document.getElementById('nome_patrono').value;
        num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
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
    else if ((escolher_patrono == 'existe' || escolher_patrono == 'actual') && id_patrono_filtrado == 0 && acto_pretendido != 'Indicação de Patrono') {
        msgErro = "Especifique o patrono para este processo";
        tem = false;
    }
    else if ((escolher_patrono == 'novo' || escolher_patrono == 'actual') && (nome_patrono == '' || nome_patrono == null) && acto_pretendido != 'Indicação de Patrono') {
        msgErro = "Digite o nome do patrono";
        tem = false;
    }
    else if ((escolher_patrono == 'novo') && (municipio_id_est == '' || municipio_id_est == null) && acto_pretendido != 'Indicação de Patrono') {
        msgErro = "Escolha o município";
        tem = false;
    }
    else if ((escolher_patrono == 'novo') && (endereco_escritorio_est == '' || endereco_escritorio_est == null) && acto_pretendido != 'Indicação de Patrono') {
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
        const tipo_processo_id = document.getElementById('tipo_processo_id').value;
        const observacao2 = document.getElementById('observacao2').value;
        const registo_entrada_id = document.getElementById('registo_entrada_id').value;
        const escolher_patrono = document.getElementById('escolher_patrono').value;
        var patrono_id;

        nome_patrono;
        num_cedula_patrono;
        tel_patrono;
        email_patrono;
        nome_escritorio;
        endereco_escritorio_est;
        municipio_id_est;

        if ((escolher_patrono == 'novo' || escolher_patrono == 'actual') && acto_pretendido != 'Indicação de Patrono') {
            nome_patrono = document.getElementById('nome_patrono').value;
            num_cedula_patrono = document.getElementById('num_cedula_patrono').value;
            tel_patrono = document.getElementById('tel_patrono').value;
            email_patrono = document.getElementById('email_patrono').value;
            nome_escritorio = document.getElementById('nome_escritorio').value;
            endereco_escritorio_est = document.getElementById('endereco_escritorio_est').value;
            municipio_id_est = document.getElementById('municipio_id_est').value;
        }

        if (escolher_patrono == 'actual') {
            patrono_id = document.getElementById('patrono_id').value;
        }
        else if (escolher_patrono == 'existe') {
            patrono_id = id_patrono_filtrado;
        }
        else if (escolher_patrono == 'novo') {
            patrono_id = 0;
        }

        formData.append('num_bilhete', num_bilhete);
        formData.append('genero', sexo);
        formData.append('telefone1', telefone1);
        formData.append('telefone2', telefone2);
        formData.append('email', email);
        formData.append('escolher_patrono', escolher_patrono);
        formData.append('acto_pretendido', acto_pretendido);
        formData.append('observacao', observacao2);
        formData.append('registo_entrada_id', registo_entrada_id);
        formData.append('tipo_processo_id', tipo_processo_id);
        formData.append('patrono_id', patrono_id);

        if ((escolher_patrono == 'novo' || escolher_patrono == 'actual') && acto_pretendido != 'Indicação de Patrono') {
            formData.append('nome_patrono', nome_patrono);
            formData.append('num_cedula_patrono', num_cedula_patrono);
            formData.append('tel_patrono', tel_patrono);
            formData.append('email_patrono', email_patrono);
            formData.append('nome_escritorio', nome_escritorio);
            formData.append('endereco_escritorio', endereco_escritorio_est);
            formData.append('municipio_id', municipio_id_est);
        }

        Swal.fire({
            title: "Confirmação",
            text: "Tem certeza que deseja actualizar estes dados?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Salvar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return $.ajax({
                    url: "/system/editar-inscricao-estagiario/post",
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
                        else if (res == 'sucesso-cn') {
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'Dados actualizados com sucesso!',
                                timer: 3000
                            });
                            window.location.href = "/system/areatecnica/list/subscription-trainee/remetidoscn";
                        }
                        else if (res == 'duplicado') {
                            sweetAlert({
                                type: "success",
                                title: "Sucesso",
                                text: 'O número de cédula do patrono está duplicado na base de dados!',
                                timer: 3000
                            });
                        }
                        else if (res == 'bilhete') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O número do bilhete está duplicado na base de dados!',
                                timer: 3000
                            });
                        }
                        else if (res == 'maximo') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'O patrono já tem o número máximo de estagiários permitidos!',
                                timer: 4000
                            });
                        }
                        else if (res == 'sem patrono') {
                            sweetAlert({
                                type: "warning",
                                title: "Aviso",
                                text: 'É necessário selecionar um patrono para o estagiário!',
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