<?php
/**
 * La plantilla principal para mostrar páginas
 *
 * Esta es la plantilla más genérica en la jerarquía de WordPress.
 * Se utiliza para mostrar un blog predeterminado y otras vistas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

<main id="primary" class="content-body">
    <div class="container-fluid">
        <?php
        // Soporte para títulos de página
        if (function_exists('ui_panel_saas_page_title')) {
            ui_panel_saas_page_title();
        } else {
            // Título de página básico
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<div class="page-title-box">';
            echo '<h4 class="page-title">';
            
            if (is_home() && !is_front_page()) {
                single_post_title();
            } elseif (is_search()) {
                /* translators: %s: search query. */
                printf(esc_html__('Resultados de búsqueda para: %s', 'ui-panel-saas'), '<span>' . get_search_query() . '</span>');
            } elseif (is_404()) {
                esc_html_e('Página no encontrada', 'ui-panel-saas');
            } elseif (is_archive()) {
                the_archive_title();
            } else {
                the_title();
            }
            
            echo '</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (have_posts()) :

                            /* Iniciar el loop */
                            while (have_posts()) :
                                the_post();

                                /*
                                 * Incluir la plantilla de contenido parcial para el formato de post actual.
                                 * Si quieres sobreescribir esto en un tema hijo, entonces incluye un archivo llamado
                                 * content-___.php (donde ___ es el formato de Post) y eso será usado en su lugar.
                                 */
                                get_template_part('template-parts/content', get_post_type());

                                // Si los comentarios están abiertos o tenemos al menos un comentario, cargamos la plantilla de comentarios.
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;

                            endwhile;

                            // Paginación
                            if (function_exists('ui_panel_saas_pagination')) {
                                ui_panel_saas_pagination();
                            } else {
                                echo '<div class="blog-pagination">';
                                the_posts_pagination(array(
                                    'prev_text' => '<i class="ri-arrow-left-s-line"></i> ' . esc_html__('Anterior', 'ui-panel-saas'),
                                    'next_text' => esc_html__('Siguiente', 'ui-panel-saas') . ' <i class="ri-arrow-right-s-line"></i>',
                                ));
                                echo '</div>';
                            }

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
