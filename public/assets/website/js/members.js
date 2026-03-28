// Troca o placeholder do input de pesquisa
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('search-select');
    const input = document.querySelector('.search-section input[type="text"]');

    function updatePlaceholder() {
        switch (select.value) {
            case 'nome':
                input.placeholder = 'Digite o nome do advogado para pesquisar...';
                break;
            case 'cedula':
                input.placeholder = 'Digite o número da cédula para pesquisar...';
                break;
            case 'bi':
                input.placeholder = 'Digite o número do BI para pesquisar...';
                break;
            default:
                input.placeholder = 'Digite para pesquisar...';
        }
    }

    select.addEventListener('change', updatePlaceholder);
    updatePlaceholder();
});

// Animação de fade-in
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll('.section-statistics, .members-section,.members-section2, .search-section');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.2 });

    sections.forEach(section => observer.observe(section));
});

// Interatividade de pesquisa de associados
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.search-section form');
    const input = form.querySelector('input');
    const results = document.querySelectorAll('.search-results li');
    const noneResult = document.querySelector('.none-result');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const query = input.value.trim().toLowerCase();
        let found = false;

        results.forEach(li => {
            const name = li.querySelector('.member-name').textContent.toLowerCase();
            if (name.includes(query)) {
                li.style.display = '';
                found = true;
            } else {
                li.style.display = 'none';
            }
        });

        noneResult.style.display = found ? 'none' : 'block';
    });

    // Limpa filtro ao apagar texto
    input.addEventListener('input', function () {
        if (input.value.trim() === '') {
            results.forEach(li => li.style.display = '');
            noneResult.style.display = 'none';
        }
    });
});

$("#dv-search-results").hide();
$("#pg-none-result").hide();

document.getElementById('btn-search').addEventListener('click', function () {

    if (valida_formulario() === true) {

        const formData = new FormData();

        const text_search = document.getElementById('text-search').value;
        const search_select = document.getElementById('search-select').value;

        formData.append('text_search', text_search);
        formData.append('search_select', search_select);

        const dvrs = document.getElementById('dv-search-results');
        const ul_elements = document.getElementById('ul-elements');
        dvrs.style.display = 'none';

        return $.ajax({
            url: "/search-lawyer/post",
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

                var elementos = '';
                var num_cedula = '';
                ul_elements.innerHTML = elementos;

                if (res.rows.length == 0) {

                    $("#pg-none-result").show();

                } else {

                    $("#pg-none-result").hide();
                    dvrs.style.display = 'block';

                    res.rows.forEach(item => {

                        if (item.categoria == 'Estagiario') {
                            num_cedula = item.num_estagiario;

                            elementos += `<li>
                        <div class="member-info">
                            <span class="member-name">${item.nome}</span>
                            <div>Email: ${item.email}</div>
                            <div>Telefone: ${item.telefone1}</div>
                        </div>
                        <div class="member-details">
                            <div>Cédula Patrono: [ Não Definido ] </div>
                            <div>Nome Patrono: [ Não Definido ] </div>
                        </div>
                        <span class="number-card">Cédula N.º ${num_cedula}</span>
                    </li>`;

                        }
                        else {
                            num_cedula = item.num_associado;

                            elementos += `<li>
                        <div class="member-info">
                            <span class="member-name">${item.nome}</span>
                            <div>Email: ${item.email}</div>
                            <div>Telefone: ${item.telefone1}</div>
                        </div>
                        <span class="number-card">Cédula N.º ${num_cedula}</span>
                    </li>`;

                        }

                    });

                    ul_elements.innerHTML = elementos;

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

function valida_formulario() {

    var msgErro = '';
    var tem = true;

    const text_search = document.getElementById('text-search').value;


    if (text_search == '' || text_search == null) {
        msgErro = "Digite o que deseja pesquisar";
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