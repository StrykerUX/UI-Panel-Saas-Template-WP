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
        margin-right: 8px;
        cursor: pointer;
        border: 1px solid #ccc;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        position: relative;
    }
    
    .color-option.border-3 {
        border: 3px solid var(--ui-panel-saas-primary);
    }
    
    .custom-color {
        background: linear-gradient(135deg, #f44336 0%, #2196f3 25%, #4caf50 50%, #ffeb3b 75%, #ff9800 100%);
        overflow: hidden;
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
    
    .card-radio {
        background-color: var(--bs-body-bg);
        border: 2px solid var(--bs-body-bg);
        border-radius: 0.25rem;
        padding: 1rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        position: relative;
    }
    
    .card-radio:hover {
        border-color: var(--ui-panel-saas-primary);
    }
    
    .card-radio .form-check-input {
        display: none;
    }
    
    .card-radio .form-check-label {
        cursor: pointer;
    }
    
    .card-radio-label {
        display: block;
        width: 100%;
        text-align: center;
        font-weight: 500;
    }
    
    .card-radio .form-check-input:checked + .form-check-label {
        color: var(--ui-panel-saas-primary);
    }
    
    .card-radio .form-check-input:checked + .form-check-label:before {
        content: '';
        position: absolute;
        top: 2px;
        right: 2px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: var(--ui-panel-saas-primary);
    }
    
    .avatar-md {
        height: 4.5rem;
        width: 4.5rem;
    }
</style>

<script>
    // This script will run after the page loads to handle theme settings
    document.addEventListener('DOMContentLoaded', function() {
        // Theme mode toggle
        const themeRadios = document.querySelectorAll('input[name="theme-mode"]');
        themeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const mode = this.value;
                document.documentElement.setAttribute('data-bs-theme', mode);
                
                // Save the setting via AJAX
                saveThemeSetting('ui_panel_saas_theme_mode', mode);
            });
        });
        
        // Color options
        const colorOptions = document.querySelectorAll('.color-option:not(.custom-color)');
        colorOptions.forEach(option => {
            option.addEventListener('click', function() {
                const color = this.getAttribute('data-color');
                updatePrimaryColor(color);
                
                // Update active state
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('border-3'));
                this.classList.add('border-3');
                
                // Save the setting via AJAX
                saveThemeSetting('ui_panel_saas_primary_color', color);
            });
        });
        
        // Custom color picker
        const customColorPicker = document.querySelector('.custom-color-picker');
        if (customColorPicker) {
            customColorPicker.addEventListener('change', function() {
                const color = this.value;
                updatePrimaryColor(color);
                
                // Update active state
                document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('border-3'));
                this.closest('.color-option').classList.add('border-3');
                
                // Save the setting via AJAX
                saveThemeSetting('ui_panel_saas_primary_color', color);
            });
        }
        
        // Sidebar mode options
        const sidebarRadios = document.querySelectorAll('input[name="sidebar-mode"]');
        sidebarRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const mode = this.value;
                document.documentElement.setAttribute('data-sidenav-size', mode);
                
                // Save the setting via AJAX
                saveThemeSetting('ui_panel_saas_sidebar_mode', mode);
            });
        });
        
        // Layout width options
        const layoutWidthRadios = document.querySelectorAll('input[name="layout-width"]');
        layoutWidthRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const width = this.value;
                const containerClass = width === 'boxed' ? 'container' : 'container-fluid';
                
                // Update containers
                document.querySelectorAll('.container-fluid').forEach(container => {
                    container.className = containerClass;
                });
                
                // Save the setting via AJAX
                saveThemeSetting('ui_panel_saas_layout_width', width);
            });
        });
        
        // Footer type options
        const footerTypeRadios = document.querySelectorAll('input[name="footer-type"]');
        footerTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Save the setting via AJAX, page will need reload to show changes
                saveThemeSetting('ui_panel_saas_footer_type', this.value);
            });
        });
        
        // Reset theme settings
        const resetButton = document.getElementById('reset-theme-settings');
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                if (confirm('<?php echo esc_js(__('¿Estás seguro de que quieres restablecer todos los ajustes del tema?', 'ui-panel-saas')); ?>')) {
                    // Reset to defaults
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                    document.documentElement.setAttribute('data-sidenav-size', 'default');
                    updatePrimaryColor('#4F46E5');
                    
                    // Reset all inputs
                    document.getElementById('theme-mode-light').checked = true;
                    document.getElementById('sidebar-option-default').checked = true;
                    document.getElementById('layout-width-fluid').checked = true;
                    document.getElementById('footer-type-standard').checked = true;
                    
                    document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('border-3'));
                    document.querySelector('.color-option[data-color="#4F46E5"]').classList.add('border-3');
                    
                    // Save all settings via AJAX
                    saveThemeSetting('ui_panel_saas_theme_mode', 'light');
                    saveThemeSetting('ui_panel_saas_sidebar_mode', 'default');
                    saveThemeSetting('ui_panel_saas_layout_width', 'fluid');
                    saveThemeSetting('ui_panel_saas_primary_color', '#4F46E5');
                    saveThemeSetting('ui_panel_saas_footer_type', 'standard');
                    
                    // Show success message
                    alert('<?php echo esc_js(__('Los ajustes del tema se han restablecido correctamente.', 'ui-panel-saas')); ?>');
                }
            });
        }
        
        // Function to update primary color CSS variables
        function updatePrimaryColor(color) {
            document.documentElement.style.setProperty('--ui-panel-saas-primary', color);
        }
        
        // Function to save theme settings via AJAX
        function saveThemeSetting(setting, value) {
            const data = new FormData();
            data.append('action', 'ui_panel_saas_save_theme_setting');
            data.append('setting', setting);
            data.append('value', value);
            data.append('nonce', '<?php echo wp_create_nonce('ui-panel-saas-theme-settings'); ?>');
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                credentials: 'same-origin',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Setting saved successfully:', setting);
                } else {
                    console.error('Error saving setting:', data.data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>
