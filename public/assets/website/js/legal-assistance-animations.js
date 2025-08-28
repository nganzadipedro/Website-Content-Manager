document.addEventListener('DOMContentLoaded', () => {
  // Selecionar elementos para animações
  const sections = document.querySelectorAll('.title-page, .legal-assistance-info, .section-complaints, .section-complaint-form');
  const titles = document.querySelectorAll('.title-page h3, .title-page h4, .legal-assistance-info h2, .legal-assistance-info h3, .section-complaints h4, .section-complaint-form h3');
  const paragraphs = document.querySelectorAll('.legal-assistance-info p, .section-complaints .description');
  const formFields = document.querySelectorAll('.section-complaint-form .form-control, .section-complaint-form .btn-submit');
  const hoverElements = document.querySelectorAll('.section-complaint-form .btn-submit'); // Apenas o botão do formulário

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
            entry.target.classList.contains('legal-assistance-info') ||
            entry.target.classList.contains('section-complaints') ||
            entry.target.classList.contains('section-complaint-form')) {
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

        // Slide-Left para título da legal-assistance-info, Slide-Right para subtítulo
        if (entry.target.matches('.legal-assistance-info h2')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.legal-assistance-info h3')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Up para parágrafos
        if (entry.target.matches('.legal-assistance-info p')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Right para título da section-complaints, Slide-Left para descrição
        if (entry.target.matches('.section-complaints h4')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.section-complaints .description')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        }

        // Slide-Left para título do formulário, Slide-Right e Slide-Left para campos, Slide-Up para botão
        if (entry.target.matches('.section-complaint-form h3')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.section-complaint-form .form-control')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateX(0)';
          entry.target.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        }
        if (entry.target.matches('.section-complaint-form .btn-submit')) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          entry.target.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
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
      title.style.transform = 'translateX(-100px)'; // Slide-right inicial
    } else if (title.matches('.legal-assistance-info h2')) {
      title.style.transform = 'translateX(100px)'; // Slide-left inicial
    } else if (title.matches('.legal-assistance-info h3')) {
      title.style.transform = 'translateX(-100px)'; // Slide-right inicial
    } else if (title.matches('.section-complaints h4')) {
      title.style.transform = 'translateX(-100px)'; // Slide-right inicial
    } else if (title.matches('.section-complaint-form h3')) {
      title.style.transform = 'translateX(100px)'; // Slide-left inicial
    }
    observer.observe(title);
  });

  paragraphs.forEach(paragraph => {
    paragraph.style.opacity = '0';
    if (paragraph.matches('.section-complaints .description')) {
      paragraph.style.transform = 'translateX(100px)'; // Slide-left inicial
    } else {
      paragraph.style.transform = 'translateY(20px)'; // Slide-up para legal-assistance-info
    }
    observer.observe(paragraph);
  });

  formFields.forEach((field, index) => {
    field.style.opacity = '0';
    if (field.matches('.form-control') && index === 0) {
      field.style.transform = 'translateX(-100px)'; // Slide-right para Nome
    } else if (field.matches('.form-control') && index === 1) {
      field.style.transform = 'translateX(100px)'; // Slide-left para Assunto
    } else if (field.matches('.form-control') && index === 2) {
      field.style.transform = 'translateY(20px)'; // Slide-up para Mensagem
    } else if (field.matches('.btn-submit')) {
      field.style.transform = 'translateY(20px)'; // Slide-up para botão
    }
    observer.observe(field);
  });

  // Hover com Escala Sutil e Sombra para o botão
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

  // Animação de Pulsar para o botão "Enviar" quando preenchido
  // const form = document.getElementById('complaintForm');
  // const inputs = form.querySelectorAll('input, textarea');
  // const submitBtn = form.querySelector('.btn-submit');

  // let pulseInterval = null;
  // const checkForm = () => {
  //   const allFilled = Array.from(inputs).every(input => input.value.trim() !== '');
  //   if (allFilled && !pulseInterval) {
  //     pulseInterval = setInterval(() => {
  //       submitBtn.style.transform = 'scale(1.1)';
  //       submitBtn.style.transition = 'transform 0.4s ease-in-out';
  //       setTimeout(() => {
  //         submitBtn.style.transform = 'scale(1)';
  //       }, 400);
  //     }, 2000);
  //   } else if (!allFilled && pulseInterval) {
  //     clearInterval(pulseInterval);
  //     pulseInterval = null;
  //     submitBtn.style.transform = 'scale(1)';
  //   }
  // };

  // inputs.forEach(input => input.addEventListener('input', checkForm));

  // Feedback de envio do formulário
  // form.addEventListener('submit', (e) => {
  //   e.preventDefault();
  //   submitBtn.disabled = true;
  //   submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
    
  //   // Simulação de envio (remover ou ajustar para backend real)
  //   setTimeout(() => {
  //     submitBtn.disabled = false;
  //     submitBtn.innerHTML = 'Enviar';
  //     alert('Formulário enviado com sucesso! (Simulação)');
  //     form.reset();
  //     if (pulseInterval) {
  //       clearInterval(pulseInterval);
  //       pulseInterval = null;
  //     }
  //   }, 2000);
  // });

});