
$('#campos-finais').hide();
$('#pg-aviso').hide();

$(document).on('click', '#btn-verificar', function () {

    $('#campos-finais').hide();
    $('#pg-aviso').hide();

    let num_verificar = $('#num_verificar').val();

    if ((num_verificar == '' || num_verificar == null)) {
        sweetAlert({
            type: "warning",
            title: "Aviso!",
            text: "Digite o número do processo",
            timer: 3000
        });
    }

    else {

        // rotina para pesquisar o advogado
        buscarDados(num_verificar);

    }

});

function buscarDados(numero) {

    let resultado = numero.split("/").join("-");

    fetch(`/system/getConsultaHistoricoProcesso/${resultado}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(data => {

            if (Object.keys(data).length === 0) {
                console.log("Objeto vazio ❌");
                $('#pg-aviso').show();
            } else {

            }

        })
        .catch(error => {
            console.log('Erro:', error);
        });
}

