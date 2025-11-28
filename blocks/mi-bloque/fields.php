<?php
/**
 * Campos ACF para el bloque: Mi Bloque Personalizado
 */

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_mi_bloque',
        'title' => 'Mi Bloque Personalizado - Campos',
        'fields' => [
            [
                'key' => 'field_mi_bloque_titulo',
                'label' => 'Título',
                'name' => 'titulo',
                'type' => 'text',
                'required' => 0,
                'placeholder' => 'Escribe un título',
                'default_value' => '',
            ],
            [
                'key' => 'field_mi_bloque_descripcion',
                'label' => 'Descripción',
                'name' => 'descripcion',
                'type' => 'textarea',
                'required' => 0,
                'placeholder' => 'Escribe una descripción',
                'rows' => 5,
                'default_value' => '',
            ],
            [
                'key' => 'field_mi_bloque_color',
                'label' => 'Color de Fondo',
                'name' => 'color_fondo',
                'type' => 'color_picker',
                'required' => 0,
                'default_value' => '#f9f9f9',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/mi-bloque',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ]);
}
