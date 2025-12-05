<?php
/**
 * Campos ACF para Ficha Tecnica
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', 'acf_ficha_register_fields');

function acf_ficha_register_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key'      => 'group_ficha_animacion_final',
        'title'    => 'Ficha Tecnica - Datos Completos',
        'fields'   => acf_ficha_get_all_fields(),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'ficha_animacion',
                ),
            ),
        ),
        'menu_order'   => 0,
        'position'     => 'normal',
        'style'        => 'default',
    ));
}

function acf_ficha_get_all_fields() {
    return array(
        // PESTAÑA 1: MINI GALERIA
        array(
            'key'       => 'field_ficha_gallery_tab',
            'label'     => 'Mini galeria de imagenes',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
            'endpoint'  => 0,
        ),
        array(
            'key'        => 'field_ficha_gallery',
            'label'      => 'Galeria de imagenes',
            'name'       => 'gallery',
            'type'       => 'repeater',
            'required'   => 0,
            'layout'     => 'table',
            'button_label' => 'Anadir imagen',
            'sub_fields' => array(
                array(
                    'key'           => 'field_ficha_gallery_image',
                    'label'         => 'Imagen',
                    'name'          => 'image',
                    'type'          => 'image',
                    'required'      => 1,
                    'return_format' => 'array',
                    'preview_size'  => 'thumbnail',
                ),
            ),
        ),

        // PESTAÑA 2: FICHA TECNICA
        array(
            'key'       => 'field_ficha_main_tab',
            'label'     => 'Ficha tecnica',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
            'endpoint'  => 0,
        ),
        array(
            'key'           => 'field_ficha_afiche',
            'label'         => 'Afiche',
            'name'          => 'afiche',
            'type'          => 'image',
            'required'      => 0,
            'return_format' => 'array',
        ),
        array(
            'key'      => 'field_ficha_nombre',
            'label'    => 'Nombre',
            'name'     => 'nombre',
            'type'     => 'text',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
        ),
        array(
            'key'      => 'field_ficha_year',
            'label'    => 'Ano de estreno',
            'name'     => 'year',
            'type'     => 'number',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
            'min'      => 1900,
            'max'      => 2100,
        ),
        array(
            'key'      => 'field_ficha_duration',
            'label'    => 'Duracion',
            'name'     => 'duration',
            'type'     => 'number',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
            'append'   => 'minutos',
            'min'      => 1,
        ),
        array(
            'key'           => 'field_ficha_format',
            'label'         => 'Formato',
            'name'          => 'format',
            'type'          => 'select',
            'required'      => 1,
            'wrapper'       => array('width' => '50'),
            'choices'       => array(
                'cortometraje' => 'Cortometraje',
                'pelicula'     => 'Pelicula',
                'serie'        => 'Serie',
                'videoclip'    => 'Videoclip',
                'miniserie'    => 'Miniserie',
                'otro'         => 'Otro',
            ),
            'return_format' => 'value',
        ),
        array(
            'key'               => 'field_ficha_format_custom',
            'label'             => 'Formato personalizado',
            'name'              => 'format_custom',
            'type'              => 'text',
            'conditional_logic' => array(
                array(
                    array(
                        'field'    => 'field_ficha_format',
                        'operator' => '==',
                        'value'    => 'otro',
                    ),
                ),
            ),
        ),
        array(
            'key'           => 'field_ficha_animation',
            'label'         => 'Tecnica de animacion',
            'name'          => 'animation_technique',
            'type'          => 'select',
            'required'      => 1,
            'wrapper'       => array('width' => '50'),
            'choices'       => array(
                'stop_motion' => 'Stop Motion',
                '2d'          => '2D',
                '3d'          => '3D',
                'tradicional' => 'Tradicional',
                'otro'        => 'Otro',
            ),
            'return_format' => 'value',
        ),
        array(
            'key'               => 'field_ficha_animation_custom',
            'label'             => 'Tecnica personalizada',
            'name'              => 'animation_technique_custom',
            'type'              => 'text',
            'wrapper'           => array('width' => '50'),
            'conditional_logic' => array(
                array(
                    array(
                        'field'    => 'field_ficha_animation',
                        'operator' => '==',
                        'value'    => 'otro',
                    ),
                ),
            ),
        ),
        array(
            'key'      => 'field_ficha_genre',
            'label'    => 'Genero',
            'name'     => 'genre',
            'type'     => 'text',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
        ),
        array(
            'key'      => 'field_ficha_idioma',
            'label'    => 'Idioma',
            'name'     => 'idioma',
            'type'     => 'text',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
        ),
        array(
            'key'      => 'field_ficha_pais',
            'label'    => 'Pais/Region',
            'name'     => 'pais',
            'type'     => 'text',
            'required' => 1,
            'wrapper'  => array('width' => '50'),
        ),
        array(
            'key'      => 'field_ficha_sinopsis',
            'label'    => 'Sinopsis',
            'name'     => 'sinopsis',
            'type'     => 'textarea',
            'required' => 1,
            'wrapper'  => array('width' => '100'),
            'rows'     => 5,
        ),
        array(
            'key'      => 'field_ficha_imdb',
            'label'    => 'Link IMDB',
            'name'     => 'imdb_link',
            'type'     => 'url',
            'required' => 0,
        ),

        // PESTAÑA 3: EQUIPO Y REPARTO
        array(
            'key'       => 'field_ficha_crew_tab',
            'label'     => 'Equipo y Reparto',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
            'endpoint'  => 0,
        ),
        array(
            'key'      => 'field_ficha_direccion',
            'label'    => 'Direccion',
            'name'     => 'direccion',
            'type'     => 'text',
            'required' => 1,
        ),
        array('key' => 'field_ficha_guion', 'label' => 'Guion', 'name' => 'guion', 'type' => 'text'),
        array('key' => 'field_ficha_productora', 'label' => 'Casa Productora', 'name' => 'productora', 'type' => 'text'),
        array('key' => 'field_ficha_produccion', 'label' => 'Produccion', 'name' => 'produccion', 'type' => 'text'),
        array('key' => 'field_ficha_anim_crew', 'label' => 'Animacion', 'name' => 'animacion', 'type' => 'text'),
        array('key' => 'field_ficha_reparto', 'label' => 'Reparto', 'name' => 'reparto', 'type' => 'text'),
        array('key' => 'field_ficha_fotografia', 'label' => 'Fotografia', 'name' => 'fotografia', 'type' => 'text'),
        array('key' => 'field_ficha_musica_crew', 'label' => 'Musica', 'name' => 'musica', 'type' => 'text'),
        array('key' => 'field_ficha_sonido', 'label' => 'Sonido', 'name' => 'sonido', 'type' => 'text'),
        array('key' => 'field_ficha_dir_arte', 'label' => 'Dir. de arte', 'name' => 'direccion_arte', 'type' => 'text'),
        array('key' => 'field_ficha_montaje', 'label' => 'Montaje', 'name' => 'montaje', 'type' => 'text'),
        array('key' => 'field_ficha_edicion', 'label' => 'Edicion', 'name' => 'edicion', 'type' => 'text'),

        // PESTAÑA 4: FINANCIAMIENTO Y PREMIOS
        array(
            'key'       => 'field_ficha_financing_tab',
            'label'     => 'Financiamiento y Premios',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
            'endpoint'  => 0,
        ),
        array(
            'key'      => 'field_ficha_financiamiento',
            'label'    => 'Financiamiento',
            'name'     => 'financiamiento',
            'type'     => 'textarea',
            'required' => 0,
            'rows'     => 4,
        ),
        array(
            'key'          => 'field_ficha_premios',
            'label'        => 'Premios',
            'name'         => 'premios',
            'type'         => 'textarea',
            'required'     => 0,
            'rows'         => 4,
        ),

        // PESTAÑA 5: DISPONIBLE EN
        array(
            'key'       => 'field_ficha_available_tab',
            'label'     => 'Disponible en',
            'name'      => '',
            'type'      => 'tab',
            'placement' => 'top',
            'endpoint'  => 1,
        ),
        array(
            'key'          => 'field_ficha_plataformas',
            'label'        => 'Plataformas',
            'name'         => 'plataformas',
            'type'         => 'repeater',
            'required'     => 0,
            'layout'       => 'block', // Changed to block for better control
            'button_label' => 'Anadir Plataforma',
            'sub_fields'   => array(
                array(
                    'key'           => 'field_ficha_plataforma_servicio',
                    'label'         => 'Servicio',
                    'name'          => 'servicio',
                    'type'          => 'select',
                    'required'      => 1,
                    'wrapper'       => array('width' => '50'),
                    'choices'       => array(
                        'youtube'   => 'YouTube',
                        'netflix'   => 'Netflix',
                        'amazon'    => 'Amazon Prime',
                        'ondamedia' => 'OndaMedia',
                        'hbo'       => 'HBO Max',
                        'otro'      => 'Otro',
                    ),
                    'return_format' => 'value',
                ),
                array(
                    'key'      => 'field_ficha_plataforma_link',
                    'label'    => 'Link',
                    'name'     => 'link',
                    'type'     => 'url',
                    'required' => 1,
                    'wrapper'  => array('width' => '50'),
                ),
                array(
                    'key'               => 'field_ficha_plataforma_nombre_otro',
                    'label'             => 'Nombre de la plataforma',
                    'name'              => 'nombre_otro',
                    'type'              => 'text',
                    'required'          => 1,
                    'wrapper'           => array('width' => '100'),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_ficha_plataforma_servicio',
                                'operator' => '==',
                                'value'    => 'otro',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );
}
