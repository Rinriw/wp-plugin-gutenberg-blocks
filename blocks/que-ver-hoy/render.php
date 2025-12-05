<?php
/**
 * Block Template: Qué ver hoy
 * 
 * Muestra una recomendación diaria de una obra audiovisual.
 * Se actualiza cada 24 horas a las 00:00.
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Nombre del transient para almacenar el ID de la recomendación diaria
$transient_name = 'que_ver_hoy_daily_id';

// Intentar obtener el ID del transient
$recommended_id = get_transient($transient_name);

// Si no hay ID guardado o el transient expiró, buscar uno nuevo
if (false === $recommended_id) {
    // Argumentos para buscar una ficha aleatoria
    $args = array(
        'post_type'      => 'ficha_animación', // Asegurarse que el slug sea correcto (con tilde o sin tilde, revisar registro)
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
        'fields'         => 'ids', // Solo necesitamos el ID
    );

    // Nota: El slug del CPT suele ser 'ficha_animacion' (sin tilde) en la mayoría de los casos. 
    // Verificaré con un fallback si no encuentra nada.
    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        // Intentar con slug sin tilde por si acaso
        $args['post_type'] = 'ficha_animacion';
        $query = new WP_Query($args);
    }

    if ($query->have_posts()) {
        $recommended_id = $query->posts[0];

        // Calcular tiempo hasta la próxima medianoche (00:00)
        // Usamos current_time para respetar la zona horaria de WP
        $now = current_time('timestamp');
        $tomorrow_midnight = strtotime('tomorrow 00:00:00', $now);
        $seconds_until_midnight = $tomorrow_midnight - $now;

        // Guardar en transient
        set_transient($transient_name, $recommended_id, $seconds_until_midnight);
    }
}

// Si aún no hay ID (p.ej. no hay posts), no mostrar nada
if (!$recommended_id) {
    if (is_admin()) {
        echo '<p>No hay fichas de animación disponibles para mostrar.</p>';
    }
    return;
}

// Obtener datos del post seleccionado
$post_id = $recommended_id;
$afiche = get_field('afiche', $post_id);
$nombre = get_field('nombre', $post_id);
if (empty($nombre)) {
    $nombre = get_the_title($post_id);
}
$year = get_field('year', $post_id);

// URL del post
$permalink = get_permalink($post_id);

// Clases del bloque
$class_name = 'que-ver-hoy-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div class="<?php echo esc_attr($class_name); ?>">
    <a href="<?php echo esc_url($permalink); ?>" class="que-ver-hoy-card">
        <div class="que-ver-hoy-content">
            <?php if ($afiche) : ?>
                <div class="que-ver-hoy-image">
                    <img src="<?php echo esc_url($afiche['url']); ?>" alt="<?php echo esc_attr($nombre); ?>">
                </div>
            <?php endif; ?>
            
            <div class="que-ver-hoy-info">
                <h3 class="que-ver-hoy-title"><?php echo esc_html($nombre); ?></h3>
                <?php if ($year) : ?>
                    <span class="que-ver-hoy-year"><?php echo esc_html($year); ?></span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="que-ver-hoy-badge">
            Qué ver hoy
        </div>
    </a>
</div>
