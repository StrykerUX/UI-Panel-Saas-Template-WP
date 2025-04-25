<?php
/**
 * Funciones de etiquetas personalizadas para este tema
 *
 * Eventualmente, algunas de las funcionalidades aquí podrían ser reemplazadas por características del núcleo.
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Imprime el nombre del autor
 */
if (!function_exists('ui_panel_saas_posted_by')) :
    function ui_panel_saas_posted_by() {
        echo '<span class="byline">';
        echo '<span class="author vcard">';
        echo '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">';
        echo get_avatar(get_the_author_meta('ID'), 32, '', get_the_author(), array('class' => 'me-1'));
        echo esc_html(get_the_author());
        echo '</a>';
        echo '</span>';
        echo '</span>';
    }
endif;

/**
 * Imprime la fecha de publicación
 */
if (!function_exists('ui_panel_saas_posted_on')) :
    function ui_panel_saas_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
        
        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );
        
        echo '<span class="posted-on">';
        echo '<i class="ri-calendar-line me-1"></i>';
        echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>';
        echo '</span>';
    }
endif;

/**
 * Imprime las categorías de una entrada
 */
if (!function_exists('ui_panel_saas_post_categories')) :
    function ui_panel_saas_post_categories() {
        if ('post' !== get_post_type()) {
            return;
        }
        
        $categories = get_the_category();
        
        if (empty($categories)) {
            return;
        }
        
        echo '<span class="cat-links">';
        echo '<i class="ri-folder-line me-1"></i>';
        
        $output = array();
        
        foreach ($categories as $category) {
            $output[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">' . esc_html($category->name) . '</a>';
        }
        
        echo implode(', ', $output);
        echo '</span>';
    }
endif;

/**
 * Imprime las etiquetas de una entrada
 */
if (!function_exists('ui_panel_saas_post_tags')) :
    function ui_panel_saas_post_tags() {
        if ('post' !== get_post_type()) {
            return;
        }
        
        $tags = get_the_tags();
        
        if (empty($tags)) {
            return;
        }
        
        echo '<span class="tags-links">';
        echo '<i class="ri-price-tag-3-line me-1"></i>';
        
        $output = array();
        
        foreach ($tags as $tag) {
            $output[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
        }
        
        echo implode(', ', $output);
        echo '</span>';
    }
endif;

/**
 * Imprime el número de comentarios de una entrada
 */
if (!function_exists('ui_panel_saas_comment_count')) :
    function ui_panel_saas_comment_count() {
        if (!post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            echo '<i class="ri-chat-3-line me-1"></i>';
            
            $comment_count = get_comments_number();
            
            if ($comment_count == 0) {
                echo '<a href="' . esc_url(get_comments_link()) . '">' . esc_html__('Sin comentarios', 'ui-panel-saas') . '</a>';
            } elseif ($comment_count == 1) {
                echo '<a href="' . esc_url(get_comments_link()) . '">' . esc_html__('1 comentario', 'ui-panel-saas') . '</a>';
            } else {
                echo '<a href="' . esc_url(get_comments_link()) . '">' . sprintf(
                    /* translators: %d: número de comentarios */
                    esc_html(_n('%d comentario', '%d comentarios', $comment_count, 'ui-panel-saas')),
                    $comment_count
                ) . '</a>';
            }
            
            echo '</span>';
        }
    }
endif;

/**
 * Imprime el tiempo de lectura estimado para un post
 */
if (!function_exists('ui_panel_saas_reading_time')) :
    function ui_panel_saas_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // 200 palabras por minuto
        
        if ($reading_time < 1) {
            $reading_time = 1;
        }
        
        echo '<span class="reading-time">';
        echo '<i class="ri-time-line me-1"></i>';
        printf(
            /* translators: %d: tiempo de lectura en minutos */
            esc_html(_n('%d min de lectura', '%d mins de lectura', $reading_time, 'ui-panel-saas')),
            $reading_time
        );
        echo '</span>';
    }
endif;

/**
 * Imprime el enlace para editar el post
 */
if (!function_exists('ui_panel_saas_edit_link')) :
    function ui_panel_saas_edit_link() {
        // Solo si el usuario puede editar el post
        if (!current_user_can('edit_post', get_the_ID())) {
            return;
        }
        
        edit_post_link(
            sprintf(
                /* translators: %s: Nombre del post actual */
                esc_html__('Editar %s', 'ui-panel-saas'),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            ),
            '<span class="edit-link"><i class="ri-edit-line me-1"></i>',
            '</span>'
        );
    }
endif;

/**
 * Imprime una card para un post
 */
if (!function_exists('ui_panel_saas_post_card')) :
    function ui_panel_saas_post_card() {
        ?>
        <div class="card mb-4">
            <?php if (has_post_thumbnail()) : ?>
                <div class="card-img-top">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?php the_permalink(); ?>" class="text-reset"><?php the_title(); ?></a>
                </h5>
                
                <div class="card-text">
                    <?php the_excerpt(); ?>
                </div>
            </div>
            
            <div class="card-footer bg-transparent">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="post-meta">
                        <?php ui_panel_saas_posted_by(); ?>
                        <span class="sep"> • </span>
                        <?php ui_panel_saas_posted_on(); ?>
                    </div>
                    
                    <div class="post-meta-right">
                        <?php ui_panel_saas_reading_time(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Imprime una card para una página
 */
if (!function_exists('ui_panel_saas_page_card')) :
    function ui_panel_saas_page_card() {
        ?>
        <div class="card mb-4">
            <?php if (has_post_thumbnail()) : ?>
                <div class="card-img-top">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?php the_permalink(); ?>" class="text-reset"><?php the_title(); ?></a>
                </h5>
                
                <div class="card-text">
                    <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html__('Leer más', 'ui-panel-saas'); ?></a>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Imprime los metadatos de un post
 */
if (!function_exists('ui_panel_saas_post_meta')) :
    function ui_panel_saas_post_meta() {
        ?>
        <div class="entry-meta">
            <?php
            ui_panel_saas_posted_by();
            echo ' <span class="sep">•</span> ';
            ui_panel_saas_posted_on();
            
            if (get_post_type() === 'post') {
                echo ' <span class="sep">•</span> ';
                ui_panel_saas_reading_time();
            }
            
            if (get_post_type() === 'post' && (has_category() || has_tag())) {
                echo '<div class="entry-meta-bottom mt-2">';
                
                if (has_category()) {
                    ui_panel_saas_post_categories();
                }
                
                if (has_tag()) {
                    if (has_category()) {
                        echo ' <span class="sep">•</span> ';
                    }
                    ui_panel_saas_post_tags();
                }
                
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }
endif;

/**
 * Imprime un widget de información del autor
 */
if (!function_exists('ui_panel_saas_author_box')) :
    function ui_panel_saas_author_box() {
        // Solo mostrar para posts individuales
        if (!is_singular('post')) {
            return;
        }
        
        $author_id = get_the_author_meta('ID');
        $author_bio = get_the_author_meta('description');
        
        // No mostrar si no hay biografía
        if (empty($author_bio)) {
            return;
        }
        ?>
        <div class="card author-box my-4">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div class="author-avatar me-3">
                        <?php echo get_avatar($author_id, 96, '', get_the_author(), array('class' => 'rounded-circle')); ?>
                    </div>
                    
                    <div class="author-details flex-grow-1">
                        <h5 class="author-name mb-1"><?php echo get_the_author(); ?></h5>
                        
                        <?php if ($author_bio) : ?>
                            <p class="author-bio mb-2"><?php echo esc_html($author_bio); ?></p>
                        <?php endif; ?>
                        
                        <div class="author-links">
                            <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="ri-article-line me-1"></i>
                                <?php
                                printf(
                                    /* translators: %s: nombre del autor */
                                    esc_html__('Ver todas las publicaciones de %s', 'ui-panel-saas'),
                                    get_the_author()
                                );
                                ?>
                            </a>
                            
                            <?php
                            $author_website = get_the_author_meta('user_url');
                            if (!empty($author_website)) :
                            ?>
                                <a href="<?php echo esc_url($author_website); ?>" class="btn btn-sm btn-outline-secondary ms-2" target="_blank">
                                    <i class="ri-global-line me-1"></i>
                                    <?php echo esc_html__('Sitio web', 'ui-panel-saas'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php
                            // Redes sociales del autor si existen los campos personalizados
                            $social_networks = array(
                                'twitter' => array(
                                    'url' => get_the_author_meta('twitter'),
                                    'icon' => 'ri-twitter-line',
                                    'label' => 'Twitter'
                                ),
                                'facebook' => array(
                                    'url' => get_the_author_meta('facebook'),
                                    'icon' => 'ri-facebook-circle-line',
                                    'label' => 'Facebook'
                                ),
                                'linkedin' => array(
                                    'url' => get_the_author_meta('linkedin'),
                                    'icon' => 'ri-linkedin-line',
                                    'label' => 'LinkedIn'
                                ),
                                'instagram' => array(
                                    'url' => get_the_author_meta('instagram'),
                                    'icon' => 'ri-instagram-line',
                                    'label' => 'Instagram'
                                )
                            );
                            
                            foreach ($social_networks as $network => $data) {
                                if (!empty($data['url'])) {
                                    echo '<a href="' . esc_url($data['url']) . '" class="btn btn-sm btn-outline-info ms-2" target="_blank">';
                                    echo '<i class="' . esc_attr($data['icon']) . ' me-1"></i>';
                                    echo esc_html($data['label']);
                                    echo '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Imprime la navegación entre posts (anterior/siguiente)
 */
if (!function_exists('ui_panel_saas_post_navigation')) :
    function ui_panel_saas_post_navigation() {
        // Solo mostrar para posts individuales
        if (!is_singular('post')) {
            return;
        }
        
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        
        // No mostrar si no hay posts anteriores o siguientes
        if (empty($prev_post) && empty($next_post)) {
            return;
        }
        ?>
        <div class="post-navigation my-4">
            <div class="row">
                <?php if (!empty($prev_post)) : ?>
                    <div class="col-md-6">
                        <div class="post-navigation-prev mb-3 mb-md-0">
                            <span class="nav-subtitle"><?php echo esc_html__('Anterior', 'ui-panel-saas'); ?></span>
                            <h5 class="nav-title">
                                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="text-reset">
                                    <i class="ri-arrow-left-line me-1"></i>
                                    <?php echo get_the_title($prev_post->ID); ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($next_post)) : ?>
                    <div class="col-md-6 <?php echo empty($prev_post) ? '' : 'text-md-end'; ?>">
                        <div class="post-navigation-next">
                            <span class="nav-subtitle"><?php echo esc_html__('Siguiente', 'ui-panel-saas'); ?></span>
                            <h5 class="nav-title">
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="text-reset">
                                    <?php echo get_the_title($next_post->ID); ?>
                                    <i class="ri-arrow-right-line ms-1"></i>
                                </a>
                            </h5>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Imprime posts relacionados
 */
if (!function_exists('ui_panel_saas_related_posts')) :
    function ui_panel_saas_related_posts() {
        // Solo mostrar para posts individuales
        if (!is_singular('post')) {
            return;
        }
        
        // Obtener categorías del post actual
        $categories = get_the_category();
        
        if (empty($categories)) {
            return;
        }
        
        $category_ids = array();
        
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
        
        // Consulta para posts relacionados
        $related_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => array(get_the_ID()),
            'category__in'   => $category_ids,
        );
        
        $related_query = new WP_Query($related_args);
        
        // No mostrar si no hay posts relacionados
        if (!$related_query->have_posts()) {
            return;
        }
        ?>
        <div class="related-posts my-4">
            <h4 class="section-title"><?php echo esc_html__('Artículos relacionados', 'ui-panel-saas'); ?></h4>
            
            <div class="row">
                <?php
                while ($related_query->have_posts()) :
                    $related_query->the_post();
                ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="card-img-top">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?php the_permalink(); ?>" class="text-reset"><?php the_title(); ?></a>
                                </h5>
                                
                                <div class="post-meta small">
                                    <?php ui_panel_saas_posted_on(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                
                // Restaurar datos originales
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Imprime la portada de la página con título y descripción
 */
if (!function_exists('ui_panel_saas_page_header')) :
    function ui_panel_saas_page_header() {
        // No mostrar en la página de inicio
        if (is_front_page()) {
            return;
        }
        
        // Determinar si tiene una imagen de portada
        $has_header_image = false;
        
        if (is_singular() && has_post_thumbnail()) {
            $has_header_image = true;
            $header_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        } elseif (get_header_image()) {
            $has_header_image = true;
            $header_image = get_header_image();
        }
        
        // Clase adicional si tiene imagen de portada
        $header_class = $has_header_image ? 'page-header-with-image' : '';
        ?>
        <div class="page-header <?php echo esc_attr($header_class); ?>"<?php if ($has_header_image) : ?> style="background-image: url('<?php echo esc_url($header_image); ?>')"<?php endif; ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-title">
                            <?php
                            if (is_home()) {
                                echo esc_html__('Blog', 'ui-panel-saas');
                            } elseif (is_archive()) {
                                the_archive_title();
                            } elseif (is_search()) {
                                /* translators: %s: search query. */
                                printf(esc_html__('Resultados para: %s', 'ui-panel-saas'), '<span>' . get_search_query() . '</span>');
                            } elseif (is_404()) {
                                echo esc_html__('Página no encontrada', 'ui-panel-saas');
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                        
                        <?php
                        // Mostrar descripción en páginas de archivo
                        if (is_archive()) {
                            the_archive_description('<div class="page-description">', '</div>');
                        }
                        
                        // Mostrar subtítulo en páginas individuales si existe
                        if (is_singular() && function_exists('get_field') && get_field('subtitle')) {
                            echo '<div class="page-subtitle">' . esc_html(get_field('subtitle')) . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;
