<?php
/**
 * UI Panel SAAS - Funciones y definiciones del tema
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define constantes del tema
 */
define('UI_PANEL_SAAS_VERSION', '1.0.0');
define('UI_PANEL_SAAS_DIR', get_template_directory());
define('UI_PANEL_SAAS_URI', get_template_directory_uri());
define('UI_PANEL_SAAS_ASSETS_URI', UI_PANEL_SAAS_URI . '/assets');

/**
 * Incluir archivos de funciones separados
 */
require_once UI_PANEL_SAAS_DIR . '/inc/helpers.php';
require_once UI_PANEL_SAAS_DIR . '/inc/template-functions.php';
require_once UI_PANEL_SAAS_DIR . '/inc/template-tags.php';
require_once UI_PANEL_SAAS_DIR . '/inc/customizer.php';
require_once UI_PANEL_SAAS_DIR . '/inc/class-ui-panel-saas-walker-nav-menu.php';

if (!function_exists('ui_panel_saas_setup')) :
    /**
     * Configuración principal del tema
     */
    function ui_panel_saas_setup() {
        // Agregar soporte para traducción
        load_theme_textdomain('ui-panel-saas', UI_PANEL_SAAS_DIR . '/languages');

        // Añadir soporte para etiqueta de título generada automáticamente
        add_theme_support('title-tag');

        // Habilitar soporte para imágenes destacadas en posts
        add_theme_support('post-thumbnails');

        // Soporte para logo personalizado
        add_theme_support('custom-logo', array(
            'height'      => 60,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
        ));

        // Configurar tamaños de imágenes personalizados
        add_image_size('ui-panel-card', 800, 600, true);
        add_image_size('ui-panel-avatar', 100, 100, true);

        // Registrar ubicaciones de menús
        register_nav_menus(array(
            'primary'      => esc_html__('Menú Principal', 'ui-panel-saas'),
            'sidebar'      => esc_html__('Menú Lateral', 'ui-panel-saas'),
            'topbar-right' => esc_html__('Menú Superior Derecho', 'ui-panel-saas'),
        ));

        // Soporte HTML5 para elementos de formulario, búsqueda, comentarios, etc.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Soporte para configuración de colores de fondo
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
        ));

        // Añadir soporte para alineación amplia y ancha
        add_theme_support('align-wide');

        // Añadir soporte para personalización selectiva de la vista previa
        add_theme_support('customize-selective-refresh-widgets');

        // Añadir soporte para bloque de estilos
        add_theme_support('wp-block-styles');

        // Añadir paleta de colores del tema para el editor
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => esc_html__('Primario', 'ui-panel-saas'),
                'slug'  => 'primary',
                'color' => '#4F46E5',
            ),
            array(
                'name'  => esc_html__('Secundario', 'ui-panel-saas'),
                'slug'  => 'secondary',
                'color' => '#8B5CF6',
            ),
            array(
                'name'  => esc_html__('Éxito', 'ui-panel-saas'),
                'slug'  => 'success',
                'color' => '#10B981',
            ),
            array(
                'name'  => esc_html__('Peligro', 'ui-panel-saas'),
                'slug'  => 'danger',
                'color' => '#EF4444',
            ),
            array(
                'name'  => esc_html__('Advertencia', 'ui-panel-saas'),
                'slug'  => 'warning',
                'color' => '#F59E0B',
            ),
            array(
                'name'  => esc_html__('Información', 'ui-panel-saas'),
                'slug'  => 'info',
                'color' => '#3B82F6',
            ),
            array(
                'name'  => esc_html__('Oscuro', 'ui-panel-saas'),
                'slug'  => 'dark',
                'color' => '#111827',
            ),
            array(
                'name'  => esc_html__('Claro', 'ui-panel-saas'),
                'slug'  => 'light',
                'color' => '#F9FAFB',
            ),
        ));
    }
endif;
add_action('after_setup_theme', 'ui_panel_saas_setup');

/**
 * Establecer el ancho del contenido en píxeles, basado en el diseño del tema.
 */
function ui_panel_saas_content_width() {
    $GLOBALS['content_width'] = apply_filters('ui_panel_saas_content_width', 1140);
}
add_action('after_setup_theme', 'ui_panel_saas_content_width', 0);

/**
 * Registrar áreas de widgets.
 */
function ui_panel_saas_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Barra lateral', 'ui-panel-saas'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la barra lateral.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 1', 'ui-panel-saas'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la primera columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 2', 'ui-panel-saas'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la segunda columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 3', 'ui-panel-saas'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la tercera columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Panel de control', 'ui-panel-saas'),
        'id'            => 'dashboard',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en el panel de control.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="dashboard-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="dashboard-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ui_panel_saas_widgets_init');

/**
 * Registrar y cargar scripts y estilos del tema
 */
function ui_panel_saas_scripts() {
    // Estilos
    wp_enqueue_style('ui-panel-saas-vendor', UI_PANEL_SAAS_ASSETS_URI . '/css/vendor.min.css', array(), UI_PANEL_SAAS_VERSION);
    wp_enqueue_style('ui-panel-saas-icons', UI_PANEL_SAAS_ASSETS_URI . '/css/icons.min.css', array(), UI_PANEL_SAAS_VERSION);
    wp_enqueue_style('ui-panel-saas-app', UI_PANEL_SAAS_ASSETS_URI . '/css/app.min.css', array(), UI_PANEL_SAAS_VERSION);
    wp_enqueue_style('ui-panel-saas-main', UI_PANEL_SAAS_ASSETS_URI . '/css/main.css', array('ui-panel-saas-app'), UI_PANEL_SAAS_VERSION);

    // Scripts
    wp_enqueue_script('ui-panel-saas-vendor', UI_PANEL_SAAS_ASSETS_URI . '/js/vendor.min.js', array('jquery'), UI_PANEL_SAAS_VERSION, true);
    wp_enqueue_script('ui-panel-saas-config', UI_PANEL_SAAS_ASSETS_URI . '/js/config.js', array('jquery'), UI_PANEL_SAAS_VERSION, true);
    wp_enqueue_script('ui-panel-saas-app', UI_PANEL_SAAS_ASSETS_URI . '/js/app.js', array('jquery', 'ui-panel-saas-vendor'), UI_PANEL_SAAS_VERSION, true);
    wp_enqueue_script('ui-panel-saas-main', UI_PANEL_SAAS_ASSETS_URI . '/js/main.js', array('jquery', 'ui-panel-saas-app'), UI_PANEL_SAAS_VERSION, true);

    // Pasar datos a JavaScript
    wp_localize_script('ui-panel-saas-main', 'ui_panel_saas_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('ui-panel-saas-nonce'),
        'homeUrl' => esc_url(home_url('/')),
        'themeUri' => UI_PANEL_SAAS_URI,
        'userMode' => get_theme_mod('ui_panel_saas_theme_mode', 'light')
    ));

    // Comentarios
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ui_panel_saas_scripts');

/**
 * Agregar atributos al HTML para controlar el modo del tema (claro/oscuro)
 */
function ui_panel_saas_add_html_attributes($output) {
    $theme_mode = get_theme_mod('ui_panel_saas_theme_mode', 'light');
    $sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');
    
    return str_replace('<html', '<html data-bs-theme="' . esc_attr($theme_mode) . '" data-sidenav-size="' . esc_attr($sidebar_mode) . '"', $output);
}
add_filter('language_attributes', 'ui_panel_saas_add_html_attributes');

/**
 * Función para determinar si se está usando un layout oscuro
 */
function ui_panel_saas_is_dark_mode() {
    return get_theme_mod('ui_panel_saas_theme_mode', 'light') === 'dark';
}

/**
 * Agregado de clase al elemento li del menú para indicar si tiene submenú
 */
function ui_panel_saas_add_menu_parent_class($items) {
    $parents = array();
    
    // Recorrer todos los elementos del menú para encontrar elementos con hijos
    foreach ($items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }
    
    // Agregar clase 'has-children' a elementos del menú que son padres
    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'has-children';
        }
    }
    
    return $items;
}
add_filter('wp_nav_menu_objects', 'ui_panel_saas_add_menu_parent_class');
