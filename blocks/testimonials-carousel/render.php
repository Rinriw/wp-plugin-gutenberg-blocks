<?php
/**
 * Template del bloque Testimonials Carousel
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
$testimonials = get_field('testimonials');
$autoplay = get_field('autoplay');
$autoplay_speed = get_field('autoplay_speed') ?? 5;

// ID único para el bloque
$block_id = 'testimonials-carousel-' . ($block['id'] ?? uniqid());

// Clases del bloque
$class_name = 'acf-block-testimonials-carousel';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Mensaje si no hay testimonios (preview en editor)
if (empty($testimonials) && $is_preview) {
    echo '<div class="acfb-p-8 acfb-bg-secondary-100 acfb-text-center">';
    echo '<p class="acfb-text-secondary-600">👆 Añade testimonios en el panel de la derecha</p>';
    echo '</div>';
    return;
}

if (empty($testimonials)) {
    return;
}

// Generar Schema.org para SEO (solo si hay ratings >= 4)
$has_high_rating = false;
foreach ($testimonials as $testimonial) {
    if (!empty($testimonial['rating']) && $testimonial['rating'] >= 4) {
        $has_high_rating = true;
        break;
    }
}
?>

<section
    id="<?php echo esc_attr($block_id); ?>"
    class="<?php echo esc_attr($class_name); ?>"
    role="region"
    aria-label="Testimonios de clientes"
    data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
    data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>"
>
    <div class="acfb-bg-secondary-50 acfb-py-12 md:acfb-py-16 lg:acfb-py-20">
        <div class="acfb-container acfb-mx-auto acfb-px-4 md:acfb-px-6 lg:acfb-px-8">
            
            <!-- Carrusel Container -->
            <div class="acfb-carousel-wrapper" data-carousel="testimonials">
                
                <!-- Lista de Testimonios -->
                <ul
                    class="acfb-carousel-list"
                    role="listbox"
                    aria-label="Lista de testimonios"
                    data-total-items="<?php echo count($testimonials); ?>"
                >
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <?php
                        $author_name = $testimonial['author_name'];
                        $author_role = $testimonial['author_role'];
                        $author_image = $testimonial['author_image'];
                        $testimonial_text = $testimonial['testimonial_text'];
                        $rating = (int)$testimonial['rating'];
                        $is_high_rating = $rating >= 4 && $has_high_rating;
                        ?>
                        <li
                            class="acfb-carousel-item"
                            role="option"
                            aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                            data-index="<?php echo $index; ?>"
                            <?php if ($is_high_rating): ?>
                            itemscope
                            itemtype="https://schema.org/Review"
                            <?php endif; ?>
                        >
                            <figure class="acfb-testimonial-figure">
                                
                                <!-- Quote / Blockquote -->
                                <blockquote class="acfb-testimonial-quote">
                                    <p
                                        class="acfb-testimonial-text acfb-text-main-black"
                                        <?php if ($is_high_rating): ?>
                                        itemprop="reviewBody"
                                        <?php endif; ?>
                                    >
                                        "<?php echo esc_html($testimonial_text); ?>"
                                    </p>
                                </blockquote>

                                <!-- Figcaption: Autor y Rating -->
                                <figcaption class="acfb-testimonial-caption">
                                    
                                    <!-- Avatar -->
                                    <?php if ($author_image): ?>
                                        <div class="acfb-testimonial-avatar-container">
                                            <img
                                                src="<?php echo esc_url($author_image['url']); ?>"
                                                alt="<?php echo esc_attr($author_name); ?>"
                                                class="acfb-testimonial-avatar"
                                                width="100"
                                                height="100"
                                                loading="lazy"
                                                <?php if ($is_high_rating): ?>
                                                itemprop="author"
                                                itemscope
                                                itemtype="https://schema.org/Person"
                                                <?php endif; ?>
                                            >
                                        </div>
                                    <?php endif; ?>

                                    <!-- Author Info -->
                                    <div class="acfb-testimonial-author-info">
                                        <p
                                            class="acfb-testimonial-author-name acfb-text-main-black acfb-font-semibold"
                                            <?php if ($is_high_rating): ?>
                                            itemprop="author"
                                            <?php endif; ?>
                                        >
                                            <?php echo esc_html($author_name); ?>
                                        </p>
                                        <p class="acfb-testimonial-author-role acfb-text-secondary-600 acfb-text-sm">
                                            <?php echo esc_html($author_role); ?>
                                        </p>
                                    </div>

                                    <!-- Rating Stars -->
                                    <div class="acfb-testimonial-rating" aria-label="Calificación: <?php echo $rating; ?> de 5 estrellas">
                                        <div class="acfb-stars-container">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span
                                                    class="acfb-star <?php echo $i <= $rating ? 'acfb-star-filled' : 'acfb-star-empty'; ?>"
                                                    aria-hidden="true"
                                                    <?php if ($is_high_rating && $i <= $rating): ?>
                                                    itemprop="ratingValue"
                                                    content="<?php echo $rating; ?>"
                                                    <?php endif; ?>
                                                >
                                                    <?php echo $i <= $rating ? '★' : '☆'; ?>
                                                </span>
                                            <?php endfor; ?>
                                        </div>
                                        <?php if ($is_high_rating): ?>
                                            <meta itemprop="ratingValue" content="<?php echo $rating; ?>">
                                            <meta itemprop="bestRating" content="5">
                                            <meta itemprop="worstRating" content="1">
                                        <?php endif; ?>
                                    </div>

                                </figcaption>

                            </figure>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Navegación Desktop: Flechas -->
                <div class="acfb-carousel-nav acfb-hidden md:acfb-flex acfb-items-center acfb-gap-4">
                    <button
                        class="acfb-carousel-nav-btn acfb-carousel-prev"
                        type="button"
                        aria-label="Testimonio anterior"
                        aria-controls="<?php echo esc_attr($block_id); ?>"
                    >
                        <span aria-hidden="true">←</span>
                    </button>
                    <button
                        class="acfb-carousel-nav-btn acfb-carousel-next"
                        type="button"
                        aria-label="Siguiente testimonio"
                        aria-controls="<?php echo esc_attr($block_id); ?>"
                    >
                        <span aria-hidden="true">→</span>
                    </button>
                </div>

            </div>

            <!-- Indicadores: Dots -->
            <div
                class="acfb-carousel-indicators"
                role="tablist"
                aria-label="Selecciona un testimonio"
            >
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <button
                        class="acfb-carousel-dot <?php echo $index === 0 ? 'acfb-active' : ''; ?>"
                        role="tab"
                        type="button"
                        aria-label="Ir al testimonio <?php echo $index + 1; ?> de <?php echo count($testimonials); ?>"
                        aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                        data-slide-index="<?php echo $index; ?>"
                        aria-controls="<?php echo esc_attr($block_id); ?>"
                    ></button>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

</section>
