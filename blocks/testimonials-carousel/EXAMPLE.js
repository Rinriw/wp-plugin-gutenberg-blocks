/**
 * Ejemplo de uso del Testimonials Carousel
 * 
 * Este archivo muestra cómo se estructura el block.json y los datos
 * que se usan en el renderizado.
 */

// =============================================================================
// CONFIGURACIÓN DEL BLOQUE EN block.json
// =============================================================================

/*
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "acf/testimonials-carousel",
  "title": "Testimonios Carousel",
  "description": "Carrusel de testimonios de clientes con rotación automática",
  "category": "acf-blocks",
  "icon": "format-quote",
  "keywords": ["testimonios", "carousel", "opiniones", "clientes", "review"],
  "acf": {
    "mode": "preview",
    "renderTemplate": "render.php",
    "blockVersion": 3
  },
  "supports": {
    "align": ["wide", "full"],
    "anchor": true,
    "customClassName": true
  }
}
*/

// =============================================================================
// DATOS DE CAMPOS ACF (Ejemplo)
// =============================================================================

const EXAMPLE_DATA = {
  // Array de testimonios (repeater)
  testimonials: [
    {
      author_name: "María García",
      author_role: "CEO en TechCorp",
      author_image: {
        url: "/wp-content/uploads/2024/maria-garcia.jpg",
        alt: "María García"
      },
      testimonial_text: "Excelente servicio, muy profesionales y rápidos. El equipo resolvió todos nuestros problemas en tiempo récord. Recomendados 100%.",
      rating: 5
    },
    {
      author_name: "Juan López",
      author_role: "Founder de StartupX",
      author_image: {
        url: "/wp-content/uploads/2024/juan-lopez.jpg",
        alt: "Juan López"
      },
      testimonial_text: "La calidad del trabajo es impecable. Desde el primer contacto mostró gran disposición y entendimiento de nuestras necesidades.",
      rating: 5
    },
    {
      author_name: "Sofia Martínez",
      author_role: "Marketing Manager en BrandCo",
      author_image: {
        url: "/wp-content/uploads/2024/sofia-martinez.jpg",
        alt: "Sofia Martínez"
      },
      testimonial_text: "Superaron nuestras expectativas. El proyecto se completó antes de lo previsto y con excelente comunicación.",
      rating: 4
    },
    {
      author_name: "Carlos Ruiz",
      author_role: "CTO en DevStudio",
      author_image: {
        url: "/wp-content/uploads/2024/carlos-ruiz.jpg",
        alt: "Carlos Ruiz"
      },
      testimonial_text: "Profesionalismo de principio a fin. Excelente atención al detalle y seguimiento continuado del proyecto.",
      rating: 5
    },
    {
      author_name: "Laura Fernández",
      author_role: "Directora de Operaciones en EmpresaZ",
      author_image: {
        url: "/wp-content/uploads/2024/laura-fernandez.jpg",
        alt: "Laura Fernández"
      },
      testimonial_text: "Un equipo muy profesional y dedicado. Lograron entender perfectamente nuestra visión y la ejecutaron impecablemente.",
      rating: 5
    }
  ],
  
  // Configuración de autoplay
  autoplay: true,
  autoplay_speed: 5  // segundos
};

// =============================================================================
// ATRIBUTOS DE DATOS EN HTML
// =============================================================================

/*
<section
    id="testimonials-carousel-12345"
    class="acf-block-testimonials-carousel"
    role="region"
    aria-label="Testimonios de clientes"
    data-autoplay="true"
    data-autoplay-speed="5"
>
*/

// =============================================================================
// ESTRUCTURA HTML RENDERIZADA (Simplificada)
// =============================================================================

const HTML_STRUCTURE = `
<section 
  id="testimonials-carousel-12345"
  class="acf-block-testimonials-carousel"
  role="region"
  aria-label="Testimonios de clientes"
  data-autoplay="true"
  data-autoplay-speed="5"
>
  <div class="acfb-bg-secondary-50 acfb-py-12">
    <div class="acfb-container">
      
      <!-- CARRUSEL -->
      <div class="acfb-carousel-wrapper" data-carousel="testimonials">
        
        <!-- LISTA DE TESTIMONIOS -->
        <ul class="acfb-carousel-list" role="listbox">
          
          <!-- TESTIMONIO 1 (Activo) -->
          <li class="acfb-carousel-item acfb-active" role="option" aria-selected="true" data-index="0"
              itemscope itemtype="https://schema.org/Review">
            <figure class="acfb-testimonial-figure">
              
              <!-- BLOCKQUOTE -->
              <blockquote class="acfb-testimonial-quote">
                <p class="acfb-testimonial-text acfb-text-main-black" itemprop="reviewBody">
                  "Excelente servicio, muy profesionales y rápidos..."
                </p>
              </blockquote>
              
              <!-- FIGCAPTION: AUTOR E INFO -->
              <figcaption class="acfb-testimonial-caption">
                
                <!-- AVATAR -->
                <div class="acfb-testimonial-avatar-container">
                  <img src="maria.jpg" alt="María García" class="acfb-testimonial-avatar"
                       width="100" height="100" loading="lazy"
                       itemprop="author" itemscope itemtype="https://schema.org/Person">
                </div>
                
                <!-- NOMBRE Y ROL -->
                <div class="acfb-testimonial-author-info">
                  <p class="acfb-testimonial-author-name acfb-text-main-black acfb-font-semibold"
                     itemprop="author">
                    María García
                  </p>
                  <p class="acfb-testimonial-author-role acfb-text-secondary-600 acfb-text-sm">
                    CEO en TechCorp
                  </p>
                </div>
                
                <!-- ESTRELLAS -->
                <div class="acfb-testimonial-rating"
                     aria-label="Calificación: 5 de 5 estrellas">
                  <div class="acfb-stars-container">
                    <span class="acfb-star acfb-star-filled">★</span>
                    <span class="acfb-star acfb-star-filled">★</span>
                    <span class="acfb-star acfb-star-filled">★</span>
                    <span class="acfb-star acfb-star-filled">★</span>
                    <span class="acfb-star acfb-star-filled">★</span>
                  </div>
                  <meta itemprop="ratingValue" content="5">
                  <meta itemprop="bestRating" content="5">
                  <meta itemprop="worstRating" content="1">
                </div>
                
              </figcaption>
            </figure>
          </li>
          
          <!-- TESTIMONIO 2, 3, 4, 5... (igual estructura) -->
          
        </ul>
        
        <!-- NAVEGACIÓN: FLECHAS (Desktop) -->
        <div class="acfb-carousel-nav acfb-hidden md:acfb-flex">
          <button class="acfb-carousel-nav-btn acfb-carousel-prev"
                  aria-label="Testimonio anterior">
            ←
          </button>
          <button class="acfb-carousel-nav-btn acfb-carousel-next"
                  aria-label="Siguiente testimonio">
            →
          </button>
        </div>
        
      </div>
      
      <!-- INDICADORES: DOTS -->
      <div class="acfb-carousel-indicators" role="tablist">
        <button class="acfb-carousel-dot acfb-active" role="tab"
                aria-label="Ir al testimonio 1 de 5" aria-selected="true"
                data-slide-index="0"></button>
        <button class="acfb-carousel-dot" role="tab"
                aria-label="Ir al testimonio 2 de 5" aria-selected="false"
                data-slide-index="1"></button>
        <!-- Más dots... -->
      </div>
      
    </div>
  </div>
</section>
`;

// =============================================================================
// EVENTOS JAVASCRIPT
// =============================================================================

const JAVASCRIPT_EVENTS = {
  // Cuando se crea una instancia
  init: "Inicializa el carrusel, event listeners, y autoplay",
  
  // Interacciones del usuario
  prev: "Click en flecha izquierda: testimonios -= 1",
  next: "Click en flecha derecha: testimonios += 1",
  goToSlide: "Click en un dot: ir al índice específico",
  handleSwipe: "Swipe/drag horizontal: navegar",
  handleKeyboard: "Teclas ← →: navegar",
  
  // Autoplay
  startAutoplay: "Inicia rotación automática",
  pauseAutoplay: "Pausa la rotación (hover)",
  restartAutoplay: "Reinicia autoplay después de interacción",
  
  // Actualización de UI
  updateCarousel: "Actualiza posición, ARIA labels, dots",
};

// =============================================================================
// DATOS ENVIADOS A RENDER.PHP
// =============================================================================

const RENDER_CONTEXT = {
  // Datos del bloque
  block: {
    id: "block_12345",
    className: "custom-class",
    align: "wide",
  },
  
  // Valores de los campos ACF
  testimonials: [...],
  autoplay: true,
  autoplay_speed: 5,
  
  // Contexto de editor
  is_preview: false,
  post_id: 123,
};

// =============================================================================
// SCHEMA.ORG JSON-LD (Generado automáticamente)
// =============================================================================

/*
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Review",
  "author": {
    "@type": "Person",
    "name": "María García"
  },
  "reviewBody": "Excelente servicio, muy profesionales y rápidos...",
  "ratingValue": {
    "@type": "Rating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1"
  }
}
</script>
*/

// =============================================================================
// RESPONSIVE BREAKPOINTS
// =============================================================================

const RESPONSIVE_CONFIG = {
  mobile: {
    breakpoint: "< 768px",
    itemsVisible: 1,
    navigation: "swipe + dots",
    arrows: "hidden"
  },
  tablet: {
    breakpoint: "768px - 1024px",
    itemsVisible: 2,
    navigation: "arrows + dots",
    arrows: "visible"
  },
  desktop: {
    breakpoint: "> 1024px",
    itemsVisible: 3,
    navigation: "arrows + dots + keyboard",
    arrows: "visible"
  }
};

// =============================================================================
// REGLAS ACCESIBILIDAD
// =============================================================================

const ACCESSIBILITY = {
  semanticHTML: [
    "section (region)",
    "figure (contenedor testimonio)",
    "blockquote (cita)",
    "figcaption (autor + metadata)",
    "ul (lista de testimonios)"
  ],
  
  ariaAttributes: [
    "role='region'",
    "role='listbox'",
    "role='option'",
    "role='tablist'",
    "role='tab'",
    "aria-label='...'",
    "aria-selected='true/false'",
    "aria-controls='...'",
    "itemscope + itemtype"
  ],
  
  keyboard: [
    "ArrowLeft: anterior",
    "ArrowRight: siguiente",
    "Tab: navegar entre controles",
    "Enter/Space: activar botones"
  ],
  
  inclusión: [
    "Funciona sin JavaScript",
    "Respeta prefers-reduced-motion",
    "Focus visible en controles",
    "Contraste de colores WCAG AA",
    "Texto alternativo en imágenes"
  ]
};

export {
  EXAMPLE_DATA,
  HTML_STRUCTURE,
  JAVASCRIPT_EVENTS,
  RENDER_CONTEXT,
  RESPONSIVE_CONFIG,
  ACCESSIBILITY
};
