/**
 * JavaScript específico para la plantilla Canvas
 * 
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

(function($) {
    'use strict';

    /**
     * Inicialización de funcionalidades cuando el DOM está listo
     */
    $(document).ready(function() {
        // Inicializar funcionalidades de Canvas
        canvasInit();
    });

    /**
     * Inicialización principal de funcionalidades de Canvas
     */
    function canvasInit() {
        // Hacer responsive los elementos de layout flex
        makeResponsive();
        
        // Aplicar estilos personalizados a elementos de shortcodes
        initShortcodeStyles();
        
        // Inicializar tooltips y popovers si están presentes
        initTooltipsAndPopovers();
        
        // Manejar eventos de ventana redimensionada
        $(window).on('resize', function() {
            makeResponsive();
        });
    }

    /**
     * Aplicar comportamiento responsive a los layouts
     */
    function makeResponsive() {
        const windowWidth = $(window).width();
        
        // Cambiar comportamiento de flex-row en dispositivos móviles
        if (windowWidth <= 768) {
            $('.flex-row:not(.no-stack)').each(function() {
                $(this).addClass('mobile-stack');
            });
        } else {
            $('.flex-row.mobile-stack').removeClass('mobile-stack');
        }
        
        // Ajustar las columnas en pantallas medianas
        if (windowWidth <= 992 && windowWidth > 768) {
            $('[class*="flex-col-"]').each(function() {
                // Solo aplicar a elementos que no tienen clases md-* específicas
                if (!$(this).is('[class*="flex-col-md-"]')) {
                    // Si es columna mayor a 6, aplicar ancho completo
                    if (parseInt($(this).attr('class').match(/flex-col-(\d+)/)[1]) > 6) {
                        $(this).addClass('flex-col-md-12');
                    } else {
                        $(this).addClass('flex-col-md-6');
                    }
                }
            });
        }
    }

    /**
     * Inicializar estilos y comportamientos específicos para shortcodes
     */
    function initShortcodeStyles() {
        // Mejorar apariencia de tarjetas de Canvas
        $('.canvas-card').each(function() {
            // Agregar efecto hover si la tarjeta no lo tiene
            if (!$(this).hasClass('no-hover')) {
                $(this).addClass('card-hover');
            }
            
            // Agregar sombra si está configurada
            if ($(this).data('shadow') === 'true') {
                $(this).addClass('shadow');
            }
            
            // Manejar tarjetas con comportamiento de enlace completo
            if ($(this).hasClass('clickable') && $(this).find('a.card-link').length) {
                $(this).on('click', function(e) {
                    if (!$(e.target).is('a, button, input, select, textarea')) {
                        $(this).find('a.card-link').first()[0].click();
                    }
                });
            }
        });
        
        // Aplicar altura igual a grupos de elementos
        $('.equal-height').each(function() {
            const items = $(this).find('.canvas-card, .canvas-box');
            let maxHeight = 0;
            
            // Encontrar la altura máxima
            items.each(function() {
                if ($(this).outerHeight() > maxHeight) {
                    maxHeight = $(this).outerHeight();
                }
            });
            
            // Aplicar altura máxima a todos los elementos
            items.css('min-height', maxHeight + 'px');
        });
    }

    /**
     * Inicializar tooltips y popovers de Bootstrap si están presentes
     */
    function initTooltipsAndPopovers() {
        // Inicializar tooltips
        if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tooltip !== 'undefined') {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        }
        
        // Inicializar popovers
        if (typeof bootstrap !== 'undefined' && typeof bootstrap.Popover !== 'undefined') {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
        }
    }

    /**
     * Objeto global para funciones públicas relacionadas con Canvas
     */
    window.UICanvas = {
        // Método para forzar el recálculo de alturas iguales
        recalculateHeights: function() {
            $('.equal-height').each(function() {
                const items = $(this).find('.canvas-card, .canvas-box');
                let maxHeight = 0;
                
                // Restablecer alturas
                items.css('min-height', '');
                
                // Encontrar la nueva altura máxima
                items.each(function() {
                    if ($(this).outerHeight() > maxHeight) {
                        maxHeight = $(this).outerHeight();
                    }
                });
                
                // Aplicar nueva altura máxima
                items.css('min-height', maxHeight + 'px');
            });
        },
        
        // Método para actualizar la responsividad
        updateResponsive: function() {
            makeResponsive();
        }
    };

})(jQuery);
