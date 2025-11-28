# Testimonios Carousel Block

Bloque Gutenberg personalizado para mostrar opiniones de clientes con carrusel automático y navegación interactiva.

## 📋 Características

✅ **Carrusel Responsivo**
- Mobile: 1 testimonio por vista con swipe horizontal
- Desktop: 3 testimonios visibles simultáneamente
- Navegación suave con animaciones

✅ **Interactividad**
- Touch swipe en dispositivos móviles
- Navegación con flechas (desktop)
- Indicadores (dots) clickeables
- Rotación automática configurable
- Pausa de autoplay al hacer hover
- Navegación por teclado (flechas ← →)

✅ **Diseño**
- Responsive y mobile-first
- Colores: fondo `acfb-bg-secondary-50`, texto `acfb-text-main-black`
- Estrellas: `acfb-text-accent-main` (llenas), `acfb-text-secondary-200` (vacías)
- Soporte para dark mode
- Respeta preferencias de movimiento reducido

✅ **Accesibilidad**
- ARIA labels y roles semánticos
- Navegación por teclado
- Focus visible para usuarios de teclado
- Etiquetas descriptivas
- Elementos semánticos (`<section>`, `<figure>`, `<blockquote>`, `<figcaption>`, `<ul>`)

✅ **SEO**
- Schema.org Review (solo si rating ≥ 4)
- itemProp para author, reviewBody, ratingValue
- No genera schema decorativo

## 🛠️ Campos ACF

| Campo | Tipo | Descripción | Obligatorio |
|-------|------|-------------|------------|
| `testimonials` | Repeater | Lista de testimonios (3-6 máx) | ✅ |
| `author_name` | Text | Nombre del cliente | ✅ |
| `author_role` | Text | Cargo/empresa | ✅ |
| `author_image` | Image | Foto 100x100px | ✅ |
| `testimonial_text` | Textarea | Opinión (máx 280 caracteres) | ✅ |
| `rating` | Range | Calificación 1-5 estrellas | ✅ |
| `autoplay` | True/False | Rotación automática | Sí (default: true) |
| `autoplay_speed` | Number | Segundos entre slides (2-15) | Condicional (si autoplay=true) |

## 📱 Diseño Responsive

### Mobile (< 768px)
- 1 testimonio visible
- Swipe horizontal para navegar
- Dots indicadores clickeables
- Sin flechas de navegación

### Tablet (768px - 1024px)
- 2-3 testimonios visibles
- Flechas de navegación
- Dots indicadores

### Desktop (> 1024px)
- 3 testimonios visibles
- Flechas de navegación
- Dots indicadores
- Efectos hover activados

## 🎨 Clases CSS

Todas las clases tienen el prefijo `acfb-` (ACF Blocks):

### Estructura
```
acfb-carousel-wrapper         // Contenedor principal
acfb-carousel-list            // Lista de items
acfb-carousel-item            // Item individual (slide)
acfb-carousel-item.acfb-active // Item activo
```

### Navegación
```
acfb-carousel-nav             // Contenedor de flechas
acfb-carousel-nav-btn         // Botón flecha (prev/next)
acfb-carousel-indicators      // Contenedor de dots
acfb-carousel-dot             // Indicador individual
acfb-carousel-dot.acfb-active // Dot activo
```

### Testimonio
```
acfb-testimonial-figure       // Figure container
acfb-testimonial-quote        // Blockquote
acfb-testimonial-text         // Texto de opinión
acfb-testimonial-caption      // Figcaption
acfb-testimonial-avatar-container
acfb-testimonial-avatar       // Imagen del cliente
acfb-testimonial-author-info
acfb-testimonial-author-name
acfb-testimonial-author-role
acfb-testimonial-rating
acfb-stars-container
acfb-star                     // Estrella individual
acfb-star-filled              // Estrella llena
acfb-star-empty               // Estrella vacía
```

## 🔧 Personalización

### Cambiar colores
Los colores se definen en `tailwind.config.js`. Modifica la paleta de colores:

```javascript
colors: {
  accent: {
    main: '#f59e0b', // Color de las estrellas llenas
  },
  secondary: {
    50: '#f8fafc',   // Fondo
    200: '#e2e8f0',  // Estrellas vacías
  },
  'main-black': '#000000', // Texto
}
```

### Cambiar velocidad de animación
En `styles.css`:
```css
.acf-block-testimonials-carousel {
    --carousel-transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
```

### Cambiar cantidad de testimonios visibles
En `testimonials-carousel.js` método `updateCarousel()`:
```javascript
const itemsPerView = isMobile ? 1 : 3; // Cambiar 3 por el número deseado
```

## 📝 Ejemplos de Uso

### Bloque en el editor
1. Añade el bloque "Testimonios Carousel" en el editor
2. Configura los testimonios con los datos de clientes
3. Activa/desactiva autoplay según necesites
4. Ajusta la velocidad de rotación

### Datos de ejemplo
```
Nombre: María García
Cargo: CEO en TechCorp
Imagen: /uploads/maria-garcia.jpg
Opinión: "Excelente servicio, muy profesionales y rápidos. Recomendados 100%."
Rating: 5 estrellas
```

## 🐛 Troubleshooting

### El carrusel no funciona
1. Verifica que ACF Pro esté activo
2. Recarga la página (Ctrl+F5)
3. Compila Tailwind CSS: `npm run tailwind:build`

### Los estilos no se aplican
1. Verifica que `styles.css` exista en `/blocks/testimonials-carousel/`
2. Recarga con caché limpio: Ctrl+Shift+Del → Vaciar caché
3. Compila Tailwind: `npm run tailwind:build`

### JavaScript no funciona (sin swipe)
1. Verifica que `testimonials-carousel.js` esté encolado
2. Abre la consola (F12) y busca errores
3. Verifica que el selector `[data-carousel="testimonials"]` exista en el HTML

### Schema.org no genera
1. El schema solo genera si **rating ≥ 4**
2. Usa Google Rich Results Test: https://search.google.com/test/rich-results

## 📦 Instalación

El bloque se registra automáticamente si:
1. ✅ La carpeta `/blocks/testimonials-carousel/` existe
2. ✅ Contiene `block.json`
3. ✅ ACF Pro está activo en WordPress

Ninguna configuración adicional necesaria.

## 🔄 Build & Deploy

### Desarrollo
```bash
npm run dev                    # Watch Tailwind CSS en tiempo real
```

### Build Final
```bash
npm run build:plugin          # Compila y crea ZIP para instalar
```

## 📚 Archivos del bloque

```
blocks/testimonials-carousel/
├── block.json                # Configuración del bloque
├── fields.php               # Definición de campos ACF
├── render.php               # Template HTML
├── testimonials-carousel.js # Lógica interactiva
└── styles.css              # Estilos CSS
```

## ♿ Accesibilidad Verificada

- ✅ WCAG 2.1 Level AA
- ✅ Navegación por teclado
- ✅ Lectores de pantalla
- ✅ Contraste de colores
- ✅ Focus indicators
- ✅ ARIA labels completos
- ✅ Respeta `prefers-reduced-motion`

## 📄 Licencia

GPL v2 o posterior (mismo que WordPress)

## 👨‍💻 Autor

Parte del plugin **ACF Blocks Starter**
