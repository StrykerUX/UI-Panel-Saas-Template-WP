<?php
/**
 * UI Panel SAAS Theme Customizer
 *
 * @package UI_Panel_SAAS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ui_panel_saas_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    // Verificar si hay soporte para custom background
    if (isset($wp_customize->get_setting('background_color'))) {
        $wp_customize->get_setting('background_color')->transport = 'postMessage';
    }

    /**
     * Sección para los ajustes del sidebar
     */
    $wp_customize->add_section('ui_panel_saas_sidebar_section', array(
        'title'      => esc_html__('Sidebar', 'ui-panel-saas'),
        'priority'   => 120,
    ));

    // Modo del sidebar (default, condensed, hidden)
    $wp_customize->add_setting('ui_panel_saas_sidebar_mode', array(
        'default'           => 'default',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('ui_panel_saas_sidebar_mode', array(
        'label'    => esc_html__('Modo del sidebar', 'ui-panel-saas'),
        'section'  => 'ui_panel_saas_sidebar_section',
        'type'     => 'select',
        'choices'  => array(
            'default' => esc_html__('Por defecto', 'ui-panel-saas'),
            'condensed' => esc_html__('Condensado', 'ui-panel-saas'),
            'hidden' => esc_html__('Oculto', 'ui-panel-saas'),
        ),
    ));

    /**
     * Sección para los ajustes del layout
     */
    $wp_customize->add_section('ui_panel_saas_layout_section', array(
        'title'      => esc_html__('Layout', 'ui-panel-saas'),
        'priority'   => 130,
    ));

    // Modo del layout (fluid, boxed)
    $wp_customize->add_setting('ui_panel_saas_layout_mode', array(
        'default'           => 'fluid',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('ui_panel_saas_layout_mode', array(
        'label'    => esc_html__('Modo del layout', 'ui-panel-saas'),
        'section'  => 'ui_panel_saas_layout_section',
        'type'     => 'select',
        'choices'  => array(
            'fluid' => esc_html__('Fluido', 'ui-panel-saas'),
            'boxed' => esc_html__('Boxed', 'ui-panel-saas'),
        ),
    ));

    /**
     * Sección para los ajustes de color
     */
    $wp_customize->add_section('ui_panel_saas_colors_section', array(
        'title'      => esc_html__('Colores', 'ui-panel-saas'),
        'priority'   => 140,
    ));

    // Modo del tema (light, dark)
    $wp_customize->add_setting('ui_panel_saas_theme_mode', array(
        'default'           => 'light',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('ui_panel_saas_theme_mode', array(
        'label'    => esc_html__('Modo del tema', 'ui-panel-saas'),
        'section'  => 'ui_panel_saas_colors_section',
        'type'     => 'select',
        'choices'  => array(
            'light' => esc_html__('Claro', 'ui-panel-saas'),
            'dark' => esc_html__('Oscuro', 'ui-panel-saas'),
        ),
    ));

    // Color del topbar (light, dark)
    $wp_customize->add_setting('ui_panel_saas_topbar_color', array(
        'default'           => 'light',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('ui_panel_saas_topbar_color', array(
        'label'    => esc_html__('Color de la barra superior', 'ui-panel-saas'),
        'section'  => 'ui_panel_saas_colors_section',
        'type'     => 'select',
        'choices'  => array(
            'light' => esc_html__('Claro', 'ui-panel-saas'),
            'dark' => esc_html__('Oscuro', 'ui-panel-saas'),
        ),
    ));

    // Color del menú (light, dark)
    $wp_customize->add_setting('ui_panel_saas_menu_color', array(
        'default'           => 'dark',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('ui_panel_saas_menu_color', array(
        'label'    => esc_html__('Color del menú lateral', 'ui-panel-saas'),
        'section'  => 'ui_panel_saas_colors_section',
        'type'     => 'select',
        'choices'  => array(
            'light' => esc_html__('Claro', 'ui-panel-saas'),
            'dark' => esc_html__('Oscuro', 'ui-panel-saas'),
        ),
    ));

    // Notificación para personalización avanzada
    $wp_customize->add_setting('ui_panel_saas_vortex_notification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new UI_Panel_SAAS_Customizer_Notification_Control($wp_customize, 'ui_panel_saas_vortex_notification', array(
        'label'       => esc_html__('Personalización avanzada', 'ui-panel-saas'),
        'description' => esc_html__('Para una personalización más avanzada de colores, tipografía y componentes, utilice el plugin Vortex UI Panel en el menú de administración.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'priority'    => 1,
    )));

    /**
     * Notificaciones para las opciones adicionales disponibles a través del plugin Vortex UI Panel
     */
    if (!class_exists('UI_Panel_SAAS_Customizer_Notification_Control')) {
        /**
         * Clase para crear un control personalizado para mostrar notificaciones
         */
        class UI_Panel_SAAS_Customizer_Notification_Control extends WP_Customize_Control {
            public $type = 'ui_panel_saas_notification';
            
            public function render_content() {
                ?>
                <div class="ui-panel-saas-customizer-notification">
                    <?php if (!empty($this->label)) : ?>
                        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <?php endif; ?>
                    
                    <?php if (!empty($this->description)) : ?>
                        <div class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                            
                            <?php if (class_exists('Vortex_UI_Panel')) : ?>
                                <p><a href="<?php echo esc_url(admin_url('admin.php?page=vortex-ui-panel-theme-styles')); ?>" class="button button-primary" target="_blank"><?php echo esc_html__('Abrir Personalizador Avanzado', 'ui-panel-saas'); ?></a></p>
                            <?php else : ?>
                                <p><?php echo esc_html__('El plugin Vortex UI Panel no está instalado o activado.', 'ui-panel-saas'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
            }
        }
    }
}
add_action('customize_register', 'ui_panel_saas_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ui_panel_saas_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ui_panel_saas_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ui_panel_saas_customize_preview_js() {
    wp_enqueue_script('ui-panel-saas-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), UI_PANEL_SAAS_VERSION, true);
}
add_action('customize_preview_init', 'ui_panel_saas_customize_preview_js');

/**
 * Sanitize select option
 */
function ui_panel_saas_sanitize_select($input, $setting) {
    // Ensure input is a slug
    $input = sanitize_key($input);
    
    // Get list of choices from the control associated with the setting
    $choices = $setting->manager->get_control($setting->id)->choices;
    
    // If the input is a valid key, return it; otherwise, return the default
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Integración con el plugin Vortex UI Panel para estilos personalizados
 * 
 * Esta función carga los estilos personalizados del tema desde el plugin Vortex UI Panel
 */
function ui_panel_saas_load_vortex_custom_styles() {
    // Comprobar si el plugin Vortex UI Panel está activo
    if (class_exists('Vortex_UI_Panel')) {
        // Obtener la instancia del personalizador de estilos
        $vortex_theme_customizer = Vortex_UI_Panel::get_instance()->get_theme_customizer();
        
        if ($vortex_theme_customizer) {
            // Generar CSS personalizado
            $custom_css = $vortex_theme_customizer->generate_custom_css();
            
            // Inyectar el CSS en el frontend
            if (!empty($custom_css)) {
                wp_add_inline_style('ui-panel-saas-main', $custom_css);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'ui_panel_saas_load_vortex_custom_styles', 999);
