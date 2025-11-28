<?php
/**
 * Registrar Custom Post Type: Ficha tecnica
 * Para obras audiovisuales animadas chilenas
 */

if (!defined('ABSPATH')) {
    exit;
}

function acf_blocks_register_ficha_cpt() {
    $labels = array(
        'name'                  => 'Fichas Técnicas',
        'singular_name'         => 'Ficha Técnica',
        'menu_name'             => 'Fichas Técnicas',
        'name_admin_bar'        => 'Ficha Técnica',
        'all_items'             => 'Todas las Fichas',
        'add_new_item'          => 'Añadir Nueva Ficha',
        'edit_item'             => 'Editar Ficha',
        'view_item'             => 'Ver Ficha',
        'search_items'          => 'Buscar Fichas',
    );

    $args = array(
        'label'                 => 'Fichas Tecnicas',
        'labels'                => $labels,
        'description'           => 'Fichas tecnicas de obras audiovisuales animadas',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'show_in_rest'          => true,
        'rest_base'             => 'ficha-animacion',
        'has_archive'           => false,
        'hierarchical'          => false,
        'can_export'            => true,
        'delete_with_user'      => false,
        'exclude_from_search'   => false,
        'capability_type'       => 'post',
        'map_meta_cap'          => true,
        'rewrite'               => array(
            'slug'              => 'ficha-animacion',
            'with_front'        => true,
        ),
        'supports'              => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'custom-fields',
            'revisions',
            'author',
        ),
        'menu_icon'             => 'dashicons-format-image',
    );

    register_post_type('ficha_animacion', $args);
}
add_action('init', 'acf_blocks_register_ficha_cpt');


function acf_blocks_register_ficha_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key'      => 'group_ficha_animacion',
        'title'    => 'Ficha Tecnica - Datos Completos',
        'fields'   => array(
            // TAB 1: GALERIA
            array(
                'key'       => 'tab_gallery',
                'label'     => 'Mini galeria',
                'name'      => '',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ),
            array(
                'key'          => 'field_gallery',
                'label'        => 'Galeria de imagenes',
                'name'         => 'gallery',
                'type'         => 'repeater',
                'required'     => 0,
                'layout'       => 'table',
                'button_label' => 'Anadir imagen',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_gallery_img',
                        'label'         => 'Imagen',
                        'name'          => 'image',
                        'type'          => 'image',
                        'required'      => 1,
                        'return_format' => 'array',
                    ),
                ),
            ),
            // TAB 2: FICHA TECNICA
            array(
                'key'       => 'tab_ficha',
                'label'     => 'Ficha tecnica',
                'name'      => '',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ),
            array(
                'key'           => 'field_afiche',
                'label'         => 'Afiche',
                'name'          => 'afiche',
                'type'          => 'image',
                'required'      => 0,
                'return_format' => 'array',
            ),
            array('key' => 'f_nombre', 'label' => 'Nombre', 'name' => 'nombre', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_year', 'label' => 'Año de estreno', 'name' => 'year', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_duration', 'label' => 'Duración', 'name' => 'duration', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_format', 'label' => 'Formato', 'name' => 'format', 'type' => 'select', 'required' => 1, 'wrapper' => array('width' => '50'), 'choices' => array('cortometraje' => 'Cortometraje', 'pelicula' => 'Película', 'serie' => 'Serie', 'videoclip' => 'Videoclip', 'miniserie' => 'Miniserie', 'otro' => 'Otro')),
            array('key' => 'f_format_custom', 'label' => 'Formato personalizado', 'name' => 'format_custom', 'type' => 'text', 'conditional_logic' => array(array(array('field' => 'f_format', 'operator' => '==', 'value' => 'otro')))),
            array('key' => 'f_anim_tech', 'label' => 'Técnica de animación', 'name' => 'animation_technique', 'type' => 'select', 'required' => 1, 'wrapper' => array('width' => '50'), 'choices' => array('stop_motion' => 'Stop Motion', '2d' => '2D', '3d' => '3D', 'tradicional' => 'Tradicional', 'otro' => 'Otro')),
            array('key' => 'f_anim_custom', 'label' => 'Técnica personalizada', 'name' => 'animation_technique_custom', 'type' => 'text', 'wrapper' => array('width' => '50'), 'conditional_logic' => array(array(array('field' => 'f_anim_tech', 'operator' => '==', 'value' => 'otro')))),
            array('key' => 'f_genre', 'label' => 'Género', 'name' => 'genre', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_idioma', 'label' => 'Idioma', 'name' => 'idioma', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_pais', 'label' => 'País/Región', 'name' => 'pais', 'type' => 'text', 'required' => 1, 'wrapper' => array('width' => '50')),
            array('key' => 'f_sinopsis', 'label' => 'Sinopsis', 'name' => 'sinopsis', 'type' => 'textarea', 'required' => 1, 'wrapper' => array('width' => '100'), 'rows' => 5),
            array('key' => 'f_imdb', 'label' => 'Link IMDB', 'name' => 'imdb_link', 'type' => 'url', 'required' => 0),
            // TAB 3: EQUIPO Y REPARTO
            array('key' => 'tab_crew', 'label' => 'Equipo y Reparto', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0),
            array('key' => 'f_dir', 'label' => 'Dirección', 'name' => 'direccion', 'type' => 'text', 'required' => 1),
            array('key' => 'f_guion', 'label' => 'Guión', 'name' => 'guion', 'type' => 'text'),
            array('key' => 'f_prod_house', 'label' => 'Casa Productora', 'name' => 'productora', 'type' => 'text'),
            array('key' => 'f_prod', 'label' => 'Producción', 'name' => 'produccion', 'type' => 'text'),
            array('key' => 'f_anim', 'label' => 'Animación', 'name' => 'animacion', 'type' => 'text'),
            array('key' => 'f_reparto', 'label' => 'Reparto', 'name' => 'reparto', 'type' => 'text'),
            array('key' => 'f_fotografia', 'label' => 'Fotografía', 'name' => 'fotografia', 'type' => 'text'),
            array('key' => 'f_musica', 'label' => 'Música', 'name' => 'musica', 'type' => 'text'),
            array('key' => 'f_sonido', 'label' => 'Sonido', 'name' => 'sonido', 'type' => 'text'),
            array('key' => 'f_dir_arte', 'label' => 'Dir. de arte', 'name' => 'direccion_arte', 'type' => 'text'),
            array('key' => 'f_montaje', 'label' => 'Montaje', 'name' => 'montaje', 'type' => 'text'),
            array('key' => 'f_edicion', 'label' => 'Edición', 'name' => 'edicion', 'type' => 'text'),
            // TAB 4: FINANCIAMIENTO
            array('key' => 'tab_financing', 'label' => 'Financiamiento y Premios', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0),
            array('key' => 'f_financing', 'label' => 'Financiamiento', 'name' => 'financiamiento', 'type' => 'textarea', 'required' => 0, 'rows' => 4),
            array('key' => 'f_premios', 'label' => 'Premios y Festivales', 'name' => 'premios', 'type' => 'textarea', 'required' => 0, 'rows' => 4),
            // TAB 5: DISPONIBLE EN
            array('key' => 'tab_available', 'label' => 'Disponible en', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 1),
            array('key' => 'f_plataformas', 'label' => 'Plataformas', 'name' => 'plataformas', 'type' => 'repeater', 'required' => 0, 'layout' => 'table', 'button_label' => 'Anadir Plataforma', 'sub_fields' => array(
                array('key' => 'f_plat_servicio', 'label' => 'Servicio', 'name' => 'servicio', 'type' => 'select', 'required' => 1, 'wrapper' => array('width' => '50'), 'choices' => array('youtube' => 'YouTube', 'netflix' => 'Netflix', 'amazon' => 'Amazon Prime', 'ondamedia' => 'OndaMedia', 'hbo' => 'HBO Max', 'otro' => 'Otro')),
                array('key' => 'f_plat_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url', 'required' => 1, 'wrapper' => array('width' => '50')),
            )),
        ),
        'location' => array(array(array('param' => 'post_type', 'operator' => '==', 'value' => 'ficha_animacion'))),
    ));
}
add_action('acf/init', 'acf_blocks_register_ficha_fields');

