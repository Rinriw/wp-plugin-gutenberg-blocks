<?php
/**
 * ACF Fields para Testimonials Carousel Block
 */

if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_testimonials_carousel',
        'title' => 'Testimonials Carousel Block Fields',
        'fields' => [
            [
                'key' => 'field_testimonials_repeater',
                'label' => 'Testimonios',
                'name' => 'testimonials',
                'type' => 'repeater',
                'instructions' => 'Añade entre 3 y 6 testimonios',
                'min' => 3,
                'max' => 6,
                'button_label' => 'Añadir Testimonio',
                'layout' => 'block',
                'collapsed' => 'field_testimonial_author_name',
                'sub_fields' => [
                    [
                        'key' => 'field_testimonial_author_name',
                        'label' => 'Nombre del Cliente',
                        'name' => 'author_name',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'Ej: María García',
                    ],
                    [
                        'key' => 'field_testimonial_author_role',
                        'label' => 'Cargo / Empresa',
                        'name' => 'author_role',
                        'type' => 'text',
                        'required' => 1,
                        'placeholder' => 'Ej: CEO en TechCorp',
                    ],
                    [
                        'key' => 'field_testimonial_author_image',
                        'label' => 'Foto del Cliente',
                        'name' => 'author_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'required' => 1,
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'instructions' => 'Se recomienda imagen cuadrada de al menos 100x100px',
                    ],
                    [
                        'key' => 'field_testimonial_text',
                        'label' => 'Texto del Testimonio',
                        'name' => 'testimonial_text',
                        'type' => 'textarea',
                        'required' => 1,
                        'rows' => 4,
                        'placeholder' => 'Escribe la opinión del cliente (máximo 280 caracteres)',
                        'instructions' => 'Máximo 280 caracteres',
                        'maxlength' => 280,
                    ],
                    [
                        'key' => 'field_testimonial_rating',
                        'label' => 'Calificación (Estrellas)',
                        'name' => 'rating',
                        'type' => 'range',
                        'required' => 1,
                        'default_value' => 5,
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                        'prepend' => '⭐',
                    ],
                ],
            ],
            [
                'key' => 'field_testimonials_autoplay',
                'label' => 'Rotación Automática',
                'name' => 'autoplay',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'Si está activo, el carrusel rotará automáticamente',
                'ui' => 1,
            ],
            [
                'key' => 'field_testimonials_autoplay_speed',
                'label' => 'Velocidad de Rotación',
                'name' => 'autoplay_speed',
                'type' => 'number',
                'default_value' => 5,
                'min' => 2,
                'max' => 15,
                'step' => 1,
                'append' => 'segundos',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_testimonials_autoplay',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/testimonials-carousel',
                ],
            ],
        ],
    ]);
}
