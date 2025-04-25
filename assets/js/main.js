/**
 * UI Panel SAAS Theme - Main JavaScript
 * Funcionalidades JavaScript para el tema.
 * 
 * @package UI_Panel_SAAS
 */

(function($) {
    'use strict';

    // Global UI Panel SAAS Object
    window.UIPanelSAAS = {};
    
    /**
     * Theme configuration
     */
    UIPanelSAAS.config = {
        theme: 'light',           // 'light' or 'dark'
        layout: {
            mode: 'fluid'         // 'fluid' or 'boxed'
        },
        sidenav: {
            size: 'default'       // 'default', 'condensed', 'compact', 'full'
        },
        topbar: {
            color: 'light'        // 'light' or 'dark'
        },
        menu: {
            color: 'dark'         // 'light' or 'dark'
        }
    };

    /**
     * Initialize theme configuration from HTML attributes or localStorage
     */
    UIPanelSAAS.initConfig = function() {
        // Get configuration from localStorage if available
        var savedConfig = localStorage.getItem('ui_panel_saas_config');
        if (savedConfig) {
            UIPanelSAAS.config = JSON.parse(savedConfig);
        } else {
            // Get configuration from HTML attributes
            var html = document.getElementsByTagName('html')[0];
            
            // Theme mode
            var themeMode = html.getAttribute('data-bs-theme');
            if (themeMode) {
                UIPanelSAAS.config.theme = themeMode;
            }
            
            // Layout mode
            var layoutMode = html.getAttribute('data-layout-mode');
            if (layoutMode) {
                UIPanelSAAS.config.layout.mode = layoutMode;
            }
            
            // Sidebar size
            var sidenavSize = html.getAttribute('data-sidenav-size');
            if (sidenavSize) {
                UIPanelSAAS.config.sidenav.size = sidenavSize;
            }
            
            // Topbar color
            var topbarColor = html.getAttribute('data-topbar-color');
            if (topbarColor) {
                UIPanelSAAS.config.topbar.color = topbarColor;
            }
            
            // Menu color
            var menuColor = html.getAttribute('data-menu-color');
            if (menuColor) {
                UIPanelSAAS.config.menu.color = menuColor;
            }
        }
        
        // Apply configuration to HTML
        UIPanelSAAS.applyConfig();
    };
    
    /**
     * Apply configuration to HTML
     */
    UIPanelSAAS.applyConfig = function() {
        var html = document.getElementsByTagName('html')[0];
        
        // Apply theme mode
        html.setAttribute('data-bs-theme', UIPanelSAAS.config.theme);
        
        // Apply layout mode
        html.setAttribute('data-layout-mode', UIPanelSAAS.config.layout.mode);
        
        // Apply sidebar size
        html.setAttribute('data-sidenav-size', UIPanelSAAS.config.sidenav.size);
        
        // Apply topbar color
        html.setAttribute('data-topbar-color', UIPanelSAAS.config.topbar.color);
        
        // Apply menu color
        html.setAttribute('data-menu-color', UIPanelSAAS.config.menu.color);
        
        // Save configuration to localStorage
        localStorage.setItem('ui_panel_saas_config', JSON.stringify(UIPanelSAAS.config));
        
        // Update radio buttons in theme settings
        UIPanelSAAS.updateThemeSettingsForm();
    };
    
    /**
     * Update theme settings form with current configuration
     */
    UIPanelSAAS.updateThemeSettingsForm = function() {
        // Theme mode
        $('input[name="data-bs-theme"][value="' + UIPanelSAAS.config.theme + '"]').prop('checked', true);
        
        // Layout mode
        $('input[name="data-layout-mode"][value="' + UIPanelSAAS.config.layout.mode + '"]').prop('checked', true);
        
        // Sidebar size
        $('input[name="data-sidenav-size"][value="' + UIPanelSAAS.config.sidenav.size + '"]').prop('checked', true);
        
        // Topbar color
        $('input[name="data-topbar-color"][value="' + UIPanelSAAS.config.topbar.color + '"]').prop('checked', true);
        
        // Menu color
        $('input[name="data-menu-color"][value="' + UIPanelSAAS.config.menu.color + '"]').prop('checked', true);
    };
    
    /**
     * Initialize sidebar functionality
     */
    UIPanelSAAS.initSidebar = function() {
        // Toggle sidebar on mobile
        $('.sidenav-toggle-button').on('click', function() {
            $('body').toggleClass('sidebar-enable');
            
            if ($(window).width() >= 992) {
                // If screen is large, toggle between condensed and default
                var currentSize = UIPanelSAAS.config.sidenav.size;
                if (currentSize === 'default') {
                    UIPanelSAAS.config.sidenav.size = 'condensed';
                } else if (currentSize === 'condensed') {
                    UIPanelSAAS.config.sidenav.size = 'default';
                }
                UIPanelSAAS.applyConfig();
            }
        });
        
        // Close sidebar when clicking close button
        $('.button-close-fullsidebar').on('click', function() {
            $('body').removeClass('sidebar-enable');
        });
        
        // Close sidebar when clicking outside on mobile
        $(document).on('click', function(e) {
            if ($(window).width() < 992) {
                if (!$(e.target).closest('.sidenav-menu').length && 
                    !$(e.target).closest('.sidenav-toggle-button').length) {
                    $('body').removeClass('sidebar-enable');
                }
            }
        });
        
        // Expand/collapse menu items
        $('.side-nav-item .menu-arrow').on('click', function(e) {
            e.preventDefault();
            $(this).parent().next('.collapse').collapse('toggle');
            $(this).parent().parent().toggleClass('show');
        });
        
        // Add active class to current menu item
        $('.side-nav-link').each(function() {
            var href = $(this).attr('href');
            if (href === window.location.href || window.location.href.indexOf(href) === 0) {
                $(this).addClass('active');
                
                // If it has parent menu items, expand them
                $(this).parents('.side-nav-item').addClass('show');
                $(this).parents('.collapse').addClass('show');
            }
        });
    };
    
    /**
     * Initialize theme settings form
     */
    UIPanelSAAS.initThemeSettings = function() {
        // Theme mode
        $('input[name="data-bs-theme"]').change(function() {
            UIPanelSAAS.config.theme = $(this).val();
            UIPanelSAAS.applyConfig();
        });
        
        // Layout mode
        $('input[name="data-layout-mode"]').change(function() {
            UIPanelSAAS.config.layout.mode = $(this).val();
            UIPanelSAAS.applyConfig();
        });
        
        // Sidebar size
        $('input[name="data-sidenav-size"]').change(function() {
            UIPanelSAAS.config.sidenav.size = $(this).val();
            UIPanelSAAS.applyConfig();
        });
        
        // Topbar color
        $('input[name="data-topbar-color"]').change(function() {
            UIPanelSAAS.config.topbar.color = $(this).val();
            UIPanelSAAS.applyConfig();
        });
        
        // Menu color
        $('input[name="data-menu-color"]').change(function() {
            UIPanelSAAS.config.menu.color = $(this).val();
            UIPanelSAAS.applyConfig();
        });
        
        // Reset to default
        $('#reset-layout').click(function() {
            // Default configuration
            UIPanelSAAS.config = {
                theme: 'light',
                layout: {
                    mode: 'fluid'
                },
                sidenav: {
                    size: 'default'
                },
                topbar: {
                    color: 'light'
                },
                menu: {
                    color: 'dark'
                }
            };
            
            UIPanelSAAS.applyConfig();
        });
        
        // Light/Dark mode toggle
        $('#light-dark-mode').click(function() {
            if (UIPanelSAAS.config.theme === 'light') {
                UIPanelSAAS.config.theme = 'dark';
            } else {
                UIPanelSAAS.config.theme = 'light';
            }
            
            UIPanelSAAS.applyConfig();
        });
    };
    
    /**
     * Initialize dropdowns and other components
     */
    UIPanelSAAS.initComponents = function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        
        // Prevent dropdown from closing when clicking inside
        $(document).on('click', '.dropdown-menu', function(e) {
            if ($(this).hasClass('dropdown-menu-end') && !$(e.target).is('a')) {
                e.stopPropagation();
            }
        });
        
        // Multi-level dropdown
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
            }
            
            var $subMenu = $(this).next('.dropdown-menu');
            $subMenu.toggleClass('show');
            
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass('show');
            });
            
            return false;
        });
    };
    
    /**
     * Handle responsive layout
     */
    UIPanelSAAS.handleResponsiveLayout = function() {
        $(window).on('resize', function() {
            UIPanelSAAS.adjustLayout();
        });
        
        UIPanelSAAS.adjustLayout();
    };
    
    /**
     * Adjust layout based on screen size
     */
    UIPanelSAAS.adjustLayout = function() {
        var windowWidth = $(window).width();
        
        if (windowWidth < 992) {
            // Small screen, use full sidebar
            $('html').attr('data-sidenav-size', 'full');
        } else {
            // Large screen, restore saved sidebar size
            $('html').attr('data-sidenav-size', UIPanelSAAS.config.sidenav.size);
        }
    };
    
    /**
     * Initialize dashboard charts
     */
    UIPanelSAAS.initCharts = function() {
        // Traffic Sources Chart (Donut chart)
        if ($('#traffic-sources-chart').length) {
            var options = {
                chart: {
                    height: 263,
                    type: 'donut',
                },
                series: [65, 5, 7, 7, 16], // Direct, Social, Marketing, Affiliates, Other
                labels: ['Direct', 'Social', 'Marketing', 'Affiliates', 'Other'],
                colors: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                }
            };
            
            new ApexCharts(document.querySelector("#traffic-sources-chart"), options).render();
        }
        
        // Revenue Chart (Mixed chart)
        if ($('#revenue-chart').length) {
            var options = {
                chart: {
                    height: 263,
                    type: 'line',
                    stacked: false,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    width: [0, 0, 2, 2],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                colors: ['#10B981', '#EF4444', '#4F46E5', '#F59E0B'],
                series: [{
                    name: 'Income',
                    type: 'column',
                    data: [65, 59, 80, 81, 56, 89, 40, 75, 85, 70, 60, 66]
                }, {
                    name: 'Expense',
                    type: 'column',
                    data: [35, 41, 35, 50, 35, 50, 30, 30, 45, 40, 50, 55]
                }, {
                    name: 'Investment',
                    type: 'line',
                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39, 51]
                }, {
                    name: 'Savings',
                    type: 'line',
                    data: [23, 28, 32, 34, 29, 33, 42, 38, 43, 32, 35, 47]
                }],
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
                    type: 'category'
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val + 'k';
                        }
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return "$" + y.toFixed(0) + "k";
                            }
                            return y;
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f3fa',
                    padding: {
                        bottom: 5
                    }
                },
                legend: {
                    show: false
                },
            };
            
            if ($('#revenue-chart').length) {
                new ApexCharts(document.querySelector("#revenue-chart"), options).render();
            }
        }
    };
    
    /**
     * Initialize date pickers
     */
    UIPanelSAAS.initDatepickers = function() {
        if ($('#dash-daterange').length) {
            $('#dash-daterange').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'DD MMM YYYY'
                }
            });
            
            $('#dash-daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));
            });
            
            $('#dash-daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        }
    };
    
    /**
     * Initialize all theme features
     */
    UIPanelSAAS.init = function() {
        UIPanelSAAS.initConfig();
        UIPanelSAAS.initSidebar();
        UIPanelSAAS.initThemeSettings();
        UIPanelSAAS.initComponents();
        UIPanelSAAS.handleResponsiveLayout();
        UIPanelSAAS.initCharts();
        UIPanelSAAS.initDatepickers();
    };
    
    // Initialize when document is ready
    $(document).ready(function() {
        UIPanelSAAS.init();
    });

})(jQuery);
