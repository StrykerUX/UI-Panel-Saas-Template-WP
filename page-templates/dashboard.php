<?php
/**
 * Template Name: Panel de Control
 * 
 * Plantilla para mostrar un dashboard con widgets personalizados
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

<main id="primary" class="content-body dashboard-page">
    <div class="container-fluid">
        <?php
        // Título del panel
        echo '<div class="row">';
        echo '<div class="col-12">';
        echo '<div class="page-title-box">';
        echo '<div class="page-title-right">';
        echo '<form class="d-flex align-items-center mb-0">';
        echo '<div class="input-group input-group-sm">';
        echo '<input type="text" class="form-control border-0" id="dash-daterange" value="' . esc_attr(date_i18n('d M Y', strtotime('-30 days'))) . ' - ' . esc_attr(date_i18n('d M Y')) . '">';
        echo '<span class="input-group-text bg-primary border-primary text-white"><i class="ri-calendar-todo-line"></i></span>';
        echo '</div>';
        echo '<a href="javascript:void(0);" class="btn btn-primary btn-sm ms-2"><i class="ri-refresh-line"></i></a>';
        echo '</form>';
        echo '</div>';
        echo '<h4 class="page-title">' . esc_html__('Panel de Control', 'ui-panel-saas') . '</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Widgets 1: Estadísticas principales
        echo '<div class="row">';
        
        // Widget: Usuarios
        echo '<div class="col-md-6 col-xl-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="d-flex align-items-center">';
        echo '<div class="flex-shrink-0 avatar-lg">';
        echo '<div class="avatar-title bg-light text-primary rounded-circle">';
        echo '<i class="ri-user-line fs-1"></i>';
        echo '</div>';
        echo '</div>';
        echo '<div class="flex-grow-1 ms-3">';
        
        // Obtener número de usuarios
        $users_count = count_users();
        $total_users = $users_count['total_users'];
        
        echo '<h4 class="mb-1">' . number_format_i18n($total_users) . '</h4>';
        echo '<p class="text-muted mb-0">' . esc_html__('Usuarios totales', 'ui-panel-saas') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Widget: Entradas
        echo '<div class="col-md-6 col-xl-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="d-flex align-items-center">';
        echo '<div class="flex-shrink-0 avatar-lg">';
        echo '<div class="avatar-title bg-light text-success rounded-circle">';
        echo '<i class="ri-file-text-line fs-1"></i>';
        echo '</div>';
        echo '</div>';
        echo '<div class="flex-grow-1 ms-3">';
        
        // Obtener número de entradas
        $post_counts = wp_count_posts();
        $published_posts = $post_counts->publish;
        
        echo '<h4 class="mb-1">' . number_format_i18n($published_posts) . '</h4>';
        echo '<p class="text-muted mb-0">' . esc_html__('Entradas publicadas', 'ui-panel-saas') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Widget: Comentarios
        echo '<div class="col-md-6 col-xl-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="d-flex align-items-center">';
        echo '<div class="flex-shrink-0 avatar-lg">';
        echo '<div class="avatar-title bg-light text-info rounded-circle">';
        echo '<i class="ri-chat-3-line fs-1"></i>';
        echo '</div>';
        echo '</div>';
        echo '<div class="flex-grow-1 ms-3">';
        
        // Obtener número de comentarios aprobados
        $comments_count = wp_count_comments();
        $approved_comments = $comments_count->approved;
        
        echo '<h4 class="mb-1">' . number_format_i18n($approved_comments) . '</h4>';
        echo '<p class="text-muted mb-0">' . esc_html__('Comentarios aprobados', 'ui-panel-saas') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Widget: Vistas de página (si existe un plugin de estadísticas)
        echo '<div class="col-md-6 col-xl-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="d-flex align-items-center">';
        echo '<div class="flex-shrink-0 avatar-lg">';
        echo '<div class="avatar-title bg-light text-warning rounded-circle">';
        echo '<i class="ri-eye-line fs-1"></i>';
        echo '</div>';
        echo '</div>';
        echo '<div class="flex-grow-1 ms-3">';
        
        // Obtener vistas (usando un hook para que plugins de estadísticas puedan integrarse)
        $page_views = apply_filters('ui_panel_saas_dashboard_page_views', 0);
        
        echo '<h4 class="mb-1">' . number_format_i18n($page_views) . '</h4>';
        echo '<p class="text-muted mb-0">' . esc_html__('Vistas de página', 'ui-panel-saas') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>'; // Fin fila 1
        
        // Widgets 2: Gráficos y actividad
        echo '<div class="row">';
        
        // Gráfico de actividad
        echo '<div class="col-xl-8">';
        echo '<div class="card">';
        echo '<div class="card-header d-flex justify-content-between align-items-center">';
        echo '<h4 class="header-title">' . esc_html__('Actividad reciente', 'ui-panel-saas') . '</h4>';
        echo '<div class="dropdown">';
        echo '<a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">';
        echo '<i class="ri-more-2-fill"></i>';
        echo '</a>';
        echo '<div class="dropdown-menu dropdown-menu-end">';
        echo '<a href="javascript:void(0);" class="dropdown-item">' . esc_html__('Actualizar', 'ui-panel-saas') . '</a>';
        echo '<a href="javascript:void(0);" class="dropdown-item">' . esc_html__('Exportar', 'ui-panel-saas') . '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="card-body pt-0">';
        echo '<div class="chart-container" style="position: relative; height: 320px;">';
        echo '<canvas id="activity-chart"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Actividad reciente
        echo '<div class="col-xl-4">';
        echo '<div class="card">';
        echo '<div class="card-header d-flex justify-content-between align-items-center">';
        echo '<h4 class="header-title">' . esc_html__('Actividad del sitio', 'ui-panel-saas') . '</h4>';
        echo '</div>';
        
        echo '<div class="card-body pt-0">';
        
        // Obtener actividad reciente (últimos 5 posts/comments)
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        
        $recent_posts = new WP_Query($args);
        
        if ($recent_posts->have_posts()) {
            echo '<div class="timeline timeline-center">';
            
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                
                echo '<div class="timeline-item">';
                echo '<i class="timeline-icon ri-article-line"></i>';
                echo '<div class="timeline-content">';
                echo '<h5 class="text-primary mb-1">' . get_the_date() . '</h5>';
                echo '<p class="mb-0">' . esc_html__('Nueva entrada:', 'ui-panel-saas') . ' <a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></p>';
                echo '</div>';
                echo '</div>';
            }
            
            wp_reset_postdata();
            
            // Obtener comentarios recientes
            $comments_args = array(
                'number' => 3,
                'status' => 'approve',
                'order' => 'DESC',
            );
            
            $comments = get_comments($comments_args);
            
            foreach ($comments as $comment) {
                echo '<div class="timeline-item">';
                echo '<i class="timeline-icon ri-chat-1-line"></i>';
                echo '<div class="timeline-content">';
                echo '<h5 class="text-primary mb-1">' . get_comment_date('', $comment->comment_ID) . '</h5>';
                echo '<p class="mb-0">' . esc_html__('Nuevo comentario de', 'ui-panel-saas') . ' ' . esc_html($comment->comment_author) . ' ' . esc_html__('en', 'ui-panel-saas') . ' <a href="' . esc_url(get_permalink($comment->comment_post_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a></p>';
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>';
        } else {
            echo '<div class="text-center">';
            echo '<div class="mb-3">';
            echo '<i class="ri-file-text-line text-muted" style="font-size: 3rem;"></i>';
            echo '</div>';
            echo '<p>' . esc_html__('No hay actividad reciente', 'ui-panel-saas') . '</p>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>'; // Fin fila 2
        
        // Widgets 3: Entradas populares y categorías
        echo '<div class="row">';
        
        // Entradas más populares
        echo '<div class="col-xl-8">';
        echo '<div class="card">';
        echo '<div class="card-header d-flex justify-content-between align-items-center">';
        echo '<h4 class="header-title">' . esc_html__('Entradas populares', 'ui-panel-saas') . '</h4>';
        echo '</div>';
        
        echo '<div class="card-body pt-0">';
        echo '<div class="table-responsive">';
        echo '<table class="table table-centered table-nowrap mb-0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . esc_html__('Título', 'ui-panel-saas') . '</th>';
        echo '<th>' . esc_html__('Categoría', 'ui-panel-saas') . '</th>';
        echo '<th>' . esc_html__('Fecha', 'ui-panel-saas') . '</th>';
        echo '<th>' . esc_html__('Comentarios', 'ui-panel-saas') . '</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Entradas populares (por número de comentarios)
        $popular_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'orderby' => 'comment_count',
            'order' => 'DESC',
        );
        
        $popular_posts = new WP_Query($popular_args);
        
        if ($popular_posts->have_posts()) {
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                
                echo '<tr>';
                echo '<td><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></td>';
                echo '<td>';
                
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<span class="badge bg-primary">' . esc_html($categories[0]->name) . '</span>';
                }
                
                echo '</td>';
                echo '<td>' . get_the_date() . '</td>';
                echo '<td>' . get_comments_number() . '</td>';
                echo '</tr>';
            }
            
            wp_reset_postdata();
        } else {
            echo '<tr><td colspan="4" class="text-center">' . esc_html__('No hay entradas para mostrar', 'ui-panel-saas') . '</td></tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Categorías
        echo '<div class="col-xl-4">';
        echo '<div class="card">';
        echo '<div class="card-header d-flex justify-content-between align-items-center">';
        echo '<h4 class="header-title">' . esc_html__('Categorías', 'ui-panel-saas') . '</h4>';
        echo '</div>';
        
        echo '<div class="card-body pt-0">';
        
        // Obtener categorías con conteo
        $categories = get_categories(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 6,
        ));
        
        if (!empty($categories)) {
            foreach ($categories as $category) {
                // Calcular porcentaje basado en la categoría con más posts
                $max_posts = $categories[0]->count;
                $percentage = ($category->count / $max_posts) * 100;
                
                echo '<div class="mb-4">';
                echo '<div class="d-flex align-items-center mb-2">';
                echo '<div class="flex-grow-1">';
                echo '<h5 class="mb-0 font-size-15">' . esc_html($category->name) . '</h5>';
                echo '</div>';
                echo '<div class="flex-shrink-0">';
                echo '<span class="badge bg-primary">' . number_format_i18n($category->count) . ' ' . esc_html__('posts', 'ui-panel-saas') . '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="progress" style="height: 6px;">';
                echo '<div class="progress-bar" role="progressbar" style="width: ' . esc_attr($percentage) . '%;" aria-valuenow="' . esc_attr($percentage) . '" aria-valuemin="0" aria-valuemax="100"></div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="text-center">';
            echo '<div class="mb-3">';
            echo '<i class="ri-folder-line text-muted" style="font-size: 3rem;"></i>';
            echo '</div>';
            echo '<p>' . esc_html__('No hay categorías para mostrar', 'ui-panel-saas') . '</p>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>'; // Fin fila 3
        
        // Área de widgets personalizada del dashboard
        if (is_active_sidebar('dashboard')) {
            echo '<div class="row">';
            echo '<div class="col-12">';
            dynamic_sidebar('dashboard');
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</main>

<script>
    // Gráfico de actividad con datos simulados
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            if (typeof Chart !== 'undefined' && $('#activity-chart').length) {
                var ctx = document.getElementById('activity-chart').getContext('2d');
                
                // Generar fechas para el último mes
                var dates = [];
                var visitData = [];
                var postsData = [];
                var commentsData = [];
                
                var today = new Date();
                for (var i = 30; i >= 0; i--) {
                    var date = new Date(today);
                    date.setDate(date.getDate() - i);
                    dates.push(date.toLocaleDateString());
                    
                    // Datos simulados
                    visitData.push(Math.floor(Math.random() * 500) + 100);
                    postsData.push(Math.floor(Math.random() * 10));
                    commentsData.push(Math.floor(Math.random() * 20) + 5);
                }
                
                var activityChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [
                            {
                                label: '<?php echo esc_js(__('Visitas', 'ui-panel-saas')); ?>',
                                data: visitData,
                                borderColor: '#4F46E5',
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                borderWidth: 2,
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: '<?php echo esc_js(__('Publicaciones', 'ui-panel-saas')); ?>',
                                data: postsData,
                                borderColor: '#10B981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 2,
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: '<?php echo esc_js(__('Comentarios', 'ui-panel-saas')); ?>',
                                data: commentsData,
                                borderColor: '#F59E0B',
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                borderWidth: 2,
                                tension: 0.3,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            },
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    maxTicksLimit: 10
                                }
                            }
                        }
                    }
                });
                
                // Ajustar tema oscuro si es necesario
                if ($('html').attr('data-bs-theme') === 'dark') {
                    activityChart.options.scales.y.grid.color = 'rgba(255, 255, 255, 0.1)';
                    activityChart.options.scales.x.grid.color = 'rgba(255, 255, 255, 0.1)';
                    activityChart.update();
                }
            }
        });
    })(jQuery);
</script>

<?php
get_footer();
