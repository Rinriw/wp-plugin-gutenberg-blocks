/**
 * Testimonials Carousel Block
 * Funcionalidad interactiva con vanilla JS: swipe, autoplay, navegación keyboard
 */

class TestimonialsCarousel {
    constructor(container) {
        this.container = container;
        this.carousel = container.querySelector('[data-carousel="testimonials"]');
        this.list = this.carousel.querySelector('.acfb-carousel-list');
        this.items = Array.from(this.list.querySelectorAll('.acfb-carousel-item'));
        this.prevBtn = this.carousel.querySelector('.acfb-carousel-prev');
        this.nextBtn = this.carousel.querySelector('.acfb-carousel-next');
        this.dots = Array.from(container.querySelectorAll('.acfb-carousel-dot'));
        
        // Configuración
        this.currentIndex = 0;
        this.autoplay = container.dataset.autoplay === 'true';
        this.autoplaySpeed = parseInt(container.dataset.autoplaySpeed || 5) * 1000;
        this.autoplayTimeout = null;
        
        // Touch/Swipe
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.isDragging = false;
        
        this.init();
    }

    init() {
        // Event Listeners: Navegación
        if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prev());
        if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.next());
        
        // Event Listeners: Dots
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });
        
        // Event Listeners: Touch/Swipe
        this.list.addEventListener('touchstart', (e) => this.handleTouchStart(e), false);
        this.list.addEventListener('touchend', (e) => this.handleTouchEnd(e), false);
        
        // Event Listeners: Keyboard
        this.container.addEventListener('keydown', (e) => this.handleKeyboard(e));
        
        // Event Listeners: Hover (pausa autoplay)
        this.carousel.addEventListener('mouseenter', () => this.pauseAutoplay());
        this.carousel.addEventListener('mouseleave', () => this.startAutoplay());
        
        // Iniciar autoplay si está habilitado
        if (this.autoplay) {
            this.startAutoplay();
        }
        
        // Mostrar el primer slide
        this.updateCarousel();
    }

    /**
     * Navegar al slide anterior
     */
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
        this.restartAutoplay();
        this.updateCarousel();
    }

    /**
     * Navegar al siguiente slide
     */
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.items.length;
        this.restartAutoplay();
        this.updateCarousel();
    }

    /**
     * Ir a un slide específico
     */
    goToSlide(index) {
        if (index >= 0 && index < this.items.length) {
            this.currentIndex = index;
            this.restartAutoplay();
            this.updateCarousel();
        }
    }

    /**
     * Actualizar la visualización del carrusel
     */
    updateCarousel() {
        // Actualizar posición del carrusel (desktop: scrollear 3 items, mobile: 1 item)
        const isMobile = window.innerWidth < 768;
        const itemsPerView = isMobile ? 1 : 3;
        const translateX = -(this.currentIndex * (100 / itemsPerView));
        
        this.list.style.transform = `translateX(${translateX}%)`;
        
        // Actualizar atributos ARIA
        this.items.forEach((item, index) => {
            const isActive = index === this.currentIndex;
            item.setAttribute('aria-selected', isActive ? 'true' : 'false');
            item.classList.toggle('acfb-active', isActive);
        });
        
        // Actualizar dots
        this.dots.forEach((dot, index) => {
            const isActive = index === this.currentIndex;
            dot.classList.toggle('acfb-active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    }

    /**
     * Handle touch start
     */
    handleTouchStart(e) {
        this.touchStartX = e.changedTouches[0].screenX;
        this.isDragging = true;
        this.pauseAutoplay();
    }

    /**
     * Handle touch end (swipe detection)
     */
    handleTouchEnd(e) {
        this.touchEndX = e.changedTouches[0].screenX;
        this.isDragging = false;
        this.handleSwipe();
        this.restartAutoplay();
    }

    /**
     * Detectar dirección del swipe
     */
    handleSwipe() {
        const diff = this.touchStartX - this.touchEndX;
        const minSwipeDistance = 50;
        
        if (Math.abs(diff) < minSwipeDistance) return;
        
        if (diff > 0) {
            // Swipe izquierda = siguiente
            this.next();
        } else {
            // Swipe derecha = anterior
            this.prev();
        }
    }

    /**
     * Navegación con teclado
     */
    handleKeyboard(e) {
        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            this.prev();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            this.next();
        }
    }

    /**
     * Iniciar autoplay
     */
    startAutoplay() {
        if (!this.autoplay) return;
        
        this.autoplayTimeout = setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.items.length;
            this.updateCarousel();
        }, this.autoplaySpeed);
    }

    /**
     * Pausar autoplay
     */
    pauseAutoplay() {
        if (this.autoplayTimeout) {
            clearInterval(this.autoplayTimeout);
            this.autoplayTimeout = null;
        }
    }

    /**
     * Reiniciar autoplay (útil cuando el usuario interactúa)
     */
    restartAutoplay() {
        this.pauseAutoplay();
        if (this.autoplay) {
            this.startAutoplay();
        }
    }

    /**
     * Destruir la instancia (cleanup)
     */
    destroy() {
        this.pauseAutoplay();
        if (this.prevBtn) this.prevBtn.removeEventListener('click', () => this.prev());
        if (this.nextBtn) this.nextBtn.removeEventListener('click', () => this.next());
        this.dots.forEach((dot) => {
            dot.removeEventListener('click', () => this.goToSlide());
        });
        this.list.removeEventListener('touchstart', (e) => this.handleTouchStart(e));
        this.list.removeEventListener('touchend', (e) => this.handleTouchEnd(e));
        this.container.removeEventListener('keydown', (e) => this.handleKeyboard(e));
    }
}

/**
 * Inicializar todas las instancias de carruseles en la página
 */
document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('.acf-block-testimonials-carousel');
    
    carousels.forEach((carousel) => {
        new TestimonialsCarousel(carousel);
    });
});

// Re-inicializar en caso de Dynamic Blocks (Gutenberg)
if (window.wp && window.wp.hooks) {
    window.wp.hooks.addAction(
        'blocks.afterBlocksRegister',
        'acfb/testimonials-carousel',
        () => {
            const carousels = document.querySelectorAll('.acf-block-testimonials-carousel');
            carousels.forEach((carousel) => {
                // Evitar inicializaciones duplicadas
                if (!carousel.dataset.initialized) {
                    new TestimonialsCarousel(carousel);
                    carousel.dataset.initialized = 'true';
                }
            });
        }
    );
}
