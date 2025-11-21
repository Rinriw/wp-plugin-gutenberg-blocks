<?php
/**
 * Helpers para Schema.org JSON-LD
 * 
 * Funciones auxiliares para registrar y generar
 * datos estructurados Schema.org
 */

if (!defined('ABSPATH')) {
    exit;
}

// Array global para almacenar schemas
global $acfb_schemas;
$acfb_schemas = [];

/**
 * Registrar un schema para ser incluido en el <head>
 * 
 * @param array $schema Array con datos del schema en formato JSON-LD
 */
function acfb_register_schema($schema) {
    global $acfb_schemas;
    
    if (!empty($schema) && is_array($schema)) {
        $acfb_schemas[] = $schema;
    }
}

/**
 * Generar y outputear todos los schemas registrados
 */
function acfb_output_schema() {
    global $acfb_schemas;
    
    if (empty($acfb_schemas)) {
        return;
    }

    // Si hay múltiples schemas, usar @graph
    if (count($acfb_schemas) > 1) {
        $output = [
            '@context' => 'https://schema.org',
            '@graph' => $acfb_schemas
        ];
    } else {
        $output = array_merge(
            ['@context' => 'https://schema.org'],
            $acfb_schemas[0]
        );
    }

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($output, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n</script>\n";
}

/**
 * Tipos de Schema.org más comunes para bloques
 * 
 * @return array Lista de tipos de schema relevantes
 */
function acfb_get_schema_types() {
    return [
        'Article' => 'Artículo o post de blog',
        'BlogPosting' => 'Post de blog específico',
        'ImageGallery' => 'Galería de imágenes',
        'ImageObject' => 'Imagen individual',
        'FAQPage' => 'Página de preguntas frecuentes',
        'Question' => 'Pregunta individual',
        'HowTo' => 'Guía paso a paso',
        'Product' => 'Producto',
        'Review' => 'Reseña',
        'Rating' => 'Calificación',
        'Organization' => 'Organización o empresa',
        'Person' => 'Persona',
        'VideoObject' => 'Video',
        'Event' => 'Evento',
        'LocalBusiness' => 'Negocio local',
        'BreadcrumbList' => 'Migas de pan',
        'WebPage' => 'Página web genérica',
    ];
}

/**
 * Helper para crear schema de ImageGallery
 * 
 * @param array $images Array de imágenes con url, alt, caption
 * @return array Schema de ImageGallery
 */
function acfb_create_image_gallery_schema($images) {
    if (empty($images)) {
        return [];
    }

    $image_objects = [];
    
    foreach ($images as $image) {
        $image_objects[] = [
            '@type' => 'ImageObject',
            'contentUrl' => $image['url'],
            'name' => $image['alt'] ?? '',
            'description' => $image['caption'] ?? '',
        ];
    }

    return [
        '@type' => 'ImageGallery',
        'image' => $image_objects,
    ];
}

/**
 * Helper para crear schema de FAQ
 * 
 * @param array $faqs Array de preguntas con 'question' y 'answer'
 * @return array Schema de FAQPage
 */
function acfb_create_faq_schema($faqs) {
    if (empty($faqs)) {
        return [];
    }

    $main_entity = [];
    
    foreach ($faqs as $faq) {
        $main_entity[] = [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['answer'],
            ],
        ];
    }

    return [
        '@type' => 'FAQPage',
        'mainEntity' => $main_entity,
    ];
}
