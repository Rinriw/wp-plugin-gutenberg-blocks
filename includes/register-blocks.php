<?php
/**
 * Registro automático de bloques ACF
 * 
 * Escanea la carpeta /blocks/ y registra todos los bloques
 * que contengan un archivo block.json
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registrar todos los bloques automáticamente
 */
function acf_blocks_register_blocks() {
    // Verificar que ACF Pro esté activo
    if (!function_exists('register_block_type')) {
        return;
    }

    // Escanear carpeta de bloques
    $blocks_dir = ACF_BLOCKS_PATH . 'blocks/';
    
    if (!is_dir($blocks_dir)) {
        return;
    }

    $blocks = glob($blocks_dir . '*', GLOB_ONLYDIR);

    foreach ($blocks as $block) {
        $block_json = $block . '/block.json';
        
        // Registrar el bloque si existe block.json
        if (file_exists($block_json)) {
            register_block_type($block_json);
            
            // Cargar fields.php si existe
            $fields_file = $block . '/fields.php';
            if (file_exists($fields_file)) {
                require_once $fields_file;
            }
        }
    }
}
add_action('init', 'acf_blocks_register_blocks');

/**
 * Encolar JavaScript y CSS de bloques individuales
 */
function acf_blocks_enqueue_block_scripts() {
    $blocks_dir = ACF_BLOCKS_PATH . 'blocks/';
    
    if (!is_dir($blocks_dir)) {
        return;
    }

    $blocks = glob($blocks_dir . '*', GLOB_ONLYDIR);

    foreach ($blocks as $block) {
        $block_name = basename($block);
        $js_file = $block . '/' . $block_name . '.js';
        $css_file = $block . '/styles.css';
        
        // Encolar JS si existe
        if (file_exists($js_file)) {
            wp_enqueue_script(
                'acf-block-' . $block_name,
                ACF_BLOCKS_URL . 'blocks/' . $block_name . '/' . $block_name . '.js',
                [],
                filemtime($js_file),
                true
            );
        }
        
        // Encolar CSS si existe
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'acf-block-' . $block_name . '-styles',
                ACF_BLOCKS_URL . 'blocks/' . $block_name . '/styles.css',
                [],
                filemtime($css_file)
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'acf_blocks_enqueue_block_scripts');
add_action('enqueue_block_editor_assets', 'acf_blocks_enqueue_block_scripts');
