<?php
/**
 * ACF Fields para Hero Block
 */

if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_hero',
        'title' => 'Hero Block Fields',
        'fields' => [
            [
                'key' => 'field_hero_title',
                'label' => 'Título Principal',
                'name' => 'title',
                'type' => 'text',
                'required' => 1,
                'placeholder' => 'Escribe el título principal',
                'instructions' => 'Será renderizado como H1 (máximo uno por página)',
            ],
            [
                'key' => 'field_hero_subtitle',
                'label' => 'Subtítulo',
                'name' => 'subtitle',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => 'Texto descriptivo del hero',
            ],
            [
                'key' => 'field_hero_image',
                'label' => 'Imagen de Fondo',
                'name' => 'background_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
                'instructions' => 'Imagen de alta resolución. Se recomienda al menos 1920x1080px',
            ],
            [
                'key' => 'field_hero_overlay_opacity',
                'label' => 'Opacidad del Overlay',
                'name' => 'overlay_opacity',
                'type' => 'range',
                'default_value' => 50,
                'min' => 0,
                'max' => 100,
                'step' => 10,
                'append' => '%',
                'instructions' => 'Controla la oscuridad de la capa sobre la imagen',
            ],
            [
                'key' => 'field_hero_height',
                'label' => 'Altura del Hero',
                'name' => 'hero_height',
                'type' => 'select',
                'choices' => [
                    'small' => 'Pequeño (50vh)',
                    'medium' => 'Mediano (75vh)',
                    'full' => 'Pantalla completa (100vh)',
                ],
                'default_value' => 'full',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/hero',
                ],
            ],
        ],
    ]);
}
