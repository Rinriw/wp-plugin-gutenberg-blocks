/**
 * Gallery Block - Carrusel Vanilla JS
 * 
 * Maneja la interactividad del carrusel en mobile
 * Solo se ejecuta en viewports < md (< 768px)
 */

(function() {
    'use strict';

    // Verificar si estamos en mobile
    function isMobile() {
        return window.innerWidth < 768;
    }

    // Inicializar carrusel
    function initCarousel(carouselEl) {
        const track = carouselEl.querySelector('.gallery-track');
        const indicators = carouselEl.querySelectorAll('.gallery-indicator');
        
        if (!track || indicators.length === 0) return;

        let currentIndex = 0;
        let isScrolling = false;

        // Actualizar indicadores
        function updateIndicators() {
            indicators.forEach((indicator, index) => {
                if (index === currentIndex) {
                    indicator.classList.add('acfb-bg-primary-500', 'acfb-w-6');
                    indicator.classList.remove('acfb-bg-secondary-300', 'acfb-w-2');
                } else {
                    indicator.classList.remove('acfb-bg-primary-500', 'acfb-w-6');
                    indicator.classList.add('acfb-bg-secondary-300', 'acfb-w-2');
                }
            });
        }

        // Detectar scroll del carrusel
        function handleScroll() {
            if (isScrolling) return;
            
            isScrolling = true;
            
            setTimeout(() => {
                const scrollLeft = track.scrollLeft;
                const slideWidth = track.offsetWidth;
                const newIndex = Math.round(scrollLeft / slideWidth);
                
                if (newIndex !== currentIndex) {
                    currentIndex = newIndex;
                    updateIndicators();
                }
                
                isScrolling = false;
            }, 100);
        }

        // Click en indicadores
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                const slideWidth = track.offsetWidth;
                track.scrollTo({
                    left: slideWidth * index,
                    behavior: 'smooth'
                });
                updateIndicators();
            });
        });

        // Escuchar scroll
        track.addEventListener('scroll', handleScroll);

        // Touch swipe mejorado
        let touchStartX = 0;
        let touchEndX = 0;

        track.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        track.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0 && currentIndex < indicators.length - 1) {
                    // Swipe left
                    currentIndex++;
                } else if (diff < 0 && currentIndex > 0) {
                    // Swipe right
                    currentIndex--;
                }
                
                const slideWidth = track.offsetWidth;
                track.scrollTo({
                    left: slideWidth * currentIndex,
                    behavior: 'smooth'
                });
                updateIndicators();
            }
        }

        // Inicializar indicadores
        updateIndicators();

        // Intersection Observer para lazy loading mejorado
        if ('IntersectionObserver' in window) {
            const images = track.querySelectorAll('img[loading="lazy"]');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px'
            });

            images.forEach(img => imageObserver.observe(img));
        }
    }

    // Inicializar todos los carruseles en la página
    function initAllCarousels() {
        if (!isMobile()) return;

        const carousels = document.querySelectorAll('[data-carousel]');
        carousels.forEach(carousel => initCarousel(carousel));
    }

    // Ejecutar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllCarousels);
    } else {
        initAllCarousels();
    }

    // Reinicializar en resize (con debounce)
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            initAllCarousels();
        }, 250);
    });

})();
