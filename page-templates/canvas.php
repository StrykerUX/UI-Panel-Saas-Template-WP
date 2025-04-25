<?php
/**
 * Template Name: Canvas
 *
 * Plantilla para mostrar una página tipo canvas donde se pueden insertar shortcodes
 * y usar CSS flex con ancho completo (sin tener en cuenta el menú lateral)
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

get_header();
get_sidebar();
?>

<main id="primary" class="content-body canvas-container">
    <div class="canvas-wrapper">
        <?php
        // Obtener el título de la página y breadcrumbs
        if (function_exists('ui_panel_saas_page_title')) {
            ui_panel_saas_page_title();
        } else {
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<div class="page-title-box">';
            echo '<h4 class="page-title">' . esc_html(get_the_title()) . '</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <div class="canvas-content">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main><!-- #main -->

<?php
// Agregar estilos específicos para la plantilla Canvas
$canvas_styles = "
    .canvas-container {
        width: 100%;
        padding: 0;
        overflow-x: hidden;
    }
    
    .canvas-wrapper {
        width: 100%;
        max-width: 1680px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .canvas-content {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    
    /* Estilos responsivos */
    @media (max-width: 768px) {
        .canvas-wrapper {
            padding: 0 10px;
        }
    }
";

// Agregar los estilos al footer
wp_add_inline_style('ui-panel-saas-app', $canvas_styles);

get_footer();
