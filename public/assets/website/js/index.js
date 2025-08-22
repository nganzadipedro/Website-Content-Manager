document.addEventListener('DOMContentLoaded', () => {
  // Selecionar elementos para animações
  const sections = document.querySelectorAll('.section-president, .section-feature, .section-about, .section-values, .section-team');
  const titles = document.querySelectorAll('.section-president h2, .section-president h3, .section-feature h3, .section-about h3, .section-about h4, .section-values h3, .section-team h3, .section-team h4');
  const images = document.querySelectorAll('.section-president img, .section-feature img, .section-team img');
  const hoverElements = document.querySelectorAll('.section-feature a, .section-about a, .section-values a, .section-team a, .membro, .hiperlikns a'); // Removido .section-menu a
  const footerLinks = document.querySelectorAll('.hiperlikns a');
  const saibaMais = document.querySelector('.section-feature a');
  const scrollArrow = document.querySelector('.scroll-down-arrow');

  // Configurar IntersectionObserver para animações
  const observerOptions = {
    root: null,
    threshold: 0.1 // 10% do elemento visível na viewport
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Fade-In para seções
        if (entry.target.classList.contains('section-president') || 
            entry.target.classList.contains('section-feature') || 
            entry.target.classList.contains('section-about') || 
            entry.target.classList.contains('section-values') || 
            entry.target.classList.contains('section-team')) {
          entry.target.style.opacity = '1';
          entry.target.style.transition = 'opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para títulos
        if (entry.target.matches('h2, h3, h4')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide Right para imagem do presidente e Slide Left para imagem em destaque
        if (entry.target.matches('.section-president img')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
        }
        if (entry.target.matches('.section-feature img')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
        }
        if (entry.target.matches('.section-team img')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'scale(1)';
          entry.target.style.transition = 'opacity 0.8s ease-in-out, transform 0.8s ease-in-out';
        }

        // Deslocamento Lateral para links do footer
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
    if (image.closest('.section-president')) {
      image.style.transform = 'translateX(-100px)'; // Slide Right inicial (esquerda)
    } else if (image.closest('.section-feature')) {
      image.style.transform = 'translateX(100px)'; // Slide Left inicial (direita)
    } else if (image.closest('.section-team')) {
      image.style.transform = 'scale(0.95)'; // Escala inicial para equipe
    }
    observer.observe(image);
  });

  footerLinks.forEach(link => {
    link.style.opacity = '0';
    link.style.transform = 'translateX(-10px)';
    observer.observe(link);
  });

  // Hover com Escala Sutil e Sombra, apenas para elementos fora da navbar
  hoverElements.forEach(element => {
    element.style.willChange = 'transform, box-shadow';
    element.style.transformOrigin = 'center';
    element.addEventListener('mouseenter', () => {
      element.style.transform = 'scale(1.05)';
      // element.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
      element.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
    });
    element.addEventListener('mouseleave', () => {
      element.style.transform = 'scale(1)';
      element.style.boxShadow = 'none';
      element.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
    });
    element.addEventListener('focus', (e) => {
      e.preventDefault();
      element.blur();
    }, { passive: true });
  });

  // Animação de Pulsar para "Saiba Mais"
  if (saibaMais) {
    setInterval(() => {
      saibaMais.style.transform = 'scale(1.1)';
      saibaMais.style.transition = 'transform 0.4s ease-in-out';
      setTimeout(() => {
        saibaMais.style.transform = 'scale(1)';
      }, 400);
    }, 2000);
  }

  // Animação de Pulsar para a Seta de Rolagem
  if (scrollArrow) {
    setInterval(() => {
      scrollArrow.style.transform = 'translateY(10px)';
      scrollArrow.style.opacity = '0.5';
      scrollArrow.style.transition = 'transform 0.6s ease-in-out, opacity 0.6s ease-in-out';
      setTimeout(() => {
        scrollArrow.style.transform = 'translateY(0)';
        scrollArrow.style.opacity = '1';
      }, 600);
    }, 1200);
  }
});