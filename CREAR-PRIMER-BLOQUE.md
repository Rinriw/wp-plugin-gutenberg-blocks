# 🎓 GUÍA PARA ESTUDIANTES: Crea tu Primer Bloque Gutenberg

Esta guía te mostrará cómo crear tu primer bloque personalizado desde cero.

## 📋 Requisitos

Asegúrate de tener:
- ✅ WordPress 6.2+ instalado
- ✅ ACF Pro 6.0+ instalado y activo
- ✅ Plugin "ACF Blocks Starter" activo
- ✅ Node.js instalado (para Tailwind)
- ✅ Editor VS Code (recomendado)

## 🎯 Objetivo

Crearemos un bloque llamado "Mi Tarjeta" con:
- Título
- Descripción
- Color de fondo

## 🚀 Paso 1: Crear la Carpeta del Bloque

En tu terminal:

```bash
# Ir a la carpeta del plugin
cd c:\xampp\htdocs\wordpress\wp-content\plugins\wp-plugin-gutenberg-blocks

# Crear carpeta del bloque
mkdir blocks/mi-tarjeta

# Crear archivos vacíos
echo. > blocks/mi-tarjeta/block.json
echo. > blocks/mi-tarjeta/fields.php
echo. > blocks/mi-tarjeta/render.php
```

## 📝 Paso 2: Crear el Archivo block.json

Abre `blocks/mi-tarjeta/block.json` y copia esto:

```json
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "acf/mi-tarjeta",
  "title": "Mi Tarjeta",
  "description": "Una tarjeta personalizada para mostrar contenido",
  "category": "acf-blocks",
  "icon": "layout",
  "keywords": ["tarjeta", "card"],
  "acf": {
    "mode": "preview",
    "renderTemplate": "render.php"
  },
  "supports": {
    "align": ["wide", "full"],
    "anchor": true,
    "jsx": true
  }
}
```

**¿Qué significa?**
- `name`: ID único del bloque (siempre con prefijo `acf/`)
- `title`: Nombre visible en el editor
- `renderTemplate`: Qué archivo usar para mostrar

## 🏗️ Paso 3: Definir Campos ACF

Abre `blocks/mi-tarjeta/fields.php` y copia esto:

```php
<?php
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_mi_tarjeta',
        'title' => 'Mi Tarjeta - Campos',
        'fields' => [
            [
                'key' => 'field_tarjeta_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'key' => 'field_tarjeta_descripcion',
                'label' => 'Descripción',
                'name' => 'descripcion',
                'type' => 'textarea',
                'required' => 0,
                'rows' => 5,
            ],
            [
                'key' => 'field_tarjeta_color',
                'label' => 'Color de Fondo',
                'name' => 'color_fondo',
                'type' => 'color_picker',
                'required' => 0,
                'default_value' => '#ffffff',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/mi-tarjeta',
                ],
            ],
        ],
    ]);
}
```

**¿Qué significa?**
- Estamos definiendo 3 campos ACF
- Cada campo tiene un `key` único y un `name` para acceder en PHP
- El `type` define qué tipo de campo es (text, textarea, color_picker)
- El `location` dice: "muestra estos campos cuando sea el bloque acf/mi-tarjeta"

## 🎨 Paso 4: Crear el Template

Abre `blocks/mi-tarjeta/render.php` y copia esto:

```php
<?php
// Obtener los valores de los campos
$titulo = get_field('titulo');
$descripcion = get_field('descripcion');
$color = get_field('color_fondo');

// ID único para el bloque
$block_id = 'tarjeta-' . $block['id'];

// Clases del bloque
$class_name = 'acf-block-mi-tarjeta';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
?>

<div 
    id="<?php echo esc_attr($block_id); ?>" 
    class="<?php echo esc_attr($class_name); ?>"
    style="background-color: <?php echo esc_attr($color); ?>;"
>
    <div class="acfb-p-6 acfb-rounded-lg acfb-shadow-lg acfb-max-w-md">
        
        <?php if ($titulo): ?>
            <h3 class="acfb-text-2xl acfb-font-bold acfb-mb-4">
                <?php echo esc_html($titulo); ?>
            </h3>
        <?php endif; ?>

        <?php if ($descripcion): ?>
            <p class="acfb-text-gray-700">
                <?php echo wp_kses_post($descripcion); ?>
            </p>
        <?php endif; ?>

    </div>
</div>
```

**¿Qué significa?**
- `get_field('titulo')`: Obtiene el valor del campo "titulo"
- `esc_html()`: Escapa caracteres HTML para seguridad
- `wp_kses_post()`: Permite HTML seguro (etiquetas como `<strong>`, `<em>`)
- Clases `acfb-`: Son clases Tailwind con nuestro prefijo

## 🎯 Paso 5: Registrar el Bloque

El archivo `includes/register-blocks.php` ya busca automáticamente todos los bloques. Solo necesitas que el `block.json` exista en tu carpeta.

**Verifica que tu estructura es:**
```
blocks/
  └─ mi-tarjeta/
      ├─ block.json
      ├─ fields.php
      └─ render.php
```

## ✅ Paso 6: Probar en WordPress

1. Ve al Dashboard
2. Abre una página o post
3. Click en "+" para agregar bloque
4. Busca "Mi Tarjeta"
5. ¡Debería aparecer!

Si NO aparece:
- Actualiza la página (Ctrl+F5)
- Verifica que ACF Pro esté activo
- Verifica que el plugin esté activo
- Mira en consola (F12) si hay errores

## 🎨 Paso 7: Personalizar Estilos con Tailwind

Si quieres cambiar cómo se ve, edita `render.php` y usa clases Tailwind:

```php
<!-- ANTES -->
<div class="acfb-p-6 acfb-rounded-lg acfb-shadow-lg">

<!-- DESPUÉS - Rojo con bordes redondeados -->
<div class="acfb-p-8 acfb-rounded-xl acfb-shadow-2xl acfb-bg-red-100 acfb-border-4 acfb-border-red-500">
```

**Clases Tailwind comunes:**
- `acfb-p-6` = padding 6 (espaciado interno)
- `acfb-m-4` = margin 4 (espaciado externo)
- `acfb-text-2xl` = tamaño de texto
- `acfb-font-bold` = texto negrita
- `acfb-bg-blue-500` = fondo azul
- `acfb-rounded-lg` = esquinas redondeadas
- `acfb-shadow-lg` = sombra

⚠️ **IMPORTANTE**: Siempre usa el prefijo `acfb-`

## 🔄 Paso 8: Agregar Más Campos (Opcional)

Si quieres agregar otro campo, en `fields.php` agrega a la array `'fields'`:

```php
[
    'key' => 'field_tarjeta_imagen',
    'label' => 'Imagen',
    'name' => 'imagen',
    'type' => 'image',
    'return_format' => 'array',
],
```

Y en `render.php` úsalo:

```php
$imagen = get_field('imagen');
if ($imagen) {
    echo '<img src="' . esc_url($imagen['url']) . '" />';
}
```

## 💡 Tips Importantes

### SIEMPRE usa acfb- en Tailwind
```php
// ❌ MALO
<div class="flex items-center">

// ✅ BUENO
<div class="acfb-flex acfb-items-center">
```

### SIEMPRE sanitiza la salida
```php
// ❌ MALO
<?php echo $titulo; ?>

// ✅ BUENO
<?php echo esc_html($titulo); ?>
```

### Tipos de campos ACF comunes
- `text` - Texto simple
- `textarea` - Texto multilínea
- `number` - Números
- `email` - Email
- `url` - URLs
- `image` - Imágenes
- `color_picker` - Selector de color
- `select` - Menú desplegable
- `true_false` - Checkbox (sí/no)

## 🚀 Próximos Pasos

1. ✅ Crea tu primer bloque (copia este)
2. ✅ Personaliza los campos
3. ✅ Personaliza los estilos
4. ✅ Prueba en diferentes páginas
5. ✅ Comparte tu bloque con el equipo

## 🆘 Troubleshooting

### Problema: El bloque no aparece en el editor
**Soluciones:**
1. Verifica que `block.json` existe
2. Verifica que ACF Pro está activo
3. Actualiza la página (Ctrl+F5)
4. Busca "Mi Tarjeta" en el buscador de bloques

### Problema: Los estilos no se ven
**Soluciones:**
1. Verifica que usaste `acfb-` en las clases
2. Compila Tailwind: `npm run tailwind:build`
3. Limpia cache: Ctrl+Shift+Delete
4. Ctrl+F5 en la página

### Problema: Los campos no aparecen
**Soluciones:**
1. Verifica que `fields.php` existe
2. Verifica que la sintaxis PHP es correcta
3. Ve a Dashboard → ACF → Field Groups
4. Busca tu grupo y actívalo

## 📚 Recursos Adicionales

- [Documentación Completa del Plugin](./begin.md)
- [Bloque de Ejemplo: Mi Bloque Personalizado](./blocks/mi-bloque/README.md)
- [Documentación ACF Pro](https://www.advancedcustomfields.com/)
- [Referencia Tailwind CSS](https://tailwindcss.com/docs)

---

**¡Lo hiciste!** 🎉

Ahora puedes crear bloques ilimitados siguiendo este mismo proceso.

Para cada bloque nuevo:
1. Crea carpeta en `blocks/`
2. Copia la estructura de archivos
3. Cambia el `name` en block.json
4. Modifica fields.php con tus campos
5. Personaliza render.php
6. ¡Listo!
