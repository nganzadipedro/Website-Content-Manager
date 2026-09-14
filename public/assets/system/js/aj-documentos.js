
$(document).on('click', '.btn-preview', function () {

    // Pega o data-id do <a> clicado
    let id = $(this).data('id');

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "/system/secretaria/imprimirpdf-assistencia";
    form.target = "_blank";

    // CSRF
    const csrf = document.createElement("input");
    csrf.type = "hidden";
    csrf.name = "_token";
    csrf.value = document.querySelector('meta[name="csrf-token"]').content;
    form.appendChild(csrf);

    // Dados que quer enviar
    const dados = document.createElement("input");
    dados.type = "hidden";
    dados.name = "hash_registo";
    dados.value = id;
    form.appendChild(dados);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);

});
