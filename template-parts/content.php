<?php
/**
 * Plantilla para mostrar el contenido de posts
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Si estamos en la página de inicio o en el blog, mostrar el post en formato de card
    if (is_home() || is_front_page() || is_archive() || is_search()) {
        ui_panel_saas_post_card();
    } else {
        // En páginas individuales, mostrar el post completo
        ?>
        <div class="entry-header mb-4">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            // Mostrar meta información
            if ('post' === get_post_type()) {
                ui_panel_saas_post_meta();
            }
            ?>
        </div><!-- .entry-header -->

        <?php if (has_post_thumbnail() && !post_password_required()) : ?>
            <div class="entry-thumbnail mb-4">
                <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded')); ?>
                
                <?php
                $thumbnail_caption = get_the_post_thumbnail_caption();
                if ($thumbnail_caption) :
                ?>
                    <figcaption class="mt-2 text-center text-muted small">
                        <?php echo wp_kses_post($thumbnail_caption); ?>
                    </figcaption>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content(
                sprintf(
                    /* translators: %s: Título del post. */
                    esc_html__('Continuar leyendo %s', 'ui-panel-saas'),
                    '<span class="screen-reader-text">' . get_the_title() . '</span>'
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'ui-panel-saas'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <div class="entry-footer mt-4">
            <?php
            // Mostrar categorías y etiquetas si hay
            if ('post' === get_post_type()) {
                echo '<div class="entry-meta-tags">';
                
                if (has_category()) {
                    echo '<div class="post-categories mb-2">';
                    ui_panel_saas_post_categories();
                    echo '</div>';
                }
                
                if (has_tag()) {
                    echo '<div class="post-tags">';
                    ui_panel_saas_post_tags();
                    echo '</div>';
                }
                
                echo '</div>';
            }
            
            // Mostrar enlace de edición
            ui_panel_saas_edit_link();
            ?>
        </div><!-- .entry-footer -->

        <?php
        // Mostrar información del autor
        ui_panel_saas_author_box();
        
        // Mostrar navegación de posts
        ui_panel_saas_post_navigation();
        
        // Mostrar posts relacionados
        ui_panel_saas_related_posts();
    }
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
