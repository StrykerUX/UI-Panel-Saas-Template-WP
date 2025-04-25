<?php
/**
 * Template Name: Dashboard
 *
 * Esta plantilla muestra un panel de control personalizado con widgets y estadísticas.
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
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">
                            <?php esc_html_e('Panel de Control', 'ui-panel-saas'); ?>
                        </h4>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <!-- Widgets de estadísticas -->
        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-user-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="<?php esc_attr_e('Número de Usuarios', 'ui-panel-saas'); ?>">
                            <?php esc_html_e('Usuarios', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php 
                            $count_users = count_users();
                            echo number_format_i18n($count_users['total_users']); 
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2">
                                <i class="ri-arrow-up-line"></i> 5.27%
                            </span>
                            <span class="text-nowrap">
                                <?php esc_html_e('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-article-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="<?php esc_attr_e('Número de Publicaciones', 'ui-panel-saas'); ?>">
                            <?php esc_html_e('Publicaciones', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            $count_posts = wp_count_posts();
                            echo number_format_i18n($count_posts->publish);
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-danger me-2">
                                <i class="ri-arrow-down-line"></i> 1.08%
                            </span>
                            <span class="text-nowrap">
                                <?php esc_html_e('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-message-2-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="<?php esc_attr_e('Número de Comentarios', 'ui-panel-saas'); ?>">
                            <?php esc_html_e('Comentarios', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            $count_comments = wp_count_comments();
                            echo number_format_i18n($count_comments->approved);
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2">
                                <i class="ri-arrow-up-line"></i> 3.18%
                            </span>
                            <span class="text-nowrap">
                                <?php esc_html_e('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-eye-line widget-icon"></i>
                        </div>
                        <h5 class="text-muted fw-normal mt-0" title="<?php esc_attr_e('Visualizaciones de Página', 'ui-panel-saas'); ?>">
                            <?php esc_html_e('Visualizaciones', 'ui-panel-saas'); ?>
                        </h5>
                        <h3 class="mt-3 mb-3">
                            <?php
                            // Si tienes un plugin de estadísticas, puedes obtener datos reales aquí
                            // De lo contrario, mostramos un valor de ejemplo
                            echo number_format_i18n(12450);
                            ?>
                        </h3>
                        <p class="mb-0 text-muted">
                            <span class="text-success me-2">
                                <i class="ri-arrow-up-line"></i> 7.41%
                            </span>
                            <span class="text-nowrap">
                                <?php esc_html_e('Desde el mes pasado', 'ui-panel-saas'); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <!-- Gráfico de actividad reciente -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php esc_html_e('Actividad del Sitio', 'ui-panel-saas'); ?></h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Informes Semanales', 'ui-panel-saas'); ?></a>
                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Informes Mensuales', 'ui-panel-saas'); ?></a>
                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Exportar Informe', 'ui-panel-saas'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="chart-container" style="height: 320px;">
                            <canvas id="activity-chart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Fin del gráfico de actividad -->

                <!-- Publicaciones recientes -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php esc_html_e('Publicaciones Recientes', 'ui-panel-saas'); ?></h4>
                            <a href="<?php echo esc_url(admin_url('edit.php')); ?>" class="btn btn-sm btn-primary">
                                <?php esc_html_e('Ver Todas', 'ui-panel-saas'); ?>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th><?php esc_html_e('Título', 'ui-panel-saas'); ?></th>
                                        <th><?php esc_html_e('Categoría', 'ui-panel-saas'); ?></th>
                                        <th><?php esc_html_e('Autor', 'ui-panel-saas'); ?></th>
                                        <th><?php esc_html_e('Fecha', 'ui-panel-saas'); ?></th>
                                        <th><?php esc_html_e('Estado', 'ui-panel-saas'); ?></th>
                                        <th><?php esc_html_e('Acciones', 'ui-panel-saas'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $recent_posts = wp_get_recent_posts(array(
                                        'numberposts' => 5,
                                        'post_status' => 'publish'
                                    ));
                                    
                                    foreach ($recent_posts as $post) :
                                        $post_id = $post['ID'];
                                        $categories = get_the_category($post_id);
                                        $author_id = $post['post_author'];
                                        $author_name = get_the_author_meta('display_name', $author_id);
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="text-body fw-semibold">
                                                <?php echo esc_html(get_the_title($post_id)); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($categories)) {
                                                $category_names = array();
                                                foreach ($categories as $category) {
                                                    $category_names[] = '<span class="badge bg-primary">' . esc_html($category->name) . '</span>';
                                                }
                                                echo implode(' ', $category_names);
                                            } else {
                                                echo '<span class="badge bg-secondary">' . esc_html__('Sin categoría', 'ui-panel-saas') . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo esc_html($author_name); ?></td>
                                        <td><?php echo esc_html(get_the_date('', $post_id)); ?></td>
                                        <td><span class="badge bg-success"><?php esc_html_e('Publicado', 'ui-panel-saas'); ?></span></td>
                                        <td>
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="action-icon">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <?php if (current_user_can('edit_post', $post_id)) : ?>
                                            <a href="<?php echo esc_url(get_edit_post_link($post_id)); ?>" class="action-icon">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Fin de publicaciones recientes -->
            </div>

            <div class="col-xl-4">
                <!-- Área de widget de WordPress -->
                <?php if (is_active_sidebar('dashboard')) : ?>
                <div class="dashboard-widget-area">
                    <?php dynamic_sidebar('dashboard'); ?>
                </div>
                <?php else : ?>
                
                <!-- Actividad reciente -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php esc_html_e('Actividad Reciente', 'ui-panel-saas'); ?></h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Actualizar', 'ui-panel-saas'); ?></a>
                                    <a href="javascript:void(0);" class="dropdown-item"><?php esc_html_e('Ver Todo', 'ui-panel-saas'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-alt pb-0">
                            <?php
                            // Obtener comentarios recientes
                            $recent_comments = get_comments(array(
                                'number' => 3,
                                'status' => 'approve'
                            ));
                            
                            // Obtener usuarios registrados recientemente
                            $recent_users = get_users(array(
                                'number' => 2,
                                'orderby' => 'registered',
                                'order' => 'DESC'
                            ));
                            
                            // Mezclar y ordenar por fecha
                            $activities = array();
                            
                            foreach ($recent_comments as $comment) {
                                $activities[] = array(
                                    'type' => 'comment',
                                    'date' => strtotime($comment->comment_date),
                                    'data' => $comment
                                );
                            }
                            
                            foreach ($recent_users as $user) {
                                $activities[] = array(
                                    'type' => 'user',
                                    'date' => strtotime($user->user_registered),
                                    'data' => $user
                                );
                            }
                            
                            // Ordenar por fecha de forma descendente
                            usort($activities, function($a, $b) {
                                return $b['date'] - $a['date'];
                            });
                            
                            // Mostrar actividades
                            foreach ($activities as $activity) :
                                if ($activity['type'] === 'comment') :
                                    $comment = $activity['data'];
                                    $comment_author = $comment->comment_author;
                                    $comment_post = get_post($comment->comment_post_ID);
                                    $time_diff = human_time_diff(strtotime($comment->comment_date), current_time('timestamp'));
                            ?>
                            <div class="timeline-item">
                                <i class="timeline-icon ri-message-2-line"></i>
                                <div class="timeline-item-info">
                                    <a href="<?php echo esc_url(get_comment_link($comment)); ?>" class="text-body fw-semibold mb-1 d-block">
                                        <?php echo esc_html($comment_author); ?>
                                    </a>
                                    <small>
                                        <?php
                                        printf(
                                            esc_html__('Comentó en "%s"', 'ui-panel-saas'),
                                            '<a href="' . esc_url(get_permalink($comment->comment_post_ID)) . '">' . esc_html(get_the_title($comment->comment_post_ID)) . '</a>'
                                        );
                                        ?>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">
                                            <?php echo sprintf(esc_html__('hace %s', 'ui-panel-saas'), $time_diff); ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <?php
                                elseif ($activity['type'] === 'user') :
                                    $user = $activity['data'];
                                    $time_diff = human_time_diff(strtotime($user->user_registered), current_time('timestamp'));
                            ?>
                            <div class="timeline-item">
                                <i class="timeline-icon ri-user-add-line"></i>
                                <div class="timeline-item-info">
                                    <a href="<?php echo esc_url(admin_url('user-edit.php?user_id=' . $user->ID)); ?>" class="text-body fw-semibold mb-1 d-block">
                                        <?php echo esc_html($user->display_name); ?>
                                    </a>
                                    <small><?php esc_html_e('Se registró como nuevo usuario', 'ui-panel-saas'); ?></small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">
                                            <?php echo sprintf(esc_html__('hace %s', 'ui-panel-saas'), $time_diff); ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <?php endif; endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- Fin de actividad reciente -->
                
                <!-- Resumen del sistema -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3"><?php esc_html_e('Información del Sistema', 'ui-panel-saas'); ?></h4>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0"><?php esc_html_e('Versión de WordPress', 'ui-panel-saas'); ?></p>
                                    <span class="badge bg-primary rounded-pill"><?php echo esc_html(get_bloginfo('version')); ?></span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0"><?php esc_html_e('Tema', 'ui-panel-saas'); ?></p>
                                    <span class="badge bg-primary rounded-pill"><?php echo esc_html(wp_get_theme()->get('Name')); ?></span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0"><?php esc_html_e('Plugins Activos', 'ui-panel-saas'); ?></p>
                                    <span class="badge bg-primary rounded-pill">
                                        <?php
                                        if (!function_exists('get_plugins')) {
                                            require_once ABSPATH . 'wp-admin/includes/plugin.php';
                                        }
                                        $all_plugins = get_plugins();
                                        $active_plugins = get_option('active_plugins', array());
                                        echo count($active_plugins) . '/' . count($all_plugins);
                                        ?>
                                    </span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0"><?php esc_html_e('PHP Versión', 'ui-panel-saas'); ?></p>
                                    <span class="badge bg-primary rounded-pill"><?php echo esc_html(phpversion()); ?></span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0"><?php esc_html_e('MySQL Versión', 'ui-panel-saas'); ?></p>
                                    <span class="badge bg-primary rounded-pill">
                                        <?php 
                                        global $wpdb;
                                        echo esc_html($wpdb->db_version());
                                        ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Fin de resumen del sistema -->
                
                <?php endif; ?>
            </div>
        </div>
        <!-- end row -->
    </div>
</main>

<script>
    (function($) {
        'use strict';
        
        $(document).ready(function() {
            // Configuración del gráfico de actividad
            if (document.getElementById('activity-chart')) {
                var ctx = document.getElementById('activity-chart').getContext('2d');
                
                // Datos de ejemplo para el gráfico
                // En una implementación real, estos datos vendrían de la base de datos o una API
                var activityData = {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    datasets: [
                        {
                            label: '<?php esc_html_e('Visitas', 'ui-panel-saas'); ?>',
                            data: [450, 380, 520, 690, 605, 535, 720, 830, 790, 850, 760, 695],
                            backgroundColor: 'rgba(79, 70, 229, 0.2)',
                            borderColor: 'rgba(79, 70, 229, 1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: '<?php esc_html_e('Páginas Vistas', 'ui-panel-saas'); ?>',
                            data: [650, 590, 710, 940, 820, 730, 950, 1100, 980, 1150, 1050, 940],
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                };
                
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: activityData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [2],
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
            
            // Puedes agregar más gráficos o funcionalidades aquí
        });
    })(jQuery);
</script>

<?php
get_footer();
