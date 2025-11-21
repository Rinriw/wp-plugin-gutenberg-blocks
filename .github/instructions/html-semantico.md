# HTML Semántico Obligatorio

## Regla
**Usar elementos HTML5 semánticos según el contexto del contenido.**

## Elementos por Tipo de Contenido

### Navegación
```html
<nav aria-label="Menú principal">
    <ul>
        <li><a href="#">Link</a></li>
    </ul>
</nav>
```

### Encabezados de Página
```html
<header role="banner">
    <h1>Título principal</h1>
</header>
```

### Contenido Principal
```html
<main>
    <article>
        <h2>Título del artículo</h2>
        <p>Contenido...</p>
    </article>
</main>
```

### Secciones
```html
<section>
    <h2>Título de sección</h2>
    <p>Contenido relacionado...</p>
</section>
```

### Contenido Lateral
```html
<aside>
    <h3>Información relacionada</h3>
</aside>
```

### Pie de Página
```html
<footer>
    <p>&copy; 2025 Empresa</p>
</footer>
```

## Listas Repetitivas

### ❌ Incorrecto
```html
<div class="items">
    <div class="item">Item 1</div>
    <div class="item">Item 2</div>
</div>
```

### ✅ Correcto
```html
<!-- Lista desordenada -->
<ul>
    <li>Item 1</li>
    <li>Item 2</li>
</ul>

<!-- Lista ordenada -->
<ol>
    <li>Paso 1</li>
    <li>Paso 2</li>
</ol>
```

## Imágenes con Contexto
```html
<figure>
    <img src="imagen.jpg" alt="Descripción clara">
    <figcaption>Descripción extendida</figcaption>
</figure>
```

## Jerarquía de Headings
```html
<h1>Título principal (solo uno por página)</h1>
    <h2>Subtítulo nivel 2</h2>
        <h3>Subtítulo nivel 3</h3>
```

**No saltar niveles** (h1 → h3 ❌)

## Checklist Pre-Código
- [ ] ¿Es una lista? → `<ul>` o `<ol>`
- [ ] ¿Es navegación? → `<nav>`
- [ ] ¿Es encabezado principal? → `<header>` + `<h1>`
- [ ] ¿Es contenido principal? → `<main>`
- [ ] ¿Tiene imagen + descripción? → `<figure>` + `<figcaption>`

**Prioridad: Semántica sobre diseño.**
