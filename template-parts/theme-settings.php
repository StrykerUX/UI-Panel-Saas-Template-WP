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
        border-radius: 50%;
        margin-right: 5px;
        cursor: pointer;
        border: 1px solid #dee2e6;
        position: relative;
        transition: all 0.2s;
    }
    
    .color-option.border-3 {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);
    }
    
    .custom-color {
        background: linear-gradient(135deg, #f44336 0%, #2196f3 50%, #4caf50 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        position: relative;
    }
    
    .custom-color-picker {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Theme mode button styles */
    .btn-check:checked + .btn-outline-primary {
        color: #fff;
        background-color: var(--ui-panel-saas-primary);
        border-color: var(--ui-panel-saas-primary);
    }
    
    .card-radio {
        cursor: pointer;
    }
    
    .card-radio .form-check-input {
        display: none;
    }
    
    .card-radio .form-check-label {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.75rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        position: relative;
        padding-right: 32px;
        padding-left: 42px;
        min-height: 56px;
        display: flex;
        align-items: center;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .card-radio .form-check-input:checked + .form-check-label {
        border-color: var(--ui-panel-saas-primary);
        background-color: rgba(var(--ui-panel-saas-primary-rgb), 0.1);
    }
    
    .card-radio .form-check-input:checked + .form-check-label:before {
        content: '\eb80';
        font-family: 'remixicon';
        position: absolute;
        top: 2px;
        right: 4px;
        font-size: 16px;
        color: var(--ui-panel-saas-primary);
    }
    
    [data-bs-theme="dark"] .card-radio .form-check-label {
        border-color: #495057;
        color: #ced4da;
    }
    
    [data-bs-theme="dark"] .card-radio .form-check-input:checked + .form-check-label {
        background-color: rgba(var(--ui-panel-saas-primary-rgb), 0.3);
    }
</style>

<script type="text/javascript">
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            /**
             * Theme Settings Script
             */
            
            // Theme Mode Switcher
            $('input[name="theme-mode"]').on('change', function() {
                var mode = $(this).val();
                $('html').attr('data-bs-theme', mode);
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_theme_mode', mode);
            });
            
            // Color Scheme Selector
            $('.color-option:not(.custom-color)').on('click', function() {
                var color = $(this).data('color');
                updateColorScheme(color);
                
                // Update active state
                $('.color-option').removeClass('border-3');
                $(this).addClass('border-3');
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_primary_color', color);
            });
            
            // Custom Color Picker
            $('.custom-color-picker').on('change', function() {
                var color = $(this).val();
                updateColorScheme(color);
                
                // Update active state
                $('.color-option').removeClass('border-3');
                $(this).parent().addClass('border-3');
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_primary_color', color);
            });
            
            // Sidebar Mode
            $('input[name="sidebar-mode"]').on('change', function() {
                var mode = $(this).val();
                $('html').attr('data-sidenav-size', mode);
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_sidebar_mode', mode);
            });
            
            // Layout Width
            $('input[name="layout-width"]').on('change', function() {
                var width = $(this).val();
                
                if (width === 'boxed') {
                    $('.wrapper').addClass('container-fluid').removeClass('w-100');
                } else {
                    $('.wrapper').removeClass('container-fluid').addClass('w-100');
                }
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_layout_width', width);
            });
            
            // Footer Type
            $('input[name="footer-type"]').on('change', function() {
                var type = $(this).val();
                
                // Save to server via AJAX
                saveThemeSetting('ui_panel_saas_footer_type', type);
                
                // We'll need to reload the page for this to take effect
                setTimeout(function() {
                    window.location.reload();
                }, 300);
            });
            
            // Reset Settings
            $('#reset-theme-settings').on('click', function() {
                // Reset to defaults
                $('input[name="theme-mode"][value="light"]').prop('checked', true).trigger('change');
                updateColorScheme('#4F46E5');
                $('input[name="sidebar-mode"][value="default"]').prop('checked', true).trigger('change');
                $('input[name="layout-width"][value="fluid"]').prop('checked', true).trigger('change');
                $('input[name="footer-type"][value="standard"]').prop('checked', true).trigger('change');
                
                $('.color-option').removeClass('border-3');
                $('.color-option[data-color="#4F46E5"]').addClass('border-3');
                
                // Show message
                alert('<?php echo esc_js(__('Configuración restablecida correctamente', 'ui-panel-saas')); ?>');
            });
            
            /**
             * Helper Functions
             */
            
            // Update color scheme
            function updateColorScheme(color) {
                document.documentElement.style.setProperty('--ui-panel-saas-primary', color);
                
                // Calculate RGB values for CSS variables
                var r = parseInt(color.slice(1, 3), 16);
                var g = parseInt(color.slice(3, 5), 16);
                var b = parseInt(color.slice(5, 7), 16);
                
                document.documentElement.style.setProperty('--ui-panel-saas-primary-rgb', r + ',' + g + ',' + b);
            }
            
            // Save setting via AJAX
            function saveThemeSetting(setting, value) {
                $.ajax({
                    url: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
                    type: 'POST',
                    data: {
                        action: 'ui_panel_saas_save_setting',
                        setting: setting,
                        value: value,
                        nonce: '<?php echo esc_js(wp_create_nonce('ui_panel_saas_settings_nonce')); ?>'
                    },
                    success: function(response) {
                        console.log('Setting saved:', setting, value);
                    }
                });
            }
        });
    })(jQuery);
</script>
