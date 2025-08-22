document.addEventListener('DOMContentLoaded', () => {
    // Configurar slider
    const slider = document.getElementById('commission-communication-slider');
    const track = slider.querySelector('.slider-track');
    const items = track.querySelectorAll('.commission-member');
    const dotsContainer = slider.querySelector('.slider-dots');
    let currentIndex = 0;
    let autoPlayInterval = null;
    let perView = 4;
    let isTransitioning = false;

    // Calcular número de slides baseado no total de itens e perView
    const updateSlidesCount = () => {
        return Math.ceil(items.length / perView);
    };
    let slidesCount = updateSlidesCount();

    // Criar indicadores (dots)
    const createDots = () => {
        dotsContainer.innerHTML = '';
        for (let i = 0; i < slidesCount; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
    };
    createDots();

    // Atualizar visibilidade dos itens
    const updateSlider = () => {
        items.forEach((item, index) => {
            const slideIndex = Math.floor(index / perView);
            const isVisible = currentIndex === slideIndex && 
                             (currentIndex < slidesCount - 1 || (currentIndex === slidesCount - 1 && index < items.length));
            item.classList.toggle('visible', isVisible);
            item.style.transform = isVisible ? 'translateX(0)' : 
                (index < currentIndex * perView ? 'translateX(-100px)' : 'translateX(100px)');
        });

        // Atualizar indicadores
        dotsContainer.querySelectorAll('.dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    };

    // Ir para um slide específico
    const goToSlide = (index) => {
        if (isTransitioning || index >= slidesCount) return;
        isTransitioning = true;
        currentIndex = index;
        track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = `translateX(-${(currentIndex * 100)}%)`;
        updateSlider();

        setTimeout(() => {
            isTransitioning = false;
        }, 600);
    };

    // Próximo slide
    const nextSlide = () => {
        if (isTransitioning) return;
        isTransitioning = true;
        currentIndex = (currentIndex + 1) % slidesCount;
        track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = `translateX(-${(currentIndex * 100)}%)`;
        updateSlider();

        setTimeout(() => {
            isTransitioning = false;
        }, 600);
    };

    // Slide anterior
    const prevSlide = () => {
        if (isTransitioning) return;
        isTransitioning = true;
        currentIndex = (currentIndex - 1 + slidesCount) % slidesCount;
        track.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = `translateX(-${(currentIndex * 100)}%)`;
        updateSlider();

        setTimeout(() => {
            isTransitioning = false;
        }, 600);
    };

    // Suporte a toque (swipe)
    let touchStartX = 0;
    let touchEndX = 0;
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
    });
    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].clientX;
        if (touchStartX - touchEndX > 50) nextSlide();
        if (touchEndX - touchStartX > 50) prevSlide();
    });

    // Autoplay
    const startAutoPlay = () => {
        autoPlayInterval = setInterval(nextSlide, 5000);
    };
    const stopAutoPlay = () => {
        clearInterval(autoPlayInterval);
    };
    startAutoPlay();
    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);

    // Animação de entrada com IntersectionObserver
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                slider.style.opacity = '1';
                slider.style.transform = 'translateY(0)';
                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.add('visible');
                    }, (index % items.length) * 100);
                });
                observer.unobserve(slider);
            }
        });
    }, { root: null, threshold: 0.1 });

    slider.style.opacity = '0';
    slider.style.transform = 'translateY(20px)';
    observer.observe(slider);

    // Inicializar slider
    track.style.transform = `translateX(0%)`;
    updateSlider();

    // Ajustar número de itens por visualização com base no tamanho da tela
    const updatePerView = () => {
        const prevPerView = perView;
        const containerWidth = slider.offsetWidth;
        if (containerWidth <= 576) {
            perView = 1;
        } else if (containerWidth <= 768) {
            perView = 2;
        } else if (containerWidth <= 992) {
            perView = 3;
        } else {
            perView = 4;
        }
        if (perView !== prevPerView) {
            track.style.transition = 'none';
            slidesCount = updateSlidesCount();
            createDots();
            currentIndex = Math.min(currentIndex, slidesCount - 1);
            if (currentIndex < 0) currentIndex = 0;
            track.style.transform = `translateX(-${(currentIndex * 100)}%)`;
            updateSlider();
        }
    };
    window.addEventListener('resize', updatePerView);
    updatePerView();
});