<?php
/**
 * Template Name: Dashboard
 *
 * Esta plantilla se utiliza para mostrar un panel de control administrativo.
 *
 * @package UI_Panel_SAAS
 * @since 1.0.0
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

get_header();
get_sidebar();
?>

<main id="primary" class="content-body">
    <div class="container-fluid">
        <?php
        // Título de la página
        if (function_exists('ui_panel_saas_page_title')) {
            ui_panel_saas_page_title();
        } else {
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<div class="page-title-box">';
            echo '<h4 class="page-title">' . esc_html(get_the_title()) . '</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

        <!-- Dashboard Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">
                                    <?php echo esc_html__('Usuarios', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="mt-3 mb-3">
                                    <?php 
                                    // Contar usuarios
                                    $users_count = count_users();
                                    echo number_format_i18n($users_count['total_users']);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <?php
                                    // Obtener estadísticas de crecimiento por mes
                                    $args = array(
                                        'date_query' => array(
                                            array(
                                                'after' => '1 month ago',
                                            ),
                                        ),
                                        'fields' => 'ID',
                                    );
                                    $recent_users = get_users($args);
                                    $growth = count($recent_users);
                                    $growth_percent = ($users_count['total_users'] > 0) ? ($growth / $users_count['total_users'] * 100) : 0;
                                    ?>
                                    <span class="text-<?php echo ($growth > 0) ? 'success' : 'danger'; ?>">
                                        <i class="ri-arrow-<?php echo ($growth > 0) ? 'up' : 'down'; ?>-line"></i> 
                                        <?php echo number_format_i18n($growth_percent, 1); ?>%
                                    </span>
                                    <span class="text-nowrap">
                                        <?php echo esc_html__('Desde el último mes', 'ui-panel-saas'); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-primary-subtle rounded">
                                    <i class="ri-user-line font-24 text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Posts">
                                    <?php echo esc_html__('Publicaciones', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="mt-3 mb-3">
                                    <?php 
                                    // Contar publicaciones
                                    $count_posts = wp_count_posts();
                                    echo number_format_i18n($count_posts->publish);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <?php
                                    // Obtener estadísticas de publicaciones por mes
                                    $args = array(
                                        'post_type' => 'post',
                                        'post_status' => 'publish',
                                        'date_query' => array(
                                            array(
                                                'after' => '1 month ago',
                                            ),
                                        ),
                                        'fields' => 'ids',
                                    );
                                    $recent_posts = get_posts($args);
                                    $monthly_posts = count($recent_posts);
                                    $growth_percent = ($count_posts->publish > 0) ? ($monthly_posts / $count_posts->publish * 100) : 0;
                                    ?>
                                    <span class="text-success">
                                        <i class="ri-file-list-line"></i> <?php echo number_format_i18n($monthly_posts); ?>
                                    </span>
                                    <span class="text-nowrap">
                                        <?php echo esc_html__('En el último mes', 'ui-panel-saas'); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-success-subtle rounded">
                                    <i class="ri-file-list-3-line font-24 text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Comments">
                                    <?php echo esc_html__('Comentarios', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="mt-3 mb-3">
                                    <?php 
                                    // Contar comentarios
                                    $comments_count = wp_count_comments();
                                    echo number_format_i18n($comments_count->approved);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <?php
                                    // Pendientes de moderación
                                    $pending = $comments_count->moderated;
                                    ?>
                                    <span class="text-<?php echo ($pending > 0) ? 'warning' : 'success'; ?>">
                                        <i class="ri-time-line"></i> <?php echo number_format_i18n($pending); ?>
                                    </span>
                                    <span class="text-nowrap">
                                        <?php echo esc_html__('Pendientes de moderación', 'ui-panel-saas'); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-info-subtle rounded">
                                    <i class="ri-chat-3-line font-24 text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fw-normal mt-0" title="Server Uptime">
                                    <?php echo esc_html__('Espacio de disco', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="mt-3 mb-3">
                                    <?php 
                                    // Obtener tamaño de la carpeta de uploads
                                    $upload_dir = wp_upload_dir();
                                    
                                    function ui_panel_saas_get_folder_size($dir) {
                                        $size = 0;
                                        $files = scandir($dir);
                                        
                                        foreach ($files as $file) {
                                            if ($file != '.' && $file != '..') {
                                                $path = $dir . '/' . $file;
                                                
                                                if (is_dir($path)) {
                                                    $size += ui_panel_saas_get_folder_size($path);
                                                } else {
                                                    $size += filesize($path);
                                                }
                                            }
                                        }
                                        
                                        return $size;
                                    }
                                    
                                    $upload_size = ui_panel_saas_get_folder_size($upload_dir['basedir']);
                                    $upload_size_mb = number_format($upload_size / 1048576, 2);
                                    
                                    echo $upload_size_mb . ' MB';
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <?php
                                    // Número de archivos en el directorio de uploads
                                    function ui_panel_saas_count_files($dir) {
                                        $count = 0;
                                        $files = scandir($dir);
                                        
                                        foreach ($files as $file) {
                                            if ($file != '.' && $file != '..') {
                                                $path = $dir . '/' . $file;
                                                
                                                if (is_dir($path)) {
                                                    $count += ui_panel_saas_count_files($path);
                                                } else {
                                                    $count++;
                                                }
                                            }
                                        }
                                        
                                        return $count;
                                    }
                                    
                                    $files_count = ui_panel_saas_count_files($upload_dir['basedir']);
                                    ?>
                                    <span class="text-info">
                                        <i class="ri-file-line"></i> <?php echo number_format_i18n($files_count); ?>
                                    </span>
                                    <span class="text-nowrap">
                                        <?php echo esc_html__('Archivos en total', 'ui-panel-saas'); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-warning-subtle rounded">
                                    <i class="ri-save-line font-24 text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="header-title"><?php echo esc_html__('Actividad reciente', 'ui-panel-saas'); ?></h4>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="<?php echo esc_url(admin_url('edit.php')); ?>" class="dropdown-item">
                                    <?php echo esc_html__('Ver todos los posts', 'ui-panel-saas'); ?>
                                </a>
                                <?php if (current_user_can('edit_posts')) : ?>
                                <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="dropdown-item">
                                    <?php echo esc_html__('Añadir nuevo post', 'ui-panel-saas'); ?>
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(admin_url('edit-comments.php')); ?>" class="dropdown-item">
                                    <?php echo esc_html__('Moderar comentarios', 'ui-panel-saas'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <?php
                        // Obtener los últimos posts
                        $recent_posts = get_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ));
                        
                        if (!empty($recent_posts)) :
                        ?>
                            <div class="timeline-alt pb-0">
                                <?php foreach ($recent_posts as $post) : ?>
                                    <div class="timeline-item">
                                        <i class="ri-article-line text-primary timeline-icon"></i>
                                        <div class="timeline-item-info">
                                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="text-primary fw-bold mb-1 d-block">
                                                <?php echo esc_html(get_the_title($post->ID)); ?>
                                            </a>
                                            <small><?php echo esc_html__('Por', 'ui-panel-saas'); ?> 
                                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author)); ?>">
                                                    <?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                                                </a>
                                            </small>
                                            <p class="mb-0 pb-2">
                                                <small class="text-muted">
                                                    <?php echo esc_html(get_the_date('', $post->ID)); ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <?php echo esc_html__('No hay publicaciones recientes.', 'ui-panel-saas'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="header-title"><?php echo esc_html__('Comentarios recientes', 'ui-panel-saas'); ?></h4>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="<?php echo esc_url(admin_url('edit-comments.php')); ?>" class="dropdown-item">
                                    <?php echo esc_html__('Ver todos los comentarios', 'ui-panel-saas'); ?>
                                </a>
                                <a href="<?php echo esc_url(admin_url('edit-comments.php?comment_status=moderated')); ?>" class="dropdown-item">
                                    <?php echo esc_html__('Comentarios pendientes', 'ui-panel-saas'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <?php
                        // Obtener los últimos comentarios
                        $recent_comments = get_comments(array(
                            'number' => 5,
                            'status' => 'approve',
                        ));
                        
                        if (!empty($recent_comments)) :
                        ?>
                            <div class="timeline-alt pb-0">
                                <?php foreach ($recent_comments as $comment) : ?>
                                    <div class="timeline-item">
                                        <i class="ri-chat-1-line text-info timeline-icon"></i>
                                        <div class="timeline-item-info">
                                            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>" class="text-info fw-bold mb-1 d-block">
                                                <?php 
                                                $excerpt = wp_trim_words($comment->comment_content, 10, '...');
                                                echo esc_html($excerpt); 
                                                ?>
                                            </a>
                                            <small><?php echo esc_html__('Por', 'ui-panel-saas'); ?> 
                                                <span class="fw-bold"><?php echo esc_html($comment->comment_author); ?></span>
                                                <?php echo esc_html__('en', 'ui-panel-saas'); ?>
                                                <a href="<?php echo esc_url(get_permalink($comment->comment_post_ID)); ?>">
                                                    <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                                                </a>
                                            </small>
                                            <p class="mb-0 pb-2">
                                                <small class="text-muted">
                                                    <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($comment->comment_date))); ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <?php echo esc_html__('No hay comentarios recientes.', 'ui-panel-saas'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Dashboard Widgets Area -->
        <?php if (is_active_sidebar('dashboard')) : ?>
        <div class="row">
            <div class="col-12">
                <?php dynamic_sidebar('dashboard'); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Contenido de la página -->
        <?php while (have_posts()) : the_post(); ?>
            <div class="card mt-4">
                <div class="card-body">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
