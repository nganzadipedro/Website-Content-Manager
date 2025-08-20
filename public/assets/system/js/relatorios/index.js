
$("#filtro1").change(function () {

    var filtro = document.getElementById('filtro1');

    if (filtro.checked)
        $("#dv-provincia").show();
    else
        $("#dv-provincia").hide();

});

$("#exame2").change(function () {

    var filtro = document.getElementById('exame2');

    if (filtro.checked) {
        $("#dv-provincia-2").hide();
    }
});

$("#exame1").change(function () {

    var filtro = document.getElementById('exame1');

    if (filtro.checked) {
        $("#dv-provincia-2").show();
    }
});

function validacao() {

    var filtro = document.getElementById('exame1');
    var provincia = document.getElementById('provincia_exame_id').selectedIndex;

    if (filtro.checked) {
        if (provincia == 0) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: 'Escolha a Província do Exame',
                timer: 4000
            });
            return false;
        }
        else
            return true;
    }
}

function validacao1() {

    var provincia = document.getElementById('provincia_exame').selectedIndex;
    var filtro = document.getElementById('filtro1');

    if (filtro.checked) {
        if (provincia == 0) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: 'Escolha a Província do Exame',
                timer: 4000
            });
            return false;
        }
        else
            return true;
    }

}