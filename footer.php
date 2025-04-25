<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UI_Panel_SAAS
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

?>
            </div><!-- .page-container -->
        </div><!-- .page-content -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <?php 
                        $footer_text = get_theme_mod('ui_panel_saas_footer_copyright', sprintf(
                            /* translators: %s: Current year, site name */
                            esc_html__('%1$s © %2$s - All rights reserved', 'ui-panel-saas'), 
                            date('Y'), 
                            get_bloginfo('name')
                        ));
                        echo wp_kses_post($footer_text);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <?php
                            if (has_nav_menu('footer')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'footer',
                                    'menu_class'     => 'list-inline mb-0',
                                    'container'      => '',
                                    'fallback_cb'    => false,
                                    'depth'          => 1,
                                    'items_wrap'     => '%3$s',
                                    'walker'         => new UI_Panel_SAAS_Walker_Nav_Menu(),
                                ));
                            } else {
                                // Menú predeterminado si no hay uno definido
                                ?>
                                <a href="javascript: void(0);"><?php esc_html_e('About Us', 'ui-panel-saas'); ?></a>
                                <a href="javascript: void(0);"><?php esc_html_e('Help', 'ui-panel-saas'); ?></a>
                                <a href="javascript: void(0);"><?php esc_html_e('Contact Us', 'ui-panel-saas'); ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        <!-- Theme Settings -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="theme-settings-offcanvasLabel"><?php esc_html_e('Theme Settings', 'ui-panel-saas'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="p-3">
                    <h6 class="fw-medium fs-15 text-muted mb-2"><?php esc_html_e('Choose Mode', 'ui-panel-saas'); ?></h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-bs-theme" id="layout-mode-light" value="light" <?php checked(get_theme_mod('ui_panel_saas_theme_mode', 'light'), 'light'); ?>>
                        <label class="form-check-label" for="layout-mode-light"><?php esc_html_e('Light', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="radio" class="form-check-input" name="data-bs-theme" id="layout-mode-dark" value="dark" <?php checked(get_theme_mod('ui_panel_saas_theme_mode', 'light'), 'dark'); ?>>
                        <label class="form-check-label" for="layout-mode-dark"><?php esc_html_e('Dark', 'ui-panel-saas'); ?></label>
                    </div>

                    <h6 class="fw-medium fs-15 text-muted mt-4 mb-2"><?php esc_html_e('Sidebar Size', 'ui-panel-saas'); ?></h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-sidenav-size" id="sidenav-size-default" value="default" <?php checked(get_theme_mod('ui_panel_saas_sidebar_mode', 'default'), 'default'); ?>>
                        <label class="form-check-label" for="sidenav-size-default"><?php esc_html_e('Default', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-sidenav-size" id="sidenav-size-compact" value="compact" <?php checked(get_theme_mod('ui_panel_saas_sidebar_mode', 'default'), 'compact'); ?>>
                        <label class="form-check-label" for="sidenav-size-compact"><?php esc_html_e('Compact', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-sidenav-size" id="sidenav-size-condensed" value="condensed" <?php checked(get_theme_mod('ui_panel_saas_sidebar_mode', 'default'), 'condensed'); ?>>
                        <label class="form-check-label" for="sidenav-size-condensed"><?php esc_html_e('Condensed', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-sidenav-size" id="sidenav-size-full" value="full" <?php checked(get_theme_mod('ui_panel_saas_sidebar_mode', 'default'), 'full'); ?>>
                        <label class="form-check-label" for="sidenav-size-full"><?php esc_html_e('Full', 'ui-panel-saas'); ?></label>
                    </div>

                    <h6 class="fw-medium fs-15 text-muted mt-4 mb-2"><?php esc_html_e('Layout Mode', 'ui-panel-saas'); ?></h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-layout-mode" id="layout-width-fluid" value="fluid" <?php checked(get_theme_mod('ui_panel_saas_layout_mode', 'fluid'), 'fluid'); ?>>
                        <label class="form-check-label" for="layout-width-fluid"><?php esc_html_e('Fluid', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-layout-mode" id="layout-width-boxed" value="boxed" <?php checked(get_theme_mod('ui_panel_saas_layout_mode', 'fluid'), 'boxed'); ?>>
                        <label class="form-check-label" for="layout-width-boxed"><?php esc_html_e('Boxed', 'ui-panel-saas'); ?></label>
                    </div>

                    <h6 class="fw-medium fs-15 text-muted mt-4 mb-2"><?php esc_html_e('Topbar Color', 'ui-panel-saas'); ?></h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-topbar-color" id="topbar-color-light" value="light" <?php checked(get_theme_mod('ui_panel_saas_topbar_color', 'light'), 'light'); ?>>
                        <label class="form-check-label" for="topbar-color-light"><?php esc_html_e('Light', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-topbar-color" id="topbar-color-dark" value="dark" <?php checked(get_theme_mod('ui_panel_saas_topbar_color', 'light'), 'dark'); ?>>
                        <label class="form-check-label" for="topbar-color-dark"><?php esc_html_e('Dark', 'ui-panel-saas'); ?></label>
                    </div>

                    <h6 class="fw-medium fs-15 text-muted mt-4 mb-2"><?php esc_html_e('Menu Color', 'ui-panel-saas'); ?></h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-menu-color" id="menu-color-light" value="light" <?php checked(get_theme_mod('ui_panel_saas_menu_color', 'dark'), 'light'); ?>>
                        <label class="form-check-label" for="menu-color-light"><?php esc_html_e('Light', 'ui-panel-saas'); ?></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="data-menu-color" id="menu-color-dark" value="dark" <?php checked(get_theme_mod('ui_panel_saas_menu_color', 'dark'), 'dark'); ?>>
                        <label class="form-check-label" for="menu-color-dark"><?php esc_html_e('Dark', 'ui-panel-saas'); ?></label>
                    </div>

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="reset-layout"><?php esc_html_e('Reset to Default', 'ui-panel-saas'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <?php ui_panel_saas_footer_bottom(); ?>

    </div>
    <!-- END wrapper -->

    <?php wp_footer(); ?>

</body>
</html>
