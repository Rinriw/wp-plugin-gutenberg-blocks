<?php
/**
 * Script de Diagnóstico de Ficha Técnica
 * Accede a: http://localhost/wordpress/?ficha_debug=1
 */

if (!isset($_GET['ficha_debug']) || $_GET['ficha_debug'] !== '1') {
    return;
}

// Agregar estilos para el panel
add_action('wp_head', function() {
    ?>
    <style>
        #ficha-debug-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            max-height: 100vh;
            background: white;
            border-left: 3px solid #007bff;
            box-shadow: -2px 0 10px rgba(0,0,0,0.2);
            padding: 20px;
            overflow-y: auto;
            font-family: monospace;
            z-index: 99999;
            font-size: 12px;
        }
        .debug-section {
            margin: 15px 0;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 4px;
            border-left: 3px solid #007bff;
        }
        .debug-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 8px;
        }
        .debug-ok { color: green; }
        .debug-error { color: red; font-weight: bold; }
        .debug-warning { color: orange; }
    </style>
    <?php
});

// Agregar panel de debug
add_action('wp_footer', function() {
    ?>
    <div id="ficha-debug-panel">
        <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 2px solid #ddd;">
            <strong style="font-size: 14px; color: #007bff;">🔧 FICHA DEBUG PANEL</strong>
            <p style="color: #999; font-size: 11px; margin: 5px 0 0 0;">Press F12 Console for more details</p>
        </div>

        <div class="debug-section">
            <div class="debug-title">✓ HTML Structure</div>
            <div id="debug-html"></div>
        </div>

        <div class="debug-section">
            <div class="debug-title">✓ CSS Files</div>
            <div id="debug-css"></div>
        </div>

        <div class="debug-section">
            <div class="debug-title">✓ JavaScript Functions</div>
            <div id="debug-js"></div>
        </div>

        <div class="debug-section">
            <div class="debug-title">✓ DOM Elements</div>
            <div id="debug-dom"></div>
        </div>

        <div class="debug-section">
            <div class="debug-title">✓ Console Logs</div>
            <div id="debug-console"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check HTML Structure
            const container = document.querySelector('.ficha-tecnica-container');
            const htmlStatus = container ? 
                '<span class="debug-ok">✓ Container found</span>' : 
                '<span class="debug-error">✗ Container NOT found</span>';
            document.getElementById('debug-html').innerHTML = htmlStatus;

            // Check CSS Files
            const stylesheets = Array.from(document.styleSheets)
                .filter(sheet => sheet.href && sheet.href.includes('ficha'));
            const cssStatus = stylesheets.length > 0 ?
                `<span class="debug-ok">✓ ${stylesheets.length} CSS file(s) loaded</span>` :
                '<span class="debug-warning">⚠ No ficha CSS files detected</span>';
            document.getElementById('debug-css').innerHTML = cssStatus;

            // Check JS Functions
            const functions = [
                'initAccordions',
                'initGalleryCarousels',
                'initTabs',
                'initSmoothScroll',
                'initFichaTecnica'
            ];
            let jsStatus = '';
            functions.forEach(fn => {
                const exists = typeof window[fn] === 'function';
                jsStatus += exists ? 
                    `<div class="debug-ok">✓ ${fn}</div>` :
                    `<div class="debug-error">✗ ${fn} NOT FOUND</div>`;
            });
            document.getElementById('debug-js').innerHTML = jsStatus;

            // Check DOM Elements
            const elements = {
                'Accordions': '.accordion-btn',
                'Tabs': '.tab-btn',
                'Gallery': '.galeria-carousel',
                'Carousels': '.ficha-content'
            };
            let domStatus = '';
            for (let [name, selector] of Object.entries(elements)) {
                const count = document.querySelectorAll(selector).length;
                domStatus += count > 0 ?
                    `<div class="debug-ok">✓ ${name}: ${count} element(s)</div>` :
                    `<div class="debug-warning">⚠ ${name}: not found</div>`;
            }
            document.getElementById('debug-dom').innerHTML = domStatus;

            // Capture console logs
            const originalLog = console.log;
            const logs = [];
            console.log = function(...args) {
                logs.push(args.join(' '));
                originalLog.apply(console, args);
            };

            // Test functions
            try {
                if (typeof initAccordions === 'function') {
                    console.log('✓ Initializing accordions...');
                    initAccordions();
                }
                if (typeof initGalleryCarousels === 'function') {
                    console.log('✓ Initializing gallery carousels...');
                    initGalleryCarousels();
                }
                if (typeof initTabs === 'function') {
                    console.log('✓ Initializing tabs...');
                    initTabs();
                }
            } catch (e) {
                console.error('Error during initialization:', e.message);
            }

            // Display logs
            setTimeout(() => {
                document.getElementById('debug-console').innerHTML = logs.length > 0 ?
                    logs.map(log => `<div>${log}</div>`).join('') :
                    '<span class="debug-warning">No logs captured</span>';
            }, 1000);
        });
    </script>
    <?php
});
?>
