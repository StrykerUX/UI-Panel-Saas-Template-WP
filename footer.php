<?php
/**
 * El pie de página para nuestro tema
 *
 * Contiene el área de cierre del contenido y todos los scripts del pie de página
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Obtener opciones del pie de página
$show_footer = apply_filters('ui_panel_saas_show_footer', true);
$footer_type = get_theme_mod('ui_panel_saas_footer_type', 'standard');
?>

                <?php if (function_exists('ui_panel_saas_content_bottom')) { ui_panel_saas_content_bottom(); } ?>
            </div> <!-- container-fluid -->
        </div> <!-- content -->

        <?php if ($show_footer) : ?>
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    
                    <?php if ($footer_type === 'widgets' && (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3'))) : ?>
                    
                    <div class="col-md-4">
                        <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4">
                        <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-md-4">
                        <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget-area">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php else : ?>
                    
                    <div class="col-md-6">
                        <div class="text-md-start text-center">
                            <?php 
                            $footer_copyright = get_theme_mod('ui_panel_saas_footer_copyright', sprintf(
                                esc_html__('%1$s &copy; %2$s %3$s. Todos los derechos reservados.', 'ui-panel-saas'),
                                date('Y'),
                                get_bloginfo('name'),
                                UI_PANEL_SAAS_VERSION
                            ));
                            
                            echo wp_kses_post($footer_copyright);
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="text-md-end text-center">
                            <?php
                            $footer_credits = get_theme_mod('ui_panel_saas_footer_credits', sprintf(
                                esc_html__('Desarrollado con %1$s por %2$s', 'ui-panel-saas'),
                                '<i class="ri-heart-fill text-danger"></i>',
                                '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>'
                            ));
                            
                            echo wp_kses_post($footer_credits);
                            ?>
                        </div>
                    </div>
                    
                    <?php endif; ?>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <?php endif; ?>

    </div>
    <!-- ========== Content Wrapper End ========== -->
</div>
<!-- END wrapper -->

<?php if (function_exists('ui_panel_saas_footer_bottom')) { ui_panel_saas_footer_bottom(); } ?>

<!-- Right Sidebar -->
<?php
$show_right_sidebar = apply_filters('ui_panel_saas_show_right_sidebar', false);
if ($show_right_sidebar) {
    get_template_part('template-parts/right-sidebar');
}
?>
<!-- /Right-bar -->

<!-- Theme Settings -->
<?php
$show_theme_customizer = get_theme_mod('ui_panel_saas_show_theme_customizer', true);
if ($show_theme_customizer) {
    get_template_part('template-parts/theme-settings');
}
?>
<!-- /Theme Settings -->

<?php wp_footer(); ?>

<!-- Custom Scripts -->
<script type="text/javascript">
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            // Inicialización de toggles para modo claro/oscuro
            $('.theme-mode-toggle').on('click', function(e) {
                e.preventDefault();
                
                var currentMode = $('html').attr('data-bs-theme');
                var newMode = (currentMode === 'dark') ? 'light' : 'dark';
                
                // Cambiar atributo HTML
                $('html').attr('data-bs-theme', newMode);
                
                // Guardar preferencia de usuario con AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_theme_mode',
                        mode: newMode,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Modo de tema guardado: ' + newMode);
                        }
                    }
                });
            });
            
            // Toggle del menú lateral
            $('.button-toggle-menu').on('click', function() {
                $('body').toggleClass('sidebar-enable');
            });
            
            // Tooltip initialization
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Popover initialization
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
            
            // Manejo responsivo
            function checkWindowSize() {
                if ($(window).width() < 992) {
                    $('body').addClass('sidebar-responsive');
                } else {
                    $('body').removeClass('sidebar-responsive');
                }
            }
            
            // Ejecutar en carga
            checkWindowSize();
            
            // Ejecutar en cambio de tamaño
            $(window).resize(function() {
                checkWindowSize();
            });
            
            <?php do_action('ui_panel_saas_footer_js'); ?>
        });
    })(jQuery);
</script>

</body>
</html>
