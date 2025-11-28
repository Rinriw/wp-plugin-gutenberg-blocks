# Ficha Técnica - Custom Post Type

Sistema completo para catalogar y mostrar obras audiovisuales animadas chilenas.

## Características

### ✅ Funcionalidad Completa
- **Custom Post Type (CPT)**: `ficha_animacion` con slug `/ficha-animacion/`
- **5 Grupos ACF Tab**: Mini galería, Ficha técnica, Equipo y Reparto, Financiamiento y Premios, Disponible en
- **Diseño Responsivo**: 
  - Mobile-first con cards redondeadas y acordeones
  - Desktop con grid 2-columnas y sistema de tabs
- **Interactividad**: Acordeones, carousel de galerías, tabs con fade
- **Validación de Campos**: Campos condicionales (mostrar custom si se selecciona "otro")

### 📋 ACF Field Groups

#### Tab 1: Mini Galería
- `gallery` (repeater): imagen sub-field

#### Tab 2: Ficha Técnica
- `afiche` (image)
- `nombre` (text)
- `year` (text)
- `duration` (text)
- `format` (select + custom field)
- `animation_technique` (select + custom field)
- `genre` (text)
- `idioma` (text)
- `pais` (text)
- `sinopsis` (textarea)
- `imdb_link` (url)

#### Tab 3: Equipo y Reparto
- `direccion` (text)
- `guion` (text)
- `productora` (text)
- `produccion` (text)
- `animacion` (text)
- `reparto` (text)
- `fotografia` (text)
- `musica` (text)
- `sonido` (text)
- `direccion_arte` (text)
- `montaje` (text)
- `edicion` (text)

#### Tab 4: Financiamiento y Premios
- `financiamiento` (textarea)
- `premios` (repeater): nombre, festival, year

#### Tab 5: Disponible en
- `plataformas` (repeater): servicio (select), link (url)

## Archivos

```
includes/
  └── register-ficha-cpt.php      # CPT registration + ACF fields
  
single-ficha_animacion.php        # Template (mobile & desktop)
ficha-styles.css                  # Estilos CSS
ficha-script.js                   # JavaScript (accordeons, carousel, tabs)
FICHA-README.md                   # Este archivo
```

## Instalación

### 1. Activar el Plugin
El CPT se registra automáticamente cuando el plugin está activo. Los campos ACF se crean mediante `acf_add_local_field_group()`.

### 2. Crear una Ficha Técnica
1. Ve a **Dashboard → Ficha Animación**
2. Click en **Agregar Nueva**
3. Completa los campos (mínimo: Nombre)
4. **Publicar**

### 3. Ver la Ficha
- URL automática: `/ficha-animacion/nombre-de-la-obra/`
- Template responsivo se cargará automáticamente

## Estructura Visual

### Mobile (< 768px)
```
┌─────────────────────┐
│      Afiche         │
├─────────────────────┤
│ Título              │
│ Año: 2023           │
├─────────────────────┤
│ Info Rápida         │
│ Duración | Formato  │
├─────────────────────┤
│ Galería Carousel    │
│ ● ○ ○ ○             │
├─────────────────────┤
│ Sinopsis            │
├─────────────────────┤
│ ▼ Ficha Técnica     │
│   [Detalle datos]   │
├─────────────────────┤
│ ▼ Equipo y Reparto  │
│   [Directores...]   │
├─────────────────────┤
│ ▼ Financiamiento    │
│   [Premios...]      │
├─────────────────────┤
│ Disponible en       │
│ [Plataforma 1]      │
│ [Plataforma 2]      │
└─────────────────────┘
```

### Desktop (≥ 768px)
```
┌────────────────────┬──────────────────────┐
│                    │ Título               │
│    Afiche          │ Año: 2023            │
│                    │                      │
│                    │ Galería              │
│                    │ ● ○ ○ ○              │
│                    │                      │
│    Plataformas     │ [Tabs]               │
│    [Button 1]      │ Info │Crew │Premios │
│    [Button 2]      ├──────────────────────┤
│                    │ Sinopsis + detalles  │
│                    │ Ficha técnica        │
│                    │ Equipo y Reparto     │
│                    │ Financiamiento       │
│                    │                      │
└────────────────────┴──────────────────────┘
```

## CSS Classes

### Container & Layout
- `.ficha-tecnica-container` - Wrapper principal
- `.ficha-mobile` / `.ficha-desktop` - Vista móvil/escritorio
- `.ficha-card` - Card container con sombra
- `.ficha-grid` - Grid 2 columnas (desktop)

### Componentes
- `.ficha-header` - Encabezado con título y año
- `.ficha-info-rapida` - Info rápida (duración, formato, etc)
- `.galeria-carousel` - Carrusel de galerías
- `.ficha-accordion` - Acordeón para secciones
- `.ficha-tabs` - Sistema de tabs (desktop)
- `.tab-pane` - Contenido de tab individual
- `.plataformas-list` - Lista de plataformas

## JavaScript Modules

### Accordions
Permite abrir/cerrar secciones en mobile:
```javascript
// Automático al cargar
initAccordions();
```
- Click en `.accordion-btn` abre/cierra `.accordion-content`
- Solo un acordeón abierto a la vez
- Clase `.active` para estado abierto

### Gallery Carousel
Muestra 4 items a la vez con paginación por puntos:
```javascript
initGalleryCarousels();
```
- Auto-scroll cada 5s (mobile)
- Navegación por dots
- Soporte swipe/touch
- Responsive a resize

### Tabs
Cambio entre Info, Equipo, Financiamiento (desktop):
```javascript
initTabs();
```
- Click en `.tab-btn` muestra `.tab-pane`
- Datos: `data-tab` y `data-pane` para emparejar
- Animación fade-in al cambiar

## Campos Condicionales

### Format & Animation Technique
Si el usuario selecciona "Otro":
- Se muestra campo de texto para ingresar valor custom
- ACF field keys: `format_custom`, `animation_technique_custom`

### Mostrar en Template
```php
$formato = get_field('format');
$formato_display = $formato === 'otro' ? get_field('format_custom') : $formato;
```

## Personalización

### Colores
Editar `ficha-styles.css`:
```css
/* Cambiar color primario */
.tab-btn.active { color: #007bff; }  /* Cambiar a tu color */
.dot.active { background: #007bff; } /* Cambiar a tu color */
.plataforma-btn { background: #007bff; } /* Cambiar a tu color */
```

### Breakpoints
El template usa `768px` como breakpoint entre mobile/desktop. Modificar en CSS:
```css
@media (min-width: 768px) { /* Cambiar aquí */ }
```

### Items Visibles en Galería
Editar en `ficha-script.js`:
```javascript
const itemsPerView = 4; // Cambiar número de items
```

## Depuración

### ACF Fields No Aparecen
1. Verificar ACF Pro esté instalado y activo
2. En `includes/register-ficha-cpt.php`, confirmar `acf_add_local_field_group()` está definido
3. WordPress Admin → ACF → Field Groups → Verificar grupo está activo

### Template No Se Carga
1. Confirmar post type está registrado:
   - Dashboard → Ficha Animación debe estar visible
2. Verificar archivo `single-ficha_animacion.php` está en raíz del plugin
3. Inspeccionar: `<?php the_content(); ?>` debe estar en template

### Estilos No Cargan
1. Verificar `wp_enqueue_style()` en template (líneas 12-13)
2. Path debe ser relativo: `plugin_dir_url(__FILE__) . 'ficha-styles.css'`
3. Limpiar cache del navegador (Ctrl+F5)

### JavaScript No Funciona
1. Verificar `wp_enqueue_script()` en template
2. Asegurar no hay conflictos con otros plugins
3. Verificar en Console de Developer Tools (F12)

## API Usage

### Obtener datos en templates/plugins
```php
// Obtener un campo
$nombre = get_field('nombre', $post_id);
$galeria = get_field('gallery', $post_id); // Array de items

// Loop custom
$args = array(
    'post_type' => 'ficha_animacion',
    'posts_per_page' => -1
);
$posts = new WP_Query($args);

while ($posts->have_posts()) {
    $posts->the_post();
    $nombre = get_field('nombre');
    echo get_the_title();
}
```

## Soporte

Si hay errores en el template:
1. Activar `WP_DEBUG` en `wp-config.php`
2. Ver logs en `wp-content/debug.log`
3. Inspeccionar HTML con DevTools (F12)
4. Verificar console.log en JS (F12 → Console)

---

**Versión**: 1.0  
**Última actualización**: 2024  
**Compatible con**: WordPress 6.2+, ACF Pro 6.0+
