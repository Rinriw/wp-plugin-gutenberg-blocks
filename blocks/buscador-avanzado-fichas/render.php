<?php
/**
 * Buscador Avanzado Fichas Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'buscador-avanzado-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'buscador-avanzado-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Get unique years for filter
global $wpdb;
$years = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'year' ORDER BY meta_value DESC");

?>

<style>
@media (min-width: 1024px) {
    .buscador-avanzado-block {
        width: 80% !important;
        margin-left: auto !important;
        margin-right: auto !important;
        max-width: 1400px !important;
    }
    .ficha-results-grid {
        grid-template-columns: repeat(4, 1fr) !important;
    }
}
@media (min-width: 1440px) {
    .ficha-results-grid {
        grid-template-columns: repeat(5, 1fr) !important;
    }
}
.buscador-main-input input {
    font-size: 14px !important; /* Reduced by approx 4px from 1.1rem */
}
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    <!-- Search Controls -->
    <div class="buscador-controls">
        <div class="buscador-main-input">
            <input type="text" id="ficha-search-input" placeholder="Buscar por obra, director, equipo..." aria-label="Buscar">
            <button id="ficha-search-btn" type="button" aria-label="Buscar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </div>

        <div class="buscador-filters">
            <div class="filter-group">
                <select id="filter-format">
                    <option value="">Formato</option>
                    <option value="cortometraje">Cortometraje</option>
                    <option value="pelicula">Película</option>
                    <option value="serie">Serie</option>
                    <option value="videoclip">Videoclip</option>
                    <option value="miniserie">Miniserie</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <div class="filter-group">
                <select id="filter-technique">
                    <option value="">Técnica</option>
                    <option value="stop_motion">Stop Motion</option>
                    <option value="2d">2D</option>
                    <option value="3d">3D</option>
                    <option value="tradicional">Tradicional</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <div class="filter-group">
                <select id="filter-year">
                    <option value="">Año</option>
                    <?php if($years): ?>
                        <?php foreach($years as $y): ?>
                            <option value="<?php echo esc_attr($y); ?>"><?php echo esc_html($y); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="filter-group sort-group">
                <select id="sort-order">
                    <option value="title_asc">A-Z</option>
                    <option value="year_desc">Más reciente</option>
                    <option value="year_asc">Más antiguos</option>
                </select>
            </div>
            
            <button id="reset-filters" class="reset-btn" title="Limpiar filtros">
                Limpiar
            </button>
        </div>
    </div>

    <!-- Results Grid -->
    <div id="ficha-results-grid" class="ficha-results-grid">
        <!-- Results will be injected here via JS -->
        <div class="ficha-loading">Cargando...</div>
    </div>

    <!-- No Results Message -->
    <div id="ficha-no-results" class="ficha-no-results" style="display: none;">
        <p>No se encontraron resultados.</p>
    </div>

</div>
