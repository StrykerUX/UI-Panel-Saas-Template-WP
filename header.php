<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UI_Panel_SAAS
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Obtener modo de tema (claro/oscuro)
$theme_mode = get_theme_mod('ui_panel_saas_theme_mode', 'light');
// Obtener modo de sidebar (default, condensed, compact, icon)
$sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');
// Obtener color de topbar (light, dark)
$topbar_color = get_theme_mod('ui_panel_saas_topbar_color', 'light');
// Obtener color de menú (light, dark)
$menu_color = get_theme_mod('ui_panel_saas_menu_color', 'dark');
// Obtener modo de layout (fluid, boxed)
$layout_mode = get_theme_mod('ui_panel_saas_layout_mode', 'fluid');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-bs-theme="<?php echo esc_attr($theme_mode); ?>" data-menu-color="<?php echo esc_attr($menu_color); ?>" data-topbar-color="<?php echo esc_attr($topbar_color); ?>" data-layout-mode="<?php echo esc_attr($layout_mode); ?>" data-sidenav-size="<?php echo esc_attr($sidebar_mode); ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Begin page -->
    <div class="wrapper">
        <?php do_action('ui_panel_saas_before_sidebar'); ?>

        <?php get_sidebar(); ?>

        <?php do_action('ui_panel_saas_after_sidebar'); ?>

        <!-- Topbar Start -->
        <header class="app-topbar">
            <div class="page-container topbar-menu">
                <div class="d-flex align-items-center gap-2">
                    <!-- Brand Logo -->
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                        <span class="logo-light">
                            <?php
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                            
                            if (has_custom_logo()) {
                                echo '<span class="logo-lg"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></span>';
                                echo '<span class="logo-sm"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" height="28"></span>';
                            } else {
                                echo '<span class="logo-lg">' . get_bloginfo('name') . '</span>';
                                echo '<span class="logo-sm">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
                            }
                            ?>
                        </span>

                        <span class="logo-dark">
                            <?php
                            if (has_custom_logo()) {
                                echo '<span class="logo-lg"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></span>';
                                echo '<span class="logo-sm"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" height="28"></span>';
                            } else {
                                echo '<span class="logo-lg">' . get_bloginfo('name') . '</span>';
                                echo '<span class="logo-sm">' . esc_html(substr(get_bloginfo('name'), 0, 2)) . '</span>';
                            }
                            ?>
                        </span>
                    </a>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="sidenav-toggle-button btn btn-secondary btn-icon">
                        <i class="ti ti-menu-deep fs-24"></i>
                    </button>

                    <!-- Search for medium and large screens -->
                    <div class="topbar-search text-muted d-none d-xl-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                        <i class="ti ti-search fs-18"></i>
                        <span class="me-2"><?php esc_html_e('Search something..', 'ui-panel-saas'); ?></span>
                        <button type="submit" class="ms-auto btn btn-sm btn-primary shadow-none">⌘K</button>
                    </div>

                    <!-- Pages Dropdown Menu -->
                    <div class="topbar-item d-none d-md-flex">
                        <div class="dropdown">
                            <a href="#" class="topbar-link btn btn-link px-2 dropdown-toggle drop-arrow-none fw-medium" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <?php esc_html_e('Pages', 'ui-panel-saas'); ?> <i class="ti ti-chevron-down ms-1"></i>
                            </a>

                            <?php
                            // Menú principal en el topbar
                            if (has_nav_menu('primary')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container'      => 'div',
                                    'container_class' => 'dropdown-menu dropdown-menu-lg p-0',
                                    'menu_class'     => 'list-unstyled',
                                    'depth'          => 2,
                                    'fallback_cb'    => false,
                                    'walker'         => new UI_Panel_SAAS_Walker_Nav_Menu(),
                                ));
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <!-- Search for small devices -->
                    <div class="topbar-item d-flex d-xl-none">
                        <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                            <i class="ti ti-search fs-22"></i>
                        </button>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="topbar-item">
                        <div class="dropdown">
                            <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="dropdown" data-bs-offset="0,24" type="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/flags/us.svg'); ?>" alt="user-image" class="w-100 rounded" height="18" id="selected-language-image">
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/flags/us.svg'); ?>" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle"><?php esc_html_e('English', 'ui-panel-saas'); ?></span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/flags/es.svg'); ?>" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle"><?php esc_html_e('Spanish', 'ui-panel-saas'); ?></span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/flags/de.svg'); ?>" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle"><?php esc_html_e('German', 'ui-panel-saas'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Dropdown -->
                    <div class="topbar-item">
                        <div class="dropdown">
                            <button class="topbar-link btn btn-outline-primary btn-icon dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" data-bs-offset="0,24" type="button" data-bs-auto-close="outside" aria-haspopup="false" aria-expanded="false">
                                <i class="ti ti-bell animate-ring fs-22"></i>
                                <span class="noti-icon-badge"></span>
                            </button>

                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                                <div class="p-3 border-bottom border-dashed">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-16 fw-semibold"><?php esc_html_e('Notifications', 'ui-panel-saas'); ?></h6>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle drop-arrow-none link-dark" data-bs-toggle="dropdown" data-bs-offset="0,15" aria-expanded="false">
                                                    <i class="ti ti-settings fs-22 align-middle"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Mark as Read', 'ui-panel-saas'); ?></a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Delete All', 'ui-panel-saas'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative z-2 rounded-0" style="max-height: 300px;" data-simplebar>
                                    <!-- Placeholder para notifications -->
                                    <div class="p-3 text-center">
                                        <p class="text-muted"><?php esc_html_e('No new notifications', 'ui-panel-saas'); ?></p>
                                    </div>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notification-item text-center text-reset text-decoration-underline link-offset-2 fw-bold notify-item border-top border-light py-2">
                                    <?php esc_html_e('View All', 'ui-panel-saas'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Apps Dropdown -->
                    <div class="topbar-item d-none d-sm-flex">
                        <div class="dropdown">
                            <button class="topbar-link btn btn-outline-primary btn-icon dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" data-bs-offset="0,24" type="button" aria-haspopup="false" aria-expanded="false">
                                <i class="ti ti-apps fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0">
                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/brands/slack.svg'); ?>" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/brands/gitlab.svg'); ?>" alt="Github">
                                                <span>Gitlab</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?php echo esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/brands/dribbble.svg'); ?>" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Theme Settings Button -->
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" type="button">
                            <i class="ti ti-settings fs-22"></i>
                        </button>
                    </div>

                    <!-- Light/Dark Mode Button -->
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link btn btn-outline-primary btn-icon" id="light-dark-mode" type="button">
                            <i class="ti ti-moon fs-22"></i>
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="topbar-item">
                        <div class="dropdown">
                            <a class="topbar-link btn btn-outline-primary dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" data-bs-offset="0,22" type="button" aria-haspopup="false" aria-expanded="false">
                                <?php
                                // Si el usuario está logueado, mostramos su avatar y nombre
                                if (is_user_logged_in()) {
                                    $current_user = wp_get_current_user();
                                    echo get_avatar($current_user->ID, 24, '', $current_user->display_name, array('class' => 'rounded-circle me-lg-2 d-flex'));
                                    echo '<span class="d-lg-flex flex-column gap-1 d-none">' . esc_html($current_user->display_name) . '</span>';
                                } else {
                                    // Si no está logueado, mostramos un avatar genérico
                                    echo '<img src="' . esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/users/avatar-1.jpg') . '" width="24" class="rounded-circle me-lg-2 d-flex" alt="user-image">';
                                    echo '<span class="d-lg-flex flex-column gap-1 d-none">' . esc_html__('Guest', 'ui-panel-saas') . '</span>';
                                }
                                ?>
                                <i class="ti ti-chevron-down d-none d-lg-block align-middle ms-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0"><?php esc_html_e('Welcome !', 'ui-panel-saas'); ?></h6>
                                </div>

                                <?php if (is_user_logged_in()) : ?>
                                    <!-- item-->
                                    <a href="<?php echo esc_url(get_edit_profile_url()); ?>" class="dropdown-item">
                                        <i class="ti ti-user-hexagon me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('My Account', 'ui-panel-saas'); ?></span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="ti ti-settings me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('Settings', 'ui-panel-saas'); ?></span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="ti ti-lifebuoy me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('Support', 'ui-panel-saas'); ?></span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="dropdown-item active fw-semibold text-danger">
                                        <i class="ti ti-logout me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('Sign Out', 'ui-panel-saas'); ?></span>
                                    </a>
                                <?php else : ?>
                                    <!-- item-->
                                    <a href="<?php echo esc_url(wp_login_url()); ?>" class="dropdown-item">
                                        <i class="ti ti-login me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('Sign In', 'ui-panel-saas'); ?></span>
                                    </a>

                                    <!-- item-->
                                    <a href="<?php echo esc_url(wp_registration_url()); ?>" class="dropdown-item">
                                        <i class="ti ti-user-plus me-1 fs-17 align-middle"></i>
                                        <span class="align-middle"><?php esc_html_e('Register', 'ui-panel-saas'); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->

        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent">
                    <div class="card mb-0 shadow-none">
                        <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                            <i class="ti ti-search fs-22"></i>
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="search" class="form-control border-0" id="search-modal-input" name="s" placeholder="<?php esc_attr_e('Search for actions, people,', 'ui-panel-saas'); ?>">
                            </form>
                            <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            <div class="page-container">
