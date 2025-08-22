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