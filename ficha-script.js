/**
 * Ficha Tecnica Interactive Features
 * - Accordion toggle
 * - Gallery carousel
 * - Tabs switching (desktop)
 */

// ========== ACCORDION FUNCTIONALITY ==========

const initAccordions = () => {
    const buttons = document.querySelectorAll('.accordion-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const isActive = this.classList.contains('active');

            // Close all accordions
            document.querySelectorAll('.accordion-btn').forEach(b => {
                b.classList.remove('active');
                b.nextElementSibling.classList.remove('active');
            });

            // Open clicked accordion if it wasn't already open
            if (!isActive) {
                this.classList.add('active');
                content.classList.add('active');
            }
        });
    });
};

    // ========== GALLERY CAROUSEL FUNCTIONALITY ==========

    const initGalleryCarousels = () => {
        const carousels = document.querySelectorAll('.galeria-carousel');

        carousels.forEach(carousel => {
            const track = carousel.querySelector('.galeria-track');
            const items = carousel.querySelectorAll('.galeria-item');
            const dotsContainer = carousel.querySelector('.galeria-dots');
            const itemsPerView = 4;

            if (items.length <= itemsPerView) {
                if (dotsContainer) dotsContainer.style.display = 'none';
                return;
            }

            const totalPages = Math.ceil(items.length / itemsPerView);
            let currentPage = 0;

            // Create dots if not already present
            if (dotsContainer && dotsContainer.children.length === 0) {
                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement('button');
                    dot.className = 'dot' + (i === 0 ? ' active' : '');
                    dot.setAttribute('aria-label', `Página ${i + 1}`);
                    dot.addEventListener('click', () => goToPage(i));
                    dotsContainer.appendChild(dot);
                }
            }

            const updateCarousel = () => {
                const offset = -currentPage * itemsPerView * (100 / itemsPerView);
                track.style.transform = `translateX(${offset}%)`;

                // Update active dot
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentPage);
                });
            };

            const goToPage = (page) => {
                currentPage = page % totalPages;
                updateCarousel();
            };

            // Auto-scroll on mobile (every 5 seconds)
            if (window.innerWidth < 768) {
                let autoScroll = setInterval(() => {
                    currentPage = (currentPage + 1) % totalPages;
                    updateCarousel();
                }, 5000);

                carousel.addEventListener('mouseenter', () => clearInterval(autoScroll));
                carousel.addEventListener('mouseleave', () => {
                    autoScroll = setInterval(() => {
                        currentPage = (currentPage + 1) % totalPages;
                        updateCarousel();
                    }, 5000);
                });
            }

            // Touch/swipe support
            let touchStartX = 0;
            track.addEventListener('touchstart', (e) => {
                touchStartX = e.touches[0].clientX;
            });

            track.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        // Swipe left - next page
                        currentPage = (currentPage + 1) % totalPages;
                    } else {
                        // Swipe right - prev page
                        currentPage = (currentPage - 1 + totalPages) % totalPages;
                    }
                    updateCarousel();
                }
            });
        });
    };

    // ========== TABS FUNCTIONALITY (DESKTOP) ==========

    const initTabs = () => {
        const tabBtns = document.querySelectorAll('.tab-btn');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabGroup = this.closest('.ficha-tabs');
                if (!tabGroup) return;

                const tabName = this.getAttribute('data-tab');
                const panes = tabGroup.querySelectorAll('.tab-pane');
                const buttons = tabGroup.querySelectorAll('.tab-btn');

                // Deactivate all tabs and panes
                buttons.forEach(b => b.classList.remove('active'));
                panes.forEach(pane => pane.classList.remove('active'));

                // Activate selected tab
                this.classList.add('active');
                const activePane = tabGroup.querySelector(`#${tabName}`);
                if (activePane) {
                    activePane.classList.add('active');
                }
            });
        });

        // Auto-activate first tab on load
        const firstBtn = document.querySelector('.tab-btn');
        if (firstBtn) {
            firstBtn.classList.add('active');
            const firstPane = document.querySelector(`#${firstBtn.getAttribute('data-tab')}`);
            if (firstPane) {
                firstPane.classList.add('active');
            }
        }
    };

// ========== SMOOTH SCROLL ==========

const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
};

// ========== INITIALIZATION ==========

const initFichaTecnica = () => {
    initAccordions();
    initGalleryCarousels();
    initTabs();
    initSmoothScroll();

    // Handle window resize for carousel
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            initGalleryCarousels();
        }, 250);
    });
};

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFichaTecnica);
} else {
    initFichaTecnica();
}
