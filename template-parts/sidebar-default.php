<?php
/**
 * Template part for displaying the default sidebar
 *
 * @package UI_Panel_SAAS
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Sidenav Menu Start -->
<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
        <span class="logo-light">
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            
            if (has_custom_logo()) {
                echo '<span class="logo-lg"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></span>';
                echo '<span class="logo-sm text-center">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
            } else {
                echo '<span class="logo-lg">' . get_bloginfo('name') . '</span>';
                echo '<span class="logo-sm text-center">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
            }
            ?>
        </span>

        <span class="logo-dark">
            <?php
            if (has_custom_logo()) {
                echo '<span class="logo-lg"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></span>';
                echo '<span class="logo-sm text-center">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
            } else {
                echo '<span class="logo-lg">' . get_bloginfo('name') . '</span>';
                echo '<span class="logo-sm text-center">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
            }
            ?>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>
        <!--- Sidenav Menu -->
        <?php
        // Verifica si hay un menú asociado a la ubicación 'sidebar'
        if (has_nav_menu('sidebar')) {
            wp_nav_menu(array(
                'theme_location' => 'sidebar',
                'menu_class'     => 'side-nav',
                'container'      => '',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => new UI_Panel_SAAS_Walker_Nav_Menu(),
            ));
        } else {
            // Menú de ejemplo si no hay un menú configurado
            ?>
            <ul class="side-nav">
                <li class="side-nav-item">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text"> <?php esc_html_e('Dashboard', 'ui-panel-saas'); ?> </span>
                        <span class="badge bg-success rounded-pill">5</span>
                    </a>
                </li>

                <li class="side-nav-title mt-2"><?php esc_html_e('Apps & Pages', 'ui-panel-saas'); ?></li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-message-filled"></i></span>
                        <span class="menu-text"> <?php esc_html_e('Chat', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-calendar-filled"></i></span>
                        <span class="menu-text"> <?php esc_html_e('Calendar', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-inbox"></i></span>
                        <span class="menu-text"> <?php esc_html_e('Email', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-folder-filled"></i></span>
                        <span class="menu-text"> <?php esc_html_e('File Manager', 'ui-panel-saas'); ?> </span>
                    </a>
                </li>

                <!-- Resto del menú por defecto -->
                <!-- ... Ecommerce, Pages, etc. (igual que sidebar.php) ... -->
            </ul>
            <?php
        }
        ?>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->