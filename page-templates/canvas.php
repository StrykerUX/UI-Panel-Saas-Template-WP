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
            
            // Mostrar el área de widgets de Canvas si existe y tiene widgets activos
            if (is_active_sidebar('canvas')) {
                dynamic_sidebar('canvas');
            }
            ?>
        </div>
    </div>
</main><!-- #main -->

<?php
// Cargar el script de Canvas
wp_enqueue_script('ui-panel-saas-canvas', UI_PANEL_SAAS_ASSETS_URI . '/js/canvas.js', array('jquery'), UI_PANEL_SAAS_VERSION, true);

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
    
    /* Estilos adicionales para la tarjeta */
    .canvas-card {
        transition: all 0.3s ease;
    }
    
    .canvas-card.card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .canvas-card-header {
        display: flex;
        align-items: center;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    [data-bs-theme='dark'] .canvas-card-header {
        border-bottom-color: rgba(255,255,255,0.1);
    }
    
    .canvas-card-title {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .section-title {
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    /* Estilos para layout responsivo */
    .mobile-stack {
        flex-direction: column;
    }
    
    .mobile-stack > [class*='flex-col-'] {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    /* Clases de utilidad adicionales */
    .clickable {
        cursor: pointer;
    }
    
    /* Estilos responsivos */
    @media (max-width: 768px) {
        .canvas-wrapper {
            padding: 0 10px;
        }
        
        [class*='flex-col-'] {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
";

// Agregar estilos adicionales para modo oscuro
if (ui_panel_saas_is_dark_mode()) {
    $canvas_styles .= "
    .canvas-card {
        background-color: #2a2f34;
        color: #e9ecef;
    }
    
    .section-title, .canvas-card-title {
        color: #f8f9fa;
    }
    ";
}

// Agregar los estilos al footer
wp_add_inline_style('ui-panel-saas-canvas', $canvas_styles);

get_footer();
