document.addEventListener('DOMContentLoaded', () => { 
    const categoryButtons = document.querySelectorAll('.category-button'); 
    const imageCards = document.querySelectorAll('.image-card'); 
    const lightboxOverlay = document.getElementById('lightboxOverlay'); 
    const lightboxImage = document.getElementById('lightboxImage'); 
    const lightboxPrev = document.getElementById('lightboxPrev'); 
    const lightboxNext = document.getElementById('lightboxNext'); 
    const lightboxClose = document.getElementById('lightboxClose'); 

    let currentImageIndex = 0; 
    let filteredImages = []; 

    // Filtra imagens por categoria
    const filterImages = (selectedCategory) => { 
        filteredImages = []; 
        imageCards.forEach(card => { 
            const cardCategory = card.dataset.category; 
            if (selectedCategory === 'all' || cardCategory === selectedCategory) { 
                card.classList.remove('hidden'); 
                filteredImages.push(card.querySelector('img')); 
            } else { 
                card.classList.add('hidden'); 
            } 
        }); 
    }; 

    categoryButtons.forEach(button => { 
        button.addEventListener('click', () => { 
            categoryButtons.forEach(btn => btn.classList.remove('active')); 
            button.classList.add('active'); 
            const selectedCategory = button.dataset.category; 
            filterImages(selectedCategory); 
        }); 
    }); 

    imageCards.forEach((card) => { 
        card.addEventListener('click', () => { 
            const currentActiveCategoryButton = document.querySelector('.category-button.active'); 
            const currentSelectedCategory = currentActiveCategoryButton ? 
                currentActiveCategoryButton.dataset.category : 'all'; 
            filterImages(currentSelectedCategory); 

            const clickedImageSrc = card.querySelector('img').src; 
            currentImageIndex = filteredImages.findIndex(img => img.src === clickedImageSrc); 

            lightboxImage.src = filteredImages.length > 0 ? filteredImages[currentImageIndex].src : ''; 
            lightboxOverlay.classList.add('visible'); 
        }); 
    }); 

    lightboxClose.addEventListener('click', () => { 
        lightboxOverlay.classList.remove('visible'); 
    }); 
    lightboxOverlay.addEventListener('click', (event) => { 
        if (event.target === lightboxOverlay) { 
            lightboxOverlay.classList.remove('visible'); 
        } 
    }); 

    lightboxPrev.addEventListener('click', () => { 
        currentImageIndex--; 
        if (currentImageIndex < 0) { 
            currentImageIndex = filteredImages.length - 1; 
        } 
        lightboxImage.src = filteredImages[currentImageIndex].src; 
    }); 
    lightboxNext.addEventListener('click', () => { 
        currentImageIndex++; 
        if (currentImageIndex >= filteredImages.length) { 
            currentImageIndex = 0; 
        } 
        lightboxImage.src = filteredImages[currentImageIndex].src; 
    }); 

    // Inicializa a galeria exibindo todas as imagens
    filterImages('all'); 

    // Animação POP-IN no carregamento
    imageCards.forEach((card, index) => { 
        card.style.opacity = '0'; 
        card.style.transform = 'scale(0.5)'; 
        card.style.transition = 'opacity 0.5s ease-out, transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)'; 
        const delay = index * 100; 
        setTimeout(() => { 
            card.style.opacity = '1';  
            card.style.transform = 'scale(1)';  
        }, delay); 
    }); 
});