<?php
/**
 * Template Name: Dashboard
 *
 * Plantilla para crear un dashboard personalizado con estilo del template Boron.
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
        // Título de la página con breadcrumbs
        if (function_exists('ui_panel_saas_page_title')) {
            ui_panel_saas_page_title();
        } else {
            the_title('<h1 class="page-title">', '</h1>');
        }
        ?>

        <!-- Widgets/Tarjetas de estadísticas -->
        <div class="row">
            <!-- Tarjeta 1: Total de usuarios -->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded bg-primary-subtle">
                                    <span class="avatar-title rounded bg-primary-subtle text-primary">
                                        <i class="ri-user-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <?php 
                                // Contar usuarios
                                $users_count = count_users();
                                $total_users = $users_count['total_users'];
                                ?>
                                <h4 class="mt-0 mb-1 fs-20"><?php echo esc_html(number_format_i18n($total_users)); ?></h4>
                                <p class="mb-0 text-muted"><?php echo esc_html__('Usuarios totales', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php echo esc_url(admin_url('users.php')); ?>" class="dropdown-item">
                                        <i class="ri-eye-fill me-2"></i> 
                                        <?php echo esc_html__('Ver todos', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php if (current_user_can('create_users')) : ?>
                                    <a href="<?php echo esc_url(admin_url('user-new.php')); ?>" class="dropdown-item">
                                        <i class="ri-user-add-line me-2"></i> 
                                        <?php echo esc_html__('Añadir nuevo', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 2: Posts totales -->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded bg-success-subtle">
                                    <span class="avatar-title rounded bg-success-subtle text-success">
                                        <i class="ri-article-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <?php 
                                // Contar posts publicados
                                $count_posts = wp_count_posts();
                                $published_posts = $count_posts->publish;
                                ?>
                                <h4 class="mt-0 mb-1 fs-20"><?php echo esc_html(number_format_i18n($published_posts)); ?></h4>
                                <p class="mb-0 text-muted"><?php echo esc_html__('Entradas publicadas', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php echo esc_url(admin_url('edit.php')); ?>" class="dropdown-item">
                                        <i class="ri-eye-fill me-2"></i> 
                                        <?php echo esc_html__('Ver todos', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php if (current_user_can('publish_posts')) : ?>
                                    <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="dropdown-item">
                                        <i class="ri-add-line me-2"></i> 
                                        <?php echo esc_html__('Añadir nueva', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 3: Páginas -->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded bg-info-subtle">
                                    <span class="avatar-title rounded bg-info-subtle text-info">
                                        <i class="ri-pages-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <?php 
                                // Contar páginas publicadas
                                $count_pages = wp_count_posts('page');
                                $published_pages = $count_pages->publish;
                                ?>
                                <h4 class="mt-0 mb-1 fs-20"><?php echo esc_html(number_format_i18n($published_pages)); ?></h4>
                                <p class="mb-0 text-muted"><?php echo esc_html__('Páginas publicadas', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="dropdown-item">
                                        <i class="ri-eye-fill me-2"></i> 
                                        <?php echo esc_html__('Ver todas', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php if (current_user_can('publish_pages')) : ?>
                                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>" class="dropdown-item">
                                        <i class="ri-add-line me-2"></i> 
                                        <?php echo esc_html__('Añadir nueva', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 4: Comentarios -->
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded bg-warning-subtle">
                                    <span class="avatar-title rounded bg-warning-subtle text-warning">
                                        <i class="ri-chat-3-line fs-22"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <?php 
                                // Contar comentarios aprobados
                                $comments_count = wp_count_comments();
                                $approved_comments = $comments_count->approved;
                                ?>
                                <h4 class="mt-0 mb-1 fs-20"><?php echo esc_html(number_format_i18n($approved_comments)); ?></h4>
                                <p class="mb-0 text-muted"><?php echo esc_html__('Comentarios', 'ui-panel-saas'); ?></p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php echo esc_url(admin_url('edit-comments.php')); ?>" class="dropdown-item">
                                        <i class="ri-eye-fill me-2"></i> 
                                        <?php echo esc_html__('Ver todos', 'ui-panel-saas'); ?>
                                    </a>
                                    <?php if ($comments_count->moderated > 0 && current_user_can('moderate_comments')) : ?>
                                    <a href="<?php echo esc_url(admin_url('edit-comments.php?comment_status=moderated')); ?>" class="dropdown-item">
                                        <i class="ri-time-line me-2"></i> 
                                        <?php echo esc_html__('Pendientes', 'ui-panel-saas'); ?> 
                                        <span class="badge bg-danger"><?php echo esc_html(number_format_i18n($comments_count->moderated)); ?></span>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de widgets/tarjetas de estadísticas -->
        
        <div class="row">
            <!-- Gráfico de actividad reciente -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0"><?php echo esc_html__('Actividad reciente', 'ui-panel-saas'); ?></h4>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item"><?php echo esc_html__('Actualizar', 'ui-panel-saas'); ?></a>
                                <a href="#" class="dropdown-item"><?php echo esc_html__('Exportar', 'ui-panel-saas'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="activity-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Actividades recientes -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1"><?php echo esc_html__('Actividades recientes', 'ui-panel-saas'); ?></h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="dashboard-activities">
                            <?php
                            // Obtener actividad reciente (posts, comentarios, etc.)
                            $args = array(
                                'post_type' => array('post', 'page'),
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC',
                            );
                            $recent_posts = new WP_Query($args);
                            
                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) :
                                    $recent_posts->the_post();
                            ?>
                            <div class="activity-item d-flex">
                                <div class="activity-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 40, '', get_the_author(), array('class' => 'rounded-circle')); ?>
                                </div>
                                <div class="activity-content flex-grow-1 ms-3">
                                    <h6 class="mb-1">
                                        <?php the_author(); ?> 
                                        <span class="text-muted small">
                                            <?php echo esc_html__('publicó', 'ui-panel-saas'); ?> 
                                            <?php if (get_post_type() === 'page') : ?>
                                                <?php echo esc_html__('una página', 'ui-panel-saas'); ?>
                                            <?php else : ?>
                                                <?php echo esc_html__('una entrada', 'ui-panel-saas'); ?>
                                            <?php endif; ?>
                                        </span>
                                    </h6>
                                    <p class="text-muted mb-2">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </p>
                                    <small class="text-muted">
                                        <i class="ri-time-line"></i> 
                                        <?php echo esc_html(human_time_diff(get_the_time('U'), current_time('timestamp'))); ?> 
                                        <?php echo esc_html__('atrás', 'ui-panel-saas'); ?>
                                    </small>
                                </div>
                            </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            
                            // Comentarios recientes
                            $recent_comments = get_comments(array(
                                'number' => 2,
                                'status' => 'approve',
                            ));
                            
                            if ($recent_comments) :
                                foreach ($recent_comments as $comment) :
                            ?>
                            <div class="activity-item d-flex">
                                <div class="activity-avatar">
                                    <?php echo get_avatar($comment->comment_author_email, 40, '', $comment->comment_author, array('class' => 'rounded-circle')); ?>
                                </div>
                                <div class="activity-content flex-grow-1 ms-3">
                                    <h6 class="mb-1">
                                        <?php echo esc_html($comment->comment_author); ?> 
                                        <span class="text-muted small">
                                            <?php echo esc_html__('comentó en', 'ui-panel-saas'); ?>
                                        </span>
                                    </h6>
                                    <p class="text-muted mb-2">
                                        <a href="<?php echo esc_url(get_permalink($comment->comment_post_ID)); ?>">
                                            <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                                        </a>
                                    </p>
                                    <p class="mb-2"><?php echo wp_kses_post(wp_trim_words($comment->comment_content, 15, '...')); ?></p>
                                    <small class="text-muted">
                                        <i class="ri-time-line"></i> 
                                        <?php echo esc_html(human_time_diff(strtotime($comment->comment_date), current_time('timestamp'))); ?> 
                                        <?php echo esc_html__('atrás', 'ui-panel-saas'); ?>
                                    </small>
                                </div>
                            </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Área de widgets del dashboard -->
        <?php if (is_active_sidebar('dashboard')) : ?>
        <div class="row">
            <div class="col-12">
                <?php dynamic_sidebar('dashboard'); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php
        // Si hay contenido en la página, mostrarlo
        while (have_posts()) :
            the_post();
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        
    </div>
</main>

<!-- Script para inicializar el gráfico -->
<script>
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            if (typeof ApexCharts !== 'undefined') {
                // Fechas para el eje X (últimos 30 días)
                var dates = [];
                for (var i = 30; i >= 0; i--) {
                    var date = new Date();
                    date.setDate(date.getDate() - i);
                    dates.push(date.toLocaleDateString());
                }
                
                // Datos de ejemplo (puedes reemplazarlos con datos reales mediante AJAX)
                var options = {
                    chart: {
                        height: 300,
                        type: 'area',
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    series: [{
                        name: '<?php echo esc_js(__('Vistas', 'ui-panel-saas')); ?>',
                        data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10, 30, 38, 42, 45, 55, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200]
                    }, {
                        name: '<?php echo esc_js(__('Visitantes', 'ui-panel-saas')); ?>',
                        data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 110, 120, 130, 140, 150, 160]
                    }],
                    colors: ['#4F46E5', '#8B5CF6'],
                    xaxis: {
                        categories: dates,
                    },
                    yaxis: {
                        title: {
                            text: '<?php echo esc_js(__('Número', 'ui-panel-saas')); ?>'
                        },
                    },
                    tooltip: {
                        x: {
                            format: 'dd/MM/yy'
                        },
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                    }
                };
                
                var chart = new ApexCharts(
                    document.querySelector("#activity-chart"),
                    options
                );
                
                chart.render();
            }
        });
    })(jQuery);
</script>

<?php
get_footer();
