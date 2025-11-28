# Ficha Técnica - Checklist de Implementación

## ✅ INSTALACIÓN Y CONFIGURACIÓN

- [ ] Plugin está activo en WordPress Dashboard
- [ ] ACF Pro 6.0+ está instalado y activo
- [ ] WP 6.2+ está instalado
- [ ] `includes/register-ficha-cpt.php` existe en el plugin
- [ ] `single-ficha_animacion.php` existe en la raíz del plugin
- [ ] `ficha-styles.css` existe en la raíz del plugin
- [ ] `ficha-script.js` existe en la raíz del plugin

## ✅ CUSTOM POST TYPE

- [ ] CPT `ficha_animacion` aparece en Dashboard
- [ ] Slug de URL es `/ficha-animacion/`
- [ ] Post type soporta: title, editor, excerpt, thumbnail, custom-fields, revisions
- [ ] No tiene archive page (has_archive = false)
- [ ] Capacidades están configuradas correctamente

## ✅ ACF FIELD GROUPS

### Tab 1: Mini Galería
- [ ] Campo `gallery` (repeater) existe
- [ ] Sub-campo de imagen está configurado
- [ ] Validación de tipo imagen funciona

### Tab 2: Ficha Técnica
- [ ] Campo `afiche` (image) - Requerido
- [ ] Campo `nombre` (text) - Requerido
- [ ] Campo `year` (text)
- [ ] Campo `duration` (text)
- [ ] Campo `format` (select) con opción "otro" + campo custom
- [ ] Campo `animation_technique` (select) con opción "otro" + campo custom
- [ ] Campo `genre` (text)
- [ ] Campo `idioma` (text)
- [ ] Campo `pais` (text)
- [ ] Campo `sinopsis` (textarea)
- [ ] Campo `imdb_link` (url)

### Tab 3: Equipo y Reparto
- [ ] Campo `direccion` (text)
- [ ] Campo `guion` (text)
- [ ] Campo `productora` (text)
- [ ] Campo `produccion` (text)
- [ ] Campo `animacion` (text)
- [ ] Campo `reparto` (text)
- [ ] Campo `fotografia` (text)
- [ ] Campo `musica` (text)
- [ ] Campo `sonido` (text)
- [ ] Campo `direccion_arte` (text)
- [ ] Campo `montaje` (text)
- [ ] Campo `edicion` (text)

### Tab 4: Financiamiento y Premios
- [ ] Campo `financiamiento` (textarea)
- [ ] Campo `premios` (repeater)
  - [ ] Sub-campo `nombre` (text)
  - [ ] Sub-campo `festival` (text)
  - [ ] Sub-campo `year` (text)

### Tab 5: Disponible en
- [ ] Campo `plataformas` (repeater)
  - [ ] Sub-campo `servicio` (select) con opciones: Netflix, Disney+, Amazon Prime, YouTube, etc.
  - [ ] Sub-campo `link` (url)

## ✅ TEMPLATE RESPONSIVO

### Mobile (< 768px)
- [ ] Afiche mostrado a ancho completo
- [ ] Título visible y centrado
- [ ] Año mostrado bajo título
- [ ] Info rápida en flex con gap
- [ ] Galería carousel con 4 items visibles
- [ ] Dots de paginación funcionales
- [ ] Sinopsis legible
- [ ] Ficha técnica colapsable (acordeón)
- [ ] Equipo y Reparto colapsable (acordeón)
- [ ] Financiamiento y Premios colapsable (acordeón)
- [ ] Botones de plataformas full-width apilados

### Desktop (≥ 768px)
- [ ] Grid 2 columnas (50/50)
- [ ] Afiche en columna izquierda
- [ ] Plataformas bajo afiche
- [ ] Título, año y galería en columna derecha
- [ ] Sistema de 3 tabs (Info, Equipo, Financiamiento)
- [ ] Info rápida 2 columnas
- [ ] Cambio de tabs sin recarga de página
- [ ] Animación fade al cambiar tab

## ✅ INTERACTIVIDAD

### Acordeones
- [ ] Click abre/cierra sección
- [ ] Solo una sección abierta a la vez
- [ ] Ícono de chevron rota correctamente
- [ ] Transición suave al abrir/cerrar

### Gallery Carousel
- [ ] Muestra exactamente 4 items
- [ ] Dots de paginación visibles si hay > 4 items
- [ ] Dot activo resaltado en azul
- [ ] Click en dot navega a página correcta
- [ ] Auto-scroll cada 5s en mobile
- [ ] Swipe/touch funciona en mobile
- [ ] Resize de ventana maneja carousel correctamente

### Tabs (Desktop)
- [ ] Primer tab abierto por defecto
- [ ] Click en tab abre contenido correspondiente
- [ ] Tab activo resaltado con línea azul
- [ ] Animación fade al cambiar
- [ ] No hay parpadeo al cambiar

## ✅ ESTILOS

### Colores
- [ ] Color primario (#007bff) aplicado a: tabs activos, dots activos, botones
- [ ] Hover en botones (#0056b3) aplicado
- [ ] Texto gris (#666) para contenido secundario
- [ ] Fondo gris claro (#f9f9f9) para secciones info

### Espaciado
- [ ] 20px padding en mobile cards
- [ ] 40px padding en desktop cards
- [ ] 15px gap en flex containers
- [ ] Márgenes consistentes entre secciones

### Typography
- [ ] Título: 24px mobile / 32px desktop
- [ ] Encabezados: 18px
- [ ] Cuerpo: 14px-16px
- [ ] Line-height: 1.6 - 1.8

### Responsive
- [ ] Viewport meta tag en header
- [ ] Media queries funcionan (@media 768px)
- [ ] Touch targets > 44px en mobile
- [ ] Imágenes responsive

## ✅ ACCESIBILIDAD

- [ ] Labels en formularios ACF son descriptivos
- [ ] Contraste de color WCAG 2.1 AA
- [ ] Ícones tienen aria-label
- [ ] Botones son tecleable (tab)
- [ ] Accordeones tienen rol ARIA

## ✅ PERFORMANCE

- [ ] CSS es minificado
- [ ] JS es minificado
- [ ] Imágenes están optimizadas
- [ ] Sin request bloqueantes
- [ ] Lazy loading en imágenes (si aplica)

## ✅ CAMPOS CONDICIONALES

- [ ] Si `format` = "otro" → Mostrar `format_custom`
- [ ] Si `animation_technique` = "otro" → Mostrar `animation_technique_custom`
- [ ] Campos custom no se muestran si no son necesarios
- [ ] Template usa lógica correcta: `$formato_display = $formato === 'otro' ? $formato_custom : $formato;`

## ✅ SEGURIDAD

- [ ] `wp_kses_post()` usado para sanitizar sinopsis
- [ ] `esc_html()` usado para campos de texto
- [ ] `esc_url()` usado para URLs de IMDB y plataformas
- [ ] `wp_verify_nonce()` si hay forms (no aplica aquí)

## ✅ TESTING

### Crear Ficha de Prueba
1. [ ] Dashboard → Ficha Animación → Agregar Nueva
2. [ ] Llenar todos los campos requeridos:
   - [ ] Nombre: "Mi Primera Animación"
   - [ ] Año: "2023"
   - [ ] Afiche: Subir imagen
   - [ ] Sinopsis: Escribir sinopsis
3. [ ] Llenar campos opcionales:
   - [ ] Galería: Subir 5+ imágenes
   - [ ] Equipo: Llenar datos de dirección, productora
   - [ ] Premios: Agregar 2-3 premios
   - [ ] Plataformas: Agregar 2-3 plataformas
   - [ ] Campos "otro": Probar con formato "Otro" + texto custom
4. [ ] Publicar

### Probar en Mobile
1. [ ] Abrir en navegador mobile (o DevTools)
2. [ ] Viewport 375px (iPhone SE)
3. [ ] [ ] Afiche visible y legible
4. [ ] [ ] Acordeones abiertos/cerrados funcionan
5. [ ] [ ] Gallery carousel navega correctamente
6. [ ] [ ] Swipe en galería funciona
7. [ ] [ ] Botones plataformas son full-width
8. [ ] [ ] Texto es legible

### Probar en Desktop
1. [ ] Abrir en navegador desktop (1920px+)
2. [ ] [ ] Layout 2 columnas correcto
3. [ ] [ ] Tabs activos muestran contenido correcto
4. [ ] [ ] Galería carousel funciona
5. [ ] [ ] Botones plataformas organizados
6. [ ] [ ] Scroll suave funciona

### Probar Interactividad
1. [ ] Click en dots → cambia página galería
2. [ ] Click en tab → cambia contenido sin recarga
3. [ ] Click en acordeón → abre/cierra suavemente
4. [ ] Solo un acordeón abierto a la vez
5. [ ] Auto-scroll en mobile funciona (5s)

## ✅ SEO / SCHEMA

- [ ] Schema.org Review agregado (si aplica)
- [ ] Meta description rellenado
- [ ] Título meta optimizado
- [ ] Og:image con afiche
- [ ] URL amigable: `/ficha-animacion/nombre-obra/`

## ✅ DOCUMENTACIÓN

- [ ] README.md creado con instrucciones
- [ ] Comentarios en código PHP
- [ ] Comentarios en JavaScript
- [ ] Comentarios en CSS
- [ ] Este checklist completado

## 🚀 DEPLOYMENT

- [ ] Código subido a git
- [ ] Sin archivos temporales (.log, .tmp)
- [ ] Sin credenciales en código
- [ ] Plugin testado en staging
- [ ] Plugin listo para producción

---

**Estado Overall**: ___ / 100 items ✅

**Notas**:  
```
[Espacio para anotaciones]
```

**Fecha de Verificación**: __________  
**Verificado por**: __________
