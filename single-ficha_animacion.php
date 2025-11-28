<?php
/**
 * Template: Single Ficha Tecnica
 * Muestra los detalles de una obra audiovisual animada
 * 
 * NOTA: Los estilos y scripts se encoldan desde plugin.php en el hook 'wp_enqueue_scripts'
 * No se pueden encolar directamente en la plantilla
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="ficha-tecnica-container">
    <?php
    while (have_posts()) : the_post();
        // Obtener los datos
        $afiche = get_field('afiche');
        $nombre = get_field('nombre');
        $year = get_field('year');
        $duracion = get_field('duration');
        $formato = get_field('format');
        $formato_custom = get_field('format_custom');
        $tecnica = get_field('animation_technique');
        $tecnica_custom = get_field('animation_technique_custom');
        $genero = get_field('genre');
        $idioma = get_field('idioma');
        $pais = get_field('pais');
        $sinopsis = get_field('sinopsis');
        $galeria = get_field('gallery');
        $imdb = get_field('imdb_link');
        $direccion = get_field('direccion');
        $guion = get_field('guion');
        $productora = get_field('productora');
        $produccion = get_field('produccion');
        $animacion = get_field('animacion');
        $reparto = get_field('reparto');
        $fotografia = get_field('fotografia');
        $musica = get_field('musica');
        $sonido = get_field('sonido');
        $dir_arte = get_field('direccion_arte');
        $montaje = get_field('montaje');
        $edicion = get_field('edicion');
        $financiamiento = get_field('financiamiento');
        $premios = get_field('premios');
        $plataformas = get_field('plataformas');

        // Determinar formato a mostrar
        $formato_labels = array(
            'cortometraje' => 'Cortometraje',
            'pelicula'     => 'Película',
            'serie'        => 'Serie',
            'videoclip'    => 'Videoclip',
            'miniserie'    => 'Miniserie',
            'otro'         => 'Otro',
        );
        $tecnica_labels = array(
            'stop_motion' => 'Stop Motion',
            '2d'          => '2D',
            '3d'          => '3D',
            'tradicional' => 'Tradicional',
            'otro'        => 'Otro',
        );
        
        $formato_display = $formato === 'otro' ? $formato_custom : (isset($formato_labels[$formato]) ? $formato_labels[$formato] : $formato);
        $tecnica_display = $tecnica === 'otro' ? $tecnica_custom : (isset($tecnica_labels[$tecnica]) ? $tecnica_labels[$tecnica] : $tecnica);
        ?>

        <article class="ficha-content">
            <!-- MOBILE VERSION -->
            <div class="ficha-mobile">
                <div class="ficha-card">
                    <!-- Titulo y Year -->
                    <div class="ficha-header">
                        <h1 class="ficha-titulo">
                            <?php echo esc_html($nombre); ?>
                            <?php if ($year) : ?>
                                <span class="ficha-year">(<?php echo esc_html($year); ?>)</span>
                            <?php endif; ?>
                        </h1>
                    </div>

                    <!-- Info Rapida Mobile -->
                    <div class="ficha-info-rapida">
                        <?php if ($duracion) : ?>
                            <span class="info-item">
                                <i>⏱</i> <?php echo esc_html($duracion); ?>'
                            </span>
                        <?php endif; ?>
                        <?php if ($formato_display) : ?>
                            <span class="info-item">
                                <?php echo esc_html($formato_display); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($tecnica_display) : ?>
                            <span class="info-item">
                                <?php echo esc_html($tecnica_display); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($genero) : ?>
                            <span class="info-item">
                                <?php echo esc_html($genero); ?>
                            </span>
                        <?php endif; ?>
                    </div>                    <!-- Afiche -->
                    <?php if ($afiche) : ?>
                        <div class="ficha-afiche-container">
                            <img src="<?php echo esc_url($afiche['url']); ?>" 
                                 alt="<?php echo esc_attr($nombre); ?>" 
                                 class="ficha-afiche">
                        </div>
                    <?php endif; ?>

                    <!-- Galeria -->
                    <?php if ($galeria && count($galeria) > 0) : ?>
                        <div class="ficha-galeria">
                            <div class="galeria-carousel" data-items="<?php echo count($galeria); ?>">
                                <div class="galeria-track">
                                    <?php foreach ($galeria as $imagen) : ?>
                                        <div class="galeria-item">
                                            <img src="<?php echo esc_url($imagen['image']['url']); ?>" 
                                                 alt="Imagen de galeria">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php if (count($galeria) > 4) : ?>
                                <div class="galeria-dots">
                                    <?php for ($i = 0; $i < ceil(count($galeria) / 4); $i++) : ?>
                                        <span class="dot <?php if ($i === 0) echo 'active'; ?>" data-slide="<?php echo $i; ?>"></span>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Sinopsis -->
                    <div class="sinopsis-section">
                        <strong>Sinopsis:</strong>
                        <p><?php echo wp_kses_post($sinopsis); ?></p>
                    </div>

                    <!-- Info Detallada -->
                    <div class="ficha-info-detallada">
                        <div class="info-row">
                            <span class="info-label">Direccion:</span>
                            <span class="info-valor"><?php echo esc_html($direccion); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Idioma:</span>
                            <span class="info-valor"><?php echo esc_html($idioma); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pais/Region:</span>
                            <span class="info-valor"><?php echo esc_html($pais); ?></span>
                        </div>
                    </div>

                    <!-- Acordeon: Equipo y Reparto -->
                    <div class="ficha-accordion">
                        <button class="accordion-btn" data-target="crew-content">
                            Equipo y Reparto
                        </button>
                        <div id="crew-content" class="accordion-content">
                            <?php if ($guion) : ?><div class="crew-item"><strong>Guion:</strong> <?php echo esc_html($guion); ?></div><?php endif; ?>
                            <?php if ($productora) : ?><div class="crew-item"><strong>Casa Productora:</strong> <?php echo esc_html($productora); ?></div><?php endif; ?>
                            <?php if ($produccion) : ?><div class="crew-item"><strong>Produccion:</strong> <?php echo esc_html($produccion); ?></div><?php endif; ?>
                            <?php if ($animacion) : ?><div class="crew-item"><strong>Animacion:</strong> <?php echo esc_html($animacion); ?></div><?php endif; ?>
                            <?php if ($reparto) : ?><div class="crew-item"><strong>Reparto:</strong> <?php echo esc_html($reparto); ?></div><?php endif; ?>
                            <?php if ($fotografia) : ?><div class="crew-item"><strong>Fotografia:</strong> <?php echo esc_html($fotografia); ?></div><?php endif; ?>
                            <?php if ($musica) : ?><div class="crew-item"><strong>Musica:</strong> <?php echo esc_html($musica); ?></div><?php endif; ?>
                            <?php if ($sonido) : ?><div class="crew-item"><strong>Sonido:</strong> <?php echo esc_html($sonido); ?></div><?php endif; ?>
                            <?php if ($dir_arte) : ?><div class="crew-item"><strong>Dir. de arte:</strong> <?php echo esc_html($dir_arte); ?></div><?php endif; ?>
                            <?php if ($montaje) : ?><div class="crew-item"><strong>Montaje:</strong> <?php echo esc_html($montaje); ?></div><?php endif; ?>
                            <?php if ($edicion) : ?><div class="crew-item"><strong>Edicion:</strong> <?php echo esc_html($edicion); ?></div><?php endif; ?>
                        </div>
                    </div>

                    <!-- Acordeon: Financiamiento y Premios -->
                    <?php if ($financiamiento || $premios) : ?>
                        <div class="ficha-accordion">
                            <button class="accordion-btn" data-target="financing-content">
                                Financiamiento y Premios
                            </button>
                            <div id="financing-content" class="accordion-content">
                                <?php if ($financiamiento) : ?>
                                    <div class="financing-section">
                                        <strong>Financiamiento:</strong>
                                        <p><?php echo wp_kses_post($financiamiento); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if ($premios) : ?>
                                    <div class="premios-section">
                                        <strong>Premios:</strong>
                                        <?php if (is_array($premios)) : ?>
                                            <ul>
                                                <?php foreach ($premios as $premio) : ?>
                                                    <li><?php echo esc_html($premio['nombre']); ?> - <?php echo esc_html($premio['festival']); ?> (<?php echo esc_html($premio['year']); ?>)</li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <div class="premios-text">
                                                <ul>
                                                    <?php 
                                                    $lines = explode("\n", str_replace("\r", "", $premios));
                                                    foreach ($lines as $line) : 
                                                        $line = trim($line);
                                                        if (empty($line)) continue;
                                                    ?>
                                                        <li><?php echo esc_html($line); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Disponible En -->
                    <?php if ($plataformas) : ?>
                        <div class="ficha-plataformas">
                            <h3>Disponible en</h3>
                            <div class="plataformas-list">
                                <?php foreach ($plataformas as $plat) : ?>
                                    <a href="<?php echo esc_url($plat['link']); ?>" 
                                       class="plataforma-btn plat-<?php echo esc_attr($plat['servicio']); ?>"
                                       target="_blank" rel="noopener">
                                        <?php echo esc_html(ucfirst($plat['servicio'])); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESKTOP VERSION -->
            <div class="ficha-desktop">
                <div class="ficha-card-desktop">
                    <div class="ficha-grid">
                        <!-- COLUMNA IZQUIERDA: AFICHE -->
                        <div class="ficha-col-left">
                            <?php if ($afiche) : ?>
                                <div class="ficha-afiche-container">
                                    <img src="<?php echo esc_url($afiche['url']); ?>" 
                                         alt="<?php echo esc_attr($nombre); ?>" 
                                         class="ficha-afiche">
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($plataformas) : ?>
                                <div class="ficha-plataformas">
                                    <h3>Disponible en</h3>
                                    <div class="plataformas-list">
                                        <?php foreach ($plataformas as $plat) : ?>
                                            <a href="<?php echo esc_url($plat['link']); ?>" 
                                               class="plataforma-btn plat-<?php echo esc_attr($plat['servicio']); ?>"
                                               target="_blank" rel="noopener">
                                                <?php echo esc_html(ucfirst($plat['servicio'])); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- COLUMNA DERECHA: CONTENIDO -->
                        <div class="ficha-col-right">
                            <!-- Header -->
                            <div class="ficha-header-desktop">
                                <h1 class="ficha-titulo"><?php echo esc_html($nombre); ?></h1>
                                <p class="ficha-year"><?php if ($year) : ?>(<?php echo esc_html($year); ?>)<?php endif; ?></p>
                            </div>

                            <!-- Info Rapida Desktop (antes de Tabs) -->
                            <div class="ficha-info-rapida-desktop">
                                <?php if ($duracion) : ?>
                                    <div class="info-block">
                                        <i>⏱</i> <?php echo esc_html($duracion); ?>'
                                    </div>
                                <?php endif; ?>
                                <?php if ($formato_display) : ?>
                                    <div class="info-block">
                                        <?php echo esc_html($formato_display); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($tecnica_display) : ?>
                                    <div class="info-block">
                                        <?php echo esc_html($tecnica_display); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($genero) : ?>
                                    <div class="info-block">
                                        <?php echo esc_html($genero); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Galeria Desktop -->
                            <?php if ($galeria && count($galeria) > 0) : ?>
                                <div class="ficha-galeria-desktop">
                                    <div class="galeria-carousel" data-items="<?php echo count($galeria); ?>">
                                        <div class="galeria-track">
                                            <?php foreach ($galeria as $imagen) : ?>
                                                <div class="galeria-item">
                                                    <img src="<?php echo esc_url($imagen['image']['url']); ?>" 
                                                         alt="Imagen de galeria">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php if (count($galeria) > 4) : ?>
                                        <div class="galeria-dots">
                                            <?php for ($i = 0; $i < ceil(count($galeria) / 4); $i++) : ?>
                                                <span class="dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></span>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Tabs -->
                            <div class="ficha-tabs">
                                <div class="tabs-nav">
                                    <button class="tab-btn active" data-tab="info">Info</button>
                                    <button class="tab-btn" data-tab="crew">Equipo y Reparto</button>
                                    <button class="tab-btn" data-tab="financing">Financiamiento y Premios</button>
                                </div>

                                <div class="tabs-content">
                                    <!-- TAB: INFO -->
                                    <div class="tab-pane active" id="info">
                                        <div class="ficha-sinopsis">
                                            <p><?php echo wp_kses_post($sinopsis); ?></p>
                                        </div>
                                        <div class="ficha-info-detallada">
                                            <div class="info-row">
                                                <span class="info-label">Dirección:</span>
                                                <span class="info-valor"><?php echo esc_html($direccion); ?></span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Idioma:</span>
                                                <span class="info-valor"><?php echo esc_html($idioma); ?></span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">País/Región:</span>
                                                <span class="info-valor"><?php echo esc_html($pais); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB: CREW -->
                                    <div class="tab-pane" id="crew">
                                        <div class="crew-list">
                                            <?php if ($guion) : ?><div class="crew-item"><strong>Guión:</strong> <?php echo esc_html($guion); ?></div><?php endif; ?>
                                            <?php if ($productora) : ?><div class="crew-item"><strong>Casa Productora:</strong> <?php echo esc_html($productora); ?></div><?php endif; ?>
                                            <?php if ($produccion) : ?><div class="crew-item"><strong>Producción:</strong> <?php echo esc_html($produccion); ?></div><?php endif; ?>
                                            <?php if ($animacion) : ?><div class="crew-item"><strong>Animación:</strong> <?php echo esc_html($animacion); ?></div><?php endif; ?>
                                            <?php if ($reparto) : ?><div class="crew-item"><strong>Reparto:</strong> <?php echo esc_html($reparto); ?></div><?php endif; ?>
                                            <?php if ($fotografia) : ?><div class="crew-item"><strong>Fotografía:</strong> <?php echo esc_html($fotografia); ?></div><?php endif; ?>
                                            <?php if ($musica) : ?><div class="crew-item"><strong>Música:</strong> <?php echo esc_html($musica); ?></div><?php endif; ?>
                                            <?php if ($sonido) : ?><div class="crew-item"><strong>Sonido:</strong> <?php echo esc_html($sonido); ?></div><?php endif; ?>
                                            <?php if ($dir_arte) : ?><div class="crew-item"><strong>Dir. de arte:</strong> <?php echo esc_html($dir_arte); ?></div><?php endif; ?>
                                            <?php if ($montaje) : ?><div class="crew-item"><strong>Montaje:</strong> <?php echo esc_html($montaje); ?></div><?php endif; ?>
                                            <?php if ($edicion) : ?><div class="crew-item"><strong>Edición:</strong> <?php echo esc_html($edicion); ?></div><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- TAB: FINANCING -->
                                    <?php if ($financiamiento || $premios) : ?>
                                        <div class="tab-pane" id="financing">
                                            <?php if ($financiamiento) : ?>
                                                <div class="financing-section">
                                                    <strong>Financiamiento:</strong>
                                                    <p><?php echo wp_kses_post($financiamiento); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($premios) : ?>
                                                <div class="premios-section">
                                                    <strong>Premios y Festivales:</strong>
                                                    <?php if (is_array($premios)) : ?>
                                                        <ul>
                                                            <?php foreach ($premios as $premio) : ?>
                                                                <li><?php echo esc_html($premio['nombre']); ?> - <?php echo esc_html($premio['festival']); ?> (<?php echo esc_html($premio['year']); ?>)</li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php else : ?>
                                                        <div class="premios-text">
                                                            <ul>
                                                                <?php 
                                                                $lines = explode("\n", str_replace("\r", "", $premios));
                                                                foreach ($lines as $line) : 
                                                                    $line = trim($line);
                                                                    if (empty($line)) continue;
                                                                ?>
                                                                    <li><?php echo esc_html($line); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();
