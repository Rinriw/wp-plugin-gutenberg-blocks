# 🔍 Diagnostico de Ficha Técnica

Para que pueda ayudarte a reparar lo que no funciona, necesito información específica.

## Opción 1: Panel de Debug Automático (Recomendado)

Abre tu ficha técnica con este parámetro:

```
http://localhost/wordpress/ficha-animacion/nombre-tu-ficha/?ficha_debug=1
```

Verás un panel en la **esquina superior derecha** con:
- ✓ Estado del HTML
- ✓ Archivos CSS cargados
- ✓ Funciones JavaScript disponibles
- ✓ Elementos HTML encontrados
- ✓ Logs de inicialización

**Copia-pega esta información en tu respuesta.**

---

## Opción 2: DevTools Manual (Si prefieres)

1. **Abre tu ficha técnica**
2. **Presiona F12** (DevTools)
3. **Ve a la pestaña Console**
4. **Pega esto y presiona Enter:**

```javascript
console.log('=== FICHA DEBUG ===');
console.log('Container:', document.querySelector('.ficha-tecnica-container') ? '✓ Found' : '✗ Not found');
console.log('initAccordions:', typeof initAccordions);
console.log('initTabs:', typeof initTabs);
console.log('initGalleryCarousels:', typeof initGalleryCarousels);
console.log('CSS files:', Array.from(document.styleSheets).filter(s => s.href && s.href.includes('ficha')).length);
console.log('Accordions:', document.querySelectorAll('.accordion-btn').length);
console.log('Tabs:', document.querySelectorAll('.tab-btn').length);
console.log('Gallery:', document.querySelectorAll('.galeria-carousel').length);
```

**Copia la respuesta que aparece.**

---

## Opción 3: Describe lo que ves

¿Cuál de estos problemas ves?

- [ ] Acordeones no abren/cierran al hacer click
- [ ] Tabs no cambian de contenido
- [ ] Carousel no funciona
- [ ] Los estilos se ven mal (colores, fuentes, tamaño)
- [ ] La página se ve diferente en móvil vs desktop
- [ ] Hay errores rojos en Console (describe)
- [ ] Otro problema (describe)

---

## Información Útil

**Resoluciones para probar:**
- Abre la ficha en tamaño normal (desktop)
- Abre la ficha en móvil (resize a < 768px)
- Intenta en navegador diferente

**Verifica también:**
- ¿La ficha tiene contenido (imagen, título, descripción)?
- ¿El formulario de ACF permitió guardar la información?
- ¿Hay campos vacíos que deberían mostrar contenido?

---

**Una vez que tengo esta información, puedo reparar exactamente qué falta!**
