<?php
/**
 * Template Name: Dashboard
 * 
 * Template para mostrar un panel de control personalizado
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
        <!-- Título de la página -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group me-2">
                                <input type="text" class="form-control form-control-light" id="dash-daterange" value="<?php echo esc_attr(date_i18n('d M, Y', strtotime('-30 days')) . ' - ' . date_i18n('d M, Y')); ?>">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-todo-line"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="ri-refresh-line"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title"><?php the_title(); ?></h4>
                </div>
            </div>
        </div>
        
        <!-- Widgets de estadísticas -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo esc_attr__('Usuarios activos', 'ui-panel-saas'); ?>">
                                    <?php echo esc_html__('Usuarios activos', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="my-2 py-1">
                                    <?php 
                                    // Obtener número de usuarios activos
                                    $count_users = count_users();
                                    echo number_format_i18n($count_users['total_users']);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2">
                                        <i class="ri-arrow-up-line"></i> 5.27%
                                    </span>
                                    <span class="text-nowrap"><?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?></span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="ri-user-3-line text-primary font-20"></i>
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
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo esc_attr__('Nuevos visitantes', 'ui-panel-saas'); ?>">
                                    <?php echo esc_html__('Nuevos visitantes', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="my-2 py-1">
                                    <?php 
                                    // Simulación de datos para fines de demostración
                                    echo number_format_i18n(2389);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2">
                                        <i class="ri-arrow-down-line"></i> 3.68%
                                    </span>
                                    <span class="text-nowrap"><?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?></span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="ri-eye-line text-primary font-20"></i>
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
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo esc_attr__('Contenido publicado', 'ui-panel-saas'); ?>">
                                    <?php echo esc_html__('Contenido publicado', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="my-2 py-1">
                                    <?php
                                    // Contar posts y páginas publicados
                                    $count_posts = wp_count_posts();
                                    $count_pages = wp_count_posts('page');
                                    $total_published = $count_posts->publish + $count_pages->publish;
                                    echo number_format_i18n($total_published);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2">
                                        <i class="ri-arrow-up-line"></i> 8.21%
                                    </span>
                                    <span class="text-nowrap"><?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?></span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="ri-file-list-3-line text-primary font-20"></i>
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
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="<?php echo esc_attr__('Comentarios', 'ui-panel-saas'); ?>">
                                    <?php echo esc_html__('Comentarios', 'ui-panel-saas'); ?>
                                </h5>
                                <h3 class="my-2 py-1">
                                    <?php
                                    // Contar comentarios
                                    $comments_count = wp_count_comments();
                                    echo number_format_i18n($comments_count->total_comments);
                                    ?>
                                </h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2">
                                        <i class="ri-arrow-up-line"></i> 1.64%
                                    </span>
                                    <span class="text-nowrap"><?php echo esc_html__('Desde el mes pasado', 'ui-panel-saas'); ?></span>
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="ri-message-2-line text-primary font-20"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos y Widgets -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php echo esc_html__('Tendencia de visitantes', 'ui-panel-saas'); ?></h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Actualizar', 'ui-panel-saas'); ?></a>
                                    <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Exportar', 'ui-panel-saas'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="chart-content-bg">
                            <div class="row text-center">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0 mt-3"><?php echo esc_html__('Semana actual', 'ui-panel-saas'); ?></p>
                                    <h2 class="fw-normal mb-3">
                                        <span>1,284</span>
                                    </h2>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0 mt-3"><?php echo esc_html__('Semana anterior', 'ui-panel-saas'); ?></p>
                                    <h2 class="fw-normal mb-3">
                                        <span>1,189</span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="dash-item-overlay d-none d-md-block">
                            <h5>
                                <?php echo esc_html__('Este año', 'ui-panel-saas'); ?>:
                                <span class="text-primary">32,349 <?php echo esc_html__('Visitantes', 'ui-panel-saas'); ?></span>
                            </h5>
                        </div>

                        <div id="weekly-visitors-chart" class="apex-charts mt-3" style="min-height: 268px;">
                            <!-- Canvas para la gráfica -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php echo esc_html__('Fuentes de tráfico', 'ui-panel-saas'); ?></h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Actualizar', 'ui-panel-saas'); ?></a>
                                    <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Exportar', 'ui-panel-saas'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div id="traffic-sources-chart" class="apex-charts mb-3 mt-3" style="min-height: 248px;"></div>

                        <div class="chart-widget-list">
                            <p>
                                <i class="ri-checkbox-blank-circle-fill text-primary me-2"></i>
                                <?php echo esc_html__('Directo', 'ui-panel-saas'); ?>
                                <span class="float-end">45%</span>
                            </p>
                            <p>
                                <i class="ri-checkbox-blank-circle-fill text-success me-2"></i>
                                <?php echo esc_html__('Búsqueda', 'ui-panel-saas'); ?>
                                <span class="float-end">30%</span>
                            </p>
                            <p>
                                <i class="ri-checkbox-blank-circle-fill text-info me-2"></i>
                                <?php echo esc_html__('Redes sociales', 'ui-panel-saas'); ?>
                                <span class="float-end">15%</span>
                            </p>
                            <p class="mb-0">
                                <i class="ri-checkbox-blank-circle-fill text-warning me-2"></i>
                                <?php echo esc_html__('Enlaces', 'ui-panel-saas'); ?>
                                <span class="float-end">10%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Área de widgets personalizados desde WordPress -->
        <?php if (is_active_sidebar('dashboard')) : ?>
        <div class="row">
            <div class="col-12">
                <div class="dashboard-widgets">
                    <?php dynamic_sidebar('dashboard'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Actividad reciente y enlaces rápidos -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="header-title"><?php echo esc_html__('Actividad reciente', 'ui-panel-saas'); ?></h4>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><?php echo esc_html__('Ver todo', 'ui-panel-saas'); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-alt pb-0">
                            <?php
                            // Obtener actividad reciente (posts, comentarios, etc.)
                            $args = array(
                                'post_type' => 'any',
                                'posts_per_page' => 5,
                                'post_status' => 'publish',
                                'orderby' => 'date',
                                'order' => 'DESC',
                            );
                            $recent_posts = new WP_Query($args);
                            
                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) :
                                    $recent_posts->the_post();
                                    $post_type = get_post_type_object(get_post_type());
                                    
                                    // Icono según el tipo de contenido
                                    $icon_class = 'ri-file-list-line';
                                    
                                    if (get_post_type() === 'post') {
                                        $icon_class = 'ri-article-line';
                                        $bg_class = 'bg-primary-lighten text-primary';
                                    } elseif (get_post_type() === 'page') {
                                        $icon_class = 'ri-pages-line';
                                        $bg_class = 'bg-info-lighten text-info';
                                    } elseif (get_post_type() === 'attachment') {
                                        $icon_class = 'ri-image-line';
                                        $bg_class = 'bg-success-lighten text-success';
                                    } elseif (get_post_type() === 'product') { // WooCommerce
                                        $icon_class = 'ri-shopping-cart-line';
                                        $bg_class = 'bg-warning-lighten text-warning';
                                    } else {
                                        $bg_class = 'bg-primary-lighten text-primary';
                                    }
                            ?>
                                <div class="timeline-item">
                                    <i class="<?php echo esc_attr($icon_class . ' ' . $bg_class); ?> timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <a href="<?php the_permalink(); ?>" class="text-body fw-semibold mb-1 d-block">
                                            <?php the_title(); ?>
                                        </a>
                                        <small class="d-inline-block">
                                            <?php echo sprintf(
                                                esc_html__('%1$s creado por %2$s', 'ui-panel-saas'),
                                                esc_html($post_type->labels->singular_name),
                                                '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
                                            ); ?>
                                        </small>
                                        <p class="mb-0 pb-2">
                                            <small class="text-muted">
                                                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ' . esc_html__('atrás', 'ui-panel-saas'); ?>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                                <div class="text-center py-4">
                                    <i class="ri-information-line text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2"><?php echo esc_html__('No hay actividad reciente para mostrar.', 'ui-panel-saas'); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="header-title"><?php echo esc_html__('Enlaces rápidos', 'ui-panel-saas'); ?></h4>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <?php if (current_user_can('edit_posts')) : ?>
                                <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-add-line me-1"></i> <?php echo esc_html__('Crear nuevo post', 'ui-panel-saas'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (current_user_can('upload_files')) : ?>
                                <a href="<?php echo esc_url(admin_url('media-new.php')); ?>" class="btn btn-info waves-effect waves-light">
                                    <i class="ri-upload-2-line me-1"></i> <?php echo esc_html__('Subir medios', 'ui-panel-saas'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (current_user_can('edit_pages')) : ?>
                                <a href="<?php echo esc_url(admin_url('post-new.php?post_type=page')); ?>" class="btn btn-success waves-effect waves-light">
                                    <i class="ri-file-add-line me-1"></i> <?php echo esc_html__('Añadir página', 'ui-panel-saas'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (current_user_can('manage_options')) : ?>
                                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="btn btn-warning waves-effect waves-light">
                                    <i class="ri-settings-3-line me-1"></i> <?php echo esc_html__('Personalizar tema', 'ui-panel-saas'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="btn btn-danger waves-effect waves-light">
                                <i class="ri-logout-box-line me-1"></i> <?php echo esc_html__('Cerrar sesión', 'ui-panel-saas'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</main>

<!-- Incluir scripts para las gráficas -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ApexCharts !== 'undefined') {
            // Configuración de la gráfica de visitantes semanales
            var weeklyVisitorsOptions = {
                series: [{
                    name: '<?php echo esc_js(__('Esta semana', 'ui-panel-saas')); ?>',
                    data: [32, 42, 42, 62, 52, 75, 62]
                }, {
                    name: '<?php echo esc_js(__('Semana pasada', 'ui-panel-saas')); ?>',
                    data: [42, 58, 66, 93, 82, 105, 92]
                }],
                chart: {
                    height: 268,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#4F46E5', '#E0E0E0'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: [3, 3]
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'],
                        opacity: 0.2
                    },
                    borderColor: '#f1f1f1'
                },
                markers: {
                    size: 4
                },
                xaxis: {
                    categories: ['<?php echo esc_js(__('Lun', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Mar', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Mié', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Jue', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Vie', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Sáb', 'ui-panel-saas')); ?>', '<?php echo esc_js(__('Dom', 'ui-panel-saas')); ?>'],
                    tooltip: {
                        enabled: false
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };
            
            // Crear gráfica de visitantes semanales
            var weeklyVisitorsChart = new ApexCharts(document.querySelector("#weekly-visitors-chart"), weeklyVisitorsOptions);
            weeklyVisitorsChart.render();
            
            // Configuración de la gráfica de fuentes de tráfico
            var trafficSourcesOptions = {
                series: [45, 30, 15, 10],
                chart: {
                    height: 255,
                    type: 'donut'
                },
                labels: [
                    '<?php echo esc_js(__('Directo', 'ui-panel-saas')); ?>',
                    '<?php echo esc_js(__('Búsqueda', 'ui-panel-saas')); ?>',
                    '<?php echo esc_js(__('Redes sociales', 'ui-panel-saas')); ?>',
                    '<?php echo esc_js(__('Enlaces', 'ui-panel-saas')); ?>'
                ],
                colors: ['#4F46E5', '#10B981', '#3B82F6', '#F59E0B'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%'
                        }
                    }
                }
            };
            
            // Crear gráfica de fuentes de tráfico
            var trafficSourcesChart = new ApexCharts(document.querySelector("#traffic-sources-chart"), trafficSourcesOptions);
            trafficSourcesChart.render();
        }
        
        // Selector de rango de fechas
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#dash-daterange", {
                mode: "range",
                defaultDate: [
                    new Date(new Date().setDate(new Date().getDate() - 30)),
                    new Date()
                ]
            });
        }
    });
</script>

<?php
get_footer();
