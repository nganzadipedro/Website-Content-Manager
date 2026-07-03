document.addEventListener("DOMContentLoaded", () => {

    $(document).on('click', '#btn-gerar', function () {

        const data_inicial = document.getElementById('data_inicial').value;
        const data_final = document.getElementById('data_final').value;

        if (data_inicial == '' || data_inicial == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data inicial para gerar o relatório",
                timer: 4000
            });
        }
        else if (data_final == '' || data_final == null) {
            sweetAlert({
                type: "warning",
                title: "Aviso!",
                text: "Informe a data final para gerar o relatório",
                timer: 4000
            });
        }
        else {

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "/system/relatorio";
            form.target = "_blank";

            // CSRF
            const csrf = document.createElement("input");
            csrf.type = "hidden";
            csrf.name = "_token";
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            form.appendChild(csrf);

            // Dados que quer enviar
            const dados1 = document.createElement("input");
            dados1.type = "hidden";
            dados1.name = "data_inicial";
            dados1.value = data_inicial;

            const dados2 = document.createElement("input");
            dados2.type = "hidden";
            dados2.name = "data_final";
            dados2.value = data_final;

            form.appendChild(dados1);
            form.appendChild(dados2);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);

        }

    });

});