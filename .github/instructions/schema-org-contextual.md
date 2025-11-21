# Schema.org Contextual

## Regla
**Usar Schema.org SOLO cuando el contenido represente una entidad estructurada clara.**

## Cuándo NO Usar
- Bloques decorativos (hero, banners)
- Contenido genérico sin estructura
- Elementos puramente visuales

## Cuándo SÍ Usar

### 1. FAQPage
**Bloque de preguntas frecuentes**
```php
if ($enable_schema) {
    $faqs = [];
    foreach ($items as $item) {
        $faqs[] = [
            'question' => $item['question'],
            'answer' => $item['answer']
        ];
    }
    acfb_register_schema(acfb_create_faq_schema($faqs));
}
```

### 2. ImageGallery
**Galería de imágenes**
```php
if ($enable_schema) {
    $images = [];
    foreach ($gallery_items as $item) {
        $images[] = [
            'url' => $item['image']['url'],
            'alt' => $item['image']['alt'],
            'caption' => $item['caption']
        ];
    }
    acfb_register_schema(acfb_create_image_gallery_schema($images));
}
```

### 3. HowTo
**Guía paso a paso**
- Tutoriales
- Instrucciones
- Recetas

### 4. Product
**Ficha de producto**
- Nombre, precio, disponibilidad
- Reviews, ratings

### 5. Event
**Evento**
- Fecha, hora, ubicación
- Organizador

## Implementación

### 1. Agregar ACF Toggle
```php
[
    'key' => 'field_enable_schema',
    'label' => 'Activar Schema.org',
    'name' => 'enable_schema',
    'type' => 'true_false',
    'default_value' => 0,
    'ui' => 1,
]
```

### 2. Registrar en render.php
```php
if (get_field('enable_schema')) {
    $schema = [ /* datos */ ];
    acfb_register_schema($schema);
}
```

## Tipos Disponibles
Ver `includes/schema-helper.php`:
- `acfb_create_image_gallery_schema()`
- `acfb_create_faq_schema()`
- Crear custom según necesidad

## Validación
Probar en:
- [Google Rich Results Test](https://search.google.com/test/rich-results)
- [Schema.org Validator](https://validator.schema.org/)

## Checklist Pre-Schema
- [ ] ¿Contenido es entidad estructurada?
- [ ] ¿Tiene datos claros para Schema?
- [ ] ¿Mejora SEO significativamente?

**Si todas ✅ → Implementar Schema con toggle ACF**
