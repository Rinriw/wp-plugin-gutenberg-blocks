# Tailwind CSS con Prefijo

## Regla Obligatoria
**TODAS las clases Tailwind deben usar el prefijo `acfb-`**

## ❌ Incorrecto
```html
<div class="flex items-center justify-between">
<h1 class="text-3xl font-bold text-gray-900">
```

## ✅ Correcto
```html
<div class="acfb-flex acfb-items-center acfb-justify-between">
<h1 class="acfb-text-3xl acfb-font-bold acfb-text-secondary-900">
```

## Paleta de Colores Personalizada

### Uso en Clases
```html
<!-- Colores primarios -->
<div class="acfb-bg-primary-500 acfb-text-main-white">
<button class="acfb-bg-accent-600 hover:acfb-bg-accent-700">
<p class="acfb-text-secondary-700">

<!-- Tonalidades disponibles: 50, 100, 200...900 -->
<div class="acfb-bg-primary-50"> <!-- Muy claro -->
<div class="acfb-bg-primary-500"> <!-- Base -->
<div class="acfb-bg-primary-900"> <!-- Muy oscuro -->
```

### Personalizar Paleta
Editar `tailwind.config.js` en `theme.extend.colors`:

```javascript
primary: {
  500: '#TU_COLOR', // Cambiar valores hex
}
```

## ⛔ Prohibido
- CSS custom en archivos `.css` separados
- Estilos inline con `style=""`
- Clases Tailwind sin prefijo `acfb-`

**Usar SOLO clases Tailwind prefijadas.**
