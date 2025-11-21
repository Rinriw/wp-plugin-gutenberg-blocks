<?php
/**
 * Configuración de ACF para usar JSON sync
 * 
 * Los field groups se exportan automáticamente como JSON en acf-json/
 * Esto permite sincronizar campos entre diferentes entornos de desarrollo
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Definir carpeta donde ACF guardará los JSON
 */
function acf_blocks_json_save_point($path) {
    return ACF_BLOCKS_PATH . 'acf-json';
}
add_filter('acf/settings/save_json', 'acf_blocks_json_save_point');

/**
 * Definir carpeta desde donde ACF cargará los JSON
 */
function acf_blocks_json_load_point($paths) {
    // Eliminar la ruta por defecto
    unset($paths[0]);
    
    // Agregar nuestra ruta personalizada
    $paths[] = ACF_BLOCKS_PATH . 'acf-json';
    
    return $paths;
}
add_filter('acf/settings/load_json', 'acf_blocks_json_load_point');
