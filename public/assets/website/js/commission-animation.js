document.addEventListener('DOMContentLoaded', () => {
  // Selecionar elementos para animações
  const sections = document.querySelectorAll('.commission, .commissions-header');
  const titles = document.querySelectorAll('.commissions-header h3, .commissions-header h4, .commission h2');
  const images = document.querySelectorAll('.commission-member img');
  const hoverElements = document.querySelectorAll('.hiperlikns a, .commission-member');
  const footerLinks = document.querySelectorAll('.hiperlikns a');

  // Configurar IntersectionObserver para animações
  const observerOptions = {
    root: null,
    threshold: 0.1 // 10% do elemento visível na viewport
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Fade-In para seções
        if (entry.target.classList.contains('commission') || 
            entry.target.classList.contains('commissions-header')) {
          entry.target.style.opacity = '1';
          entry.target.style.transition = 'opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para títulos
        if (entry.target.matches('h2, h3, h4')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Right para imagens dos membros
        if (entry.target.matches('.commission-member img')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
        }

        // Deslocamento Lateral para links do rodapé
        if (entry.target.matches('.hiperlikns a')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.5s ease-in, transform 0.5s ease-in';
        }

        // Parar de observar após a animação
        observer.unobserve(entry.target);
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

  images.forEach(image => {
    image.style.opacity = '0';
    image.style.transform = 'translateX(-100px)'; // Slide-Right inicial (esquerda)
    observer.observe(image);
  });

  footerLinks.forEach(link => {
    link.style.opacity = '0';
    link.style.transform = 'translateX(-10px)';
    observer.observe(link);
  });

  // Hover com Escala Sutil para links e membros
  hoverElements.forEach(element => {
    element.style.willChange = 'transform';
    element.style.transformOrigin = 'center';
    element.addEventListener('mouseenter', () => {
      element.style.transform = 'scale(1.05)';
      element.style.transition = 'transform 0.3s ease';
    });
    element.addEventListener('mouseleave', () => {
      element.style.transform = 'scale(1)';
      element.style.transition = 'transform 0.3s ease';
    });
    element.addEventListener('focus', (e) => {
      e.preventDefault();
      element.blur();
    }, { passive: true });
  });
});