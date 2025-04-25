<?php
/**
 * El sidebar que contiene el área de widget principal
 * y la navegación lateral
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Verificar si debemos mostrar la barra lateral
// En algunas plantillas podríamos querer ocultarla
$show_sidebar = apply_filters('ui_panel_saas_show_sidebar', true);

if (!$show_sidebar) {
    return;
}

// Obtener el modo de la barra lateral
$sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');
$sidebar_class = 'leftside-menu';

// Añadir clases basadas en el modo
if ($sidebar_mode == 'condensed') {
    $sidebar_class .= ' sidebar-condensed';
} elseif ($sidebar_mode == 'compact') {
    $sidebar_class .= ' sidebar-compact';
} elseif ($sidebar_mode == 'hover') {
    $sidebar_class .= ' sidebar-hover';
} elseif ($sidebar_mode == 'icon-view') {
    $sidebar_class .= ' sidebar-icon-view';
}
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="<?php echo esc_attr($sidebar_class); ?>">
    <!-- Brand Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo text-center logo-light">
        <span class="logo-lg">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            
            if (has_custom_logo()) :
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" height="40">';
            else :
            ?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" height="40">
            <?php endif; ?>
        </span>
        <span class="logo-sm">
            <?php
            // Logo pequeño
            $logo_sm_id = get_theme_mod('ui_panel_saas_logo_small');
            $logo_sm = wp_get_attachment_image_src($logo_sm_id, 'full');
            
            if (!empty($logo_sm)) :
                echo '<img src="' . esc_url($logo_sm[0]) . '" alt="' . get_bloginfo('name') . '" height="28">';
            elseif (has_custom_logo()) :
                echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" height="28">';
            else :
            ?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-sm.png" alt="<?php bloginfo('name'); ?>" height="28">
            <?php endif; ?>
        </span>
    </a>

    <!-- Sidebar Hover/Toggle Button -->
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php
            // Si hay un menú asignado a la ubicación de la barra lateral, lo mostramos
            if (has_nav_menu('sidebar')) :
            ?>
            <ul class="side-nav" id="side-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'sidebar',
                    'container' => false,
                    'menu_class' => '',
                    'items_wrap' => '%3$s',
                    'walker' => new UI_Panel_SAAS_Walker_Nav_Menu(),
                    'fallback_cb' => false
                ));
                ?>
            </ul>
            <?php
            // Si no hay menú asignado, mostramos un menú predeterminado
            else :
            ?>
            <ul class="side-nav" id="side-menu">
                <li class="side-nav-title">
                    <?php echo esc_html__('NAVEGACIÓN', 'ui-panel-saas'); ?>
                </li>
                
                <li class="side-nav-item">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="side-nav-link">
                        <i class="ri-dashboard-line"></i>
                        <span> <?php echo esc_html__('Dashboard', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>

                <li class="side-nav-title">
                    <?php echo esc_html__('APPS & PAGES', 'ui-panel-saas'); ?>
                </li>
                
                <?php if (class_exists('WooCommerce')) : ?>
                <li class="side-nav-item">
                    <a href="javascript:void(0);" class="side-nav-link">
                        <i class="ri-shopping-bag-3-line"></i>
                        <span> <?php echo esc_html__('Ecommerce', 'ui-panel-saas'); ?> </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <li>
                            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php echo esc_html__('Productos', 'ui-panel-saas'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>"><?php echo esc_html__('Mis Pedidos', 'ui-panel-saas'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>"><?php echo esc_html__('Carrito', 'ui-panel-saas'); ?></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                
                <?php
                // Lista de páginas para el menú
                $menu_pages = get_pages(array(
                    'sort_column' => 'menu_order',
                    'number' => 5,
                ));
                
                if (!empty($menu_pages)) :
                ?>
                <li class="side-nav-item">
                    <a href="javascript:void(0);" class="side-nav-link">
                        <i class="ri-pages-line"></i>
                        <span> <?php echo esc_html__('Páginas', 'ui-panel-saas'); ?> </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="side-nav-second-level" aria-expanded="false">
                        <?php foreach ($menu_pages as $menu_page) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($menu_page->ID)); ?>"><?php echo esc_html($menu_page->post_title); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endif; ?>
                
                <?php if (is_user_logged_in() && current_user_can('edit_posts')) : ?>
                <li class="side-nav-title">
                    <?php echo esc_html__('ADMINISTRACIÓN', 'ui-panel-saas'); ?>
                </li>
                
                <li class="side-nav-item">
                    <a href="<?php echo esc_url(admin_url('edit.php')); ?>" class="side-nav-link">
                        <i class="ri-article-line"></i>
                        <span> <?php echo esc_html__('Posts', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>
                
                <li class="side-nav-item">
                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="side-nav-link">
                        <i class="ri-pages-line"></i>
                        <span> <?php echo esc_html__('Páginas', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>
                
                <?php if (current_user_can('manage_options')) : ?>
                <li class="side-nav-item">
                    <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="side-nav-link">
                        <i class="ri-palette-line"></i>
                        <span> <?php echo esc_html__('Personalizar', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

    <?php
    // Widget área en la parte inferior del sidebar
    if (is_active_sidebar('sidebar-1')) :
    ?>
    <div class="sidebar-footer">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
    <?php endif; ?>
</div>
<!-- Left Sidebar End -->
