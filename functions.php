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
            'footer'       => esc_html__('Menú de Pie de Página', 'ui-panel-saas'),
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

        // Añadir soporte explícito para el plugin UI Panel SaaS Menu Manager
        add_theme_support('ui-panel-saas-menu-manager');

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
        'before_widget' => '<div id="%1$s" class="widget card mb-3 %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<div class="card-header"><h5 class="card-title mb-0">',
        'after_title'   => '</h5></div><div class="card-body">',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 1', 'ui-panel-saas'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la primera columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title text-uppercase mb-3">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 2', 'ui-panel-saas'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la segunda columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title text-uppercase mb-3">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Pie de página 3', 'ui-panel-saas'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la tercera columna del pie de página.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title text-uppercase mb-3">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Panel de control', 'ui-panel-saas'),
        'id'            => 'dashboard',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en el panel de control.', 'ui-panel-saas'),
        'before_widget' => '<div class="col-lg-6 col-xl-4"><div id="%1$s" class="card %2$s">',
        'after_widget'  => '</div></div></div>',
        'before_title'  => '<div class="card-header d-flex justify-content-between align-items-center"><h4 class="header-title">',
        'after_title'   => '</h4><div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-1"></i>' . esc_html__('Actualizar', 'ui-panel-saas') . '</a>
                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-settings me-1"></i>' . esc_html__('Configurar', 'ui-panel-saas') . '</a>
                            </div>
                        </div></div><div class="card-body">',
    ));

    // Registrar widget area para la plantilla Canvas
    register_sidebar(array(
        'name'          => esc_html__('Canvas', 'ui-panel-saas'),
        'id'            => 'canvas',
        'description'   => esc_html__('Añade widgets aquí para que aparezcan en la plantilla Canvas.', 'ui-panel-saas'),
        'before_widget' => '<div id="%1$s" class="canvas-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="canvas-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ui_panel_saas_widgets_init');

/**
 * Registrar y cargar scripts y estilos del tema
 */
function ui_panel_saas_scripts() {
    // Fuentes
    wp_enqueue_style('ui-panel-saas-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Estilos de Bootstrap
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    
    // Iconos
    wp_enqueue_style('tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css', array(), '2.44.0');
    
    // DateRangePicker para el calendario
    wp_enqueue_style('daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css', array(), '3.1.0');
    
    // ApexCharts para los gráficos
    wp_enqueue_style('apexcharts', 'https://cdn.jsdelivr.net/npm/apexcharts@3.42.0/dist/apexcharts.css', array(), '3.42.0');
    
    // SimpleBar para el scrollbar personalizado
    wp_enqueue_style('simplebar', 'https://cdn.jsdelivr.net/npm/simplebar@6.2.5/dist/simplebar.css', array(), '6.2.5');
    
    // Estilos principales del tema
    wp_enqueue_style('ui-panel-saas-main', UI_PANEL_SAAS_ASSETS_URI . '/css/main.css', array('bootstrap'), UI_PANEL_SAAS_VERSION);
    
    // Estilos de botones 3D
    wp_enqueue_style('ui-panel-saas-buttons-3d', UI_PANEL_SAAS_ASSETS_URI . '/css/buttons-3d.css', array('ui-panel-saas-main'), UI_PANEL_SAAS_VERSION);
    
    // Estilos específicos para RTL si es necesario
    if (is_rtl()) {
        wp_enqueue_style('ui-panel-saas-rtl', UI_PANEL_SAAS_ASSETS_URI . '/css/rtl.css', array('ui-panel-saas-main'), UI_PANEL_SAAS_VERSION);
    }
    
    // Cargar estilos de Canvas cuando sea necesario
    if (is_page_template('page-templates/canvas.php')) {
        wp_enqueue_style('ui-panel-saas-canvas', UI_PANEL_SAAS_ASSETS_URI . '/css/canvas.css', array('ui-panel-saas-main'), UI_PANEL_SAAS_VERSION);
    }
    
    // Scripts de Bootstrap
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    
    // Moment.js para manejo de fechas (requerido por daterangepicker)
    wp_enqueue_script('moment', 'https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js', array(), '2.29.4', true);
    
    // DateRangePicker
    wp_enqueue_script('daterangepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js', array('jquery', 'moment'), '3.1.0', true);
    
    // ApexCharts
    wp_enqueue_script('apexcharts', 'https://cdn.jsdelivr.net/npm/apexcharts@3.42.0/dist/apexcharts.min.js', array(), '3.42.0', true);
    
    // SimpleBar para scrollbar personalizado
    wp_enqueue_script('simplebar', 'https://cdn.jsdelivr.net/npm/simplebar@6.2.5/dist/simplebar.min.js', array(), '6.2.5', true);
    
    // Script de configuración del tema
    wp_enqueue_script('ui-panel-saas-config', UI_PANEL_SAAS_ASSETS_URI . '/js/config.js', array('jquery'), UI_PANEL_SAAS_VERSION, true);
    
    // Script principal del tema
    wp_enqueue_script('ui-panel-saas-main', UI_PANEL_SAAS_ASSETS_URI . '/js/main.js', array('jquery', 'bootstrap-bundle', 'apexcharts', 'simplebar'), UI_PANEL_SAAS_VERSION, true);

    // Pasar datos a JavaScript
    wp_localize_script('ui-panel-saas-main', 'ui_panel_saas_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('ui-panel-saas-nonce'),
        'homeUrl' => esc_url(home_url('/')),
        'themeUri' => UI_PANEL_SAAS_URI,
        'assetsUri' => UI_PANEL_SAAS_ASSETS_URI,
        'isRtl' => is_rtl(),
        'userMode' => get_theme_mod('ui_panel_saas_theme_mode', 'light'),
        'userLoggedIn' => is_user_logged_in(),
    ));

    // Script de Lucide para iconos (alternativa a Tabler si es necesario)
    wp_enqueue_script('lucide', 'https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js', array(), null, true);

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
    $layout_mode = get_theme_mod('ui_panel_saas_layout_mode', 'fluid');
    $topbar_color = get_theme_mod('ui_panel_saas_topbar_color', 'light');
    $menu_color = get_theme_mod('ui_panel_saas_menu_color', 'dark');
    
    return str_replace('<html', '<html data-bs-theme="' . esc_attr($theme_mode) . '" data-sidenav-size="' . esc_attr($sidebar_mode) . '" data-layout-mode="' . esc_attr($layout_mode) . '" data-topbar-color="' . esc_attr($topbar_color) . '" data-menu-color="' . esc_attr($menu_color) . '"', $output);
}
add_filter('language_attributes', 'ui_panel_saas_add_html_attributes');

/**
 * Agregar la clase 'apply-3d-effect' al body para activar los efectos 3D en todo el tema
 */
function ui_panel_saas_add_body_classes($classes) {
    $classes[] = 'apply-3d-effect';
    return $classes;
}
add_filter('body_class', 'ui_panel_saas_add_body_classes');

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

/**
 * Función para crear una estructura de directorio en la carpeta de uploads
 * para guardar recursos personalizados del tema (imágenes, fuentes, etc.)
 */
function ui_panel_saas_create_uploads_directory() {
    $upload_dir = wp_upload_dir();
    $ui_panel_dir = $upload_dir['basedir'] . '/ui-panel-saas';
    
    if (!file_exists($ui_panel_dir)) {
        wp_mkdir_p($ui_panel_dir);
    }
    
    $subdirs = array('images', 'fonts', 'css', 'js');
    foreach ($subdirs as $subdir) {
        $path = $ui_panel_dir . '/' . $subdir;
        if (!file_exists($path)) {
            wp_mkdir_p($path);
        }
    }
}
add_action('after_setup_theme', 'ui_panel_saas_create_uploads_directory');

/**
 * Añadir clases a los elementos <li> del menú
 */
function ui_panel_saas_add_menu_li_class($classes, $item, $args, $depth) {
    if ($args->theme_location == 'sidebar') {
        $classes[] = 'side-nav-item';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'ui_panel_saas_add_menu_li_class', 10, 4);

/**
 * Añadir clases a los enlaces <a> del menú
 */
function ui_panel_saas_add_menu_link_class($atts, $item, $args, $depth) {
    if ($args->theme_location == 'sidebar') {
        $atts['class'] = 'side-nav-link';
    } elseif ($args->theme_location == 'footer') {
        $atts['class'] = 'list-inline-item';
    }
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ui_panel_saas_add_menu_link_class', 10, 4);

/**
 * Añadir icono a los elementos del menú lateral
 */
function ui_panel_saas_add_menu_icon($title, $item, $args, $depth) {
    // Solo procesar para el menú lateral y primer nivel
    if ($args->theme_location !== 'sidebar' || $depth > 0) {
        return $title;
    }
    
    // Buscar clases que comiencen con 'ti-' (Tabler Icons)
    $icon_class = '';
    foreach ($item->classes as $class) {
        if (strpos($class, 'ti-') === 0) {
            $icon_class = $class;
            break;
        }
    }
    
    // Si no hay una clase de icono específica, usar un icono genérico
    if (empty($icon_class)) {
        $icon_class = 'ti-circle';
    }
    
    // Estructura del icono y texto del menú
    $menu_icon = '<span class="menu-icon"><i class="ti ' . esc_attr($icon_class) . '"></i></span>';
    $menu_text = '<span class="menu-text">' . $title . '</span>';
    
    // Si el elemento tiene hijos, agregar flecha
    $menu_arrow = '';
    if (in_array('has-children', $item->classes)) {
        $menu_arrow = '<span class="menu-arrow"></span>';
    }
    
    return $menu_icon . $menu_text . $menu_arrow;
}
add_filter('nav_menu_item_title', 'ui_panel_saas_add_menu_icon', 10, 4);

/**
 * Permitir la integración del menú personalizado desde el plugin UI Panel SaaS Menu Manager
 */
function ui_panel_saas_menu_integration($args) {
    return $args;
}
add_filter('wp_nav_menu_args', 'ui_panel_saas_menu_integration', 5);

/**
 * Registrar shortcodes personalizados
 */
function ui_panel_saas_register_shortcodes() {
    // Shortcode para mostrar estadísticas en dashboard
    add_shortcode('ui_panel_stat', 'ui_panel_saas_stat_shortcode');
    
    // Shortcode para mostrar tarjetas con información
    add_shortcode('ui_panel_card', 'ui_panel_saas_card_shortcode');
    
    // Shortcode para mostrar botones estilizados
    add_shortcode('ui_panel_button', 'ui_panel_saas_button_shortcode');
    
    // Shortcode para botón 3D
    add_shortcode('ui_panel_button_3d', 'ui_panel_saas_button_3d_shortcode');
    
    // Shortcodes específicos para la plantilla Canvas
    add_shortcode('flex_row', 'ui_panel_saas_flex_row_shortcode');
    add_shortcode('flex_column', 'ui_panel_saas_flex_column_shortcode');
    add_shortcode('flex_item', 'ui_panel_saas_flex_item_shortcode');
    add_shortcode('canvas_card', 'ui_panel_saas_canvas_card_shortcode');
    add_shortcode('canvas_section', 'ui_panel_saas_canvas_section_shortcode');
}
add_action('init', 'ui_panel_saas_register_shortcodes');

/**
 * Shortcode para mostrar estadísticas en el dashboard
 */
function ui_panel_saas_stat_shortcode($atts) {
    $atts = shortcode_atts(array(
        'icon' => 'ti-chart-bar',
        'color' => 'primary',
        'title' => esc_html__('Estadística', 'ui-panel-saas'),
        'value' => '0',
        'suffix' => '',
        'prefix' => '',
        'trend' => '0',
        'trend_text' => esc_html__('desde el mes pasado', 'ui-panel-saas'),
    ), $atts);
    
    $trend_class = floatval($atts['trend']) >= 0 ? 'text-success' : 'text-danger';
    $trend_icon = floatval($atts['trend']) >= 0 ? 'ti-arrow-up-filled' : 'ti-arrow-down-filled';
    
    ob_start();
    ?>
    <div class="dashboard-stat">
        <div class="stat-icon bg-<?php echo esc_attr($atts['color']); ?>-subtle text-<?php echo esc_attr($atts['color']); ?>">
            <i class="ti <?php echo esc_attr($atts['icon']); ?>"></i>
        </div>
        <h5 class="stat-title"><?php echo esc_html($atts['title']); ?></h5>
        <h3 class="stat-value">
            <?php if (!empty($atts['prefix'])) : ?>
                <span class="stat-prefix"><?php echo esc_html($atts['prefix']); ?></span>
            <?php endif; ?>
            <?php echo esc_html($atts['value']); ?>
            <?php if (!empty($atts['suffix'])) : ?>
                <span class="stat-suffix"><?php echo esc_html($atts['suffix']); ?></span>
            <?php endif; ?>
        </h3>
        <div class="stat-trend">
            <span class="<?php echo esc_attr($trend_class); ?> me-2">
                <i class="ti <?php echo esc_attr($trend_icon); ?>"></i> <?php echo esc_html(abs(floatval($atts['trend']))); ?>%
            </span>
            <span class="text-muted"><?php echo esc_html($atts['trend_text']); ?></span>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para mostrar tarjetas con información
 */
function ui_panel_saas_card_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'icon' => '',
        'class' => '',
    ), $atts);
    
    ob_start();
    ?>
    <div class="card <?php echo esc_attr($atts['class']); ?>">
        <?php if (!empty($atts['title'])) : ?>
            <div class="card-header">
                <?php if (!empty($atts['icon'])) : ?>
                    <i class="ti <?php echo esc_attr($atts['icon']); ?> me-2"></i>
                <?php endif; ?>
                <h4 class="card-title"><?php echo esc_html($atts['title']); ?></h4>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para mostrar botones estilizados
 */
function ui_panel_saas_button_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'url' => '#',
        'color' => 'primary',
        'size' => '',
        'icon' => '',
        'class' => '',
        'target' => '_self',
    ), $atts);
    
    $btn_class = 'btn btn-' . esc_attr($atts['color']);
    
    if (!empty($atts['size'])) {
        $btn_class .= ' btn-' . esc_attr($atts['size']);
    }
    
    if (!empty($atts['class'])) {
        $btn_class .= ' ' . esc_attr($atts['class']);
    }
    
    ob_start();
    ?>
    <a href="<?php echo esc_url($atts['url']); ?>" class="<?php echo esc_attr($btn_class); ?>" target="<?php echo esc_attr($atts['target']); ?>">
        <?php if (!empty($atts['icon'])) : ?>
            <i class="ti <?php echo esc_attr($atts['icon']); ?> me-1"></i>
        <?php endif; ?>
        <?php echo do_shortcode($content); ?>
    </a>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para botones 3D
 */
function ui_panel_saas_button_3d_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'url' => '#',
        'color' => 'primary',
        'size' => '',
        'icon' => '',
        'class' => '',
        'target' => '_self',
    ), $atts);
    
    $wrapper_class = 'btn-3d-wrapper ' . esc_attr($atts['color']);
    
    if (!empty($atts['size'])) {
        $wrapper_class .= ' btn-' . esc_attr($atts['size']);
    }
    
    if (!empty($atts['class'])) {
        $wrapper_class .= ' ' . esc_attr($atts['class']);
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($wrapper_class); ?>">
        <div class="btn-3d-back"></div>
        <a href="<?php echo esc_url($atts['url']); ?>" class="btn-3d" target="<?php echo esc_attr($atts['target']); ?>">
            <span class="btn-3d-text"><?php echo do_shortcode($content); ?></span>
            <?php if (!empty($atts['icon'])) : ?>
                <i class="ti <?php echo esc_attr($atts['icon']); ?> btn-3d-icon"></i>
            <?php endif; ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para crear una fila flex
 */
function ui_panel_saas_flex_row_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'class' => '',
        'justify' => '', // start, center, end, between, around, evenly
        'align' => '',   // start, center, end, stretch
        'gap' => '',     // 5, 10, 15, 20, 30
        'style' => '',
    ), $atts);
    
    $row_class = 'flex-row';
    
    if (!empty($atts['justify'])) {
        $row_class .= ' justify-' . esc_attr($atts['justify']);
    }
    
    if (!empty($atts['align'])) {
        $row_class .= ' align-' . esc_attr($atts['align']);
    }
    
    if (!empty($atts['gap'])) {
        $row_class .= ' gap-' . esc_attr($atts['gap']);
    }
    
    if (!empty($atts['class'])) {
        $row_class .= ' ' . esc_attr($atts['class']);
    }
    
    $style_attr = '';
    if (!empty($atts['style'])) {
        $style_attr = ' style="' . esc_attr($atts['style']) . '"';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($row_class); ?>"<?php echo $style_attr; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para crear una columna flex
 */
function ui_panel_saas_flex_column_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'class' => '',
        'justify' => '', // start, center, end, between, around, evenly
        'align' => '',   // start, center, end, stretch
        'gap' => '',     // 5, 10, 15, 20, 30
        'style' => '',
    ), $atts);
    
    $column_class = 'flex-column';
    
    if (!empty($atts['justify'])) {
        $column_class .= ' justify-' . esc_attr($atts['justify']);
    }
    
    if (!empty($atts['align'])) {
        $column_class .= ' align-' . esc_attr($atts['align']);
    }
    
    if (!empty($atts['gap'])) {
        $column_class .= ' gap-' . esc_attr($atts['gap']);
    }
    
    if (!empty($atts['class'])) {
        $column_class .= ' ' . esc_attr($atts['class']);
    }
    
    $style_attr = '';
    if (!empty($atts['style'])) {
        $style_attr = ' style="' . esc_attr($atts['style']) . '"';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($column_class); ?>"<?php echo $style_attr; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para elementos flex individuales
 */
function ui_panel_saas_flex_item_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'size' => '12',    // 1-12 (sistema de rejilla)
        'md' => '',        // tamaño en pantallas medianas
        'class' => '',
        'style' => '',
    ), $atts);
    
    $item_class = 'flex-col-' . esc_attr($atts['size']);
    
    if (!empty($atts['md'])) {
        $item_class .= ' flex-col-md-' . esc_attr($atts['md']);
    }
    
    if (!empty($atts['class'])) {
        $item_class .= ' ' . esc_attr($atts['class']);
    }
    
    $style_attr = '';
    if (!empty($atts['style'])) {
        $style_attr = ' style="' . esc_attr($atts['style']) . '"';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($item_class); ?>"<?php echo $style_attr; ?>>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para tarjetas en Canvas
 */
function ui_panel_saas_canvas_card_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'icon' => '',
        'class' => '',
        'style' => '',
    ), $atts);
    
    $card_class = 'canvas-card';
    
    if (!empty($atts['class'])) {
        $card_class .= ' ' . esc_attr($atts['class']);
    }
    
    $style_attr = '';
    if (!empty($atts['style'])) {
        $style_attr = ' style="' . esc_attr($atts['style']) . '"';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($card_class); ?>"<?php echo $style_attr; ?>>
        <?php if (!empty($atts['title'])) : ?>
            <div class="canvas-card-header">
                <?php if (!empty($atts['icon'])) : ?>
                    <i class="ti <?php echo esc_attr($atts['icon']); ?> me-2"></i>
                <?php endif; ?>
                <h4 class="canvas-card-title"><?php echo esc_html($atts['title']); ?></h4>
            </div>
        <?php endif; ?>
        <div class="canvas-card-body">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode para secciones en Canvas
 */
function ui_panel_saas_canvas_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'class' => '',
        'style' => '',
    ), $atts);
    
    $section_class = 'content-section';
    
    if (!empty($atts['class'])) {
        $section_class .= ' ' . esc_attr($atts['class']);
    }
    
    $style_attr = '';
    if (!empty($atts['style'])) {
        $style_attr = ' style="' . esc_attr($atts['style']) . '"';
    }
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($section_class); ?>"<?php echo $style_attr; ?>>
        <?php if (!empty($atts['title'])) : ?>
            <h3 class="section-title"><?php echo esc_html($atts['title']); ?></h3>
        <?php endif; ?>
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}
