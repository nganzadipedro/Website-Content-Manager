document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.fade-in').forEach(function(el, i) {
        setTimeout(() => el.classList.add('visible'), 200 + i * 200);
    });
})