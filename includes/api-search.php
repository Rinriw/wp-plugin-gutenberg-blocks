<?php
/**
 * API Endpoint for Advanced Search of Fichas
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('rest_api_init', function () {
    register_rest_route('acf-blocks/v1', '/search-fichas', array(
        'methods' => 'GET',
        'callback' => 'acf_blocks_search_fichas',
        'permission_callback' => '__return_true',
    ));
});

function acf_blocks_search_fichas($request) {
    $search_term = $request->get_param('s');
    $format = $request->get_param('format');
    $technique = $request->get_param('technique');
    $year = $request->get_param('year');
    $orderby = $request->get_param('orderby'); // title_asc, year_desc, year_asc

    $args = array(
        'post_type' => 'ficha_animacion',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => array('relation' => 'AND'),
    );

    // Filters
    if (!empty($format)) {
        $args['meta_query'][] = array(
            'key' => 'format',
            'value' => $format,
            'compare' => '='
        );
    }

    if (!empty($technique)) {
        $args['meta_query'][] = array(
            'key' => 'animation_technique',
            'value' => $technique,
            'compare' => '='
        );
    }

    if (!empty($year)) {
        $args['meta_query'][] = array(
            'key' => 'year',
            'value' => $year,
            'compare' => '='
        );
    }

    // Sorting
    if ($orderby === 'title_asc') {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    } elseif ($orderby === 'year_desc') {
        $args['meta_key'] = 'year';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    } elseif ($orderby === 'year_asc') {
        $args['meta_key'] = 'year';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    } else {
        // Default sort: Title ASC
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    }

    // Advanced Text Search (Title OR Meta Fields)
    if (!empty($search_term)) {
        // We need a custom WHERE clause because standard 's' only searches title/content
        // and standard meta_query is too restrictive for "OR" logic across many fields mixed with AND logic for filters
        
        add_filter('posts_where', function($where) use ($search_term) {
            global $wpdb;
            $search = $wpdb->esc_like($search_term);
            $search = '%' . $search . '%';
            
            // Search in Title
            $title_query = $wpdb->prepare("($wpdb->posts.post_title LIKE %s)", $search);
            
            // Search in Meta Fields
            // We join the postmeta table for this specific check
            // Note: This is a simplified approach. For very large DBs, this might be slow.
            // A more robust way is to use a separate join, but for this plugin scope, a subquery or EXISTS is often safer to avoid duplicate rows issues, 
            // OR we can rely on the fact that we want ANY match.
            
            // Let's try a subquery approach for the meta fields to keep the main query clean
            $meta_keys = array(
                'nombre', // Sometimes redundant with title but good to have
                'direccion',
                'guion',
                'productora',
                'produccion',
                'animacion',
                'reparto',
                'fotografia',
                'musica',
                'sonido',
                'direccion_arte',
                'montaje',
                'edicion'
            );
            
            $meta_sub_queries = array();
            foreach ($meta_keys as $key) {
                $meta_sub_queries[] = $wpdb->prepare(
                    "(meta_key = %s AND meta_value LIKE %s)",
                    $key, $search
                );
            }
            $meta_sub_query_sql = implode(' OR ', $meta_sub_queries);
            
            $meta_exists = "EXISTS (
                SELECT 1 FROM $wpdb->postmeta 
                WHERE $wpdb->postmeta.post_id = $wpdb->posts.ID 
                AND ($meta_sub_query_sql)
            )";

            // Combine: (Title LIKE ... OR Meta matches ...)
            $where .= " AND ($title_query OR $meta_exists)";
            
            return $where;
        });
    }

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $id = get_the_ID();
            $afiche = get_field('afiche', $id);
            $afiche_url = $afiche ? $afiche['url'] : ''; // Fallback image could be added here
            
            $formato = get_field('format', $id);
            $formato_custom = get_field('format_custom', $id);
            $formato_display = $formato === 'otro' ? $formato_custom : ucfirst($formato);
            
            $director = get_field('direccion', $id);
            $year_val = get_field('year', $id);

            $results[] = array(
                'id' => $id,
                'title' => get_the_title(),
                'poster' => $afiche_url,
                'year' => $year_val,
                'format' => $formato_display,
                'director' => $director,
                'link' => get_permalink(),
            );
        }
        wp_reset_postdata();
    }

    return rest_ensure_response($results);
}
