<?php
/**
 * Renderizado del Bloque: Mi Bloque Personalizado
 * 
 * @param array $block El bloque actual
 * @param string $content El contenido del bloque
 * @param bool $is_preview True durante el preview en el editor
 * @param int $post_id El ID del post actual
 */

// Obtener valores de los campos
$titulo = get_field('titulo');
$descripcion = get_field('descripcion');
$color_fondo = get_field('color_fondo');

// ID único para el bloque
$block_id = 'mi-bloque-' . $block['id'];

// Clases del bloque
$class_name = 'acf-block-mi-bloque';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Color de fondo por defecto
$bg_color = !empty($color_fondo) ? $color_fondo : '#f9f9f9';
?>

<div 
    id="<?php echo esc_attr($block_id); ?>" 
    class="<?php echo esc_attr($class_name); ?>"
    style="background-color: <?php echo esc_attr($bg_color); ?>;"
>
    <div class="acfb-p-8 acfb-max-w-4xl acfb-mx-auto">
        
        <?php if ($titulo): ?>
            <h2 class="acfb-text-3xl acfb-font-bold acfb-mb-4 acfb-text-gray-800">
                <?php echo esc_html($titulo); ?>
            </h2>
        <?php endif; ?>

        <?php if ($descripcion): ?>
            <p class="acfb-text-lg acfb-text-gray-600 acfb-leading-relaxed">
                <?php echo wp_kses_post($descripcion); ?>
            </p>
        <?php endif; ?>

        <?php if (!$titulo && !$descripcion): ?>
            <div class="acfb-p-8 acfb-bg-yellow-50 acfb-border-2 acfb-border-yellow-300 acfb-rounded-lg">
                <p class="acfb-text-yellow-800 acfb-font-semibold">
                    👋 Configura este bloque agregando un título y descripción desde el editor
                </p>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    #<?php echo esc_attr($block_id); ?> {
        border-radius: 8px;
        transition: all 0.3s ease;
    }
</style>
