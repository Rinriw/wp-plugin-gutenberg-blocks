# Mi Bloque Personalizado

Bloque de ejemplo para que los estudiantes aprendan cómo crear bloques Gutenberg con ACF Pro.

## 🎯 Características

- ✅ Bloque simple con 3 campos ACF
- ✅ Título (texto)
- ✅ Descripción (textarea)
- ✅ Selector de color de fondo
- ✅ Clases Tailwind con prefijo `acfb-`
- ✅ Responde a cambios en tiempo real

## 📋 Archivos

```
blocks/mi-bloque/
├── block.json           # Configuración del bloque
├── fields.php           # Definición de campos ACF
├── render.php           # Template de renderizado
└── README.md            # Este archivo
```

## 📊 Campos ACF

| Campo | Tipo | Requerido | Descripción |
|-------|------|-----------|------------|
| titulo | text | No | Título del bloque |
| descripcion | textarea | No | Descripción del contenido |
| color_fondo | color_picker | No | Selector de color de fondo |

## 🎨 Cómo Usar

### 1. En el Editor Gutenberg
1. Abre una página o post
2. Click en "+" para agregar bloque
3. Busca "Mi Bloque Personalizado"
4. Completa los campos (todos son opcionales)
5. El preview se actualiza automáticamente

### 2. Ejemplo de Salida

```html
<div id="mi-bloque-123" class="acf-block-mi-bloque" style="background-color: #f0f0f0;">
    <div class="acfb-p-8 acfb-max-w-4xl acfb-mx-auto">
        <h2 class="acfb-text-3xl acfb-font-bold acfb-mb-4">Título</h2>
        <p class="acfb-text-lg acfb-text-gray-600">Descripción</p>
    </div>
</div>
```

## 🎓 Qué Aprender de Este Bloque

### Registro del Bloque (block.json)
```json
{
  "name": "acf/mi-bloque",                    // Nombre único
  "title": "Mi Bloque Personalizado",         // Título visible
  "category": "acf-blocks",                   // Categoría
  "acf": {
    "renderTemplate": "render.php"            // Template a usar
  }
}
```

### Campos ACF (fields.php)
```php
acf_add_local_field_group([
    'location' => [
        [
            [
                'param' => 'block',
                'value' => 'acf/mi-bloque'    // Asociar al bloque
            ]
        ]
    ]
]);
```

### Renderizado (render.php)
```php
$titulo = get_field('titulo');                // Obtener campo
<?php echo esc_html($titulo); ?>              // Mostrar seguro
```

## 🔄 Cómo Personalizar

### Cambiar el Título del Bloque
En `block.json`:
```json
"title": "Mi Nuevo Nombre"
```

### Agregar Más Campos
En `fields.php`, agregar a la array `'fields'`:
```php
[
    'key' => 'field_nuevo',
    'label' => 'Nuevo Campo',
    'name' => 'nuevo_campo',
    'type' => 'text',
]
```

### Cambiar el Estilo
En `render.php`:
```php
<div class="acfb-bg-blue-500 acfb-text-white">
    <!-- Usa clases Tailwind con prefijo acfb- -->
</div>
```

## 💡 Tips

### Prefijo Tailwind
SIEMPRE usa `acfb-` en las clases:
- ❌ `class="flex items-center"`
- ✅ `class="acfb-flex acfb-items-center"`

### Sanitización
SIEMPRE sanitiza la salida:
- `esc_html()` para texto simple
- `wp_kses_post()` para HTML permitido
- `esc_attr()` para atributos HTML
- `esc_url()` para URLs

### Acceso a Campos
```php
// Obtener campo simple
$titulo = get_field('titulo');

// Obtener con valor por defecto
$titulo = get_field('titulo') ?: 'Sin título';

// Validar antes de mostrar
if ($titulo) {
    echo esc_html($titulo);
}
```

## 📚 Aprende Más

- [Documentación ACF Pro](https://www.advancedcustomfields.com/resources/)
- [Referencia Tailwind CSS](https://tailwindcss.com/docs)
- [WordPress Block API](https://developer.wordpress.org/block-editor/)

## 🚀 Próximo Paso

Copia este bloque y crea el tuyo:
1. Copia la carpeta `blocks/mi-bloque/` a `blocks/mi-nuevo-bloque/`
2. Cambia el nombre en `block.json`
3. Modifica los campos en `fields.php`
4. Personaliza el template en `render.php`
5. ¡Listo!

---

**Versión**: 1.0.0  
**Status**: Ejemplo / Referencia  
**Compatible con**: WordPress 6.2+, ACF Pro 6.0+
