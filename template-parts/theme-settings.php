<?php
/**
 * Plantilla para el panel de configuración del tema
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Start Theme Settings -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="m-0"><?php echo esc_html__('Personalizar tema', 'ui-panel-saas'); ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="<?php echo esc_attr__('Cerrar', 'ui-panel-saas'); ?>"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="p-3">
            <div class="alert alert-warning"><?php echo esc_html__('Personaliza la apariencia de tu panel según tus preferencias.', 'ui-panel-saas'); ?></div>
        </div>

        <!-- Theme Mode -->
        <div class="border-top border-bottom p-3">
            <h5 class="fw-medium mb-3"><?php echo esc_html__('Modo del tema', 'ui-panel-saas'); ?></h5>
            
            <div class="btn-group w-100" role="group" aria-label="<?php echo esc_attr__('Seleccionar modo del tema', 'ui-panel-saas'); ?>">
                <?php 
                $theme_mode = get_theme_mod('ui_panel_saas_theme_mode', 'light');
                ?>
                <input type="radio" class="btn-check" name="theme-mode" id="theme-mode-light" value="light" autocomplete="off" <?php checked($theme_mode, 'light'); ?>>
                <label class="btn btn-outline-primary" for="theme-mode-light">
                    <i class="ri-sun-line me-1"></i> <?php echo esc_html__('Claro', 'ui-panel-saas'); ?>
                </label>
                
                <input type="radio" class="btn-check" name="theme-mode" id="theme-mode-dark" value="dark" autocomplete="off" <?php checked($theme_mode, 'dark'); ?>>
                <label class="btn btn-outline-primary" for="theme-mode-dark">
                    <i class="ri-moon-line me-1"></i> <?php echo esc_html__('Oscuro', 'ui-panel-saas'); ?>
                </label>
            </div>
        </div>

        <!-- Color Scheme -->
        <div class="border-bottom p-3">
            <h5 class="fw-medium mb-3"><?php echo esc_html__('Esquema de color', 'ui-panel-saas'); ?></h5>
            
            <div class="d-flex flex-wrap gap-2">
                <?php
                $primary_color = get_theme_mod('ui_panel_saas_primary_color', '#4F46E5');
                $predefined_colors = array(
                    'default' => '#4F46E5',  // Indigo
                    'blue' => '#3b82f6',     // Blue
                    'green' => '#10b981',    // Green
                    'red' => '#ef4444',      // Red
                    'purple' => '#8b5cf6',   // Purple
                    'orange' => '#f59e0b',   // Orange
                    'pink' => '#ec4899',     // Pink
                    'teal' => '#14b8a6',     // Teal
                );
                
                foreach ($predefined_colors as $color_name => $color_hex) :
                    $is_active = ($primary_color === $color_hex) ? 'border-3' : '';
                ?>
                <div class="color-option <?php echo esc_attr($is_active); ?>" data-color="<?php echo esc_attr($color_hex); ?>" style="background-color: <?php echo esc_attr($color_hex); ?>;" title="<?php echo esc_attr(ucfirst($color_name)); ?>"></div>
                <?php endforeach; ?>
                
                <div class="color-option custom-color" title="<?php echo esc_attr__('Color personalizado', 'ui-panel-saas'); ?>">
                    <i class="ri-add-line"></i>
                    <input type="color" class="custom-color-picker" value="<?php echo esc_attr($primary_color); ?>">
                </div>
            </div>
        </div>

        <!-- Sidebar Options -->
        <div class="border-bottom p-3">
            <h5 class="fw-medium mb-3"><?php echo esc_html__('Barra lateral', 'ui-panel-saas'); ?></h5>
            
            <?php 
            $sidebar_mode = get_theme_mod('ui_panel_saas_sidebar_mode', 'default');
            $sidebar_options = array(
                'default' => array(
                    'label' => esc_html__('Predeterminado', 'ui-panel-saas'),
                    'icon' => 'ri-layout-left-line'
                ),
                'compact' => array(
                    'label' => esc_html__('Compacto', 'ui-panel-saas'),
                    'icon' => 'ri-layout-left-2-line'
                ),
                'condensed' => array(
                    'label' => esc_html__('Condensado', 'ui-panel-saas'),
                    'icon' => 'ri-sidebar-line'
                ),
                'hover' => array(
                    'label' => esc_html__('Al pasar el ratón', 'ui-panel-saas'),
                    'icon' => 'ri-layout-2-line'
                ),
                'icon-view' => array(
                    'label' => esc_html__('Solo iconos', 'ui-panel-saas'),
                    'icon' => 'ri-layout-3-line'
                ),
            );
            ?>
            
            <div class="row g-2">
                <?php foreach ($sidebar_options as $option_value => $option_data) : ?>
                <div class="col-6">
                    <div class="form-check card-radio">
                        <input 
                            id="sidebar-option-<?php echo esc_attr($option_value); ?>" 
                            name="sidebar-mode" 
                            type="radio" 
                            class="form-check-input" 
                            value="<?php echo esc_attr($option_value); ?>"
                            <?php checked($sidebar_mode, $option_value); ?>
                        >
                        <label class="form-check-label p-0 avatar-md w-100" for="sidebar-option-<?php echo esc_attr($option_value); ?>">
                            <span class="d-flex gap-1 h-100">
                                <span class="flex-shrink-0">
                                    <i class="<?php echo esc_attr($option_data['icon']); ?> fs-2"></i>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-block"><?php echo esc_html($option_data['label']); ?></span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Layout Width -->
        <div class="border-bottom p-3">
            <h5 class="fw-medium mb-3"><?php echo esc_html__('Ancho del layout', 'ui-panel-saas'); ?></h5>
            
            <?php 
            $layout_width = get_theme_mod('ui_panel_saas_layout_width', 'fluid');
            ?>
            
            <div class="btn-group w-100" role="group" aria-label="<?php echo esc_attr__('Seleccionar ancho del layout', 'ui-panel-saas'); ?>">
                <input type="radio" class="btn-check" name="layout-width" id="layout-width-fluid" value="fluid" autocomplete="off" <?php checked($layout_width, 'fluid'); ?>>
                <label class="btn btn-outline-primary" for="layout-width-fluid">
                    <i class="ri-layout-width-line me-1"></i> <?php echo esc_html__('Fluido', 'ui-panel-saas'); ?>
                </label>
                
                <input type="radio" class="btn-check" name="layout-width" id="layout-width-boxed" value="boxed" autocomplete="off" <?php checked($layout_width, 'boxed'); ?>>
                <label class="btn btn-outline-primary" for="layout-width-boxed">
                    <i class="ri-layout-width-default-line me-1"></i> <?php echo esc_html__('Contenido', 'ui-panel-saas'); ?>
                </label>
            </div>
        </div>

        <!-- Footer Options -->
        <div class="border-bottom p-3">
            <h5 class="fw-medium mb-3"><?php echo esc_html__('Pie de página', 'ui-panel-saas'); ?></h5>
            
            <?php 
            $footer_type = get_theme_mod('ui_panel_saas_footer_type', 'standard');
            ?>
            
            <div class="row g-2">
                <div class="col-6">
                    <div class="form-check card-radio">
                        <input 
                            id="footer-type-standard" 
                            name="footer-type" 
                            type="radio" 
                            class="form-check-input" 
                            value="standard"
                            <?php checked($footer_type, 'standard'); ?>
                        >
                        <label class="form-check-label p-0 avatar-md w-100" for="footer-type-standard">
                            <span class="d-flex gap-1 h-100">
                                <span class="flex-shrink-0">
                                    <i class="ri-layout-bottom-line fs-2"></i>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-block"><?php echo esc_html__('Estándar', 'ui-panel-saas'); ?></span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check card-radio">
                        <input 
                            id="footer-type-widgets" 
                            name="footer-type" 
                            type="radio" 
                            class="form-check-input" 
                            value="widgets"
                            <?php checked($footer_type, 'widgets'); ?>
                        >
                        <label class="form-check-label p-0 avatar-md w-100" for="footer-type-widgets">
                            <span class="d-flex gap-1 h-100">
                                <span class="flex-shrink-0">
                                    <i class="ri-layout-grid-line fs-2"></i>
                                </span>
                                <span class="flex-grow-1">
                                    <span class="d-block"><?php echo esc_html__('Widgets', 'ui-panel-saas'); ?></span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary" id="reset-theme-settings">
                    <i class="ri-refresh-line me-1"></i> <?php echo esc_html__('Restablecer ajustes', 'ui-panel-saas'); ?>
                </button>
                
                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="btn btn-outline-primary" target="_blank">
                    <i class="ri-settings-3-line me-1"></i> <?php echo esc_html__('Personalizar tema', 'ui-panel-saas'); ?>
                </a>
            </div>
        </div>
    </div>
    
    <div class="offcanvas-footer p-3 text-center">
        <div class="small"><?php echo sprintf(esc_html__('UI Panel SAAS v%s', 'ui-panel-saas'), UI_PANEL_SAAS_VERSION); ?></div>
    </div>
</div>
<!-- End Theme Settings -->

<!-- Button to toggle theme settings panel -->
<div class="position-fixed end-0 bottom-0 p-3" style="z-index: 99">
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas">
        <i class="ri-settings-4-line"></i>
    </button>
</div>

<style>
    /* Theme settings panel styles */
    .color-option {
        width: 30px;
        height: 30px;
        margin: 2px;
        border-radius: 50%;
        border: 1px solid #dee2e6;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .color-option:hover {
        border-width: 2px;
        transform: scale(1.1);
    }
    
    .color-option.border-3 {
        border-color: var(--ui-panel-saas-primary, #4F46E5);
        transform: scale(1.1);
    }
    
    .custom-color {
        background: linear-gradient(135deg, #f5f5f5 0%, #f5f5f5 50%, #e0e0e0 50%, #e0e0e0 100%);
        position: relative;
        overflow: hidden;
    }
    
    .custom-color i {
        font-size: 18px;
        color: #555;
    }
    
    .custom-color-picker {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    .form-check-card-radio .form-check-input {
        display: none;
    }
    
    .form-check-card-radio .form-check-label {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 1rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        position: relative;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .form-check-card-radio .form-check-input:checked + .form-check-label {
        border-color: var(--ui-panel-saas-primary, #4F46E5);
        background-color: rgba(var(--ui-panel-saas-primary-rgb, 79, 70, 229), 0.1);
    }
    
    /* Back to top button */
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background-color: var(--ui-panel-saas-primary, #4F46E5);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 999;
    }
    
    .back-to-top.active {
        opacity: 1;
        visibility: visible;
    }
    
    .back-to-top:hover {
        background-color: var(--ui-panel-saas-primary-hover, #4338CA);
        color: #fff;
    }
</style>

<script>
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            // Color option selection
            $('.color-option:not(.custom-color)').on('click', function() {
                var color = $(this).data('color');
                updateThemeColor(color);
                
                // Update active state
                $('.color-option').removeClass('border-3');
                $(this).addClass('border-3');
            });
            
            // Custom color picker
            $('.custom-color-picker').on('change', function() {
                var color = $(this).val();
                updateThemeColor(color);
                
                // Update active state
                $('.color-option').removeClass('border-3');
                $(this).parent().addClass('border-3');
            });
            
            // Theme mode change
            $('input[name="theme-mode"]').on('change', function() {
                var mode = $(this).val();
                updateThemeMode(mode);
            });
            
            // Sidebar mode change
            $('input[name="sidebar-mode"]').on('change', function() {
                var mode = $(this).val();
                updateSidebarMode(mode);
            });
            
            // Layout width change
            $('input[name="layout-width"]').on('change', function() {
                var width = $(this).val();
                updateLayoutWidth(width);
            });
            
            // Footer type change
            $('input[name="footer-type"]').on('change', function() {
                var type = $(this).val();
                updateFooterType(type);
            });
            
            // Reset theme settings
            $('#reset-theme-settings').on('click', function() {
                resetThemeSettings();
            });
            
            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.back-to-top').addClass('active');
                } else {
                    $('.back-to-top').removeClass('active');
                }
            });
            
            $('.back-to-top').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, 300);
                return false;
            });
            
            // Functions to update theme settings
            function updateThemeColor(color) {
                document.documentElement.style.setProperty('--ui-panel-saas-primary', color);
                
                // Save to database via AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_settings',
                        setting: 'primary_color',
                        value: color,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        console.log('Color updated:', response);
                    }
                });
            }
            
            function updateThemeMode(mode) {
                $('html').attr('data-bs-theme', mode);
                
                // Save to database via AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_settings',
                        setting: 'theme_mode',
                        value: mode,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        console.log('Theme mode updated:', response);
                    }
                });
            }
            
            function updateSidebarMode(mode) {
                $('html').attr('data-sidenav-size', mode);
                
                // Save to database via AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_settings',
                        setting: 'sidebar_mode',
                        value: mode,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        console.log('Sidebar mode updated:', response);
                    }
                });
            }
            
            function updateLayoutWidth(width) {
                if (width === 'boxed') {
                    $('.wrapper').addClass('container-fluid').removeClass('container-xxl');
                } else {
                    $('.wrapper').removeClass('container-fluid').addClass('container-xxl');
                }
                
                // Save to database via AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_settings',
                        setting: 'layout_width',
                        value: width,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        console.log('Layout width updated:', response);
                    }
                });
            }
            
            function updateFooterType(type) {
                // Save to database via AJAX
                $.ajax({
                    url: ui_panel_saas_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_settings',
                        setting: 'footer_type',
                        value: type,
                        nonce: ui_panel_saas_vars.nonce
                    },
                    success: function(response) {
                        console.log('Footer type updated:', response);
                        // Reload page to see changes
                        location.reload();
                    }
                });
            }
            
            function resetThemeSettings() {
                // Reset to default values
                updateThemeMode('light');
                updateThemeColor('#4F46E5');
                updateSidebarMode('default');
                updateLayoutWidth('fluid');
                updateFooterType('standard');
                
                // Update UI
                $('input[name="theme-mode"][value="light"]').prop('checked', true);
                $('input[name="sidebar-mode"][value="default"]').prop('checked', true);
                $('input[name="layout-width"][value="fluid"]').prop('checked', true);
                $('input[name="footer-type"][value="standard"]').prop('checked', true);
                
                $('.color-option').removeClass('border-3');
                $('.color-option[data-color="#4F46E5"]').addClass('border-3');
                
                // Show success message
                alert('<?php echo esc_js(__('Los ajustes del tema se han restablecido correctamente.', 'ui-panel-saas')); ?>');
            }
        });
    })(jQuery);
</script>
