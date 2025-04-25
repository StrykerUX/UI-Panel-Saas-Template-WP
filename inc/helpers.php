<?php
/**
 * Funciones auxiliares para el tema UI Panel SAAS
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtener formato de fecha y hora personalizado
 *
 * @param int|string $timestamp Timestamp o fecha en string
 * @return string Fecha formateada
 */
function ui_panel_saas_format_date($timestamp = '') {
    if (empty($timestamp)) {
        $timestamp = current_time('timestamp');
    } elseif (!is_numeric($timestamp)) {
        $timestamp = strtotime($timestamp);
    }
    
    $date_format = get_option('date_format');
    $time_format = get_option('time_format');
    
    return date_i18n($date_format . ' ' . $time_format, $timestamp);
}

/**
 * Obtener nombre del rol de usuario
 *
 * @param WP_User $user Usuario de WordPress
 * @return string Nombre del rol
 */
function get_user_role_name($user) {
    if (empty($user) || !is_object($user) || !($user instanceof WP_User)) {
        return '';
    }
    
    $roles = $user->roles;
    
    if (empty($roles)) {
        return '';
    }
    
    $role = reset($roles);
    
    $role_names = array(
        'administrator' => esc_html__('Administrador', 'ui-panel-saas'),
        'editor'        => esc_html__('Editor', 'ui-panel-saas'),
        'author'        => esc_html__('Autor', 'ui-panel-saas'),
        'contributor'   => esc_html__('Colaborador', 'ui-panel-saas'),
        'subscriber'    => esc_html__('Suscriptor', 'ui-panel-saas'),
    );
    
    // Permitir que otros plugins/temas añadan roles personalizados
    $role_names = apply_filters('ui_panel_saas_role_names', $role_names);
    
    return isset($role_names[$role]) ? $role_names[$role] : $role;
}

/**
 * Acortar texto a un número específico de palabras
 *
 * @param string $text Texto a acortar
 * @param int $word_count Número de palabras
 * @param string $more Texto a mostrar al final si se ha acortado
 * @return string Texto acortado
 */
function ui_panel_saas_trim_words($text, $word_count = 20, $more = '...') {
    if (empty($text)) {
        return '';
    }
    
    $text = wp_strip_all_tags($text);
    $words = explode(' ', $text, $word_count + 1);
    
    if (count($words) > $word_count) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $more;
    } else {
        $text = implode(' ', $words);
    }
    
    return $text;
}

/**
 * Obtener la URL de la primera imagen en un post
 *
 * @param int|WP_Post $post_id ID del post o objeto post
 * @return string URL de la imagen o vacío
 */
function ui_panel_saas_get_first_image($post_id = 0) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $post = get_post($post_id);
    
    if (!$post) {
        return '';
    }
    
    $content = $post->post_content;
    
    if (empty($content)) {
        return '';
    }
    
    // Buscar la primera imagen en el contenido
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    
    if (isset($matches[1][0])) {
        return $matches[1][0];
    }
    
    return '';
}

/**
 * Verificar si una URL es válida
 *
 * @param string $url URL a verificar
 * @return bool
 */
function ui_panel_saas_is_valid_url($url) {
    if (empty($url)) {
        return false;
    }
    
    // Debe tener un esquema (http://, https://, etc.)
    if (!preg_match('/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$/i', $url)) {
        return false;
    }
    
    return true;
}

/**
 * Obtener avatar personalizado para usuario
 *
 * @param string $avatar Avatar HTML
 * @param mixed $id_or_email ID de usuario, correo o objeto
 * @param int $size Tamaño del avatar
 * @param string $default URL del avatar por defecto
 * @param string $alt Texto alternativo
 * @return string Avatar HTML
 */
function ui_panel_saas_get_avatar($avatar, $id_or_email, $size, $default, $alt) {
    // Si hay un avatar personalizado en los campos de usuario, usarlo
    $user = false;
    
    if (is_numeric($id_or_email)) {
        $user = get_user_by('id', absint($id_or_email));
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    } elseif ($id_or_email instanceof WP_User) {
        $user = $id_or_email;
    } elseif ($id_or_email instanceof WP_Post) {
        $user = get_user_by('id', $id_or_email->post_author);
    } elseif ($id_or_email instanceof WP_Comment) {
        if (!empty($id_or_email->user_id)) {
            $user = get_user_by('id', $id_or_email->user_id);
        }
    }
    
    if ($user && is_object($user)) {
        $custom_avatar = get_user_meta($user->ID, 'ui_panel_saas_avatar', true);
        
        if (!empty($custom_avatar)) {
            $avatar = '<img alt="' . esc_attr($alt) . '" src="' . esc_url($custom_avatar) . '" class="avatar avatar-' . esc_attr($size) . ' photo" height="' . esc_attr($size) . '" width="' . esc_attr($size) . '" />';
        }
    }
    
    return $avatar;
}
add_filter('get_avatar', 'ui_panel_saas_get_avatar', 10, 5);

/**
 * Obtener las iniciales de un nombre
 *
 * @param string $name Nombre completo
 * @return string Iniciales (máximo 2 caracteres)
 */
function ui_panel_saas_get_initials($name) {
    if (empty($name)) {
        return '';
    }
    
    $name_parts = explode(' ', $name);
    $initials = '';
    
    foreach ($name_parts as $part) {
        if (!empty($part)) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
    }
    
    // Limitar a 2 caracteres
    if (strlen($initials) > 2) {
        $initials = substr($initials, 0, 1) . substr($initials, -1);
    }
    
    return $initials;
}

/**
 * Generar un color aleatorio pero consistente basado en una cadena
 *
 * @param string $string Cadena para generar el color
 * @return string Color hexadecimal
 */
function ui_panel_saas_generate_color($string) {
    // Hash de la cadena para conseguir un valor numérico
    $hash = 0;
    $length = strlen($string);
    
    for ($i = 0; $i < $length; $i++) {
        $hash = ord($string[$i]) + (($hash << 5) - $hash);
    }
    
    // Convertir a color hexadecimal
    $color = '#';
    
    for ($i = 0; $i < 3; $i++) {
        $value = ($hash >> ($i * 8)) & 0xFF;
        $color .= str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
    }
    
    return $color;
}

/**
 * Determinar si el color es claro u oscuro
 *
 * @param string $hex Color hexadecimal
 * @return bool true si es oscuro, false si es claro
 */
function ui_panel_saas_is_dark_color($hex) {
    $hex = str_replace('#', '', $hex);
    
    // Convertir a RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Calcular luminosidad
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
    
    return $luminance <= 0.5;
}

/**
 * Guardar el modo de tema preferido por el usuario
 */
function ui_panel_saas_save_theme_mode() {
    check_ajax_referer('ui-panel-saas-nonce', 'nonce');
    
    $mode = isset($_POST['mode']) ? sanitize_text_field($_POST['mode']) : 'light';
    
    if (is_user_logged_in()) {
        // Si el usuario está logueado, guardar en sus meta datos
        update_user_meta(get_current_user_id(), 'ui_panel_saas_theme_mode', $mode);
    } else {
        // De lo contrario, guardar en una cookie
        setcookie('ui_panel_saas_theme_mode', $mode, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }
    
    wp_send_json_success();
}
add_action('wp_ajax_ui_panel_saas_save_theme_mode', 'ui_panel_saas_save_theme_mode');
add_action('wp_ajax_nopriv_ui_panel_saas_save_theme_mode', 'ui_panel_saas_save_theme_mode');

/**
 * Obtener URL para una página de plantilla específica
 *
 * @param string $template Nombre de la plantilla
 * @return string URL o cadena vacía si no existe
 */
function ui_panel_saas_get_template_url($template) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/' . $template . '.php'
    ));
    
    if (!empty($pages)) {
        return get_permalink($pages[0]->ID);
    }
    
    return '';
}

/**
 * Comprobar si estamos en una página de plantilla específica
 *
 * @param string $template Nombre de la plantilla
 * @return bool
 */
function ui_panel_saas_is_template($template) {
    if (!is_page_template('page-templates/' . $template . '.php')) {
        return false;
    }
    
    return true;
}
