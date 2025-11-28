## 🚀 Quick Start - Testimonials Carousel

### 1️⃣ Verificar instalación

El bloque debería aparecer automáticamente en el editor Gutenberg bajo la categoría "Bloques Personalizados" si:
- ✅ WordPress 6.2+
- ✅ ACF Pro activo
- ✅ Carpeta `/blocks/testimonials-carousel/` existe

### 2️⃣ Usar en una página

1. **Abre el editor Gutenberg** en cualquier página
2. **Busca el bloque** "Testimonios Carousel" o "Testimonials Carousel"
3. **Añade testimonios**:
   - Nombre del cliente
   - Cargo/empresa
   - Foto (100x100px)
   - Opinión (máx 280 caracteres)
   - Rating (1-5 estrellas)
4. **Configura autoplay** (opcional):
   - Activar/desactivar rotación
   - Velocidad: 2-15 segundos

### 3️⃣ Estructura de datos (ejemplo)

```
Testimonios:
├─ María García
│  ├─ Cargo: CEO en TechCorp
│  ├─ Foto: /uploads/maria.jpg
│  ├─ Opinión: "Excelente servicio..."
│  └─ Rating: ⭐⭐⭐⭐⭐
├─ Juan López
│  ├─ Cargo: Founder de StartupX
│  ├─ Foto: /uploads/juan.jpg
│  ├─ Opinión: "Profesionalismo total..."
│  └─ Rating: ⭐⭐⭐⭐⭐
└─ Sofia Martínez
   ├─ Cargo: Marketing Manager
   ├─ Foto: /uploads/sofia.jpg
   ├─ Opinión: "Superaron expectativas..."
   └─ Rating: ⭐⭐⭐⭐
```

### 4️⃣ Interacción esperada

**Desktop:**
- Click en flechas → navegar
- Click en dots → ir a testimonio
- Hover → pausa autoplay
- ← → (teclado) → navegar

**Mobile:**
- Swipe izquierda/derecha → navegar
- Click en dots → ir a testimonio
- Autoplay continúa

### 5️⃣ Resultado visual

```
┌─────────────────────────────────────────────┐
│          TESTIMONIOS CAROUSEL                │
├─────────────────────────────────────────────┤
│                                              │
│  ┌──────┐  ┌──────┐  ┌──────┐              │
│  │ Foto │  │ Foto │  │ Foto │              │
│  │ 100  │  │ 100  │  │ 100  │              │
│  └──────┘  └──────┘  └──────┘              │
│                                              │
│  "Excelente   "Profesional"  "Superaron    │
│   servicio..."   total..."    expectativas"│
│                                              │
│  María García  Juan López    Sofia Martínez│
│  CEO TechCorp  Founder       Marketing Mgr  │
│  ⭐⭐⭐⭐⭐     ⭐⭐⭐⭐⭐     ⭐⭐⭐⭐   │
│                                              │
│              ← dots → | ◀ 🎯 ▶             │
└─────────────────────────────────────────────┘
```

### 6️⃣ Personalización (opcional)

**Cambiar colores** en `tailwind.config.js`:
```javascript
accent: {
  main: '#f59e0b',  // Color estrellas
}
secondary: {
  50: '#f8fafc',    // Fondo
}
```

**Cambiar cantidad visible**:
- Abre `testimonials-carousel.js`
- Línea ~67: `itemsPerView = isMobile ? 1 : 3`
- Cambia `3` al número deseado

### 7️⃣ SEO automático

El bloque genera **Schema.org Review** automáticamente si:
- Rating ≥ 4 estrellas
- Se incluye autor, opinión y calificación

Verificar en: https://search.google.com/test/rich-results

### 8️⃣ Troubleshooting

| Problema | Solución |
|----------|----------|
| No aparece el bloque | Verificar ACF Pro activo |
| Sin estilos | `npm run tailwind:build` |
| Swipe no funciona | Recarga caché (Ctrl+Shift+Del) |
| Schema no genera | Rating debe ser ≥ 4 |

### 9️⃣ Archivos clave

```
blocks/testimonials-carousel/
├── block.json (configuración)
├── fields.php (campos ACF)
├── render.php (HTML)
├── testimonials-carousel.js (lógica)
├── styles.css (estilos)
├── README.md (docs completa)
└── EXAMPLE.js (referencia)
```

### 🔟 Documentación completa

Ver `README.md` en la carpeta del bloque para guía exhaustiva.

---

**¿Lista para comenzar?** 🚀
Abre WordPress y busca "Testimonios Carousel" en el editor.
