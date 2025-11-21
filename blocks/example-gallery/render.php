<?php
/**
 * Template del bloque Gallery
 * 
 * @param array $block El bloque actual
 * @param string $content El contenido del bloque
 * @param bool $is_preview True durante preview en editor
 * @param int $post_id El ID del post actual
 */

if (!defined('ABSPATH')) {
    exit;
}

// Obtener valores de los campos
$gallery_title = get_field('gallery_title');
$gallery_items = get_field('gallery_items');
$columns = get_field('columns') ?? '3';
$enable_schema = get_field('enable_schema');

// ID único para el bloque
$block_id = 'gallery-' . ($block['id'] ?? uniqid());

// Clases del bloque
$class_name = 'acf-block-gallery';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Mapear columnas a clases Tailwind
$column_classes = [
    '2' => 'md:acfb-grid-cols-2',
    '3' => 'md:acfb-grid-cols-3',
    '4' => 'md:acfb-grid-cols-4',
];
$grid_class = $column_classes[$columns] ?? 'md:acfb-grid-cols-3';

// Mensaje si no hay contenido (preview en editor)
if (empty($gallery_items) && $is_preview) {
    echo '<div class="acfb-p-8 acfb-bg-secondary-100 acfb-text-center">';
    echo '<p class="acfb-text-secondary-600">👆 Agrega imágenes a la galería en el panel de la derecha</p>';
    echo '</div>';
    return;
}

// Generar Schema.org si está activado
if ($enable_schema && !empty($gallery_items)) {
    $schema_images = [];
    foreach ($gallery_items as $item) {
        if (!empty($item['image'])) {
            $schema_images[] = [
                'url' => $item['image']['url'],
                'alt' => $item['image']['alt'] ?? '',
                'caption' => $item['caption'] ?? '',
            ];
        }
    }
    
    $schema = acfb_create_image_gallery_schema($schema_images);
    if (!empty($schema)) {
        acfb_register_schema($schema);
    }
}
?>

<section 
    id="<?php echo esc_attr($block_id); ?>" 
    class="<?php echo esc_attr($class_name); ?> acfb-py-8"
>
    <?php if ($gallery_title): ?>
        <h2 class="acfb-text-3xl acfb-font-bold acfb-mb-8 acfb-text-center acfb-text-secondary-900">
            <?php echo esc_html($gallery_title); ?>
        </h2>
    <?php endif; ?>

    <?php if (!empty($gallery_items)): ?>
        <!-- Carrusel en mobile (< md), Grid en desktop (>= md) -->
        <div 
            class="gallery-container" 
            data-gallery-id="<?php echo esc_attr($block_id); ?>"
            data-columns="<?php echo esc_attr($columns); ?>"
        >
            <!-- Mobile: Carrusel -->
            <div class="acfb-block md:acfb-hidden">
                <div class="gallery-carousel" data-carousel>
                    <ul class="gallery-track acfb-flex acfb-overflow-x-auto acfb-snap-x acfb-snap-mandatory acfb-scrollbar-hide acfb-gap-4">
                        <?php foreach ($gallery_items as $index => $item): 
                            $image = $item['image'];
                            $caption = $item['caption'] ?? '';
                        ?>
                            <li class="gallery-slide acfb-flex-none acfb-w-full acfb-snap-center">
                                <figure class="acfb-relative acfb-aspect-[4/3] acfb-overflow-hidden acfb-rounded-lg">
                                    <img 
                                        src="<?php echo esc_url($image['url']); ?>" 
                                        alt="<?php echo esc_attr($image['alt'] ?: $caption); ?>"
                                        class="acfb-w-full acfb-h-full acfb-object-cover"
                                        loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                                    >
                                    <?php if ($caption): ?>
                                        <figcaption class="acfb-absolute acfb-bottom-0 acfb-left-0 acfb-right-0 acfb-bg-main-black acfb-bg-opacity-70 acfb-text-main-white acfb-p-4 acfb-text-sm">
                                            <?php echo esc_html($caption); ?>
                                        </figcaption>
                                    <?php endif; ?>
                                </figure>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <!-- Indicadores -->
                    <div class="gallery-indicators acfb-flex acfb-justify-center acfb-gap-2 acfb-mt-4">
                        <?php foreach ($gallery_items as $index => $item): ?>
                            <button 
                                class="gallery-indicator acfb-w-2 acfb-h-2 acfb-rounded-full acfb-bg-secondary-300 acfb-transition-all"
                                data-index="<?php echo $index; ?>"
                                aria-label="Ir a imagen <?php echo $index + 1; ?>"
                            ></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Desktop: Grid -->
            <div class="acfb-hidden md:acfb-block">
                <ul class="acfb-grid <?php echo esc_attr($grid_class); ?> acfb-gap-6">
                    <?php foreach ($gallery_items as $index => $item): 
                        $image = $item['image'];
                        $caption = $item['caption'] ?? '';
                    ?>
                        <li>
                            <figure class="acfb-relative acfb-aspect-[4/3] acfb-overflow-hidden acfb-rounded-lg acfb-group acfb-cursor-pointer acfb-transition-transform hover:acfb-scale-105">
                                <img 
                                    src="<?php echo esc_url($image['url']); ?>" 
                                    alt="<?php echo esc_attr($image['alt'] ?: $caption); ?>"
                                    class="acfb-w-full acfb-h-full acfb-object-cover"
                                    loading="<?php echo $index < 6 ? 'eager' : 'lazy'; ?>"
                                >
                                <?php if ($caption): ?>
                                    <figcaption class="acfb-absolute acfb-bottom-0 acfb-left-0 acfb-right-0 acfb-bg-main-black acfb-bg-opacity-0 group-hover:acfb-bg-opacity-70 acfb-text-main-white acfb-p-4 acfb-text-sm acfb-transition-all acfb-opacity-0 group-hover:acfb-opacity-100">
                                        <?php echo esc_html($caption); ?>
                                    </figcaption>
                                <?php endif; ?>
                            </figure>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</section>
