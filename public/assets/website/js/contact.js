document.addEventListener('DOMContentLoaded', () => {
    // Seleção de elementos para animações de carregamento
    const sections = document.querySelectorAll('.section-contact, .section-map-form');
    const titles = document.querySelectorAll('.title-page h3, .title-page h4, .contact-title-main');
    const senderType = document.getElementById('senderType');
    const identificationField = document.querySelector('.identification-field');
    const identification = document.getElementById('identification');
    const identificationLabel = document.getElementById('identificationLabel');

    // Configuração do IntersectionObserver para animações de entrada
    const observerOptions = {
        root: null,
        threshold: 0.1 // 10% do elemento visível na viewport
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Fade-In para seções
                if (entry.target.classList.contains('section-contact') || entry.target.classList.contains('section-map-form')) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transition = 'opacity 0.5s ease-out';
                }
                // Slide-Up para títulos
                if (entry.target.matches('.title-page h3, .title-page h4, .contact-title-main')) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                }
                observer.unobserve(entry.target); // Para a observação após a animação
            }
        });
    }, observerOptions);

    // Aplicar estilos iniciais e observar elementos
    sections.forEach(section => {
        section.style.opacity = '0';
        observer.observe(section);
    });

    titles.forEach(title => {
        title.style.opacity = '0';
        title.style.transform = 'translateY(20px)';
        observer.observe(title);
    });

    // Função para animar a entrada do campo de identificação
    function animateFieldIn() {
        identificationField.style.opacity = '0';
        identificationField.style.transform = 'translateY(-10px)';
        identificationField.style.display = 'block';
        setTimeout(() => {
            identificationField.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            identificationField.style.opacity = '1';
            identificationField.style.transform = 'translateY(0)';
        }, 10); // Pequeno delay para iniciar a animação
    }

    // Função para animar a saída do campo de identificação
    function animateFieldOut() {
        identificationField.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        identificationField.style.opacity = '0';
        identificationField.style.transform = 'translateY(10px)';
        setTimeout(() => {
            identificationField.style.display = 'none';
        }, 500); // Tempo igual à duração da transição
    }

    // Lógica para o select de Tipo de Remetente
    senderType.addEventListener('change', () => {
        if (senderType.value === 'advogado') {
            animateFieldIn();
            identificationLabel.textContent = 'Número da Cédula';
            identification.setAttribute('required', '');
            identification.value = ''; // Limpa o campo ao mudar
        } else if (senderType.value === 'particular') {
            animateFieldIn();
            identificationLabel.textContent = 'Número do Bilhete';
            identification.setAttribute('required', '');
            identification.value = ''; // Limpa o campo ao mudar
        } else {
            animateFieldOut();
            identificationLabel.textContent = 'Número de Identificação';
            identification.removeAttribute('required');
            identification.value = ''; // Limpa o campo ao mudar
        }
    });
});