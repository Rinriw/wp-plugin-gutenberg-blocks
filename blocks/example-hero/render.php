<?php
/**
 * Template del bloque Hero
 * 
 * @param array $block El bloque actual
 * @param string $content El contenido del bloque (inner blocks)
 * @param bool $is_preview True durante preview en editor
 * @param int $post_id El ID del post actual
 */

if (!defined('ABSPATH')) {
    exit;
}

// Obtener valores de los campos
$title = get_field('title');
$subtitle = get_field('subtitle');
$image = get_field('background_image');
$overlay_opacity = get_field('overlay_opacity') ?? 50;
$hero_height = get_field('hero_height') ?? 'full';

// ID único para el bloque
$block_id = 'hero-' . ($block['id'] ?? uniqid());

// Clases del bloque
$class_name = 'acf-block-hero';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Mapear altura
$height_classes = [
    'small' => 'acfb-h-[50vh]',
    'medium' => 'acfb-h-[75vh]',
    'full' => 'acfb-h-screen',
];
$height_class = $height_classes[$hero_height] ?? 'acfb-h-screen';

// Calcular opacidad
$opacity_value = $overlay_opacity / 100;

// Mensaje si no hay contenido (preview en editor)
if (empty($title) && $is_preview) {
    echo '<div class="acfb-p-8 acfb-bg-secondary-100 acfb-text-center">';
    echo '<p class="acfb-text-secondary-600">👆 Configura el contenido del Hero en el panel de la derecha</p>';
    echo '</div>';
    return;
}
?>

<header 
    id="<?php echo esc_attr($block_id); ?>" 
    class="<?php echo esc_attr($class_name); ?>"
    role="banner"
>
    <div class="acfb-relative <?php echo esc_attr($height_class); ?> acfb-flex acfb-items-center acfb-justify-center acfb-overflow-hidden">
        
        <?php if ($image): ?>
            <!-- Imagen de fondo -->
            <div class="acfb-absolute acfb-inset-0 acfb-z-0">
                <img 
                    src="<?php echo esc_url($image['url']); ?>" 
                    alt="<?php echo esc_attr($image['alt'] ?: $title); ?>"
                    class="acfb-w-full acfb-h-full acfb-object-cover"
                    loading="eager"
                >
                <!-- Overlay -->
                <div 
                    class="acfb-absolute acfb-inset-0 acfb-bg-main-black" 
                    style="opacity: <?php echo esc_attr($opacity_value); ?>;"
                    aria-hidden="true"
                ></div>
            </div>
        <?php else: ?>
            <!-- Fallback si no hay imagen -->
            <div class="acfb-absolute acfb-inset-0 acfb-z-0 acfb-bg-gradient-to-br acfb-from-primary-600 acfb-to-accent-600"></div>
        <?php endif; ?>

        <!-- Contenido -->
        <div class="acfb-relative acfb-z-10 acfb-text-center acfb-text-main-white acfb-px-4 acfb-max-w-5xl acfb-mx-auto">
            <?php if ($title): ?>
                <h1 class="acfb-text-4xl md:acfb-text-5xl lg:acfb-text-6xl acfb-font-bold acfb-mb-6 acfb-leading-tight">
                    <?php echo esc_html($title); ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <p class="acfb-text-lg md:acfb-text-xl lg:acfb-text-2xl acfb-max-w-3xl acfb-mx-auto acfb-leading-relaxed acfb-opacity-90">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>
        </div>

    </div>
</header>
