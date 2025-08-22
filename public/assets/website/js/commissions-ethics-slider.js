document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('commission-ethics-grid');
    const items = grid.querySelectorAll('.ethics-member');

    // Animação de entrada com IntersectionObserver
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 100); // Atraso progressivo para cada item
                observer.unobserve(entry.target);
            }
        });
    }, { root: null, threshold: 0.1 });

    items.forEach(item => {
        observer.observe(item);
    });
});