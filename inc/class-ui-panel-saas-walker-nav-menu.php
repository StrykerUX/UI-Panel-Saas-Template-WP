<?php
/**
 * Clase personalizada para el menú de navegación
 *
 * Esta clase extiende Walker_Nav_Menu para crear menús con la estructura 
 * requerida por el tema UI Panel SAAS
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clase UI_Panel_SAAS_Walker_Nav_Menu
 * 
 * Personaliza la salida del menú de navegación para que coincida con la estructura
 * del template SAAS
 */
class UI_Panel_SAAS_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Inicia el elemento del menú
     *
     * @param string $output Usado para anexar contenido adicional.
     * @param object $item   El ítem del menú actual.
     * @param int    $depth  Profundidad del ítem del menú. Usado para padding.
     * @param array  $args   Un array de argumentos. @see wp_nav_menu()
     * @param int    $id     ID actual del ítem del menú.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = ($depth) ? str_repeat($t, $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Si estamos en el menú sidebar, usar clases específicas
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            if ($depth === 0) {
                $classes[] = 'side-nav-item';
            } else {
                // Clases para elementos del submenu
                $classes[] = 'nav-item';
            }
        } elseif (isset($args->theme_location) && $args->theme_location === 'topbar-right') {
            $classes[] = 'nav-item';
        } else {
            $classes[] = 'nav-item';
        }
        
        // Detectar si este elemento tiene un submenú
        $has_children = in_array('menu-item-has-children', $classes);
        
        /**
         * Filtrar la lista de clases CSS para el ítem del menú actual.
         *
         * @param array    $classes El array de clases CSS.
         * @param WP_Post  $item    El elemento del menú actual.
         * @param stdClass $args    Un objeto de argumentos wp_nav_menu().
         * @param int      $depth   Profundidad del ítem del menú. 0 es el nivel superior.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        /**
         * Filtrar el ID aplicado al elemento LI actual.
         *
         * @param string   $menu_id El ID que se aplica al ítem del menú.
         * @param WP_Post  $item    El elemento del menú actual.
         * @param stdClass $args    Un objeto de argumentos wp_nav_menu().
         * @param int      $depth   Profundidad del ítem del menú. 0 es el nivel superior.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        // Construir el elemento del menú
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            // Para el menú lateral
            if ($depth === 0) {
                $output .= $indent . '<li' . $id . $class_names . '>';
            } else {
                // No iniciamos otro LI para submenús, por la estructura específica del tema
            }
        } else {
            // Para otros menús
            $output .= $indent . '<li' . $id . $class_names . '>';
        }
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Para el menú lateral, usar clases específicas del tema
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            if ($depth === 0) {
                $atts['class'] = 'side-nav-link';
                
                if ($has_children) {
                    $atts['href'] = 'javascript:void(0);';
                }
            } else {
                $atts['class'] = '';
            }
        } elseif (isset($args->theme_location) && $args->theme_location === 'topbar-right') {
            $atts['class'] = 'nav-link dropdown-toggle arrow-none';
            
            if ($has_children) {
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['role'] = 'button';
                $atts['aria-haspopup'] = 'false';
                $atts['aria-expanded'] = 'false';
            }
        } else {
            $atts['class'] = 'nav-link';
            
            if ($has_children) {
                $atts['class'] .= ' dropdown-toggle';
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['aria-expanded'] = 'false';
            }
        }
        
        // Añadir clase active si el ítem está activo
        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes)) {
            $atts['class'] .= ' active';
        }
        
        /**
         * Filtrar el array de atributos HTML aplicados al enlace del ítem del menú.
         *
         * @param array    $atts   {
         *     Los atributos HTML aplicados al ítem del menú, vacíos por defecto.
         *
         *     @type string $title  Atributo title.
         *     @type string $target Atributo target.
         *     @type string $rel    Atributo rel.
         *     @type string $href   Atributo href.
         * }
         * @param WP_Post  $item   El elemento del menú actual.
         * @param stdClass $args   Un objeto de argumentos wp_nav_menu().
         * @param int      $depth  Profundidad del ítem del menú. 0 es el nivel superior.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        /** Este filtro está documentado en wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        /**
         * Filtrar un ítem de menú del título de navegación.
         *
         * @param string   $title El título del ítem del menú.
         * @param WP_Post  $item  El elemento del menú actual.
         * @param stdClass $args  Un objeto de argumentos wp_nav_menu().
         * @param int      $depth Profundidad del ítem del menú. 0 es el nivel superior.
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        // Construir el enlace
        $item_output = isset($args->before) ? $args->before : '';
        
        $item_output .= '<a' . $attributes . '>';
        
        // Agregar icono si está definido en el título del menú
        // Formato: [icono]Título del menú
        if (preg_match('/^\[(.*?)\]/', $title, $matches)) {
            $icon_class = $matches[1];
            $title = preg_replace('/^\[(.*?)\]/', '', $title);
            $item_output .= '<i class="' . esc_attr($icon_class) . '"></i> ';
        }
        
        $item_output .= isset($args->link_before) ? $args->link_before : '';
        $item_output .= $title;
        $item_output .= isset($args->link_after) ? $args->link_after : '';
        
        // Añadir flechas para menús con hijos
        if ($has_children) {
            if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
                $item_output .= '<span class="menu-arrow"></span>';
            } else {
                $item_output .= '<i class="ri-arrow-down-s-line"></i>';
            }
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        /**
         * Filtrar la salida HTML del ítem de un menú específico.
         *
         * @param string   $item_output El ítem del menú HTML.
         * @param WP_Post  $item        El elemento del menú actual.
         * @param int      $depth       Profundidad del ítem del menú. 0 es el nivel superior.
         * @param stdClass $args        Un objeto de argumentos wp_nav_menu().
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Termina el elemento de menú
     *
     * @param string $output Usado para anexar contenido adicional.
     * @param object $item   El ítem del menú actual.
     * @param int    $depth  Profundidad del ítem del menú. Usado para padding.
     * @param array  $args   Un array de argumentos. @see wp_nav_menu()
     */
    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        // Para el menú lateral, no cerramos LI para submenús por la estructura específica del tema
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            if ($depth === 0) {
                $output .= "</li>{$n}";
            } else {
                // No cerramos LI para submenús
            }
        } else {
            $output .= "</li>{$n}";
        }
    }
    
    /**
     * Inicia el elemento de nivel secundario y abre la lista de elementos secundarios
     *
     * @param string $output Usado para anexar contenido adicional.
     * @param int    $depth  Profundidad del ítem del menú. Usado para padding.
     * @param array  $args   Un array de argumentos. @see wp_nav_menu()
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = str_repeat($t, $depth);
        
        // Clases para el submenú según el menú específico
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            // Para el menú lateral
            if ($depth === 0) {
                $classes = 'mm-collapse side-nav-second-level';
            } else {
                $classes = 'side-nav-third-level';
            }
            
            $output .= "{$n}{$indent}<ul class=\"{$classes}\">{$n}";
        } elseif (isset($args->theme_location) && $args->theme_location === 'topbar-right') {
            // Para el menú superior derecho
            $output .= "{$n}{$indent}<div class=\"dropdown-menu dropdown-menu-end dropdown-menu-animated\">{$n}";
        } else {
            // Para otros menús
            $output .= "{$n}{$indent}<ul class=\"dropdown-menu\">{$n}";
        }
    }
    
    /**
     * Termina el elemento de nivel secundario y cierra la lista de elementos secundarios
     *
     * @param string $output Usado para anexar contenido adicional.
     * @param int    $depth  Profundidad del ítem del menú. Usado para padding.
     * @param array  $args   Un array de argumentos. @see wp_nav_menu()
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = str_repeat($t, $depth);
        
        if (isset($args->theme_location) && $args->theme_location === 'sidebar') {
            // Para el menú lateral
            $output .= "$indent</ul>{$n}";
        } elseif (isset($args->theme_location) && $args->theme_location === 'topbar-right') {
            // Para el menú superior derecho
            $output .= "$indent</div>{$n}";
        } else {
            // Para otros menús
            $output .= "$indent</ul>{$n}";
        }
    }
}
