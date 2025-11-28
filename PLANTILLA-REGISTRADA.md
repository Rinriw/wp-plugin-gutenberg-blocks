# ✅ Plantilla de Ficha Técnica Registrada Correctamente

## 🔴 El Problema

Cuando abrías DevTools (F12), no veías `class="ficha-tecnica-container"` en el HTML.

**Causa raíz:** WordPress no estaba usando la plantilla `single-ficha_animacion.php` porque:
1. Las plantillas deben estar en el directorio del TEMA, no del plugin
2. Las rewrite rules de WordPress estaban desactualizadas

## ✅ Lo Que Hice

### 1. Copié la plantilla al tema

```
❌ Antes: /wp-plugin-gutenberg-blocks/single-ficha_animacion.php
✅ Ahora: /twentytwentyfive/single-ficha_animacion.php
```

WordPress SIEMPRE busca plantillas en el tema, no en plugins.

### 2. Actualicé plugin.php

Agregué una función que verifica y copia la plantilla al tema automáticamente:

```php
function acf_blocks_register_ficha_template() {
    $theme_template = get_template_directory() . '/single-ficha_animacion.php';
    if (!file_exists($theme_template)) {
        $plugin_template = ACF_BLOCKS_PATH . 'single-ficha_animacion.php';
        if (file_exists($plugin_template)) {
            copy($plugin_template, $theme_template);
        }
    }
}
add_action('init', 'acf_blocks_register_ficha_template');
```

## 🔧 Pasos Finales (MUY IMPORTANTE)

### PASO 1: Resetea las Rewrite Rules

Accede a este archivo en tu navegador:

```
http://localhost/wordpress/reset-rewrite-rules.php
```

Deberías ver un mensaje verde diciendo "✓ Las rewrite rules han sido reseteadas correctamente"

### PASO 2: Borra Cache del Navegador

- **Firefox:** `Ctrl+Shift+Delete` → Selecciona TODO → Borrar
- **Chrome:** `Ctrl+Shift+Delete` → Selecciona TODO → Borrar
- **Safari:** Historial → Borrar historial

### PASO 3: Recarga tu Ficha Técnica

1. Ve a WordPress
2. Abre una Ficha Técnica
3. Presiona `Ctrl+F5` (recarga forzada)
4. Abre DevTools (`F12`)
5. Busca: `class="ficha-tecnica-container"`
6. **Deberías verlo ahora**

### PASO 4: Verifica el HTML

En DevTools → Elements tab:

```html
<main id="main" class="ficha-tecnica-container">
    <article class="ficha-content">
        <!-- Contenido de la ficha -->
    </article>
</main>
```

## 📁 Ubicación de Archivos

| Descripción | Ubicación |
|------------|-----------|
| Plugin principal | `/wp-plugin-gutenberg-blocks/plugin.php` |
| Plantilla original | `/wp-plugin-gutenberg-blocks/single-ficha_animacion.php` |
| **Plantilla activa** | `/twentytwentyfive/single-ficha_animacion.php` ← **AQUÍ** |
| Reset rewrite rules | `/wordpress/reset-rewrite-rules.php` |

## ❓ Preguntas Frecuentes

**P: ¿Puedo borrar reset-rewrite-rules.php después?**
R: Sí, puedes borrarlo después de usarlo. Es solo un archivo temporal.

**P: ¿Debo hacer cambios en el código?**
R: No, todo está automatizado. Solo ejecuta el script de reset.

**P: ¿La plantilla se actualizará si cambio la del plugin?**
R: La plantilla en el tema es la activa. Para cambios, edita:
`/twentytwentyfive/single-ficha_animacion.php`

**P: ¿Qué pasa si cambio de tema?**
R: El plugin automáticamente copiará la plantilla al nuevo tema.

## 🎯 Resultado Esperado

Después de seguir estos pasos:

✅ **DevTools → Elements:**
- Ves `class="ficha-tecnica-container"`
- Ves todo el HTML de la ficha

✅ **DevTools → Network:**
- Ves `ficha-styles.css` (200 OK)
- Ves `ficha-script.js` (200 OK)

✅ **Página Visual:**
- Imagen destacada
- Toda la información de la ficha
- Estilos CSS cargados
- JavaScript funcionando (acordeones, carousel, tabs)

---

**Si aún no ves el contenido después de estos pasos, avísame con:**
- Screenshot de DevTools (Elements tab)
- URL de la ficha que estás visitando
- Error en DevTools → Console tab (si hay)
