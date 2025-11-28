<?php
/**
 * Diagnóstico Automático de Ficha Técnica
 * 
 * Uso:
 * 1. Guarda este archivo en la raíz de tu WordPress
 * 2. Accede a: http://localhost/wordpress/diagnostic.php
 * 3. Lee los resultados
 * 4. Sigue las recomendaciones
 */

// No necesita WordPress, solo información de diagnóstico
?>
<!DOCTYPE html>
<html>
<head>
    <title>Diagnóstico - Ficha Técnica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        h1 { color: #333; }
        .check { 
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            border-left: 4px solid;
        }
        .ok {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        .warning {
            background: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }
        .error {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        .section { margin: 30px 0; }
        code {
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        .solution {
            background: white;
            padding: 15px;
            margin-top: 10px;
            border-left: 3px solid #007bff;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>🔧 Diagnóstico: Ficha Técnica - Custom Post Type</h1>

<?php
// Detectar entorno
$wordpress_root = dirname(__FILE__);
$plugin_path = $wordpress_root . '/wp-content/plugins/wp-plugin-gutenberg-blocks';
$template_file = $plugin_path . '/single-ficha_animacion.php';
$htaccess_file = $wordpress_root . '/.htaccess';

echo '<div class="section">';
echo '<h2>📊 Información del Sistema</h2>';

// Información básica
echo '<div class="check ok">';
echo '<strong>✅ PHP Version:</strong> ' . phpversion() . '<br>';
echo '<strong>✅ Operating System:</strong> ' . php_uname() . '<br>';
echo '<strong>✅ Server Software:</strong> ' . (isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'Desconocido') . '<br>';
echo '</div>';

echo '</div>';

// Verificar archivos
echo '<div class="section">';
echo '<h2>📁 Verificación de Archivos</h2>';

// 1. Template
echo '<div class="check ' . (file_exists($template_file) ? 'ok' : 'error') . '">';
if (file_exists($template_file)) {
    echo '<strong>✅ Template encontrado:</strong> <code>single-ficha_animacion.php</code><br>';
    echo 'Ubicación: <code>' . $template_file . '</code><br>';
    echo 'Tamaño: ' . filesize($template_file) . ' bytes';
} else {
    echo '<strong>❌ Template NO ENCONTRADO:</strong> <code>single-ficha_animacion.php</code><br>';
    echo 'Ubicación esperada: <code>' . $template_file . '</code><br>';
    echo '<div class="solution">';
    echo '<strong>Solución:</strong> El archivo template debe estar en la raíz del plugin.<br>';
    echo 'Verifica que existe en: ' . $plugin_path . '/';
    echo '</div>';
}
echo '</div>';

// 2. Archivo CPT
$cpt_file = $plugin_path . '/includes/register-ficha-cpt.php';
echo '<div class="check ' . (file_exists($cpt_file) ? 'ok' : 'error') . '">';
if (file_exists($cpt_file)) {
    echo '<strong>✅ CPT Registration encontrado:</strong> <code>register-ficha-cpt.php</code><br>';
    echo 'Ubicación: <code>' . $cpt_file . '</code>';
} else {
    echo '<strong>❌ CPT Registration NO ENCONTRADO</strong><br>';
    echo 'Ubicación esperada: <code>' . $cpt_file . '</code>';
}
echo '</div>';

// 3. .htaccess
echo '<div class="check ' . (file_exists($htaccess_file) ? 'ok' : 'warning') . '">';
if (file_exists($htaccess_file)) {
    echo '<strong>✅ .htaccess encontrado</strong><br>';
    echo 'Ubicación: <code>' . $htaccess_file . '</code>';
} else {
    echo '<strong>⚠️ .htaccess NO ENCONTRADO</strong><br>';
    echo 'Ubicación esperada: <code>' . $htaccess_file . '</code><br>';
    echo '<div class="solution">';
    echo '<strong>Solución:</strong> Crea un archivo <code>.htaccess</code> en la raíz de WordPress<br>';
    echo 'Contenido recomendado:<br>';
    echo '<pre>';
echo htmlspecialchars('# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /wordpress/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /wordpress/index.php [L]
</IfModule>
# END WordPress');
    echo '</pre>';
    echo 'Ver: <strong>HTACCESS-SETUP.md</strong> para instrucciones detalladas';
    echo '</div>';
}
echo '</div>';

echo '</div>';

// Verificar módulos Apache
echo '<div class="section">';
echo '<h2>⚙️ Verificación de Apache Modules</h2>';

$modules = apache_get_modules();
$has_rewrite = in_array('mod_rewrite', $modules);

echo '<div class="check ' . ($has_rewrite ? 'ok' : 'error') . '">';
if ($has_rewrite) {
    echo '<strong>✅ mod_rewrite está HABILITADO</strong><br>';
    echo 'Las URLs amigables funcionarán correctamente';
} else {
    echo '<strong>❌ mod_rewrite NO está habilitado</strong><br>';
    echo '<div class="solution">';
    echo '<strong>Solución (para XAMPP):</strong><br>';
    echo '1. Abre: <code>C:\\xampp\\apache\\conf\\httpd.conf</code><br>';
    echo '2. Busca: <code>#LoadModule rewrite_module modules/mod_rewrite.so</code><br>';
    echo '3. Quita el <code>#</code> al inicio<br>';
    echo '4. Guarda el archivo<br>';
    echo '5. Reinicia Apache (XAMPP Control Panel)';
    echo '</div>';
}
echo '</div>';

// Otros módulos útiles
$other_modules = [
    'mod_deflate' => 'Compresión',
    'mod_headers' => 'Headers personalizados',
    'mod_ssl' => 'SSL/HTTPS'
];

foreach ($other_modules as $module => $description) {
    $installed = in_array($module, $modules) ? '✅' : '❌';
    echo '<div class="check">';
    echo '<strong>' . $installed . ' ' . $module . ':</strong> ' . $description;
    echo '</div>';
}

echo '</div>';

// Información de WordPress (si está disponible)
echo '<div class="section">';
echo '<h2>🔧 Configuración WordPress</h2>';

$config_file = $wordpress_root . '/wp-config.php';
if (file_exists($config_file)) {
    // Leer configuración
    require_once($config_file);
    
    // Permalink structure (necesita WordPress cargado)
    if (function_exists('get_option')) {
        $permalink = get_option('permalink_structure');
        echo '<div class="check ' . (!empty($permalink) ? 'ok' : 'warning') . '">';
        echo '<strong>Permalink Structure:</strong> ';
        if (!empty($permalink)) {
            echo '<code>' . htmlspecialchars($permalink) . '</code>';
        } else {
            echo 'Predeterminado (URLs feas)';
            echo '<div class="solution">';
            echo '<strong>Recomendación:</strong> Ve a Settings → Permalinks y selecciona "Post name"';
            echo '</div>';
        }
        echo '</div>';
    }
}

echo '</div>';

// Recomendaciones finales
echo '<div class="section" style="background: #e3f2fd; padding: 20px; border-radius: 4px;">';
echo '<h2>📋 Recomendaciones</h2>';
echo '<ol>';
echo '<li><strong>Verificar plugin activado:</strong> Dashboard → Plugins → "ACF Blocks Starter" debe estar ✅ Activo</li>';
echo '<li><strong>Verificar ACF Pro:</strong> Dashboard → Plugins → "Advanced Custom Fields Pro" debe estar ✅ Activo</li>';
echo '<li><strong>Resetear permalinks:</strong> Settings → Permalinks → Cambiar a "Post name" → Guardar cambios</li>';
echo '<li><strong>Crear ficha de prueba:</strong> Dashboard → Ficha Animación → Agregar Nueva</li>';
echo '<li><strong>Probar acceso:</strong> Haz clic en "Ver" en la ficha creada</li>';
echo '</ol>';
echo '</div>';

// Enlaces útiles
echo '<div class="section" style="background: #f0f0f0; padding: 15px; border-radius: 4px;">';
echo '<h2>📚 Documentación</h2>';
echo '<ul>';
echo '<li><a href="../ACTIVATION-GUIDE.md">ACTIVATION-GUIDE.md</a> - Guía de activación del plugin</li>';
echo '<li><a href="../HTACCESS-SETUP.md">HTACCESS-SETUP.md</a> - Configuración de .htaccess</li>';
echo '<li><a href="../TROUBLESHOOTING-FICHAS.md">TROUBLESHOOTING-FICHAS.md</a> - Solución de problemas</li>';
echo '<li><a href="../FICHA-QUICKSTART.md">FICHA-QUICKSTART.md</a> - Guía rápida</li>';
echo '</ul>';
echo '</div>';

?>

<div style="margin-top: 40px; text-align: center; color: #999;">
    <p>Generated: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p style="font-size: 12px;">Este diagnóstico ayuda a identificar problemas de configuración</p>
</div>

</body>
</html>
