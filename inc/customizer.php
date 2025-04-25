<?php
/**
 * Funciones para el Customizer de WordPress
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir configuraciones al Customizer de WordPress
 *
 * @param WP_Customize_Manager $wp_customize Objeto de personalización de WordPress
 */
function ui_panel_saas_customize_register($wp_customize) {
    
    /*
     * Panel principal del tema
     */
    $wp_customize->add_panel('ui_panel_saas_theme_panel', array(
        'title'       => esc_html__('Opciones de UI Panel SAAS', 'ui-panel-saas'),
        'description' => esc_html__('Personaliza la apariencia y funcionalidad de tu tema SAAS.', 'ui-panel-saas'),
        'priority'    => 130,
    ));
    
    /*
     * Sección: Configuración general
     */
    $wp_customize->add_section('ui_panel_saas_general_section', array(
        'title'       => esc_html__('Configuración General', 'ui-panel-saas'),
        'description' => esc_html__('Configuración básica del tema.', 'ui-panel-saas'),
        'panel'       => 'ui_panel_saas_theme_panel',
        'priority'    => 10,
    ));
    
    // Logotipo pequeño (para barra lateral colapsada)
    $wp_customize->add_setting('ui_panel_saas_logo_small', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'ui_panel_saas_logo_small', array(
        'label'         => esc_html__('Logotipo pequeño', 'ui-panel-saas'),
        'description'   => esc_html__('Usado en la barra lateral cuando está colapsada. Recomendado: 28x28px.', 'ui-panel-saas'),
        'section'       => 'ui_panel_saas_general_section',
        'settings'      => 'ui_panel_saas_logo_small',
        'mime_type'     => 'image',
        'priority'      => 20,
    )));
    
    // Favicon del sitio
    $wp_customize->add_setting('ui_panel_saas_favicon', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'ui_panel_saas_favicon', array(
        'label'         => esc_html__('Favicon', 'ui-panel-saas'),
        'description'   => esc_html__('Ícono que aparece en la pestaña del navegador. Recomendado: 32x32px.', 'ui-panel-saas'),
        'section'       => 'ui_panel_saas_general_section',
        'settings'      => 'ui_panel_saas_favicon',
        'mime_type'     => 'image',
        'priority'      => 30,
    )));
    
    /*
     * Sección: Colores y Tema
     */
    $wp_customize->add_section('ui_panel_saas_colors_section', array(
        'title'       => esc_html__('Colores y Tema', 'ui-panel-saas'),
        'description' => esc_html__('Personaliza los colores y el aspecto visual del tema.', 'ui-panel-saas'),
        'panel'       => 'ui_panel_saas_theme_panel',
        'priority'    => 20,
    ));
    
    // Modo del tema (claro/oscuro)
    $wp_customize->add_setting('ui_panel_saas_theme_mode', array(
        'default'           => 'light',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_theme_mode', array(
        'label'       => esc_html__('Modo del tema', 'ui-panel-saas'),
        'description' => esc_html__('Selecciona el modo de visualización predeterminado.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'type'        => 'select',
        'choices'     => array(
            'light' => esc_html__('Modo claro', 'ui-panel-saas'),
            'dark'  => esc_html__('Modo oscuro', 'ui-panel-saas'),
        ),
        'priority'    => 10,
    ));
    
    // Color primario
    $wp_customize->add_setting('ui_panel_saas_primary_color', array(
        'default'           => '#4F46E5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_panel_saas_primary_color', array(
        'label'       => esc_html__('Color primario', 'ui-panel-saas'),
        'description' => esc_html__('Color principal usado en botones y elementos destacados.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'priority'    => 20,
    )));
    
    // Color secundario
    $wp_customize->add_setting('ui_panel_saas_secondary_color', array(
        'default'           => '#8B5CF6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_panel_saas_secondary_color', array(
        'label'       => esc_html__('Color secundario', 'ui-panel-saas'),
        'description' => esc_html__('Color complementario usado en elementos secundarios.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'priority'    => 30,
    )));
    
    // Color de éxito
    $wp_customize->add_setting('ui_panel_saas_success_color', array(
        'default'           => '#10B981',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_panel_saas_success_color', array(
        'label'       => esc_html__('Color de éxito', 'ui-panel-saas'),
        'description' => esc_html__('Color usado para indicar operaciones correctas o exitosas.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'priority'    => 40,
    )));
    
    // Color de peligro
    $wp_customize->add_setting('ui_panel_saas_danger_color', array(
        'default'           => '#EF4444',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_panel_saas_danger_color', array(
        'label'       => esc_html__('Color de peligro', 'ui-panel-saas'),
        'description' => esc_html__('Color usado para indicar errores o acciones peligrosas.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_colors_section',
        'priority'    => 50,
    )));
    
    /*
     * Sección: Configuración de Layout
     */
    $wp_customize->add_section('ui_panel_saas_layout_section', array(
        'title'       => esc_html__('Configuración de Layout', 'ui-panel-saas'),
        'description' => esc_html__('Personaliza el diseño y estructura del tema.', 'ui-panel-saas'),
        'panel'       => 'ui_panel_saas_theme_panel',
        'priority'    => 30,
    ));
    
    // Modo de barra lateral
    $wp_customize->add_setting('ui_panel_saas_sidebar_mode', array(
        'default'           => 'default',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_sidebar_mode', array(
        'label'       => esc_html__('Modo de barra lateral', 'ui-panel-saas'),
        'description' => esc_html__('Selecciona el estilo y comportamiento de la barra lateral.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_layout_section',
        'type'        => 'select',
        'choices'     => array(
            'default'    => esc_html__('Predeterminado', 'ui-panel-saas'),
            'compact'    => esc_html__('Compacto', 'ui-panel-saas'),
            'condensed'  => esc_html__('Condensado', 'ui-panel-saas'),
            'hover'      => esc_html__('Expandir al pasar el ratón', 'ui-panel-saas'),
            'icon-view'  => esc_html__('Solo iconos', 'ui-panel-saas'),
        ),
        'priority'    => 10,
    ));
    
    // Mostrar botón flotante de volver arriba
    $wp_customize->add_setting('ui_panel_saas_show_back_to_top', array(
        'default'           => true,
        'sanitize_callback' => 'ui_panel_saas_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_show_back_to_top', array(
        'label'       => esc_html__('Mostrar botón "Volver arriba"', 'ui-panel-saas'),
        'description' => esc_html__('Muestra un botón flotante para volver al principio de la página.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_layout_section',
        'type'        => 'checkbox',
        'priority'    => 20,
    ));
    
    // Mostrar personalizador de tema
    $wp_customize->add_setting('ui_panel_saas_show_theme_customizer', array(
        'default'           => true,
        'sanitize_callback' => 'ui_panel_saas_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_show_theme_customizer', array(
        'label'       => esc_html__('Mostrar personalizador de tema', 'ui-panel-saas'),
        'description' => esc_html__('Muestra un panel lateral para personalizar el tema en tiempo real.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_layout_section',
        'type'        => 'checkbox',
        'priority'    => 30,
    ));
    
    /*
     * Sección: Configuración de pie de página
     */
    $wp_customize->add_section('ui_panel_saas_footer_section', array(
        'title'       => esc_html__('Configuración de Pie de Página', 'ui-panel-saas'),
        'description' => esc_html__('Personaliza el pie de página de tu sitio.', 'ui-panel-saas'),
        'panel'       => 'ui_panel_saas_theme_panel',
        'priority'    => 40,
    ));
    
    // Tipo de pie de página
    $wp_customize->add_setting('ui_panel_saas_footer_type', array(
        'default'           => 'standard',
        'sanitize_callback' => 'ui_panel_saas_sanitize_select',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_footer_type', array(
        'label'       => esc_html__('Tipo de pie de página', 'ui-panel-saas'),
        'description' => esc_html__('Selecciona el estilo del pie de página.', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_footer_section',
        'type'        => 'select',
        'choices'     => array(
            'standard' => esc_html__('Estándar', 'ui-panel-saas'),
            'widgets'  => esc_html__('Widgets', 'ui-panel-saas'),
        ),
        'priority'    => 10,
    ));
    
    // Texto de copyright
    $wp_customize->add_setting('ui_panel_saas_footer_copyright', array(
        'default'           => sprintf(
            esc_html__('%1$s &copy; %2$s %3$s. Todos los derechos reservados.', 'ui-panel-saas'),
            date('Y'),
            get_bloginfo('name'),
            UI_PANEL_SAAS_VERSION
        ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_footer_copyright', array(
        'label'       => esc_html__('Texto de copyright', 'ui-panel-saas'),
        'description' => esc_html__('Texto que aparecerá en el pie de página (permite HTML).', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_footer_section',
        'type'        => 'textarea',
        'priority'    => 20,
    ));
    
    // Texto de créditos
    $wp_customize->add_setting('ui_panel_saas_footer_credits', array(
        'default'           => sprintf(
            esc_html__('Desarrollado con %1$s por %2$s', 'ui-panel-saas'),
            '<i class="ri-heart-fill text-danger"></i>',
            '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>'
        ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('ui_panel_saas_footer_credits', array(
        'label'       => esc_html__('Texto de créditos', 'ui-panel-saas'),
        'description' => esc_html__('Texto de créditos que aparecerá en el pie de página (permite HTML).', 'ui-panel-saas'),
        'section'     => 'ui_panel_saas_footer_section',
        'type'        => 'textarea',
        'priority'    => 30,
    ));
}
add_action('customize_register', 'ui_panel_saas_customize_register');

/**
 * Sanitizar un valor de selección
 *
 * @param string $input Valor a sanitizar
 * @param WP_Customize_Setting $setting Objeto de configuración
 * @return string Valor sanitizado
 */
function ui_panel_saas_sanitize_select($input, $setting) {
    // Obtener las opciones válidas
    $choices = $setting->manager->get_control($setting->id)->choices;
    
    // Devolver el valor si existe en las opciones, o el valor predeterminado
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Sanitizar un valor de casilla de verificación
 *
 * @param bool $checked Si está marcado o no
 * @return bool Valor sanitizado
 */
function ui_panel_saas_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Generar CSS personalizado basado en las opciones del tema
 */
function ui_panel_saas_customizer_css() {
    // Obtener colores personalizados
    $primary_color   = get_theme_mod('ui_panel_saas_primary_color', '#4F46E5');
    $secondary_color = get_theme_mod('ui_panel_saas_secondary_color', '#8B5CF6');
    $success_color   = get_theme_mod('ui_panel_saas_success_color', '#10B981');
    $danger_color    = get_theme_mod('ui_panel_saas_danger_color', '#EF4444');
    
    // Generar CSS personalizado
    $custom_css = "
        :root {
            --ui-panel-saas-primary: {$primary_color};
            --ui-panel-saas-secondary: {$secondary_color};
            --ui-panel-saas-success: {$success_color};
            --ui-panel-saas-danger: {$danger_color};
        }
        
        /* Estilos primarios */
        .btn-primary, 
        .bg-primary,
        .badge-primary,
        .progress-bar {
            background-color: var(--ui-panel-saas-primary) !important;
            border-color: var(--ui-panel-saas-primary) !important;
        }
        
        .text-primary,
        .side-nav > li.active > a {
            color: var(--ui-panel-saas-primary) !important;
        }
        
        /* Estilos secundarios */
        .btn-secondary, 
        .bg-secondary,
        .badge-secondary {
            background-color: var(--ui-panel-saas-secondary) !important;
            border-color: var(--ui-panel-saas-secondary) !important;
        }
        
        .text-secondary {
            color: var(--ui-panel-saas-secondary) !important;
        }
        
        /* Estilos de éxito */
        .btn-success, 
        .bg-success,
        .badge-success {
            background-color: var(--ui-panel-saas-success) !important;
            border-color: var(--ui-panel-saas-success) !important;
        }
        
        .text-success {
            color: var(--ui-panel-saas-success) !important;
        }
        
        /* Estilos de peligro */
        .btn-danger, 
        .bg-danger,
        .badge-danger {
            background-color: var(--ui-panel-saas-danger) !important;
            border-color: var(--ui-panel-saas-danger) !important;
        }
        
        .text-danger {
            color: var(--ui-panel-saas-danger) !important;
        }
    ";
    
    // Añadir CSS personalizado
    wp_add_inline_style('ui-panel-saas-main', $custom_css);
}
add_action('wp_enqueue_scripts', 'ui_panel_saas_customizer_css', 20);

/**
 * Aplicar las opciones del tema en la carga de la página
 */
function ui_panel_saas_customizer_js() {
    // Verificar si mostrar el botón de volver arriba
    $show_back_to_top = get_theme_mod('ui_panel_saas_show_back_to_top', true);
    
    // JavaScript personalizado
    $custom_js = "
        // Configuración personalizada del tema
        var uiPanelSaasConfig = {
            showBackToTop: " . ($show_back_to_top ? 'true' : 'false') . "
        };
    ";
    
    // Añadir JavaScript personalizado
    wp_add_inline_script('ui-panel-saas-main', $custom_js, 'before');
}
add_action('wp_enqueue_scripts', 'ui_panel_saas_customizer_js', 20);
