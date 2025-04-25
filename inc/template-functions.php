<?php
/**
 * Funciones que mejoran el tema agregando características personalizadas
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Agregar clases adicionales al cuerpo basadas en las opciones del tema
 *
 * @param array $classes Clases del elemento body.
 * @return array
 */
function ui_panel_saas_body_classes($classes) {
    // Añadir clase para el modo de tema (claro/oscuro)
    $theme_mode = get_theme_mod('ui_panel_saas_theme_mode', 'light');
    $classes[] = 'theme-' . $theme_mode;
    
    // Añadir clase para el modo de barra lateral
    $sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');
    $classes[] = 'sidebar-' . $sidebar_mode;
    
    // Añadir clase basada en si estamos en una página que usa plantilla de panel SAAS
    if (is_page_template('page-templates/dashboard.php') ||
        is_page_template('page-templates/admin-panel.php') ||
        is_page_template('page-templates/app-layout.php')) {
        $classes[] = 'ui-panel-saas-app';
    }
    
    // Añadir clase si es usuario logueado
    if (is_user_logged_in()) {
        $classes[] = 'logged-in-user';
    }
    
    return $classes;
}
add_filter('body_class', 'ui_panel_saas_body_classes');

/**
 * Modificar el título de la página
 *
 * @param string $title Título original
 * @return string Título modificado
 */
function ui_panel_saas_document_title($title) {
    // Título personalizado para la página de dashboard
    if (is_page_template('page-templates/dashboard.php')) {
        $title['title'] = esc_html__('Dashboard', 'ui-panel-saas');
    }
    
    return $title;
}
add_filter('document_title_parts', 'ui_panel_saas_document_title');

/**
 * Generar encabezado de página con título y breadcrumbs
 */
function ui_panel_saas_page_title() {
    // No mostrar en la página de inicio
    if (is_front_page() && !is_home()) {
        return;
    }
    
    // Empezar a construir el título de la página
    echo '<div class="row">';
    echo '<div class="col-12">';
    echo '<div class="page-title-box">';
    
    // Breadcrumbs
    if (function_exists('ui_panel_saas_breadcrumbs')) {
        ui_panel_saas_breadcrumbs();
    }
    
    echo '<h4 class="page-title">';
    
    if (is_home()) {
        // Blog principal
        echo esc_html__('Blog', 'ui-panel-saas');
    } elseif (is_search()) {
        // Página de resultados de búsqueda
        /* translators: %s: search query. */
        printf(esc_html__('Resultados de búsqueda para: %s', 'ui-panel-saas'), '<span>' . get_search_query() . '</span>');
    } elseif (is_404()) {
        // Página 404
        echo esc_html__('Página no encontrada', 'ui-panel-saas');
    } elseif (is_archive()) {
        // Páginas de archivo
        the_archive_title();
    } elseif (is_singular()) {
        // Páginas singulares (post, page, etc.)
        single_post_title();
    } else {
        // Cualquier otra página
        the_title();
    }
    
    echo '</h4>';
    
    // Añadir botones de acción en páginas específicas
    if (is_singular('post') && current_user_can('edit_post', get_the_ID())) {
        echo '<div class="page-title-right">';
        echo '<a href="' . esc_url(get_edit_post_link()) . '" class="btn btn-primary btn-sm">';
        echo '<i class="ri-edit-line me-1"></i>' . esc_html__('Editar', 'ui-panel-saas');
        echo '</a>';
        echo '</div>';
    } elseif (is_post_type_archive() && current_user_can('edit_posts')) {
        $post_type = get_post_type_object(get_post_type());
        
        if ($post_type && $post_type->name !== 'page') {
            echo '<div class="page-title-right">';
            echo '<a href="' . esc_url(admin_url('post-new.php?post_type=' . $post_type->name)) . '" class="btn btn-primary btn-sm">';
            echo '<i class="ri-add-line me-1"></i>' . esc_html__('Añadir Nuevo', 'ui-panel-saas');
            echo '</a>';
            echo '</div>';
        }
    }
    
    echo '</div>'; // .page-title-box
    echo '</div>'; // .col-12
    echo '</div>'; // .row
}

/**
 * Generar breadcrumbs para la navegación
 */
function ui_panel_saas_breadcrumbs() {
    // No mostrar en la página de inicio
    if (is_front_page()) {
        return;
    }
    
    // Empezar a construir los breadcrumbs
    echo '<nav aria-label="breadcrumb" class="mb-2">';
    echo '<ol class="breadcrumb mb-0">';
    
    // Inicio siempre es el primer elemento
    echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Inicio', 'ui-panel-saas') . '</a></li>';
    
    if (is_home()) {
        // Blog principal
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__('Blog', 'ui-panel-saas') . '</li>';
    } elseif (is_category()) {
        // Categoría
        $category = get_queried_object();
        
        // Comprobar si la categoría tiene padre
        if ($category->parent != 0) {
            $parent_categories = get_category_parents($category->parent, true, '', false);
            
            if (!is_wp_error($parent_categories)) {
                $parent_categories = str_replace('<a', '<a class="breadcrumb-item"', $parent_categories);
                echo $parent_categories;
            }
        }
        
        echo '<li class="breadcrumb-item active" aria-current="page">' . single_cat_title('', false) . '</li>';
    } elseif (is_tax()) {
        // Taxonomía personalizada
        $term = get_queried_object();
        $taxonomy = get_taxonomy($term->taxonomy);
        
        if ($taxonomy) {
            echo '<li class="breadcrumb-item"><a href="#">' . esc_html($taxonomy->labels->name) . '</a></li>';
        }
        
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($term->name) . '</li>';
    } elseif (is_tag()) {
        // Etiqueta
        echo '<li class="breadcrumb-item"><a href="#">' . esc_html__('Etiquetas', 'ui-panel-saas') . '</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . single_tag_title('', false) . '</li>';
    } elseif (is_author()) {
        // Autor
        echo '<li class="breadcrumb-item"><a href="#">' . esc_html__('Autores', 'ui-panel-saas') . '</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_author() . '</li>';
    } elseif (is_year()) {
        // Archivo anual
        echo '<li class="breadcrumb-item"><a href="#">' . esc_html__('Archivos', 'ui-panel-saas') . '</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_date('Y') . '</li>';
    } elseif (is_month()) {
        // Archivo mensual
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_date('Y'))) . '">' . get_the_date('Y') . '</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_date('F') . '</li>';
    } elseif (is_day()) {
        // Archivo diario
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_year_link(get_the_date('Y'))) . '">' . get_the_date('Y') . '</a></li>';
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_month_link(get_the_date('Y'), get_the_date('m'))) . '">' . get_the_date('F') . '</a></li>';
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_date('j') . '</li>';
    } elseif (is_post_type_archive()) {
        // Archivo de tipo de contenido personalizado
        $post_type = get_post_type_object(get_post_type());
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($post_type->labels->name) . '</li>';
    } elseif (is_search()) {
        // Página de resultados de búsqueda
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__('Resultados de búsqueda', 'ui-panel-saas') . '</li>';
    } elseif (is_404()) {
        // Página 404
        echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__('Página no encontrada', 'ui-panel-saas') . '</li>';
    } elseif (is_singular('post')) {
        // Entrada individual
        $categories = get_the_category();
        
        if (!empty($categories)) {
            $category = $categories[0];
            
            // Comprobar si la categoría tiene padre
            if ($category->parent != 0) {
                $parent_categories = get_category_parents($category->parent, true, '', false);
                
                if (!is_wp_error($parent_categories)) {
                    $parent_categories = str_replace('<a', '<a class="breadcrumb-item"', $parent_categories);
                    echo $parent_categories;
                }
            }
            
            echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
        }
        
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_singular('page')) {
        // Página individual
        global $post;
        
        // Comprobar si la página tiene padre
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($ancestor)) . '">' . get_the_title($ancestor) . '</a></li>';
            }
        }
        
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_singular()) {
        // Otro tipo de contenido individual
        $post_type = get_post_type_object(get_post_type());
        
        if ($post_type) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link(get_post_type())) . '">' . esc_html($post_type->labels->name) . '</a></li>';
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        }
    }
    
    echo '</ol>';
    echo '</nav>';
}

/**
 * Agregar paginación personalizada
 */
function ui_panel_saas_pagination() {
    global $wp_query;
    
    // Salir si solo hay una página
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $current = max(1, get_query_var('paged'));
    $total = $wp_query->max_num_pages;
    
    // Configuración para la paginación
    $paginate_args = array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'current'   => $current,
        'total'     => $total,
        'type'      => 'array',
        'prev_text' => '<i class="ri-arrow-left-s-line"></i> ' . esc_html__('Anterior', 'ui-panel-saas'),
        'next_text' => esc_html__('Siguiente', 'ui-panel-saas') . ' <i class="ri-arrow-right-s-line"></i>',
        'end_size'  => 1,
        'mid_size'  => 2,
    );
    
    $pages = paginate_links($paginate_args);
    
    if (is_array($pages)) {
        echo '<div class="pagination-wrapper">';
        echo '<ul class="pagination justify-content-center">';
        
        // Construir cada elemento de paginación
        foreach ($pages as $page) {
            $active = (strpos($page, 'current') !== false) ? ' active' : '';
            echo '<li class="page-item' . $active . '">';
            
            // Reemplazar clases predeterminadas de WordPress con las de Bootstrap
            $page = str_replace('page-numbers', 'page-link', $page);
            $page = str_replace('current', '', $page);
            
            echo $page;
            echo '</li>';
        }
        
        echo '</ul>';
        echo '</div>';
    }
}

/**
 * Modificar extracto de post
 *
 * @param string $more El texto "more" al final del extracto
 * @return string Texto modificado
 */
function ui_panel_saas_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ui_panel_saas_excerpt_more');

/**
 * Modificar longitud del extracto
 *
 * @param int $length Longitud predeterminada
 * @return int Longitud modificada
 */
function ui_panel_saas_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'ui_panel_saas_excerpt_length');

/**
 * Agregar soporte para avatares personalizados
 *
 * @param array $args Argumentos para la función get_avatar
 * @return array Argumentos modificados
 */
function ui_panel_saas_get_avatar_args($args) {
    // Añadir clases de Bootstrap para avatares
    $args['class'] = isset($args['class']) ? $args['class'] . ' rounded-circle' : 'rounded-circle';
    
    return $args;
}
add_filter('get_avatar_data', 'ui_panel_saas_get_avatar_args');

/**
 * Añadir markup personalizado antes del contenido
 */
function ui_panel_saas_content_top() {
    do_action('ui_panel_saas_content_top');
}

/**
 * Añadir markup personalizado después del contenido
 */
function ui_panel_saas_content_bottom() {
    do_action('ui_panel_saas_content_bottom');
}

/**
 * Añadir markup personalizado al final del footer
 */
function ui_panel_saas_footer_bottom() {
    // Código a ejecutar al final del footer
    if (get_theme_mod('ui_panel_saas_show_back_to_top', true)) {
        echo '<a href="#" class="back-to-top" id="back-to-top">';
        echo '<i class="ri-arrow-up-line"></i>';
        echo '</a>';
    }
    
    do_action('ui_panel_saas_footer_bottom');
}
