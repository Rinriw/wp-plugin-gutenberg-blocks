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




