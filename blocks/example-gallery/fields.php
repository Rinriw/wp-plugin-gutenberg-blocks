<?php
/**
 * ACF Fields para Gallery Block
 */

if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_gallery',
        'title' => 'Gallery Block Fields',
        'fields' => [
            [
                'key' => 'field_gallery_title',
                'label' => 'Título de la Galería',
                'name' => 'gallery_title',
                'type' => 'text',
                'placeholder' => 'Ej: Nuestros Proyectos',
            ],
            [
                'key' => 'field_gallery_items',
                'label' => 'Imágenes',
                'name' => 'gallery_items',
                'type' => 'repeater',
                'required' => 1,
                'min' => 1,
                'max' => 20,
                'layout' => 'block',
                'button_label' => 'Agregar Imagen',
                'sub_fields' => [
                    [
                        'key' => 'field_gallery_item_image',
                        'label' => 'Imagen',
                        'name' => 'image',
                        'type' => 'image',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ],
                    [
                        'key' => 'field_gallery_item_caption',
                        'label' => 'Descripción',
                        'name' => 'caption',
                        'type' => 'textarea',
                        'rows' => 2,
                        'placeholder' => 'Descripción opcional de la imagen',
                    ],
                ],
            ],
            [
                'key' => 'field_gallery_columns',
                'label' => 'Columnas en Desktop',
                'name' => 'columns',
                'type' => 'select',
                'choices' => [
                    '2' => '2 columnas',
                    '3' => '3 columnas',
                    '4' => '4 columnas',
                ],
                'default_value' => '3',
                'instructions' => 'En mobile siempre será un carrusel de 1 item',
            ],
            [
                'key' => 'field_gallery_enable_schema',
                'label' => 'Activar Schema.org',
                'name' => 'enable_schema',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
                'instructions' => 'Activar datos estructurados de ImageGallery para SEO',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gallery',
                ],
            ],
        ],
    ]);
}
