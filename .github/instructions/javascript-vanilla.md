# JavaScript Vanilla Obligatorio

## Reglas
1. **JS vanilla únicamente** - Sin librerías externas
2. **SSR first** - HTML funcional sin JS
3. **Progressive enhancement** - JS mejora experiencia
4. **No CDN** - Sin scripts externos que ralenticen carga

## ❌ Prohibido
```javascript
// jQuery
$('.carousel').slick();

// Librerías externas
import Swiper from 'swiper';

// CDN
<script src="https://cdn.jsdelivr.net/...">
```

## ✅ Correcto
```javascript
// Vanilla JS moderno
(function() {
    'use strict';
    
    const carousel = document.querySelector('.carousel');
    
    function initCarousel() {
        // Implementación vanilla
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel);
    } else {
        initCarousel();
    }
})();
```

## APIs Recomendadas
- `IntersectionObserver` - Lazy loading, scroll effects
- `ResizeObserver` - Detección de cambios de tamaño
- `matchMedia` - Media queries en JS
- Touch events - Gestos táctiles
- `scrollTo()` - Scroll suave

## Patrón de Archivo
Crear `nombre-bloque.js` junto a `render.php`:
```
blocks/mi-bloque/
├── block.json
├── fields.php
├── render.php
└── mi-bloque.js  ← JavaScript vanilla aquí
```

El sistema lo encolará automáticamente.

## Excepciones
Solicitar aprobación previa para:
- APIs de terceros (Google Maps, Stripe)
- Librerías específicas justificadas

**Por defecto: Solo vanilla JS.**
