document.addEventListener('DOMContentLoaded', () => {
  // Selecionar elementos para animações
  const sections = document.querySelectorAll('.title-page, .section-services, .section-cta');
  const titles = document.querySelectorAll('.title-page h3, .title-page h4, .section-services .item-service .header h3, .section-cta .text-area .title, .section-cta .text-area .subtitle');
  const paragraphs = document.querySelectorAll('.section-services .item-service .body p, .section-cta .text-area .subtitle');
  const buttons = document.querySelectorAll('.section-services .item-service .body a, .section-cta .text-area a');
  const serviceItems = document.querySelectorAll('.section-services .item-service');
  const ctaImage = document.querySelector('.section-cta img');
  const hoverElements = document.querySelectorAll('.section-services .item-service .body a, .section-cta .text-area a');

  // Configurar IntersectionObserver para animações
  const observerOptions = {
    root: null,
    threshold: 0.1 // 10% do elemento visível na viewport
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Fade-In para seções
        if (entry.target.classList.contains('title-page') ||
            entry.target.classList.contains('section-services') ||
            entry.target.classList.contains('section-cta')) {
          entry.target.style.opacity = '1';
          entry.target.style.transition = 'opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para título principal da title-page, Slide-Right para subtítulo
        if (entry.target.matches('.title-page h3')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.title-page h4')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Left para títulos dos itens de serviço
        if (entry.target.matches('.section-services .item-service .header h3')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para parágrafos dos itens de serviço
        if (entry.target.matches('.section-services .item-service .body p')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Right para título da section-cta, Slide-Left para subtítulo
        if (entry.target.matches('.section-cta .text-area .title')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.section-cta .text-area .subtitle')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para botões
        if (entry.target.matches('.section-services .item-service .body a') ||
            entry.target.matches('.section-cta .text-area a')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Fade-In e Scale para itens de serviço
        if (entry.target.matches('.section-services .item-service')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'scale(1)';
          entry.target.style.transition = 'opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Fade-In e Slide-Left para imagem da section-cta
        if (entry.target.matches('.section-cta img')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
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
    if (title.matches('.title-page h3')) {
      title.style.transform = 'translateY(20px)';
    } else if (title.matches('.title-page h4')) {
      title.style.transform = 'translateX(-100px)';
    } else if (title.matches('.section-services .item-service .header h3')) {
      title.style.transform = 'translateX(100px)';
    } else if (title.matches('.section-cta .text-area .title')) {
      title.style.transform = 'translateX(-100px)';
    } else if (title.matches('.section-cta .text-area .subtitle')) {
      title.style.transform = 'translateX(100px)';
    }
    observer.observe(title);
  });

  paragraphs.forEach(paragraph => {
    paragraph.style.opacity = '0';
    paragraph.style.transform = 'translateY(20px)';
    observer.observe(paragraph);
  });

  buttons.forEach(button => {
    button.style.opacity = '0';
    button.style.transform = 'translateY(20px)';
    observer.observe(button);
  });

  serviceItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'scale(0.95)';
    observer.observe(item);
  });

  if (ctaImage) {
    ctaImage.style.opacity = '0';
    ctaImage.style.transform = 'translateX(100px)';
    observer.observe(ctaImage);
  }

  // Hover com Escala Sutil e Sombra para botões e links
  hoverElements.forEach(element => {
    element.style.willChange = 'transform, box-shadow';
    element.style.transformOrigin = 'center';
    element.addEventListener('mouseenter', () => {
      element.style.transform = 'scale(1.05)';
      element.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
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
});