document.addEventListener('DOMContentLoaded', () => {
    const sliderTrack = document.querySelector('.section-brands .slider-track');
    const logos = sliderTrack.querySelectorAll('.brand-logo');

    // Duplicate logos for infinite scroll
    logos.forEach(logo => {
        const clone = logo.cloneNode(true);
        sliderTrack.appendChild(clone);
    });
});