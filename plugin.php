<?php
/**
 * Plugin Name: ACF Blocks Starter
 * Plugin URI: https://github.com/sil7en/wp-plugin-gutenberg-blocks
 * Description: Plugin base para crear bloques Gutenberg personalizados con ACF Pro, Tailwind CSS y mejores prácticas SEO
 * Version: 1.0.0
 * Requires at least: 6.2
 * Requires PHP: 7.4
 * Author: Pablo Silva Pastén Sil7en
 * Author URI: https://github.com/sil7en
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: acf-blocks-starter
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Definir constantes del plugin
define('ACF_BLOCKS_VERSION', '1.0.0');
define('ACF_BLOCKS_PATH', plugin_dir_path(__FILE__));
define('ACF_BLOCKS_URL', plugin_dir_url(__FILE__));

// Incluir archivos necesarios
require_once ACF_BLOCKS_PATH . 'includes/acf-setup.php';
require_once ACF_BLOCKS_PATH . 'includes/register-blocks.php';
require_once ACF_BLOCKS_PATH . 'includes/schema-helper.php';
require_once ACF_BLOCKS_PATH . 'includes/register-ficha-cpt.php';
require_once ACF_BLOCKS_PATH . 'includes/ficha-debug.php';

/**
 * Flush rewrite rules cuando se activa el plugin
 * Esto es CRÍTICO para que funcione single-ficha_animacion.php
 */
function acf_blocks_activation_hook() {
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'acf_blocks_activation_hook');

/**
 * Flush rewrite rules cuando se desactiva el plugin
 */
function acf_blocks_deactivation_hook() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'acf_blocks_deactivation_hook');

/**
 * Encolar estilos compilados de Tailwind
 */
function acf_blocks_enqueue_styles() {
    $css_file = ACF_BLOCKS_PATH . 'dist/blocks.css';
    
    if (file_exists($css_file)) {
        wp_enqueue_style(
            'acf-blocks-styles',
            ACF_BLOCKS_URL . 'dist/blocks.css',
            [],
            filemtime($css_file)
        );
    }
}
add_action('enqueue_block_assets', 'acf_blocks_enqueue_styles');

/**
 * Crear categoría personalizada para los bloques ACF
 */
function acf_blocks_category($categories) {
    return array_merge(
        [
            [
                'slug'  => 'acf-blocks',
                'title' => __('Bloques Personalizados', 'acf-blocks-starter'),
                'icon'  => 'layout',
            ],
        ],
        $categories
    );
}
add_filter('block_categories_all', 'acf_blocks_category');

/**
 * Encolar estilos y scripts para la página de Ficha Técnica
 * CRÍTICO: Esto debe ejecutarse en wp_enqueue_scripts (no en template)
 */
function acf_blocks_enqueue_ficha_assets() {
    // Solo encolar en la página single de ficha_animacion
    if (is_singular('ficha_animacion')) {
        // Encolar CSS
        $css_file = ACF_BLOCKS_PATH . 'ficha-styles.css';
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'ficha-tecnica-styles',
                ACF_BLOCKS_URL . 'ficha-styles.css',
                [],
                filemtime($css_file)
            );
        }
        
        // Encolar JavaScript
        $js_file = ACF_BLOCKS_PATH . 'ficha-script.js';
        if (file_exists($js_file)) {
            wp_enqueue_script(
                'ficha-tecnica-script',
                ACF_BLOCKS_URL . 'ficha-script.js',
                [],
                filemtime($js_file),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'acf_blocks_enqueue_ficha_assets');

/**
 * Registrar plantilla custom para Ficha Técnica desde el tema
 * IMPORTANTE: La plantilla debe estar en wp-content/themes/[theme]/single-ficha_animacion.php
 */
function acf_blocks_register_ficha_template() {
    // Asegurar que la plantilla exista en el tema
    $theme_template = get_template_directory() . '/single-ficha_animacion.php';
    
    // Asegurar que la plantilla exista en el tema y esté actualizada
    $theme_template = get_template_directory() . '/single-ficha_animacion.php';
    
    // Copiar siempre la plantilla del plugin al tema para aplicar correcciones
    $plugin_template = ACF_BLOCKS_PATH . 'single-ficha_animacion.php';
    if (file_exists($plugin_template)) {
        copy($plugin_template, $theme_template);
    }
}
add_action('init', 'acf_blocks_register_ficha_template');

/**
 * Inyectar Schema.org JSON-LD en el <head>
 */
function acf_blocks_output_schema() {
    acfb_output_schema();
}
add_action('wp_head', 'acf_blocks_output_schema');

/**
 * Mensaje de advertencia si ACF Pro no está activo
 */
function acf_blocks_admin_notice() {
    if (!function_exists('acf_register_block_type')) {
        ?>
        <div class="notice notice-error">
            <p>
                <strong><?php _e('ACF Blocks Starter', 'acf-blocks-starter'); ?></strong>: 
                <?php _e('Este plugin requiere Advanced Custom Fields PRO para funcionar.', 'acf-blocks-starter'); ?>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'acf_blocks_admin_notice');
