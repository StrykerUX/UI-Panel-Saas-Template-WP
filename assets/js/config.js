/**
 * UI Panel SAAS Theme - Config JavaScript
 * Configuración inicial del tema.
 * 
 * @package UI_Panel_SAAS
 */

(function() {
    'use strict';
    
    // Obtener la configuración almacenada en localStorage
    var savedConfig = localStorage.getItem('ui_panel_saas_config');
    
    // Configuración por defecto
    var defaultConfig = {
        theme: 'light',
        nav: 'vertical',
        layout: {
            mode: 'fluid'
        },
        topbar: {
            color: 'light'
        },
        menu: {
            color: 'dark'
        },
        sidenav: {
            size: 'default',
            user: false
        }
    };
    
    // Usar configuración por defecto si no hay guardada
    var config = Object.assign(JSON.parse(JSON.stringify(defaultConfig)), {});
    
    // Obtener elemento HTML
    var html = document.getElementsByTagName('html')[0];
    
    // Obtener configuración de atributos HTML
    var themeMode = html.getAttribute('data-bs-theme');
    config.theme = themeMode !== null ? themeMode : defaultConfig.theme;
    
    var layoutMode = html.getAttribute('data-layout-mode');
    config.layout.mode = layoutMode !== null ? layoutMode : defaultConfig.layout.mode;
    
    var topbarColor = html.getAttribute('data-topbar-color');
    config.topbar.color = topbarColor !== null ? topbarColor : defaultConfig.topbar.color;
    
    var sidenavSize = html.getAttribute('data-sidenav-size');
    config.sidenav.size = sidenavSize !== null ? sidenavSize : defaultConfig.sidenav.size;
    
    var menuColor = html.getAttribute('data-menu-color');
    config.menu.color = menuColor !== null ? menuColor : defaultConfig.menu.color;
    
    // Guardar configuración por defecto para usarla con el botón reset
    window.defaultConfig = JSON.parse(JSON.stringify(config));
    
    // Cargar configuración guardada si existe
    if (savedConfig !== null) {
        config = JSON.parse(savedConfig);
    }
    
    // Guardar configuración actual
    window.config = config;
    
    // Aplicar configuración al HTML
    if (config.nav === 'vertical') {
        // Ajustar tamaño de sidebar según ancho de pantalla
        var sidebarSize = config.sidenav.size;
        
        if (window.innerWidth <= 767) {
            sidebarSize = 'full';
        } else if (window.innerWidth > 767 && window.innerWidth <= 1140 && 
                    config.sidenav.size !== 'full' && config.sidenav.size !== 'fullscreen') {
            sidebarSize = 'condensed';
        }
        
        html.setAttribute('data-sidenav-size', sidebarSize);
        
        // Configurar usuario de sidebar
        if (config.sidenav.user && config.sidenav.user.toString() === 'true') {
            html.setAttribute('data-sidenav-user', true);
        } else {
            html.removeAttribute('data-sidenav-user');
        }
    }
    
    // Aplicar tema, colores y modo de layout
    html.setAttribute('data-bs-theme', config.theme);
    html.setAttribute('data-menu-color', config.menu.color);
    html.setAttribute('data-topbar-color', config.topbar.color);
    html.setAttribute('data-layout-mode', config.layout.mode);
})();
