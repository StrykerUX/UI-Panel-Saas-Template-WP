<?php
/**
 * El encabezado para nuestro tema
 *
 * Muestra toda la sección <head> y comienza el <body>
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="wrapper">

    <?php
    // Determinar si mostrar topbar
    $show_topbar = apply_filters('ui_panel_saas_show_topbar', true);
    
    if ($show_topbar) :
    ?>
    <!-- ========== Topbar Start ========== -->
    <div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center gap-lg-2 gap-1">
                <!-- Topbar Logo -->
                <div class="logo-topbar">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                            <span class="logo-lg">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>">
                            </span>
                            <span class="logo-sm">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-sm.png" alt="<?php bloginfo('name'); ?>">
                            </span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="ri-menu-line"></i>
                </button>

                <!-- Horizontal Menu Toggle Button -->
                <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>

                <!-- Topbar Search Form -->
                <div class="app-search dropdown d-none d-lg-block">
                    <form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="input-group">
                            <input type="text" name="s" class="form-control dropdown-toggle" placeholder="<?php echo esc_attr__('Buscar...', 'ui-panel-saas'); ?>" id="top-search">
                            <span class="ri-search-line search-icon"></span>
                            <button class="input-group-text btn btn-primary" type="submit">
                                <?php echo esc_html__('Buscar', 'ui-panel-saas'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            // Menú superior derecho
            if (has_nav_menu('topbar-right')) :
            ?>
            <ul class="topbar-menu d-flex align-items-center gap-3">
                <?php
                // Selector de idioma si está activado WPML o Polylang
                if (function_exists('icl_object_id') || function_exists('pll_the_languages')) :
                ?>
                <!-- Language Dropdown -->
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?php
                        $current_lang = '';
                        $current_flag = '';
                        
                        if (function_exists('icl_object_id')) {
                            global $sitepress;
                            $current_lang = $sitepress->get_current_language();
                            $current_flag = $sitepress->get_flag_url($current_lang);
                        } elseif (function_exists('pll_current_language')) {
                            $current_lang = pll_current_language('name');
                            $current_flag = UI_PANEL_SAAS_ASSETS_URI . '/images/flags/' . pll_current_language() . '.png';
                        }
                        ?>
                        <img src="<?php echo esc_url($current_flag); ?>" alt="<?php echo esc_attr($current_lang); ?>" class="me-0 me-sm-1" height="12">
                        <span class="align-middle d-none d-lg-inline-block"><?php echo esc_html($current_lang); ?></span>
                        <i class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                        <?php
                        if (function_exists('icl_get_languages')) {
                            $languages = icl_get_languages('skip_missing=0');
                            if (!empty($languages)) {
                                foreach ($languages as $lang_code => $language) {
                                    if ($lang_code != $current_lang) {
                                        echo '<a href="' . esc_url($language['url']) . '" class="dropdown-item">
                                            <img src="' . esc_url($language['country_flag_url']) . '" alt="' . esc_attr($language['language_code']) . '" class="me-1" height="12"> 
                                            <span class="align-middle">' . esc_html($language['native_name']) . '</span>
                                        </a>';
                                    }
                                }
                            }
                        } elseif (function_exists('pll_the_languages')) {
                            $languages = pll_the_languages(array('raw' => 1));
                            if (!empty($languages)) {
                                foreach ($languages as $lang_code => $language) {
                                    if ($lang_code != pll_current_language()) {
                                        echo '<a href="' . esc_url($language['url']) . '" class="dropdown-item">
                                            <img src="' . esc_url(UI_PANEL_SAAS_ASSETS_URI . '/images/flags/' . $lang_code . '.png') . '" alt="' . esc_attr($lang_code) . '" class="me-1" height="12"> 
                                            <span class="align-middle">' . esc_html($language['name']) . '</span>
                                        </a>';
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </li>
                <?php endif; ?>

                <!-- Theme Mode Toggle -->
                <li class="d-none d-sm-inline-block">
                    <a href="#" class="nav-link theme-mode-toggle">
                        <i class="ri-moon-line fs-22"></i>
                    </a>
                </li>

                <!-- Notifications Dropdown -->
                <?php if (class_exists('WP_Notification_Center') || apply_filters('ui_panel_saas_show_notifications', false)) : ?>
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ri-notification-3-line fs-22"></i>
                        <?php 
                        $notification_count = apply_filters('ui_panel_saas_notification_count', 0);
                        if ($notification_count > 0) : 
                        ?>
                        <span class="noti-icon-badge"></span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-16 fw-semibold"><?php echo esc_html__('Notificaciones', 'ui-panel-saas'); ?></h6>
                                </div>
                                <?php if ($notification_count > 0) : ?>
                                <div class="col-auto">
                                    <a href="<?php echo esc_url(apply_filters('ui_panel_saas_all_notifications_url', '#')); ?>" class="text-dark text-decoration-underline">
                                        <small><?php echo esc_html__('Marcar todas como leídas', 'ui-panel-saas'); ?></small>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="px-2" style="max-height: 300px;" data-simplebar>
                            <?php
                            do_action('ui_panel_saas_notifications_dropdown');
                            
                            if ($notification_count == 0) :
                            ?>
                            <div class="text-center py-4">
                                <i class="ri-notification-off-line fs-48 text-muted"></i>
                                <p class="text-muted mt-2"><?php echo esc_html__('No tienes notificaciones', 'ui-panel-saas'); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo esc_url(apply_filters('ui_panel_saas_all_notifications_url', '#')); ?>" class="dropdown-item text-center text-primary notify-item border-top py-2">
                            <?php echo esc_html__('Ver todas', 'ui-panel-saas'); ?>
                        </a>
                    </div>
                </li>
                <?php endif; ?>

                <!-- Apps Dropdown (opcional) -->
                <?php if (apply_filters('ui_panel_saas_show_apps_dropdown', false)) : ?>
                <li class="dropdown d-none d-sm-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ri-apps-2-line fs-22"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">
                        <div class="p-2">
                            <div class="row g-0">
                                <?php do_action('ui_panel_saas_apps_dropdown'); ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endif; ?>

                <!-- User Dropdown -->
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <?php echo get_avatar(get_current_user_id(), 32); ?>
                        </span>
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            <h5 class="my-0">
                                <?php 
                                if (is_user_logged_in()) {
                                    echo esc_html(wp_get_current_user()->display_name);
                                } else {
                                    echo esc_html__('Invitado', 'ui-panel-saas');
                                }
                                ?>
                            </h5>
                            <?php if (is_user_logged_in() && function_exists('get_user_role_name')) : ?>
                            <h6 class="my-0 fw-normal"><?php echo esc_html(get_user_role_name(wp_get_current_user())); ?></h6>
                            <?php endif; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                        
                        <?php if (is_user_logged_in()) : ?>
                            
                            <!-- Información del usuario -->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0"><?php echo esc_html__('¡Bienvenido!', 'ui-panel-saas'); ?></h6>
                            </div>

                            <!-- Elementos de menú de usuario -->
                            <a href="<?php echo esc_url(get_edit_profile_url()); ?>" class="dropdown-item">
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Mi Perfil', 'ui-panel-saas'); ?></span>
                            </a>
                            
                            <?php if (current_user_can('manage_options')) : ?>
                            <a href="<?php echo esc_url(admin_url()); ?>" class="dropdown-item">
                                <i class="ri-settings-3-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Administración', 'ui-panel-saas'); ?></span>
                            </a>
                            <?php endif; ?>
                            
                            <a href="<?php echo esc_url(apply_filters('ui_panel_saas_user_support_url', '#')); ?>" class="dropdown-item">
                                <i class="ri-customer-service-2-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Soporte', 'ui-panel-saas'); ?></span>
                            </a>
                            
                            <div class="dropdown-divider"></div>
                            
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="dropdown-item">
                                <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Cerrar sesión', 'ui-panel-saas'); ?></span>
                            </a>
                            
                        <?php else : ?>
                            
                            <a href="<?php echo esc_url(wp_login_url()); ?>" class="dropdown-item">
                                <i class="ri-login-box-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Iniciar sesión', 'ui-panel-saas'); ?></span>
                            </a>
                            
                            <?php if (get_option('users_can_register')) : ?>
                            <a href="<?php echo esc_url(wp_registration_url()); ?>" class="dropdown-item">
                                <i class="ri-user-add-line fs-18 align-middle me-1"></i>
                                <span><?php echo esc_html__('Registrarse', 'ui-panel-saas'); ?></span>
                            </a>
                            <?php endif; ?>
                            
                        <?php endif; ?>
                        
                    </div>
                </li>
                
                <!-- Elementos adicionales del menú superior derecho -->
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'topbar-right',
                    'container' => false,
                    'fallback_cb' => false,
                    'depth' => 1,
                    'items_wrap' => '%3$s',
                    'walker' => new UI_Panel_SAAS_Walker_Nav_Menu()
                ));
                ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->
    <?php endif; // End if show_topbar ?>
    
    <!-- ========== Content Wrapper Start ========== -->
    <div class="content-page">
