<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UI_Panel_SAAS
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Clase CSS para el elemento body
$sidebar_class = '';
$sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');

if ($sidebar_mode == 'condensed') {
    $sidebar_class = 'sidebar-condensed';
} elseif ($sidebar_mode == 'compact') {
    $sidebar_class = 'sidebar-compact';
} elseif ($sidebar_mode == 'icon') {
    $sidebar_class = 'sidebar-icon-only';
}

// Verificar si el plugin Vortex UI Panel está activo
$use_vortex_sidebar = false;
if (class_exists('Vortex_UI_Panel')) {
    $use_vortex_sidebar = true;
}

// Si el plugin está activo, usar su renderer para el sidebar
if ($use_vortex_sidebar) {
    // Verificar si la clase ya está cargada, si no, cargarla
    if (!class_exists('Vortex_Sidebar_Renderer') && function_exists('run_vortex_ui_panel')) {
        $plugin_instance = run_vortex_ui_panel();
        $menu_manager = new Vortex_Menu_Manager();
        require_once WP_PLUGIN_DIR . '/vortex-ui-panel-nuevo/includes/class-vortex-sidebar-renderer.php';
        $sidebar_renderer = new Vortex_Sidebar_Renderer($menu_manager);
        echo $sidebar_renderer->render_sidebar();
    } else if (class_exists('Vortex_Sidebar_Renderer')) {
        $menu_manager = new Vortex_Menu_Manager();
        $sidebar_renderer = new Vortex_Sidebar_Renderer($menu_manager);
        echo $sidebar_renderer->render_sidebar();
    } else {
        // Fallback al sidebar estándar si hay problemas con el plugin
        include_once(get_template_directory() . '/template-parts/sidebar-default.php');
    }
} else {
    // Usar el sidebar estándar del tema
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

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-basket-filled"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Ecommerce', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Products', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Products Grid', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Product Details', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Add Products', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Categories', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Orders', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Order Details', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Customers', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Sellers', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-files"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Pages', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Starter Page', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('FAQ', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Timeline', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-title mt-2"><?php esc_html_e('Components', 'ui-panel-saas'); ?></li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-brightness-filled"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Base UI', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarBaseUI">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Accordions', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Alerts', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-alien-filled"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Extended UI', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarExtendedUI">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Sweet Alerts', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Ratings', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarIcons" aria-expanded="false" aria-controls="sidebarIcons" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-leaf"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Icons', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarIcons">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Tabler', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Solar', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarCharts" aria-expanded="false" aria-controls="sidebarCharts" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-chart-arcs"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Charts', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCharts">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Area', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Bar', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false" aria-controls="sidebarForms" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-forms"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Forms', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarForms">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Form Elements', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Validation', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarTables" aria-expanded="false" aria-controls="sidebarTables" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-table-filled"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Tables', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTables">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Basic Tables', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Data Tables', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-map-pin-filled"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Maps', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarMaps">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Google Maps', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Vector Maps', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-title mt-2"><?php esc_html_e('More', 'ui-panel-saas'); ?></li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-box-multiple-3"></i></span>
                            <span class="menu-text"> <?php esc_html_e('Multi Level', 'ui-panel-saas'); ?> </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarMultiLevel">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="#" class="side-nav-link">
                                        <span class="menu-text"><?php esc_html_e('Level 1.1', 'ui-panel-saas'); ?></span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel" class="side-nav-link">
                                        <span class="menu-text"> <?php esc_html_e('Level 1.2', 'ui-panel-saas'); ?> </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarSecondLevel">
                                        <ul class="sub-menu">
                                            <li class="side-nav-item">
                                                <a href="#" class="side-nav-link">
                                                    <span class="menu-text"><?php esc_html_e('Level 2.1', 'ui-panel-saas'); ?></span>
                                                </a>
                                            </li>
                                            <li class="side-nav-item">
                                                <a href="#" class="side-nav-link">
                                                    <span class="menu-text"><?php esc_html_e('Level 2.2', 'ui-panel-saas'); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <?php
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Sidenav Menu End -->
<?php
}
?>